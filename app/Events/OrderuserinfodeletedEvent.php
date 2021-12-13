<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Models\AuctionOrderInfoEnc;

class OrderuserinfodeletedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct( AuctionOrderInfoEnc $info)
    {
        $this->message = ['type'=>'userinfo','command'=>'del','order_type'=>$info->order_type,'data'=>$info];
    }

    public function broadcastOn()
    {
        //return [$this->message['data']->order_type.'-channel'];
        return ['my-channel'];
    }

    public function broadcastAs()
    {
        //return 'order-event';
        return $this->message['data']->order_type.'-event';
        return 'my-event';
    }
}
