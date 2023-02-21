<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use App\Models\Cart;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     * @return void
     */
    public function boot()
    {

        view()->composer('includes/header', function ($headerCartNumber)
        {
            $user_id = 9;
            $cartProducts = Cart::with('products')->where('user_id', '=', $user_id)->get();
            $quantityNumber = array();
            foreach ($cartProducts as $singleProduct) {
                array_push($quantityNumber, $singleProduct->qty);
            }
            $quantityNumber = array_sum($quantityNumber);
            $headerCartNumber->with('quantityNumber', $quantityNumber);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}