<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Mail\ContactReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * Display all contacts
     */
    public function index()
    {
        $contacts = Contact::latest()->paginate(5);
        $pendingCount = Contact::pending()->count();
        $repliedCount = Contact::where('status', 'replied')->count();
        $totalCount = Contact::count();

        return view('admin.contacts.index', compact('contacts', 'pendingCount', 'totalCount', 'repliedCount'));
    }

    /**
     * Display pending contacts only
     */
    public function pending()
    {
        $contacts = Contact::pending()->latest()->paginate(5);
        $pendingCount = Contact::pending()->count();
        $repliedCount = Contact::where('status', 'replied')->count();
        $totalCount = Contact::count();

        return view('admin.contacts.pending', compact('contacts', 'pendingCount', 'totalCount', 'repliedCount'));
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

            Log::info('Admin replied to contact', [
                'contact_id' => $contact->id,
                'admin_id' => auth()->id(),
                'email' => $contact->email
            ]);

            return redirect()->route('admin.contacts.show', $contact->id)
                ->with('success', 'Reply sent successfully to ' . $contact->email);
        } catch (\Exception $e) {
            Log::error('Failed to send reply email', [
                'contact_id' => $contact->id,
                'error' => $e->getMessage()
            ]);

            return redirect()->back()
                ->with('error', 'Failed to send reply. Please try again.');
        }
    }

    /**
     * Delete contact
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);

        // Delete attachment if exists
        if ($contact->attachment && Storage::disk('public')->exists($contact->attachment)) {
            Storage::disk('public')->delete($contact->attachment);
            Log::info('Deleted attachment', [
                'contact_id' => $contact->id,
                'attachment' => $contact->attachment
            ]);
        }

        $contact->delete();

        Log::info('Contact deleted', [
            'contact_id' => $id,
            'admin_id' => auth()->id()
        ]);

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Contact message deleted successfully.');
    }

    /**
     * Bulk delete contacts
     */
    public function bulkDelete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ids' => 'required|array',
            'ids.*' => 'exists:contacts,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Invalid selection.');
        }

        $ids = $request->ids;
        $deletedCount = 0;
        $failedCount = 0;

        foreach ($ids as $id) {
            try {
                $contact = Contact::find($id);
                if ($contact) {
                    // Delete attachment if exists
                    if ($contact->attachment && Storage::disk('public')->exists($contact->attachment)) {
                        Storage::disk('public')->delete($contact->attachment);
                    }
                    $contact->delete();
                    $deletedCount++;
                }
            } catch (\Exception $e) {
                $failedCount++;
                Log::error('Failed to delete contact', [
                    'contact_id' => $id,
                    'error' => $e->getMessage()
                ]);
            }
        }

        $message = $deletedCount . ' contacts deleted successfully.';
        if ($failedCount > 0) {
            $message .= ' Failed to delete ' . $failedCount . ' contacts.';
        }

        return redirect()->back()->with('success', $message);
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
     * Download attachment
     */
    public function downloadAttachment($id)
    {
        $contact = Contact::findOrFail($id);

        if (!$contact->attachment) {
            return redirect()->back()->with('error', 'No attachment found.');
        }

        $filePath = storage_path('app/public/' . $contact->attachment);

        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'Attachment file not found.');
        }

        $fileName = basename($contact->attachment);

        return response()->download($filePath, $fileName);
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

        if ($contacts->isEmpty()) {
            return redirect()->back()->with('error', 'No contacts found for export.');
        }

        $fileName = 'contacts-' . date('Y-m-d') . '.csv';

        return response()->stream(
            function () use ($contacts) {
                $handle = fopen('php://output', 'w');

                // Add UTF-8 BOM for Excel compatibility
                fprintf($handle, "\xEF\xBB\xBF");

                // Headers
                fputcsv($handle, [
                    'S.No',
                    'Name',
                    'Email',
                    'Mobile',
                    'Subject',
                    'Message',
                    'Status',
                    'Received',
                    'Replied On',
                    'Admin Reply',
                    'Has Attachment'
                ]);

                $count = 1;
                foreach ($contacts as $contact) {
                    fputcsv($handle, [
                        $count++,
                        $contact->name,
                        $contact->email,
                        $contact->mobile,
                        ucfirst(str_replace('-', ' ', $contact->subject)),
                        $contact->message,
                        ucfirst($contact->status),
                        $contact->created_at->format('d M Y h:i A'),
                        $contact->replied_at ? $contact->replied_at->format('d M Y h:i A') : 'Not replied',
                        $contact->admin_reply ?? 'No reply',
                        $contact->attachment ? 'Yes' : 'No'
                    ]);
                }
                fclose($handle);
            },
            200,
            [
                'Content-Type' => 'text/csv; charset=UTF-8',
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
                'Pragma' => 'public',
                'Expires' => '0'
            ]
        );
    }

    /**
     * Export all contacts
     */
    public function exportAll()
    {
        $contacts = Contact::latest()->get();

        if ($contacts->isEmpty()) {
            return redirect()->back()->with('error', 'No contacts found for export.');
        }

        $fileName = 'all-contacts-' . date('Y-m-d') . '.csv';

        return response()->stream(
            function () use ($contacts) {
                $handle = fopen('php://output', 'w');

                // Add UTF-8 BOM for Excel compatibility
                fprintf($handle, "\xEF\xBB\xBF");

                // Headers
                fputcsv($handle, [
                    'S.No',
                    'Name',
                    'Email',
                    'Mobile',
                    'Subject',
                    'Message',
                    'Status',
                    'Received',
                    'Replied On',
                    'Admin Reply',
                    'Has Attachment'
                ]);

                $count = 1;
                foreach ($contacts as $contact) {
                    fputcsv($handle, [
                        $count++,
                        $contact->name,
                        $contact->email,
                        $contact->mobile,
                        ucfirst(str_replace('-', ' ', $contact->subject)),
                        $contact->message,
                        ucfirst($contact->status),
                        $contact->created_at->format('d M Y h:i A'),
                        $contact->replied_at ? $contact->replied_at->format('d M Y h:i A') : 'Not replied',
                        $contact->admin_reply ?? 'No reply',
                        $contact->attachment ? 'Yes' : 'No'
                    ]);
                }
                fclose($handle);
            },
            200,
            [
                'Content-Type' => 'text/csv; charset=UTF-8',
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
                'Pragma' => 'public',
                'Expires' => '0'
            ]
        );
    }

    /**
     * Get attachment preview
     */
    public function previewAttachment($id)
    {
        $contact = Contact::findOrFail($id);

        if (!$contact->attachment) {
            return response()->json(['error' => 'No attachment found'], 404);
        }

        $filePath = storage_path('app/public/' . $contact->attachment);

        if (!file_exists($filePath)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        $extension = strtolower(pathinfo($contact->attachment, PATHINFO_EXTENSION));
        $mimeTypes = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'pdf' => 'application/pdf',
        ];

        $mimeType = $mimeTypes[$extension] ?? 'application/octet-stream';

        return response()->file($filePath, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . basename($contact->attachment) . '"'
        ]);
    }

    /**
     * Get contacts statistics for dashboard
     */
    public function getStats()
    {
        $stats = [
            'total' => Contact::count(),
            'pending' => Contact::pending()->count(),
            'read' => Contact::where('status', 'read')->count(),
            'replied' => Contact::where('status', 'replied')->count(),
            'today' => Contact::whereDate('created_at', today())->count(),
            'this_week' => Contact::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'this_month' => Contact::whereMonth('created_at', now()->month)->count(),
        ];

        return response()->json($stats);
    }

    /**
     * Search contacts
     */
    public function search(Request $request)
    {
        $query = $request->input('query');

        if (empty($query)) {
            return redirect()->route('admin.contacts.index');
        }

        $contacts = Contact::where('name', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->orWhere('mobile', 'LIKE', "%{$query}%")
            ->orWhere('message', 'LIKE', "%{$query}%")
            ->orWhere('subject', 'LIKE', "%{$query}%")
            ->latest()
            ->paginate(5)
            ->withQueryString();

        $pendingCount = Contact::pending()->count();
        $totalCount = Contact::count();

        return view('admin.contacts.index', compact('contacts', 'pendingCount', 'totalCount'));
    }
}
