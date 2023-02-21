<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
include_once $_SERVER['DOCUMENT_ROOT'] . '/myadmin/resources/helpers/helper.php';


class Welcome extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $activeAppID = 100001075;
        $head = callAppsForceAPI($activeAppID, 'include/emailheader', 1);
        $foot = callAppsForceAPI($activeAppID, 'include/emailfooter', 1);
        dd($head);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.welcome');
    }
}
