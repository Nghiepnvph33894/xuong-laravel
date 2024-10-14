<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Student::with(['passport', 'classroom', 'subjects'])
        ->latest('id')->paginate(1);

        // dd($data->toArray());

        return view('students.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classroom = Classroom::pluck('name', 'id')->all();
        $subject = Subject::pluck('name', 'id')->all();

        return view('students.create', compact('classroom', 'subject'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'classroom_id'     => 'required|exists:classrooms,id',
            'name'             => 'required|max:255',
            'email'            => 'required|max:255',

            'passport_number'  => 'required|string',
            'issued_date'      => 'required|date',
            'expiry_date'      => 'required|date',

            'subjects'         => 'required|array',
            'subjects.*'       => 'exists:subjects,id',
        ]);

        try {

            DB::transaction(function () use ($request) {
                $student = Student::create($request->only('name', 'email', 'classroom_id'));

                $student->passport()->create($request->only('passport_number', 'issued_date', 'expiry_date'));

                $student->subjects()->attach($request->input('subjects'));
            });

            return redirect()->route('students.index')
                ->with('success', true);
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('success', false);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $student->load(['passport', 'classroom', 'subjects']);
        
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $classroom = Classroom::pluck('name', 'id')->all();
        $subject = Subject::pluck('name', 'id')->all();

        return view('students.edit', compact('student', 'classroom', 'subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'classroom_id'     => 'required|exists:classrooms,id',
            'name'             => 'required|max:255',
            'email'            => 'required|max:255',

            'passport_number'  => 'required|string',
            'issued_date'      => 'required|date',
            'expiry_date'      => 'required|date',

            'subjects'         => 'required|array',
            'subjects.*'       => 'exists:subjects,id',
        ]);

        try {

            DB::transaction(function () use ($request, $student) {
                $student->update($request->only('name', 'email', 'classroom_id'));

                $student->passport()->update(
                    $request->only('passport_number', 'issued_date', 'expiry_date')
                );


                $student->subjects()->sync($request->input('subjects'));
            });

            return back()->with('success', true);
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('success', false);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        try {

            $student->delete();

            return back()->with('success', true);
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('success', false);
        }
    }
}
