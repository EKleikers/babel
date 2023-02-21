<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Schema::defaultStringLength(191);
        // $client = \DB::table('appsforce_client')->first();
        // \Config::set('mail.driver', $client->maildriver);
        // \Config::set('mail.host', $client->smtpserver);
        // \Config::set('mail.port', $client->smtpserverport);
        // \Config::set('mail.from.address', $client->from_address);
        // \Config::set('mail.from.name', $client->from_name);
        // \Config::set('mail.encryption', $client->encryption);
        // \Config::set('mail.username', $client->username);
        // try {
        //     \Config::set('mail.password', customDecrypt($client->password));
        // } catch (\Exception $e) {
        //     \Config::set('mail.password', $client->password);
        // }
    }
}
