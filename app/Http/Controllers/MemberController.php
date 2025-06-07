<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ManagerProfile;
use App\Models\EmployeeProfile;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Log;

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
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'position' => 'required|string|max:255',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'branch' => 'required|string|max:255',
        'specify_branch' => 'nullable|string|max:255',
        'link' => 'nullable|url',
        'educbackground' => 'nullable|string',
        'keyskills' => 'nullable|string',
    ]);

    try {
        $managerProfile = new ManagerProfile();
        $managerProfile->name = $validatedData['name'];
        $managerProfile->position = $validatedData['position'];
        $managerProfile->branch = $validatedData['branch'];
        $managerProfile->specify_branch = $validatedData['specify_branch'] ?? null;
        $managerProfile->link = $validatedData['link'] ?? null;
        $managerProfile->educbackground = $validatedData['educbackground'] ?? null;
        $managerProfile->keyskills = $validatedData['keyskills'] ?? null;

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');

            // Debugging - log file details
            \Log::info('Uploading file:', [
                'name' => $file->getClientOriginalName(),
                'size' => $file->getSize(),
                'mime' => $file->getMimeType()
            ]);

            // Create directory if it doesn't exist
            $uploadPath = public_path('uploads/managers_profile');

            if (!file_exists($uploadPath)) {
                \Log::info('Creating directory: ' . $uploadPath);
                if (!mkdir($uploadPath, 0755, true)) {
                    throw new \Exception('Failed to create directory: ' . $uploadPath);
                }
            }

            // Verify directory is writable
            if (!is_writable($uploadPath)) {
                throw new \Exception('Upload directory is not writable: ' . $uploadPath);
            }

            // Generate unique filename
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $fullPath = $uploadPath . '/' . $fileName;

            // Move uploaded file
            if ($file->move($uploadPath, $fileName)) {
                $managerProfile->profile_picture = 'uploads/managers_profile/' . $fileName;
                \Log::info('File uploaded successfully to: ' . $fullPath);
            } else {
                throw new \Exception('Failed to move uploaded file to ' . $fullPath);
            }
        }

        $managerProfile->save();
        return redirect()->back()->with('success', 'Branch Manager added successfully!');

    } catch (\Exception $e) {
        \Log::error('Error storing manager profile: ' . $e->getMessage());
        \Log::error('Stack trace: ' . $e->getTraceAsString());

        return redirect()->back()
            ->with('error', 'Error adding Branch Manager: ' . $e->getMessage())
            ->withInput();
    }
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
            'educationback' => 'nullable|string',
            'keyskills' => 'nullable|string',
        ]);

        $employeeProfile = new EmployeeProfile();
        $employeeProfile->name = $validatedData['name'];
        $employeeProfile->manager_profile_id = $validatedData['manager_profile_id'] ?? null;
        $employeeProfile->branch = $validatedData['branch'];
        $employeeProfile->position = $validatedData['position'];
        $employeeProfile->educationback = $validatedData['educationback'] ?? null;
        $employeeProfile->keyskills = $validatedData['keyskills'] ?? null;
        $employeeProfile->link = $validatedData['link'] ?? null;

        if ($request->hasFile('profile_picture_employee')) {
            try {
                $file = $request->file('profile_picture_employee');

                // Create upload directory if it doesn't exist
                $uploadPath = public_path('uploads/employees');
                if (!file_exists($uploadPath)) {
                    if (!mkdir($uploadPath, 0755, true)) {
                        Log::error('Failed to create employee directory: ' . $uploadPath);
                        return redirect()->back()->with('error', 'Failed to create upload directory.');
                    }
                }

                // Check if directory is writable
                if (!is_writable($uploadPath)) {
                    Log::error('Employee directory not writable: ' . $uploadPath);
                    return redirect()->back()->with('error', 'Upload directory is not writable.');
                }

                // Generate unique filename
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Move file to public directory
                if ($file->move($uploadPath, $fileName)) {
                    $employeeProfile->profile_picture = 'uploads/employees/' . $fileName;
                } else {
                    return redirect()->back()->with('error', 'Failed to upload employee file.');
                }

            } catch (\Exception $e) {
                Log::error('Employee file upload error: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Error uploading employee file: ' . $e->getMessage());
            }
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
            'specify_branch' => 'nullable|string|max:255',
            'keyskills' => 'nullable|string',
            'link' => 'nullable|url',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('profile_picture')) {
            try {
                // Delete old image if exists
                if ($manager->profile_picture) {
                    $oldPhotoPath = public_path($manager->profile_picture);
                    if (file_exists($oldPhotoPath)) {
                        unlink($oldPhotoPath);
                    }
                }

                $file = $request->file('profile_picture');

                // Create upload directory if it doesn't exist
                $uploadPath = public_path('uploads/managers_profile');
                if (!file_exists($uploadPath)) {
                    if (!mkdir($uploadPath, 0755, true)) {
                        return redirect()->back()->with('error', 'Failed to create upload directory.');
                    }
                }

                // Generate unique filename
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Move file to public directory
                if ($file->move($uploadPath, $fileName)) {
                    $validated['profile_picture'] = 'uploads/managers_profile/' . $fileName;
                } else {
                    return redirect()->back()->with('error', 'Failed to upload file.');
                }

            } catch (\Exception $e) {
                Log::error('Manager update file upload error: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Error uploading file: ' . $e->getMessage());
            }
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

        $updateData = [
            'name' => $validated['name'],
            'position' => $validated['position'],
            'educationback' => $request->input('educationback'),
            'keyskills' => $request->input('keyskills'),
            'link' => $validated['link']
        ];

        if ($request->hasFile('profile_picture_employee')) {
            try {
                // Delete old image if exists
                if ($employee->profile_picture) {
                    $oldPhotoPath = public_path($employee->profile_picture);
                    if (file_exists($oldPhotoPath)) {
                        unlink($oldPhotoPath);
                    }
                }

                $file = $request->file('profile_picture_employee');

                // Create upload directory if it doesn't exist
                $uploadPath = public_path('uploads/employees');
                if (!file_exists($uploadPath)) {
                    if (!mkdir($uploadPath, 0755, true)) {
                        return redirect()->back()->with('error', 'Failed to create upload directory.');
                    }
                }

                // Generate unique filename
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Move file to public directory
                if ($file->move($uploadPath, $fileName)) {
                    $updateData['profile_picture'] = 'uploads/employees/' . $fileName;
                } else {
                    return redirect()->back()->with('error', 'Failed to upload file.');
                }

            } catch (\Exception $e) {
                Log::error('Employee update file upload error: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Error uploading file: ' . $e->getMessage());
            }
        }

        $employee->update($updateData);

        return redirect()->back()->with('success', 'Employee profile updated successfully');
    }

    // Delete a Branch Manager
    public function deleteManagerProfile($id)
    {
        $manager = ManagerProfile::findOrFail($id);

        // Delete associated image file
        if ($manager->profile_picture) {
            $imagePath = public_path($manager->profile_picture);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $manager->delete();
        return redirect()->back()->with('success', 'Branch Manager deleted successfully!');
    }

    public function deleteEmployeeProfile($id)
    {
        $employee = EmployeeProfile::findOrFail($id);

        // Delete associated image file
        if ($employee->profile_picture) {
            $imagePath = public_path($employee->profile_picture);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

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
        $managerProfiles = ManagerProfile::where('manager_name', $manager_name)->get();

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
        $recruit = ContactUs::findOrFail($id);

        if ($recruit) {
            $recruit->delete();
            return redirect()->back()->with('success', 'Recruit deleted successfully.');
        }

        return redirect()->back()->with('error', 'Recruit not found.');
    }
}
