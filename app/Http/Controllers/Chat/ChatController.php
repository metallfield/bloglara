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
{
    private $userRepository;
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
                if (Cache::has('user-is-online-'. $user->id)){
                    $output[] = '<li>user :'. $user->name.' online</li><button type="button" class=" start_chat" data-button="" data-touserid="'.$user->id.'" data-tousername="'.$user->name.'">Start Chat</button>';
                }else{
                    $output[] = '<li>user :'. $user->name. ' offline</li>';
                }
            }
        }
        return $output;
    }

    public function insertMessage(Request $request)
    {

        $data = [
            'to_user_id'  => $request['to_user_id'],
            'from_user_id'  => session('user')['id'],
            'message'  => $request['chat_message'],
            'status'   => '1'
       ];
       $result = $this->messageService->insertMessage($data);
       if ($result)
       {
            return $this->messageService->fetch_user_chat_history($data['to_user_id'], $data['from_user_id']);
       }
    }


}
