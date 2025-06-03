<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ManagerProfile;
use App\Models\EmployeeProfile;
use App\Models\ContactUs;

class MemberController extends Controller
{
    // Display manager and employee profiles for a specific branch
    public function showBranch($branch)
    {
        $managerProfiles = ManagerProfile::where('branch', $branch)->get();
        $employeeProfiles = EmployeeProfile::where('branch', $branch)->get();

        // Get accepted recruits where either 'branch' or 'specify_branch' matches the branch
        $acceptedRecruits = ContactUs::where('status', 'accepted')
            ->where(function ($query) use ($branch) {
                $query->where('branch', $branch)
                    ->orWhere('specify_branch', $branch);
            })
            ->get();

        return view('members.' . $branch, [
            'managerProfiles' => $managerProfiles,
            'employeeProfiles' => $employeeProfiles,
            'acceptedRecruits' => $acceptedRecruits
        ]);
    }

    // Store a new branch manager
    public function storeManagerProfile(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'branch' => 'required|string|max:255',
            'specify_branch' => 'nullable|max:255',
            'link' => 'nullable|url',
            'educbackground' => 'nullable|string', // Allow HTML content
            'keyskills' => 'nullable|string',       // Allow HTML content
        ]);

        // Create a new ManagerProfile instance
        $managerProfile = new ManagerProfile();
        $managerProfile->name = $validatedData['name'];
        $managerProfile->position = $validatedData['position'];
        $managerProfile->branch = $validatedData['branch'];

        // Assign educational background and key skills, allowing HTML content
        $managerProfile->educbackground = $validatedData['educbackground'] ?? null; // Handle possible null
        $managerProfile->keyskills = $validatedData['keyskills'] ?? null; // Handle possible null

        // Assign 'link' and 'specify_branch' if they exist
        $managerProfile->link = $validatedData['link'] ?? null;
        $managerProfile->specify_branch = $validatedData['specify_branch'] ?? null;

        // Handle the profile picture upload if it exists
        if ($request->hasFile('profile_picture')) {
            // Store the profile picture in the 'manager_profiles' folder
            $path = $request->file('profile_picture')->store('manager_profiles', 'public');
            $managerProfile->profile_picture = $path;
        }

        // Save the manager profile to the database
        $managerProfile->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Branch Manager added successfully!');
    }

    // Store a new employee
    public function storeEmployeeProfile(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'profile_picture_employee' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'manager_profile_id' => 'nullable|exists:manager_profiles,id',
            'branch' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'link' => 'nullable|url',
            'educationback' => 'nullable|string', // Allow HTML content
            'keyskills' => 'nullable|string',       // Allow HTML content
        ]);

        // dd($validatedData);

        $employeeProfile = new EmployeeProfile();
        $employeeProfile->name = $validatedData['name'];
        $employeeProfile->manager_profile_id = $validatedData['manager_profile_id'] ?? null;
        $employeeProfile->branch = $validatedData['branch'];
        $employeeProfile->position = $validatedData['position'];
        // Assign educational background and key skills, allowing HTML content
        $employeeProfile->educationback = $validatedData['educationback'] ?? null; // Handle possible null
        $employeeProfile->keyskills = $validatedData['keyskills'] ?? null; // Handle possible null
        $employeeProfile->link = $validatedData['link'] ?? null;

        if ($request->hasFile('profile_picture_employee')) {
            $path = $request->file('profile_picture_employee')->store('employee_profiles', 'public');
            $employeeProfile->profile_picture = $path;
        }

        $employeeProfile->save();

        return redirect()->back()->with('success', 'Employee added successfully!');
    }


    // Update a Branch Manager

public function updateManagerProfile(Request $request, $id)
{
    $manager = ManagerProfile::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'position' => 'required|string|max:255',
        'educbackground' => 'nullable|string',
        'keyskills' => 'nullable|string',
        'link' => 'nullable|url',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    if ($request->hasFile('profile_picture')) {
        // Delete old image if exists
        if ($manager->profile_picture) {
            Storage::delete('public/' . $manager->profile_picture);
        }
        $path = $request->file('profile_picture')->store('profile_pictures', 'public');
        $validated['profile_picture'] = $path;
    }

    $manager->update($validated);

    return redirect()->back()->with('success', 'Manager profile updated successfully');
}

public function updateEmployeeProfile(Request $request, $id)
{
    $employee = EmployeeProfile::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'position' => 'required|string|max:255',
        'educationback' => 'nullable|string',
        'keyskills' => 'nullable|string',
        'link' => 'nullable|url',
        'profile_picture_employee' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    if ($request->hasFile('profile_picture_employee')) {
        // Delete old image if exists
        if ($employee->profile_picture) {
            Storage::delete('public/' . $employee->profile_picture);
        }
        $path = $request->file('profile_picture_employee')->store('employee_pictures', 'public');
        $validated['profile_picture'] = $path;
    }

    $employee->update($validated);

    return redirect()->back()->with('success', 'Employee profile updated successfully');
}


    // Delete a Branch Manager
    public function deleteManagerProfile($id)
    {
        $manager = ManagerProfile::findOrFail($id);
        $manager->delete();
        return redirect()->back()->with('success', 'Branch Manager deleted successfully!');
    }

    // Update an Employee
    /* Duplicate updateEmployeeProfile method removed to resolve duplicate symbol error. */

    // Delete an Employee
    public function deleteEmployeeProfile($id)
    {
        $employee = EmployeeProfile::findOrFail($id);
        $employee->delete();

        return redirect()->back()->with('success', 'Employee deleted successfully!');
    }

    // Show employees for a manager
    public function showEmployees($managerId)
    {
        try {
            $employeeProfiles = EmployeeProfile::where('manager_profile_id', $managerId)
                ->select('id', 'name', 'position', 'profile_picture', 'link', 'educationback', 'keyskills')
                ->get();

            return response()->json($employeeProfiles, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error fetching employees'], 500);
        }
    }

    // Fetch branch data
    public function fetchBranchData($branch)
    {
        $managers = ManagerProfile::where('branch', $branch)
            ->select('id', 'name', 'position', 'profile_picture', 'branch', 'specify_branch', 'link', 'educbackground', 'keyskills')
            ->get();

        return response()->json([
            'branch' => $branch,
            'managers' => $managers
        ]);
    }

    public function getAccepted($manager_name)
    {
        $acceptedRecruits = ContactUs::where('status', 'accepted')->get();
        $managerProfiles = ManagerProfile::where('manager_name', $manager_name)->get(); // Fetch manager profiles

        return view('members.' . $manager_name, compact('acceptedRecruits', 'managerProfiles'));
    }

    // Get employees for a specific branch and manager
    public function getEmployees($branch, Request $request)
    {
        $managerId = $request->input('manager_id');

        $employees = EmployeeProfile::where('branch', $branch)
            ->where('manager_profile_id', $managerId)
            ->get();

        return response()->json(['employees' => $employees]);
    }

    public function destroyNewRecruit($id)
    {
        // Find the recruit by ID and delete
        $recruit = ContactUs::findOrFail($id);

        if ($recruit) {
            $recruit->delete();
            return redirect()->back()->with('success', 'Recruit deleted successfully.');
        }

        return redirect()->back()->with('error', 'Recruit not found.');
    }
}
