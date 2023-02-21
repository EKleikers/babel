<?php
namespace App\Jobs;
 
use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\UserServer;
use App\UserInstance;


class UpdateServerStatus extends Job implements ShouldQueue
{
    public $tries = 3;
    
    use InteractsWithQueue, SerializesModels;
    protected $id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
        // echo "Construct";
    }
 
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        $id = $this->id;
        \Log::info('Mystore checking server id '.$id);
        $server = UserServer::where('server_id', $id)->first();
        \Log::info('Mystore checking server name '.$server->server_name);
        $check = $server->checkDroplet($server->server_id);
        $status = $check->status;
        // var_dump($status);
        if ($status == 'new') {
            //echo "New";
            //new means it is still being created, we need to relaunch job in 60 seconds
             dispatch(new UpdateServerStatus($id))->delay(60);
        } else if ($status == 'active') {
            //echo "Active";
            //it is created we need to update database with new data
            $server->server_ip = $check->networks[0]->ipAddress;
            $server->server_status = $status;
            $server->save();
            $instance = UserInstance::where('appsforce_urn', $server->appsforce_urn)->first();
            if ($instance) {
                $instance->server = $server->server_name;
                if ($instance->domain == 'localhost' | $instance->domain == 'NONE') {
                    $instance->domain = $check->networks[0]->ipAddress;
                }
                $instance->status = 1;
                $instance->save();
            }
        } else {
            // echo "Other";
            $server->server_status = $status;
            $server->save();
            $instance = UserInstance::where('appsforce_urn', $server->appsforce_urn)->first();
            if ($instance) {
                $instance->status = 0;
                $instance->save();
            }
        }
    }
}