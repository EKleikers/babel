<?php
 
namespace App\Http\Controllers\Auth;
 
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Support;
use Illuminate\Support\Facades\Crypt;

 
class GuestAPIs extends Controller { 
 
 
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
 
 
    public function login(Request $request) {
        $username = request('username');
        $password = request('password');
        $secretcode = "eyJpdiI6IndyU1QxUzNPZHE4Z0diZk9tcHlReVE9PSIsInZhbHVlIjoiTnhId2hZdXRcL0w3MVM0M1wvSzFWVGt4c3Nsa1wvOWRNV09MRE9DbDRzMVwvRzA9IiwibWFjIjoiNWU2MWMxMzY2NmY4YTNhNDQxNDk2NDFkZTk5NDRkOTRlM2QxM2QyYzk0YWYyMzFmMTRhZjJlNDI1OWJhNWJkYSJ9";
        try {
            $response = $this->checkAuthorisation($request);
            if ($response != 'OK') {
                return $response;
            }
    
            $response = $this->checkToken($request);
            if ($response != 'OK') {
                return $response;
            }
    
            $user = User::where('username', $username)->first();
    
            $response = array(
                'code' => 200,
                'message' => $this->codes['200'],
                'data' => $user,
            );
            return $response;
            
            } catch (Exception $e) {
            $response = array(
                'code' => 500,
                'message' => $this->codes['500'],
                'data' => $e
            );
            return $response;
        }
    
    } 
 
 
    public function getusers(Request $request) {
    
        $username = request('username');
        $secretcode = "eyJpdiI6IndyU1QxUzNPZHE4Z0diZk9tcHlReVE9PSIsInZhbHVlIjoiTnhId2hZdXRcL0w3MVM0M1wvSzFWVGt4c3Nsa1wvOWRNV09MRE9DbDRzMVwvRzA9IiwibWFjIjoiNWU2MWMxMzY2NmY4YTNhNDQxNDk2NDFkZTk5NDRkOTRlM2QxM2QyYzk0YWYyMzFmMTRhZjJlNDI1OWJhNWJkYSJ9";
    
        
        try {
            $response = $this->checkUser($request);
            if ($response != 'OK') {
                return $response;
            }
    
            $response = $this->checkToken($request);
            if ($response != 'OK') {
                return $response;
            } 
    
            $user = AppsForceUser::where('username', $username)->first();
    
            
            } catch (Exception $e) {
            $response = array(
                'code' => 500,
                'message' => $this->codes['500'],
                'data' => $e
            );
            return $response;
        }
    
        $user = AppsForceUser::where('username', $username)->first();
    
        $response = array(
            'code' => 200,
            'message' => $this->codes['200'],
            'data' => $user,
        );
        return $response;
    
    }
 
    public function home() {
        $response = array(
            'code' => 200,
            'message' => $this->codes['200'],
            'data' => 'OK',
        );
    }

    function checkUser($request) {
        $username = request('username');
        $user = AppsForceUser::where('username', $username)->first();
        if ($user) {
            
            return 'OK';
            
        } else {
            $response = array(
                'code' => 402,
                'message' => $this->codes['402'],
            );
            return $response;
        }
    }
 

    function checkAuthorisation($request) {
        $username = request('username');
        $password = request('password');
        include_once $_SERVER['DOCUMENT_ROOT'] . '/myadmin/resources/helpers/helper.php';
        $appsforceresponse = callAppsForceAPI('100001065', 'checkpassword/'.$username.'/'.$password);
        if ($appsforceresponse['code'] == '200' && $appsforceresponse['data'] == 'OK') {
            $response = 'OK';
            return $response;
        } else {
            $response = array(
                'code' => $appsforceresponse['code'],
                'message' => $appsforceresponse['message']
            );
            return $response;
        }
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


 
 
