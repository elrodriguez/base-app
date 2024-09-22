<?php

namespace Modules\CRM\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\Channel;

use Illuminate\Broadcasting\InteractsWithSockets;

use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class SendMessage implements ShouldBroadcastNow
{
    use InteractsWithSockets, SerializesModels;

    private $participants;
    private $message;
    private $ofUserId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($participants, $message, $ofUserId)
    {
        $this->participants = $participants;
        $this->message  = $message;
        $this->ofUserId  = $ofUserId;
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('message-notification');
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'MessageNotification';
    }
    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastWith()
    {
        return [
            'message' => $this->message,
            'participants' => $this->participants,
            'ofUserId' => $this->ofUserId
        ];
    }
}
