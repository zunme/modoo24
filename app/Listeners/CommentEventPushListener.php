<?php

namespace App\Listeners;

use App\Events\CommentEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

use App\Models\AdminPusher;

class CommentEventPushListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CommentEvent  $event
     * @return void
     */
    public function handle(CommentEvent $event)
    {
      $staff = "[".trim(isset( $event->message['data']->auction_staff_s_name) ? $event->message['data']->auction_staff_s_name : '')."] - ";

      $title = $staff."댓글등록";
      $body = "댓글이 등록되었습니다.";

      $optionBuilder = new OptionsBuilder();
      $optionBuilder->setTimeToLive(60*20);

      $notificationBuilder = new PayloadNotificationBuilder($title);
      $notificationBuilder->setBody($body)
          ->setIcon('http://modoo24.net/modoo24.ico')
          ->setClickAction('https://24auction.co.kr/community/rhksfl/jisik')
      		->setSound('default');
      $dataBuilder = new PayloadDataBuilder();
      $dataBuilder->addData(['a_data' => 'my_data']);

      $option = $optionBuilder->build();
      $notification = $notificationBuilder->build();
      $data = $dataBuilder->build();

      $tokens = AdminPusher::where(['is_use'=>'Y'])->pluck('token')->toArray();

      $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);
    }
}
