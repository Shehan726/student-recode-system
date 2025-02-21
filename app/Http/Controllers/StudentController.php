<?php

namespace App\Http\Controllers;

use App\Events\Test;
use App\Models\Student;
use App\Models\User;
use App\Notifications\StudentRegisteredNotification;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function register(Request $request)
    {
            $student = Student::create([
                'first_name' => $request->first_name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            // Send notification to the admin
            $admin = User::first(); // Assuming you notify the first admin
            if ($admin) {
                $admin->notify(new StudentRegisteredNotification($student));
            }

        //     return response()->json(['message' => 'Student registered successfully']);

        // Notify Admins
        // $admins = User::where('role', 'admin')->get();
        // foreach ($admins as $admin) {
        //     $admin->notify(new StudentRegisteredNotification($student));
        // }

        // return response()->json([
        //     'message' => 'Student registered successfully, and admin has been notified.'
        // ]);
    }



    public function create()
    {
        return view('student.register');
    }
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:students',
            'contact_no' => 'required|string|max:20|regex:/^\d+$/', // Only numbers, max 20 chars
            'nic' => 'required',
            'type' => 'required|in:Class A,Class B', // Add validation for the type field
            'address' => 'required',
            'date_of_birth' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'pdf' => 'nullable|mimes:pdf|max:5120', // PDF validation (Max: 5MB)

        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('students', 'public');
        }

        // Handle PDF upload
        $pdfPath = null;
        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')->store('students/pdfs', 'public');
        }


        Student::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'contact_no' => $request->contact_no,
            'nic' => $request->nic,
            'type' => $request->type,  // Make sure this line is added
            'address' => $request->address,
            'date_of_birth' => $request->date_of_birth,
            'image' => $imagePath,
            'pdf' => $pdfPath, // Store PDF path
        ]);

        $user = User::find(9); // Get the first user (or change this logic as needed)
        

        Notification::make()
            ->title('Student Registered to the System')
            ->body('Registred By')
            ->success()
            ->sendToDatabase($user);
        event(Test($user));

        return response()->json(['message' => 'Notification sent successfully!']);

        // return redirect()->back()->with('success', 'Registration Successful');
    }

    //  /**
    //  * Handle student application resubmission.
    //  */
    // public function resubmit(Request $request, Student $student)
    // {
    //     $validatedData = $request->validate([
    //         'name' => 'sometimes|required|string',
    //         'email' => 'sometimes|required|email',
    //         'phone' => 'sometimes|required|string',
    //     ]);

    //     // Update only the resubmitted fields
    //     $student->update($validatedData + ['status' => 'pending', 'rejected_fields' => null]);

    //     return back()->with('success', 'Application resubmitted successfully.');
    // }

    // public function notifyAdmin()
    // {
    //     $admin = User::find(1); // Assuming user ID 1 is the admin
    //     $studentName = 'John Doe';
    //     $studentId = 123;

    //     if ($admin) {
    //         $admin->notify(new StudentRegisteredNotification($studentName, $studentId));
    //         return response()->json(['message' => 'Notification sent']);
    //     }

    //     return response()->json(['message' => 'Admin not found'], 404);
    // }

    // public function sendTestNotification()
    
    // {
    //     $user = User::first(); // Get the first user (or change this logic as needed)
        

    //     Notification::make()
    //         ->title('Test Notification')
    //         ->body('This is a test notification')
    //         ->sendToDatabase($user);

    //     return response()->json(['message' => 'Notification sent successfully!']);
    // }


}
