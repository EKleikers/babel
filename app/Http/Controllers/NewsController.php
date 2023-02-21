<?php

namespace App\Http\Controllers;

use App\Models\Experiment;
use App\Models\Lab;
use App\Models\Recipe;
use App\Models\Report;
use App\Models\SensorData;
use App\Http\Requests\ExperimentRequest;

use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | News Controller
    |--------------------------------------------------------------------------
    |
    | Responsible for showing news related views: .show/ 
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show View: news.show
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showNews()
    {
        return view('babel.news.show');
    }
}
