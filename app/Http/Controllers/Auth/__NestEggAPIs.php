<?php
 
namespace App\Http\Controllers\Auth;
 
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Support;
use Illuminate\Support\Facades\Crypt;

 
class NestEggAPIs extends Controller { 
 
 
    public $codes = array(
        '200' => 'Request was succesful',
        '400' => 'Request was malformed',
        '401' => 'Application id is invalid or application is not installed',
        '402' => 'User is not logged in',
        '403' => 'Authorised user is not allowed access',
        '404' => 'Token not valid',
        '405' => 'Password incorrect',
        '406' => 'Error Saving Action',
        '407' => 'Error Updating User',
        '408' => 'Gateway or Sensor not found',
        '409' => 'Data not present or correct',
        '410' => 'No such input or input does not have Status',
        '411' => 'No Switch Status available',
        '500' => 'Internal Server error'
    );
 
    public function usbRelay() {
        //$response = "THIS IS THE USB-RELAY";
      
        // current minute
        $minute = date('i');
    
        //if minute = even: response = 0
        if($minute % 2 == 0){
            $response = 0;
        }else{
        //if minute = odd: response = 1
            $response = 1;
        }
    
        //\Log::info("nestegg api - minute: " . $minute . ", response: " . $response);
        return $response;
    }
 


function checkToken($request) {
    $token = request('token');
    $secretcode = "eyJpdiI6IndyU1QxUzNPZHE4Z0diZk9tcHlReVE9PSIsInZhbHVlIjoiTnhId2hZdXRcL0w3MVM0M1wvSzFWVGt4c3Nsa1wvOWRNV09MRE9DbDRzMVwvRzA9IiwibWFjIjoiNWU2MWMxMzY2NmY4YTNhNDQxNDk2NDFkZTk5NDRkOTRlM2QxM2QyYzk0YWYyMzFmMTRhZjJlNDI1OWJhNWJkYSJ9";
    if ($token != $secretcode) {
        $response = array(
            'code' => 404,
            'message' => $this->codes['404'],
        );
        return $response;
    } else {
        return 'OK';
    }
}
 


 
 
}