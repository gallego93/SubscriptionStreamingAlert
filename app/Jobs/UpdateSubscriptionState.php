<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Subscriptions;
use App\Traits\LogTrait;
use Illuminate\Support\Carbon;

class UpdateSubscriptionState implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, LogTrait;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $subscriptions = Subscriptions::where('status', true)->get();

            foreach ($subscriptions as $subscription) {
                if (Carbon::now()->isSameDay($subscription->final_date)) {
                    $subscription->status = false;
                    $subscription->save();
                }
            }
        } catch (\Exception $e) {
            $this->logError($e, 'Error updating subscription status: ');
        }
    }
}
