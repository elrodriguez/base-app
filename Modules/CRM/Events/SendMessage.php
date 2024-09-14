<?php

namespace Modules\CRM\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class SendMessage implements ShouldBroadcastNow
{
    use InteractsWithSockets, SerializesModels;

    protected $data = ['sender' => 'Rehan'];

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('user-channel');
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'UserEvent';
    }
    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastWith()
    {
        $sender = $this->data['sender'];
        return ['title' => 'This notification from ' . $sender];
    }
}
