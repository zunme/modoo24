<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\Alarm;
class AlarmEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct( $alarm)
    {
        $this->message = ['type'=>'alarm','command'=>'add','data'=>$alarm];
    }

    public function broadcastOn()
    {
        return ['my-channel'];
    }

    public function broadcastAs()
    {
        return 'alarm-event';
    }
}
