<?php


namespace App\Repositories;


use App\Chat_message;
use App\User;

class MessageRepository
{
    public function insertMessage($data)
    {

        return Chat_message::create($data);
    }

    public function getMessage($from_user_id, $to_user_id)
    {
        return Chat_message::where([['from_user_id', $from_user_id],['to_user_id',$to_user_id]])
            ->orWhere([['from_user_id', $to_user_id], ['to_user_id', $from_user_id]])
            ->orderBy('timestamp', 'desc');
    }
    public function messageUpdate($from_user_id, $to_user_id)
    {
        $data['status'] = 0;
        return Chat_message::where([['from_user_id', $to_user_id], ['to_user_id', $from_user_id], ['status', 1]])->update($data);
    }

    public function  getUsername($user_id)
    {
        return User::select('name')->where('id', $user_id)->get();
    }
}
