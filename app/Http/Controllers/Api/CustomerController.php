<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Customer::latest('id')->paginate(5);

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|max:255',
            'address'   => 'required|max:255',
            'avatar'    => 'nullable|max:2048|image',
            'phone'     => [
                'required',
                'string',
                'max:20',
                Rule::unique('customers')
            ],
            'email'     => 'required|email|max:100',
            'is_active' => [
                'nullable',
                Rule::in(0, 1)
            ],
        ]);

        try {
            if ($request->hasFile('avatar')) {
                $data['avatar'] = Storage::put('customers', $request->file('avatar'));
            }

            $customer =  Customer::query()->create($data);

            return response()->json([
                'data' => $customer
            ], 201);
            //code...
        } catch (\Throwable $th) {
            if (!empty($data['avatar']) && Storage::exists($data['avatar'])) {
                Storage::delete($data['avatar']);
            }

            return response()->json([], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::find($id);

        return response()->json([
            'data' => $customer
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name'      => 'required|max:255',
            'address'   => 'required|max:255',
            'avatar'    => 'nullable|max:2048|image',
            'phone'     => [
                'required',
                'string',
                'max:20',
                Rule::unique('customers')->ignore($id)
            ],
            'email'     => 'required|email|max:100',
            'is_active' => [
                'nullable',
                Rule::in(0, 1)
            ],
        ]);

        $customer = Customer::find($id);

        try {
            $data['is_active'] ??= 0;

            if ($request->hasFile('avatar')) {
                $data['avatar'] = Storage::put('customers', $request->file('avatar'));
            }

            $customer->update($data);

            $currentAvatar = $customer->avatar;

            if (
                $request->hasFile('avatar')
                && !empty($currentAvatar)
                && Storage::exists($currentAvatar)
            ) {
                Storage::delete($currentAvatar);
            }

            return response()->json([
                'data' => $customer
            ], 200);
            //code...
        } catch (\Throwable $th) {
            if (!empty($data['avatar']) && Storage::exists($data['avatar'])) {
                Storage::delete($data['avatar']);
            }

            return response()->json([], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
