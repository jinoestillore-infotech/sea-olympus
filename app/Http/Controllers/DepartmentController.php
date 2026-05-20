<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    // Display all departments
    public function index()
    {
        $departments = Department::orderBy('name', 'asc')->get();
        return view('departments.index', compact('departments'));
    }

    // Show create form
    public function create()
    {
        return view('departments.create');
    }

    // Save department
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100|unique:departments,name',
            'description' => 'nullable'
        ]);

        Department::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('departments.index')
            ->with('success', 'Department added successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return view('departments.edit', compact('department'));
    }

    // Update department
    public function update(Request $request, $id)
    {
        $department = Department::findOrFail($id);

        $request->validate([
            'name' => 'required|max:100|unique:departments,name,' . $department->id,
            'description' => 'nullable'
        ]);

        $department->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('departments.index')
            ->with('success', 'Department updated successfully.');
    }

    // Delete department
    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return redirect()->route('departments.index')
            ->with('success', 'Department deleted successfully.');
    }

    public function show(Request $request, $id)
    {
        $department = Department::findOrFail($id);

        $search = $request->search;

        $employees = Employee::where('department_id', $department->id)
            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('position', 'like', "%{$search}%");

                });

            })
            ->orderBy('last_name')
            ->get();

        return view('departments.show', compact('department', 'employees'));
    }

}
