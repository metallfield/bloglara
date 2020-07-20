<?php

namespace App\Events;

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
    public $channel;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @param Message $message
     * @param $channel
     */
    public function __construct(User $user ,Message $message, $channel )
    {
        $this->user = $user;
        $this->message = $message;
        $this->channel = $channel;
        $this->dontBroadcastToCurrentUser();

     }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chatbox_'.$this->channel);
    }

    public function broadcastAs()
    {
        return 'MessageSend';
    }
}
