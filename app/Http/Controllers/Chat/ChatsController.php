<?php

namespace App\Http\Controllers\Chat;


use App\Channel;
use App\Message;
use App\Events\CheckIsOnline;
use App\Events\MessageSend;
use App\Http\Controllers\Controller;
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


    public function getChannel(Request $request)
    {
        $data['user_id'] = Auth::id();
        $data['to_user_id'] = $request->to_user_id;
        $channels = auth()->user()->channels->all();
        foreach ($channels as   $channel)
        {
            if ($channel->users->contains($data['to_user_id']))
            {
                $ch= $channel;
            }
        }
        if (empty($ch))
        {
            $channel = auth()->user()->channels()->create();
            $channel->users()->attach($data['to_user_id']);
            $ch= $channel;
        }
        $output['channel'] = $ch;
        return response()->json($output);
    }

    public function fetchMessages(Request $request)
    {
        $data['user_id'] = Auth::id();
        $data['to_user_id'] = $request->to_user_id;
        $channel = Channel::where('id', $request->channel_id)->first();
        $result = $channel->messages;

        return response()->json($result);
    }

    public function sendMessage(Request $request)
    {
         $data['message'] = $request->message;
        $data['status'] = 1;
        $data['channel_id'] = $request->channel_id;
           $user = Auth::user();
        $message  =  auth()->user()->messages()->create($data);

        broadcast(new MessageSend($user,$message, $message->channel_id))->toOthers();

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
