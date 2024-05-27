<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicantMessageController extends Controller
{
    public function __construct()
    {
    $this->middleware(['auth', 'auth:applicant']);
    }

    public function index()
    {
        // Fetch messages for the authenticated user
        $messages = Auth::user()->messagesReceived()->get();

        return view('applicant.messages.index', compact('messages'));
    }
    public function sent()
    {
        $sentMessages = Message::where('sender_id', Auth::id())->where('sender_type', 'department_head')->get();
        return view('applicant.messages.sent', compact('sentMessages'));
    }
}
