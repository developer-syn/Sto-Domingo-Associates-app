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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url',
            'specify_branch' => 'nullable|max:255',
            'educbackground' => 'nullable|string|max:1255', // Ensure educbackground is validated
            'keyskills' => 'nullable|string|max:1255', // Ensure keyskills is validated
        ]);

        $manager = ManagerProfile::findOrFail($id);
        $manager->name = $validatedData['name'];
        $manager->position = $validatedData['position'];
        $manager->educbackground = $validatedData['educbackground']; // Update the educbackground
        $manager->keyskills = $validatedData['keyskills']; // Update the keyskills
        $manager->link = $validatedData['link'] ?? null;
        $manager->specify_branch = $validatedData['specify_branch'] ?? null;

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('manager_profiles', 'public');
            $manager->profile_picture = $path;
        }

        $manager->save();
        return redirect()->back()->with('success', 'Branch Manager updated successfully!');
    }



    // Delete a Branch Manager
    public function deleteManagerProfile($id)
    {
        $manager = ManagerProfile::findOrFail($id);
        $manager->delete();
        return redirect()->back()->with('success', 'Branch Manager deleted successfully!');
    }

    // Update an Employee
    public function updateEmployeeProfile(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'profile_picture_employee' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'position' => 'required|string|max:255', // Ensure position is validated
            'educationback' => 'nullable|string', // Ensure educbackground is validated
            'keyskills' => 'nullable|string', // Ensure keyskills is validated
            'link' => 'nullable|url', // Validate link as a URL
        ]);

        $employee = EmployeeProfile::findOrFail($id);
        $employee->name = $validatedData['name'];
        $employee->position = $validatedData['position']; // Update the position
        $employee->educationback = $validatedData['educationback']; // Update the educbackground
        $employee->keyskills = $validatedData['keyskills']; // Update the keyskills
        $employee->link = $validatedData['link'] ?? null; // Update the link

        if ($request->hasFile('profile_picture_employee')) {
            $path = $request->file('profile_picture_employee')->store('employee_profiles', 'public');
            $employee->profile_picture = $path;
        }

        $employee->save();
        return redirect()->back()->with('success', 'Employee updated successfully!');
    }

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
        $employeeProfiles = EmployeeProfile::where('manager_profile_id', $managerId)->get();

        return response()->json($employeeProfiles);
    }

    // Fetch branch data
    public function fetchBranchData($branch)
    {
        $managers = ManagerProfile::where('branch', $branch)->get();
        $employees = EmployeeProfile::where('branch', $branch)->get();

        return response()->json([
            'branch' => $branch,
            'managers' => $managers,
            'employees' => $employees
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
