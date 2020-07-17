<?php

namespace App\Http\Controllers\Chat;


use App\Chat_message;
use App\Events\CheckIsOnline;
use App\Events\MessageSend;
use App\Http\Controllers\Controller;
use App\Message;
use App\Repositories\UserRepository;
use App\services\MessageService;
use App\User;
use Illuminate\Http\JsonResponse as JsonResponseAlias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ChatsController extends Controller
{

    private $messageService;
    private $userRepository;
    public function __construct(MessageService $messageService, UserRepository $userRepository)
    {
        $this->middleware('auth');
        $this->messageService = $messageService;
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        if (Auth::check())
        {
            $request->session()->put('user', Auth::user());
            $user = session('user');
            return view('chat.index', compact('user'));
        }
    }

    public function getUsers()
    {
        $users = $this->userRepository->getAllUsers();
        foreach ($users as $user)
        {
            if ($user->id !== session('user')['id'])
            {
                $user['username'] = $user->name;
                $user['user_id'] = $user->id;

                $output[] = $user;
            }
        }
        return response()->json($output);
    }



    public function fetchMessages(Request $request)
    {
        $data['from_user_id'] = session('user')['id'];
        $data['to_user_id'] = $request->to_user_id;
        $result = $this->messageService->fetch_user_chat_history($data['from_user_id'], $data['to_user_id']);
        return response()->json($result);
    }

    public function sendMessage(Request $request)
    {
        $data['to_user_id'] = $request->to_user_id;
        $data['from_user_id'] = Auth::id();
        $data['message'] = $request->message;
        $data['status'] = 1;
        $id =  Chat_message::create($data)->id;
        $message = Chat_message::where('id',$id)->first();
        $user = User::where('id', $data['from_user_id'])->first();
        broadcast(new MessageSend($user, $message, $data['to_user_id']));

    }

    public function pusherAuth(Request $request){
        $key = 'b7a251164dc429135185';
        $secret = '33113f19eded5e756621';
        $channel_name = $request->channel_name;
        $socket_id = $request->socket_id;
        $string_to_sign = $socket_id.':'.$channel_name;
        $signature = hash_hmac('sha256', $string_to_sign, $secret);
        return response()->json(['auth' => $key.':'.$signature]);
    }
}
