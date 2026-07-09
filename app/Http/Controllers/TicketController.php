<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $tickets = Ticket::where('user_id', auth()->id())
            ->latest()
            ->paginate(3); // 👈 pagination added

        $selectedTicket = null;

        if ($request->ticket_id) {
            $selectedTicket = Ticket::with('messages')
                ->where('user_id', auth()->id())
                ->findOrFail($request->ticket_id);
        }
        $user = Auth::user();
        return view('user.tickets.index', compact('tickets', 'selectedTicket', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|max:255',
            'message' => 'required'
        ]);

        $ticket = Ticket::create([
            'ticket_no' => 'TKT' . time(),
            'user_id'   => auth()->id(),
            'subject'   => $request->subject,
            'status'    => 'open'
        ]);

        TicketMessage::create([
            'ticket_id'   => $ticket->id,
            'sender_type' => 'user',
            'sender_id'   => auth()->id(),
            'message'     => $request->message
        ]);

        return response()->json([
            'success' => true,
            'ticket' => [
                'id' => $ticket->id,
                'ticket_no' => $ticket->ticket_no,
                'subject' => $ticket->subject,
                'status' => $ticket->status
            ]
        ]);
    }

    public function reply(Request $request, $id)
    {
        $request->validate([
            'message' => 'required'
        ]);

        $ticket = Ticket::where(
            'user_id',
            auth()->id()
        )->findOrFail($id);

        if ($ticket->status == 'closed') {

            return response()->json([
                'success' => false,
                'message' => 'Ticket already closed.'
            ]);
        }

        $reply = TicketMessage::create([
            'ticket_id'   => $ticket->id,
            'sender_type' => 'user',
            'sender_id'   => auth()->id(),
            'message'     => $request->message
        ]);

        return response()->json([
            'success' => true,
            'messageData' => [
                'message' => $reply->message,
                'created_at' => $reply->created_at->format('d M Y h:i A')
            ]
        ]);
    }

    public function show($id)
    {
        $ticket = Ticket::with('messages')
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return response()->json($ticket);
    }

    public function latestMessages(Request $request, Ticket $ticket)
    {
        $lastId = $request->last_id ?? 0;

        $messages = $ticket->messages()
            ->where('id', '>', $lastId)
            ->orderBy('id')
            ->get();

        return response()->json([
            'messages' => $messages
        ]);
    }

    // admin side
    public function tickets(Request $request)
    {
        if ($request->ajax() || $request->get('ajax')) {

            $perPage = (int) $request->input('per_page', 5);
            $search  = $request->input('search', '');
            $status  = $request->input('status', 'all');

            $tickets = Ticket::with('user')
                ->when($search, function ($q) use ($search) {
                    $q->where(function ($q) use ($search) {
                        $q->where('subject',   'like', '%' . $search . '%')
                            ->orWhere('ticket_no', 'like', '%' . $search . '%')
                            ->orWhereHas('user', fn($u) => $u->where('name', 'like', '%' . $search . '%'));
                    });
                })
                ->when($status && $status !== 'all', fn($q) => $q->where('status', $status))
                ->latest()
                ->paginate($perPage);

            return response()->json([
                'data'         => $tickets->map(fn($t) => [
                    'id'        => $t->id,
                    'ticket_no' => $t->ticket_no,
                    'subject'   => $t->subject,
                    'status'    => $t->status,
                    'user'      => $t->user ? [
                        'name'  => $t->user->name,
                        'email' => $t->user->email,
                    ] : null,
                    'created_at' => optional($t->created_at)->format('d M Y'),
                ]),
                'current_page' => $tickets->currentPage(),
                'last_page'    => $tickets->lastPage(),
                'total'        => $tickets->total(),
            ]);
        }

        return view('admin.tickets.index');
    }

    public function ticketMessages($id)
    {
        // Load ticket + user + all messages
        $ticket = Ticket::with(['user', 'messages'])->findOrFail($id);

        return response()->json([
            'ticket' => [
                'id'        => $ticket->id,
                'ticket_no' => $ticket->ticket_no,
                'subject'   => $ticket->subject,
                'status'    => $ticket->status,
                'user'      => $ticket->user ? [
                    'name'  => $ticket->user->name,
                    'email' => $ticket->user->email,
                ] : ['name' => 'Unknown', 'email' => ''],
            ],
            'messages' => $ticket->messages->map(fn($m) => [
                'sender_type' => $m->sender_type,                        // 'user' | 'admin'
                'sender_name' => $m->sender_type === 'admin'
                    ? 'Admin'
                    : optional($ticket->user)->name ?? 'User',
                'message'     => $m->message,
                'created_at'  => optional($m->created_at)->format('d M Y, h:i A'),
            ]),
        ]);
    }

    public function ticketReply(Request $request, $id)
    {
        $request->validate(['message' => 'required|string|max:5000']);

        $ticket = Ticket::findOrFail($id);

        if ($ticket->status === 'closed') {
            return response()->json(['message' => 'Ticket is already closed.'], 422);
        }

        TicketMessage::create([
            'ticket_id'   => $ticket->id,
            'sender_type' => 'admin',
            'sender_id'   => auth()->id(),
            'message'     => $request->message,
        ]);

        return response()->json(['success' => true]);
    }

    public function ticketReplyClose(Request $request, $id)
    {
        $request->validate(['message' => 'required|string|max:5000']);

        $ticket = Ticket::findOrFail($id);

        TicketMessage::create([
            'ticket_id'   => $ticket->id,
            'sender_type' => 'admin',
            'sender_id'   => auth()->id(),
            'message'     => $request->message,
        ]);

        $ticket->update(['status' => 'closed']);

        return response()->json(['success' => true, 'status' => 'closed']);
    }
}
