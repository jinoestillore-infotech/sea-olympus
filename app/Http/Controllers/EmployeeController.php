<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;

class EmployeeController extends Controller
{
    /**
     * Show create employee form
     */
    public function create($departmentId)
    {
        $department = Department::findOrFail($departmentId);
        return view('employees.create', compact('department'));
    }

    /**
     * Store employee
     */
    public function store(Request $request)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'first_name'    => 'required|max:100',
            'last_name'     => 'required|max:100',
            'email'         => 'required|email|unique:employees,email',
            'phone'         => 'nullable|max:20',
            'position'      => 'nullable|max:100',
            'hire_date'     => 'nullable|date',
            'salary'        => 'nullable|numeric',
            'status'        => 'required|in:active,inactive',
        ]);

        Employee::create($request->all());

        return redirect()
            ->route('departments.show', $request->department_id)
            ->with('success', 'Employee added successfully.');
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update employee
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $request->validate([
            'first_name' => 'required|max:100',
            'last_name'  => 'required|max:100',
            'email'      => 'required|email|unique:employees,email,' . $employee->id,
            'phone'      => 'nullable|max:20',
            'position'   => 'nullable|max:100',
            'hire_date'  => 'nullable|date',
            'salary'     => 'nullable|numeric',
            'status'     => 'required|in:active,inactive',
        ]);

        $employee->update($request->all());

        return redirect()
            ->route('departments.show', $employee->department_id)
            ->with('success', 'Employee updated successfully.');
    }

    /**
     * Delete employee
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $departmentId = $employee->department_id;

        $employee->delete();

        return redirect()
            ->route('departments.show', $departmentId)
            ->with('success', 'Employee deleted successfully.');
    }
}
