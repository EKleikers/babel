<?php
 
namespace App\Jobs;
 
use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Reservations;
use App\Jobs\SendEmail;
use App\Restaurants;
use App\User;
 
class HourlyJob extends Job implements ShouldQueue {
    use InteractsWithQueue,
        SerializesModels;
 
        public $tries = 1;
    /**
     * Create a new job instance.
     *
     * @return void
     */

    
    public function __construct() {

    }
 
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
    
        \Log::info('babel hourly job');
           
    }
}