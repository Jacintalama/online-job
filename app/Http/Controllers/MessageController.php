<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    public function __construct()
    {
    $this->middleware('can:delete,message')->only('destroy');
    }


    public function index()
    {
        $messages = Auth::user()->receivedMessages;
        $sentMessages = Message::where('sender_id', Auth::id())->where('sender_type', Auth::user()->role)->get();

        if (Auth::user()->role === 'department_head') {

        return view('departmenthead.messages.index', compact('messages', 'sentMessages'));
        } elseif (Auth::user()->role === 'applicant') {
        // Logic for applicant...
        return view('messages.index', compact('messages', 'sentMessages'));
        }

    return abort(403, 'Unauthorized');
    }
    public function sent()
    {
        $sentMessages = Message::where('sender_id', Auth::id())->where('sender_type', 'department_head')->get();
        return view('messages.sent', compact('sentMessages'));
    }



    public function show(Message $message)
    {
        Log::info('Showing message ID: ' . $message->id);

        // Ensure the authenticated user is the intended recipient of the message
        if ($message->recipient_id === auth()->id()) {
            Log::info('Attempting to mark message as read. Message ID: ' . $message->id);

            $message->is_read = true;
            $wasSaved = $message->save();

            Log::info('Save attempt was: ' . ($wasSaved ? 'successful' : 'unsuccessful'));
            Log::info('Marking message as read. Message ID: ' . $message->id);
        }

        return view('messages.show', compact('message'));
    }





    public function create()
    {
        return view('messages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
        'recipient_id' => 'required|exists:users,id',
        'job_id' => 'required|exists:jobs,id',  // Ensure job_id is provided and exists
        'content' => 'required|string|max:1000',
        ]);

        $message = new Message([
        'sender_id' => Auth::id(),
        'recipient_id' => $validated['recipient_id'],
        'job_id' => $validated['job_id'],  // Associate message with job
        'content' => $validated['content'],
        'sender_type' => Auth::user()->role,
        ]);

        $message->save();

        // Specify the route name you want to redirect to
        return redirect()->route('department_head.')->with('success', 'Message sent successfully!');
    }



    public function storeApplicantMessage(Request $request)
    {
        // Validation and logic for sending messages to multiple applicants
        $validated = $request->validate([
        'job_id' => 'required|exists:jobs,id',
        'content' => 'required|string|max:1000',
        'applicants' => 'required|array|min:1',
        'applicants.*' => 'exists:users,id',
        ]);

    foreach ($request->applicants as $recipient_id) {
        $message = new Message([
            'sender_id' => Auth::id(),
            'recipient_id' => $recipient_id,
            'content' => $validated['content'],
            'sender_type' => Auth::user()->role, // Make sure to include this
            // additional fields...
        ]);
        $message->save();
        Log::info('Message Stored: ', $message->toArray());
        }

    return redirect()->route('messages.index', ['job' => $validated['job_id']])->with('success', 'Messages sent to applicants successfully!');
    }


    public function edit(Message $message)
    {
        return view('messages.edit', compact('message'));
    }

    public function update(Request $request, Message $message)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
            // ... other validation rules ...
        ]);

        $message->fill($validated);
        $message->save();

        return redirect()->route('messages.index')->with('success', 'Message updated successfully!');
    }

    public function destroy(Request $request, Message $message = null)
    {
        $message->delete();
        Log::info('Destroy method called.');
        // dd($message);
        if ($message) {
            // Deleting a single message
            Log::info('Deleting a single message.', ['message_id' => $message->id]);
            $message->delete();
            return redirect()->route('messages.index')->with('success', 'Message deleted successfully.');
        } else {
            // Bulk delete
            $messageIds = $request->input('message_ids');
            Log::info('Bulk deleting messages.', ['message_ids' => $messageIds]);

            // Validate the message ids
            $request->validate([
                'message_ids' => 'required|string',
            ]);

            // Convert comma-separated string to array
            $messageIds = explode(',', $messageIds);

            // Perform the delete operation
            Message::whereIn('id', $messageIds)->delete();

            return redirect()->route('messages.index')->with('success', 'Messages deleted successfully.');
        }
    }



}
