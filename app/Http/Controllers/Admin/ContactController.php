<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Mail\ContactReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Display all contacts
     */
    public function index()
    {
        $contacts = Contact::latest()->paginate(5);
        $pendingCount = Contact::pending()->count();
        $totalCount = Contact::count();

        return view('admin.contacts.index', compact('contacts', 'pendingCount', 'totalCount'));
    }

    /**
     * Display pending contacts only
     */
    public function pending()
    {
        $contacts = Contact::pending()->latest()->paginate(5);
        $pendingCount = Contact::pending()->count();
        $totalCount = Contact::count();

        return view('admin.contacts.pending', compact('contacts', 'pendingCount', 'totalCount'));
    }

    /**
     * Display replied contacts
     */
    public function replied()
    {
        $contacts = Contact::where('status', 'replied')->latest()->paginate(5);
        $pendingCount = Contact::pending()->count();
        $totalCount = Contact::count();

        return view('admin.contacts.replied', compact('contacts', 'pendingCount', 'totalCount'));
    }

    /**
     * Show single contact details
     */
    public function show($id)
    {
        $contact = Contact::findOrFail($id);

        // Mark as read if pending
        if ($contact->status === 'pending') {
            $contact->markAsRead();
        }

        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Reply to contact
     */
    public function reply(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'reply' => 'required|string|min:10|max:5000',
        ], [
            'reply.required' => 'Please enter a reply message.',
            'reply.min' => 'Reply must be at least 10 characters.',
            'reply.max' => 'Reply must not exceed 5000 characters.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Send email reply
            Mail::to($contact->email)->send(new ContactReply($contact, $request->reply));

            // Update contact status
            $contact->markAsReplied($request->reply);

            return redirect()->route('admin.contacts.show', $contact->id)
                ->with('success', 'Reply sent successfully to ' . $contact->email);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to send reply. Please try again. Error: ' . $e->getMessage());
        }
    }

    /**
     * Delete contact
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Contact message deleted successfully.');
    }

    /**
     * Bulk delete contacts
     */
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);

        if (empty($ids)) {
            return redirect()->back()->with('error', 'No contacts selected.');
        }

        Contact::whereIn('id', $ids)->delete();

        return redirect()->back()
            ->with('success', count($ids) . ' contacts deleted successfully.');
    }

    /**
     * Mark as read
     */
    public function markAsRead($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->markAsRead();

        return redirect()->back()->with('success', 'Contact marked as read.');
    }


    /**
     * Export contacts
     */
    public function export(Request $request)
    {
        $ids = $request->input('ids') ? explode(',', $request->input('ids')) : [];

        if (empty($ids)) {
            return redirect()->back()->with('error', 'No contacts selected for export.');
        }

        $contacts = Contact::whereIn('id', $ids)->get();

        // Create CSV export
        $fileName = 'contacts-' . date('Y-m-d') . '.csv';
        $handle = fopen('php://output', 'w');

        // Headers
        fputcsv($handle, ['Name', 'Email', 'Mobile', 'Subject', 'Message', 'Status', 'Received', 'Replied On', 'Admin Reply']);

        foreach ($contacts as $contact) {
            fputcsv($handle, [
                $contact->name,
                $contact->email,
                $contact->mobile,
                $contact->subject,
                $contact->message,
                $contact->status,
                $contact->created_at->format('d M Y h:i A'),
                $contact->replied_at ? $contact->replied_at->format('d M Y h:i A') : '',
                $contact->admin_reply ?? ''
            ]);
        }

        fclose($handle);

        return response()->stream(
            function () use ($contacts, $fileName) {
                // Output CSV
                $handle = fopen('php://output', 'w');
                fputcsv($handle, ['Name', 'Email', 'Mobile', 'Subject', 'Message', 'Status', 'Received', 'Replied On', 'Admin Reply']);
                foreach ($contacts as $contact) {
                    fputcsv($handle, [
                        $contact->name,
                        $contact->email,
                        $contact->mobile,
                        $contact->subject,
                        $contact->message,
                        $contact->status,
                        $contact->created_at->format('d M Y h:i A'),
                        $contact->replied_at ? $contact->replied_at->format('d M Y h:i A') : '',
                        $contact->admin_reply ?? ''
                    ]);
                }
                fclose($handle);
            },
            200,
            [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            ]
        );
    }
}
