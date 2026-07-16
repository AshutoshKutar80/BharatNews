<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }

    /**
     * Store contact form submission
     */
    public function store(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:20|regex:/^[0-9]{10}$/',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255|in:general,reporting,reporter-id,media-coverage,suggestion,complaint,other',
            'message' => 'required|string|min:10|max:5000',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'privacy' => 'accepted'
        ], [
            'name.required' => 'Please enter your full name.',
            'name.max' => 'Name cannot exceed 255 characters.',

            'mobile.required' => 'Please enter your mobile number.',
            'mobile.regex' => 'Please enter a valid 10-digit mobile number.',
            'mobile.max' => 'Mobile number cannot exceed 10 characters.',

            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'Email cannot exceed 255 characters.',

            'subject.required' => 'Please select a subject.',
            'subject.in' => 'Please select a valid subject.',

            'message.required' => 'Please write your message.',
            'message.min' => 'Your message must be at least 10 characters.',
            'message.max' => 'Your message cannot exceed 5000 characters.',

            'attachment.max' => 'File size must not exceed 5MB.',
            'attachment.mimes' => 'File must be of type: JPG, JPEG, PNG, or PDF',

            'privacy.accepted' => 'You must agree to the Privacy Policy and terms of service.',
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
                $file = $request->file('attachment');

                $filename = time() . '_' . Str::random(10) . '_' . preg_replace('/[^a-zA-Z0-9.]/', '_', $file->getClientOriginalName());

                $attachmentPath = $file->storeAs('contact-attachments', $filename, 'public');

                if (!$attachmentPath || !Storage::disk('public')->exists($attachmentPath)) {
                    throw new \Exception('Failed to upload file. Please try again.');
                }
            }

            $contactData = [
                'user_id' => Auth::id(), // Will be null for guests
                'name' => trim($request->name),
                'mobile' => trim($request->mobile),
                'email' => trim($request->email),
                'subject' => $request->subject,
                'message' => trim($request->message),
                'attachment' => $attachmentPath,
                'status' => 'pending',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ];

            $contact = Contact::create($contactData);

            // Log success
            Log::info('Contact form submitted', [
                'contact_id' => $contact->id,
                'email' => $contact->email,
                'user_id' => Auth::id()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Your message has been sent successfully! We\'ll get back to you soon.',
                'data' => [
                    'id' => $contact->id,
                    'name' => $contact->name,
                    'email' => $contact->email,
                    'subject' => $contact->subject,
                    'created_at' => $contact->created_at->format('d M Y, h:i A')
                ]
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Contact form submission error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            if (isset($attachmentPath) && $attachmentPath && Storage::disk('public')->exists($attachmentPath)) {
                Storage::disk('public')->delete($attachmentPath);
            }

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }
}
