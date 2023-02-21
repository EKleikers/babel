<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'appsforce_client';
    public $timestamps = false;
    
    protected $guarded =[''];
}
    