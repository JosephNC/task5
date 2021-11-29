<?php

namespace App\Providers;

use App\Events\PostCreated;
use App\Models\SubscriberNotify;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen(function (PostCreated $event) {
            $post = $event->post;
            $subscribers = $post->website->subscribers;
            $data = [];

            foreach ($subscribers as $subscriber)
                array_push($data, [
                    'subscriber_id' => $subscriber->id,
                    'post_id'       => $post->id,
                ]);

            if (!empty($data)) SubscriberNotify::upsert($data, ['subscriber_id', 'post_id']);
        });
    }
}
