<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrdercheckEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct( $ordertype, $lastidx )
    {
        $this->ordertype = $ordertype;
        $this->message = ['type'=>$ordertype,'command'=>'add','data'=>$lastidx];
    }

    public function broadcastOn()
    {
        return ['my-channel'];
    }

    public function broadcastAs()
    {
        //return 'my-event';
        //return $this->ordertype.'-check-event';
        return'order-check-event';
    }
}
