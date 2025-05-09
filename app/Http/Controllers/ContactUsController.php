<?php

namespace App\Http\Controllers;

use App\Models\ManagerProfile;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AcceptMail;
use App\Mail\DeclineMail;
use Illuminate\Support\Facades\Storage;

class ContactUsController extends Controller
{
    // Show the contact us form
    public function showForm()
    {
        $managerProfiles = ManagerProfile::all();

        return view('join', compact('managerProfiles'));
    }

    // Show pending inquiries
    public function showInquiry()
    {
        $inquiries = ContactUs::where('status', 'pending')->get(); // Adjust query as needed


        return view('inquiries.index', compact('inquiries'));
    }

    // Submit a new inquiry
    public function submit(Request $request)
    {
        $request->validate([
            'inquiry_type' => 'required|string',
            'job_type' => 'nullable|string',
            'manager_type' => 'nullable|string',
            'branch' => 'nullable|string',
            'hear_from_us' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'message' => 'required|string',
            'specify_manager' => 'nullable|string',
            'specify_branch' => 'nullable|string',
            'consent' => 'accepted',
        ]);

        ContactUs::create([
            'inquiry_type' => $request->input('inquiry_type'),
            'job_type' => $request->input('job_type'),
            'manager_name' => $request->input('manager_type'),
            'branch' => $request->input('branch'),
            'hear_from_us' => $request->input('hear_from_us'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'message' => $request->input('message'),
            'specify_manager' => $request->input('specify_manager'), // Add this line
            'specify_branch' => $request->input('specify_branch'), // Add this line
            'status' => 'pending',
        ]);

        return redirect()->route('join')->with('success', 'Your message has been sent successfully!');
    }


     // Show the edit form for a specific inquiry
     public function edit(ContactUs $contactUs)
     {
         return view('inquiries.edit', compact('contactUs'));
     }

     // Update a specific inquiry
     public function update(Request $request, $id)
     {
         $request->validate([
             'inquiry_type' => 'required|string',
             'job_type' => 'nullable|string',
             'manager_type' => 'nullable|string',
             'specify_manager' => 'nullable|string',
             'specify_branch' => 'nullable|string',
             'branch' => 'nullable|string', // Make branch nullable
             'hear_from_us' => 'required|string',
             'name' => 'required|string',
             'email' => 'required|email',
             'phone' => 'required|string',
             'message' => 'required|string',
             'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation as needed
         ]);

         $contactUs = ContactUs::findOrFail($id);

         // Handle file upload
         if ($request->hasFile('profile_picture')) {
             // Delete old profile picture if exists
             if ($contactUs->profile_picture) {
                 Storage::delete($contactUs->profile_picture);
             }

             // Store new profile picture
             $path = $request->file('profile_picture')->store('profile_pictures', 'public');
             $contactUs->profile_picture = $path;
         }

         // Update other fields
         $contactUs->inquiry_type = $request->inquiry_type;
         $contactUs->job_type = $request->job_type;
         $contactUs->manager_name = $request->manager_type;
         $contactUs->specify_manager = $request->specify_manager;
         $contactUs->specify_branch = $request->specify_branch;
         $contactUs->branch = $request->branch; // Update branch
         $contactUs->hear_from_us = $request->hear_from_us;
         $contactUs->name = $request->name;
         $contactUs->email = $request->email;
         $contactUs->phone = $request->phone;
         $contactUs->message = $request->message;
         $contactUs->specify_manager = $request->specify_manager;
         $contactUs->consent = $request->has('consent'); // Update consent

         // Save changes
         $contactUs->save();

         return redirect()->route('inquiries.index')->with('success', 'Inquiry updated successfully!');
     }

    // Accept an inquiry and send acceptance email
    public function accept(ContactUs $contactUs)
    {
        $contactUs->status = 'accepted';
        $contactUs->save();

        // Send acceptance email
        Mail::to($contactUs->email)->send(new AcceptMail($contactUs));

        return redirect()->route('inquiries.index')->with('success', 'Inquiry accepted successfully and email sent.');
    }

    // Decline an inquiry and send decline email
    public function decline($id)
    {
        $contactUs = ContactUs::findOrFail($id);
        $contactUs->status = 'declined';
        $contactUs->save();

        // Send decline email
        Mail::to($contactUs->email)->send(new DeclineMail($contactUs));

        return redirect()->route('inquiries.index')->with('success', 'Inquiry declined successfully and email sent.');
    }

    // Fetch the branch of a selected manager
    public function getManagerBranch(Request $request)
    {
        $managerName = $request->input('manager_name');

        // Find the manager by name
        $manager = ManagerProfile::where('name', $managerName)->first();

        if ($manager) {
            return response()->json(['branch' => $manager->branch]);
        }
        return response()->json(['branch' => ''], 404); // Manager not found
    }
}
