<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

use Illuminate\Support\Facades\Log;
use App\Models\Post;
use App\Models\Subscriber;
use App\Mail\PostPublishedNotification;
use Illuminate\Support\Facades\Mail;

class SendNewsletterNotification implements ShouldQueue
{
    use Queueable;

    public $post;

    /**
     * Create a new job instance.
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Subscriber::whereNotNull('verified_at')->chunk(100, function ($subscribers) {
            foreach ($subscribers as $subscriber) {
                try {
                    Mail::to($subscriber->email)->send(new PostPublishedNotification($this->post, $subscriber));
                } catch (\Exception $e) {
                    // Log error or handle gracefully
                    Log::error("Failed to send newsletter email to {$subscriber->email}: " . $e->getMessage());
                }
            }
        });
    }
}
