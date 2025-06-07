<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // Method to show the list of employees
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    // Show the form for creating a new employee
    public function create()
    {
        return view('employees.form');
    }

    // Store a new employee
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'sex' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:employees',
            'phone_number' => 'required|string|max:15',
            'age' => 'required|integer|min:18',
            'position' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:10000',
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');

            // Create upload directory if it doesn't exist
            $uploadPath = public_path('uploads/employees');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            // Generate unique filename
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Move file to public directory
            $file->move($uploadPath, $fileName);

            $validated['profile_picture'] = 'uploads/employees/' . $fileName;
        }

        // If middle_name is null, set it to an empty string
        $validated['middle_name'] = $validated['middle_name'] ?? '';

        // Create employee record
        Employee::create($validated);

        return redirect()->route('employees.index')->with('success', 'Employee added successfully.');
    }

    // Show the form for editing an employee
    public function edit(Employee $employee)
    {
        return view('employees.form', compact('employee'));
    }

    // Update an employee
    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:employees,email,' . $employee->id,
            'sex' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'age' => 'required|integer|min:18',
            'position' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // If middle_name is null or empty, set it to an empty string
        $validated['middle_name'] = $request->middle_name ?? '';

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete the old profile picture if it exists
            if ($employee->profile_picture) {
                $oldPhotoPath = public_path($employee->profile_picture);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }

            $file = $request->file('profile_picture');

            // Create upload directory if it doesn't exist
            $uploadPath = public_path('uploads/employees');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            // Generate unique filename
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Move file to public directory
            $file->move($uploadPath, $fileName);

            $validated['profile_picture'] = 'uploads/employees/' . $fileName;
        }

        // Update the employee
        $employee->update($validated);

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully');
    }

    // Delete an employee
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);

        // Delete the profile picture if it exists
        if ($employee->profile_picture) {
            $photoPath = public_path($employee->profile_picture);
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
        }

        // Delete employee
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully');
    }
}
