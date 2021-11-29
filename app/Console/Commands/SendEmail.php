<?php

namespace App\Console\Commands;

use App\Models\SubscriberNotify;
use App\Notifications\PostCreated;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to the subscribers.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Get the SubscriberNotify
        $notifications = SubscriberNotify::all();
        $ids = [];

        foreach( $notifications as $notification ) {
            $subscriber = $notification->subscriber;
            $user       = $subscriber->user;
            $post       = $notification->post;

            $user->notify(new PostCreated($post));

            $ids[] = $notification->id;
        }

        if ( ! empty($ids) ) SubscriberNotify::whereIn('id', $ids)->delete();

        $this->info( empty($ids) ? 'No emails to be sent.' : 'The emails were sent successfully!' );

        return Command::SUCCESS;
    }
}
