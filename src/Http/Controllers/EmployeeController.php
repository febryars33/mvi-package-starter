<?php

namespace MVI\Starter\Http\Controllers;

use Illuminate\Http\Request;
use MVI\Starter\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $employee = Employee::with(relations: 'role');

        if ($request->query(key: 'search')) {
            $employee->where(
                column: 'name',
                operator: 'LIKE',
                value: '%' . $request->query('search') . '%'
            );
        }

        return response()->json(
            data: [
                'data'  =>  $employee->get()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation(request: $request);

        // $employee = Employee::create([
        //     'role_id'   =>  $request->role_id,
        //     'name'      =>  $request->name,
        //     'status'    =>  $request->boolean,
        // ]);

        return response()->json(
            data: [
                'message'   =>  'New employee data has beed successfully created.',
                'data'  =>  $request->all()
            ],
            status: 201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::with(relations: 'role')->find(id: $id);

        if (!$employee) {
            return response()->json(
                data: [
                    'message'   =>  'Employee data not found.'
                ],
                status: 404
            );
        }

        return response()->json(
            data: [
                'data'  =>  $employee
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validation(request: $request);

        $employee = Employee::with(relations: 'role')->find(id: $id);

        if (!$employee) {
            return response()->json(
                data: [
                    'message'   =>  'Employee data not found.'
                ],
                status: 404
            );
        }

        // $employee->role_id  =   '';
        // $employee->name     =   '';
        // $employee->status   =   '';

        // $employee->save();

        return response()->json(
            data: [
                'data'  =>  $request->all()
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::with(relations: 'role')->find(id: $id);

        if (!$employee) {
            return response()->json(
                data: [
                    'message'   =>  'Employee data not found.'
                ],
                status: 404
            );
        }

        // $employee->delete();

        return response()->json(data: [
            'data'  =>  $employee,
            'message'   =>  'Employee ' . strtoupper($employee->name) . ' has been deleted.'
        ]);
    }

    protected function validation(Request $request)
    {
        $request->validate(rules: [
            'role_id'   =>  [
                'required', 'integer'
            ],
            'name'  =>  [
                'required', 'string'
            ],
            'status'    =>  [
                'required', 'boolean'
            ]
        ]);
    }
}
