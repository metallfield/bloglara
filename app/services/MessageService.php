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
        $output = '<ul class="list-unstyled">';
        foreach ($result as $res)
        {
            $user_name = '';
            if($res->from_user_id == $from_user_id)
            {
                $user_name = '<b class="text-success">You</b>';
            }
            else
            {
                $user_name = '<b class="text-danger">'.get_user_name($res->from_user_id).'</b>';
            }
            $output .= '<li style="border-bottom:1px dotted #ccc">
            <p>'.$user_name.' - '.$res->message.'
              <div align="right">
              - <small><em>'.$res->timestamp.'</em></small>
             </div>
            </p>
             </li>
  ';
        }
        $output .= '</ul>';
        $this->messageRepository->messageUpdate($from_user_id, $to_user_id);
        return $output;
    }

    private function get_user_name($user_id)
    {
        return $this->messageRepository->getUsername($user_id);
    }
}
