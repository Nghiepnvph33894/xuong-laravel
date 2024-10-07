<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Employee::with('department', 'manager')
            ->latest('id')
            ->paginate(5);
        // dd($data);

        return view('employees.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $department = Department::pluck('name', 'id')->all();
        $manager = Manager::pluck('name', 'id')->all();
        // dd($department, $manager);

        return view('employees.create', compact('department', 'manager'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'department_id'   => 'required',
            'manager_id'      => 'required',
            'first_name'      => 'required|max:100',
            'last_name'       => 'required|max:100',
            'email'           => [
                'required',
                'max:150',
                Rule::unique('employees')
            ],
            'phone'           => 'required|max:15',
            'date_of_birth'   => 'required|date',
            'hire_date'       => 'required|date',
            'salary'          => 'required|numeric|min:0|max:9999999999.99',
            'is_active'       => [
                'nullable',
                Rule::in(0, 1)
            ],
            'address'         => 'required',
            'profile_picture' => 'nullable|image|max:10240',
        ]);

        
        try {
            if ($request->hasFile('profile_picture')) {
                $file = $request->file('profile_picture');

                $binaryData = file_get_contents($file->getRealPath());

                $data['profile_picture'] = $binaryData;
            }

            Employee::create($data);

            return redirect()->route('employees.index')
                ->with('success', true);
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return back()
                ->with('success', false)
                ->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $department = Department::pluck('name', 'id')->all();
        $manager = Manager::pluck('name', 'id')->all();

        return view('employees.edit', compact('employee', 'department', 'manager'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $data = $request->validate([
            'department_id'   => 'required',
            'manager_id'      => 'required',
            'first_name'      => 'required|max:100',
            'last_name'       => 'required|max:100',
            'email'           => [
                'required',
                'max:150',
                Rule::unique('employees')->ignore($employee->id)
            ],
            'phone'           => 'required|max:15',
            'date_of_birth'   => 'required',
            'hire_date'       => 'required',
            'salary'          => 'required|numeric|min:0|max:9999999999.99',
            'is_active'       => [
                'nullable',
                Rule::in(0, 1)
            ],
            'address'         => 'required',
            'profile_picture' => 'nullable|image|max:10240',
        ]);

        try {
            $data['is_active'] ??= 1;

            if ($request->hasFile('profile_picture')) {
                $file = $request->file('profile_picture');

                $binaryData = file_get_contents($file->getRealPath());

                $data['profile_picture'] = $binaryData;
            }

            $employee->update($data);

            return  back()
                ->with('success', true);
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return back()
                ->with('success', false)
                ->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        try {
            $employee->delete();

            return  back()
                ->with('success', true);
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return back()
                ->with('success', false)
                ->with('error', $th->getMessage());
        }
    }
}
