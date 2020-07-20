<?php


namespace App\Repositories;


use App\Message;
use App\User;

class MessageRepository
{
    public function insertMessage($data)
    {
        return Message::create($data);
    }

    public function getMessage($from_user_id, $to_user_id)
    {
        return Message::where('user_id', $from_user_id)
            ->orWhere('user_id', $to_user_id)
            ->get();
    }
    public function messageUpdate($from_user_id, $to_user_id)
    {
        $data['status'] = 0;
        return true;
    }

    public function  getUsername($user_id)
    {
        return User::select('name')->find($user_id);
    }
}
