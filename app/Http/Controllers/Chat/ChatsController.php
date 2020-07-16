<?php

namespace App\Http\Controllers\Chat;

use App\Events\MessageSend;
use App\Http\Controllers\Controller;
use App\Message;
use App\User;
use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Auth;

class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('chat.index');
    }

    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    public function sendMessage(Request $request)
    {
        $id = Auth::id();
        $user = User::find($id);
        $message = $user->messages()->create([
            'message' => $request->input('message'),
        ]);
     broadcast(new MessageSend($user, $message))->toOthers();
        return response()->json(['message'  => $message, 'username' => $user->name]);
    }
}
