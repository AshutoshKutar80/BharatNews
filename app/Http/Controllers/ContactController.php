<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Show the contact form
     */
    public function index()
    {
        return view('contact');
    }

    /**
     * Store contact form submission
     */
    public function store(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:20|regex:/^[0-9+\-\s()]+$/',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255|in:general,reporting,reporter-id,media-coverage,suggestion,complaint,other',
            'message' => 'required|string|min:10|max:5000',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
            'privacy' => 'accepted'
        ], [
            'name.required' => 'Please enter your full name.',
            'mobile.required' => 'Please enter your mobile number.',
            'mobile.regex' => 'Please enter a valid mobile number.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'subject.required' => 'Please select a subject.',
            'subject.in' => 'Please select a valid subject.',
            'message.required' => 'Please write your message.',
            'message.min' => 'Your message must be at least 10 characters.',
            'attachment.max' => 'File size must not exceed 5MB.',
            'attachment.mimes' => 'File must be of type: jpg, jpeg, png, pdf, doc, docx.',
            'privacy.accepted' => 'You must agree to the Privacy Policy.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Handle file upload
            $attachmentPath = null;
            if ($request->hasFile('attachment')) {
                $attachmentPath = $request->file('attachment')->store('contact-attachments', 'public');
            }

            // Create contact record
            $contact = Contact::create([
                'user_id' => Auth::id(), // Will be null for guests
                'name' => $request->name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
                'attachment' => $attachmentPath,
                'status' => 'pending'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Your message has been sent successfully! We\'ll get back to you soon.',
                'data' => $contact
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }
}
