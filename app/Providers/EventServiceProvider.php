<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
        'App\Events\Registered' => [
            'App\Listeners\UserRegistered',
        ],
        'App\Events\CommentEvent' => [
            'App\Listeners\CommentEventPushListener',
        ],
		\SocialiteProviders\Manager\SocialiteWasCalled::class => [
			'SocialiteProviders\\Kakao\\KakaoExtendSocialite@handle',
			'SocialiteProviders\\Naver\\NaverExtendSocialite@handle',
    	],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
