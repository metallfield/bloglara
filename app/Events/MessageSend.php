<?php

namespace App\Events;

use App\Chat_message;
use App\Message;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSend implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Message
     */
    public $message;
    public  $user;
    public $to_user_id;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @param Chat_message $message
     * @param $to_user_id
     */
    public function __construct(User $user, Chat_message $message, $to_user_id)
    {
        $this->user = $user;
        $this->message = $message;
        $this->to_user_id = $to_user_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chatbox_'.$this->to_user_id);
    }

    public function broadcastAs()
    {
        return 'MessageSend';
    }
}
