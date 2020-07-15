<?php


namespace App\services;


use App\Repositories\MessageRepository;
use App\Repositories\UserRepository;

class MessageService
{
    private $messageRepository;

    public function __construct()
    {
        $this->messageRepository = app(MessageRepository::class);
    }

    public function insertMessage($data)
    {
        return $this->messageRepository->insertMessage($data);
    }

    public function fetch_user_chat_history($from_user_id, $to_user_id)
    {
        $result =  $this->messageRepository->getMessage($from_user_id, $to_user_id);
        $output = [];
        foreach ($result as $res)
        {
            if($res->from_user_id == $from_user_id)
            {
                $message['username'] = 'you';
            }
            else
            {
                $message['username'] = $this->messageRepository->getUsername($res->from_user_id)['name'];
            }
            $message['message']= $res->message;
            $message['updated_at'] = preg_replace('/\./', ' ' ,$res->updated_at) ;
            $output[] = $message;
        }

        $this->messageRepository->messageUpdate($from_user_id, $to_user_id);
        return $output;
    }


}
