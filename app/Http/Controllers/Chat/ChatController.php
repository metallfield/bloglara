<?php


namespace App\Http\Controllers\Chat;


use App\Repositories\MessageRepository;
use App\Repositories\UserRepository;
use App\services\MessageService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class ChatController extends  BaseController
{private $userRepository;
    private $messageService;
    public function __construct(UserRepository $userRepository, MessageService $messageService)
    {
        $this->userRepository = $userRepository;
        $this->messageService = $messageService;
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


    public function checkIsOnline()
    {
        $users = $this->userRepository->getAllUsers();
        foreach ($users as $user)
        {
            if ($user->id !== session('user')['id'])
            {
                $user['username'] = $user->name;
                $user['user_id'] = $user->id;
                if (Cache::has('user-is-online-'. $user->id)){
                    $user['status'] = 'online';
                }else{
                    $user['status']  = 'offline';
                }
                $output[] = $user;
            }
        }
        return response()->json($output);
    }

    public function insertMessage(Request $request)
    {
        $data['to_user_id'] = $request->to_user_id;
        $data['from_user_id'] = session('user')['id'];
        $data['message'] = $request->chat_message;
        $data['status'] = 1;
        $this->messageService->insertMessage($data);
        $result = $this->messageService->fetch_user_chat_history($data['from_user_id'], $data['to_user_id']);
        if ($result)
        {
            return response()->json($result);
        }

    }

    public function fetch_history(Request $request)
    {
        $data['from_user_id'] = session('user')['id'];
        $data['to_user_id'] = $request->to_user_id;
        $result = $this->messageService->fetch_user_chat_history($data['from_user_id'], $data['to_user_id']);
        if ($result)
        {
            return response()->json($result);
        }

    }

}
