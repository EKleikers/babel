<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\UserInstance;
use App\UserApp;

class BackAPIs extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        
    }

    public $codes = array(
        '200' => 'Request was succesful',
        '400' => 'Request was malformed',
        '401' => 'Application id is invalid or application is not installed',
        '402' => 'User is not logged in',
        '403' => 'Authorised user is not allowed access',
        '404' => 'Token not valid',
        '405' => 'Email not valid',
        '406' => 'User does not exist. Please register on appsforce.org',
        '407' => 'Cannot detect valid IP address',
        '500' => 'Internal Server error'
    );

    function test() {
        return 'OK';
    }

    function init(Request $request, $email) {
        \Log::info('API Init called for email: '.$email);
        try {
            //user can exist here, or not, and appsforce instance can be craeted here or not
            //if the user and or instance does not exist, we need to create it.
            
            //email can be encrypted with 2 methods or not at all
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $decrypted = $email;
            } else {
                try {$test = customDecrypt($email);} catch (\Exception $e) {$test = "";}
                if (filter_var($test, FILTER_VALIDATE_EMAIL)) {
                    $decrypted = $test;
                } else {
                    try {$test = decrypt($email);} catch (\Exception $e) {$test = "";}
                    if (filter_var($test, FILTER_VALIDATE_EMAIL)) {
                        $decrypted = $test;
                    } else {
                        // we tried 3 decriptions, none of them worked we have to return error.
                        \Log::error('Failed to Decrypt Email '.$email);
                        $response = array(
                            'code' => 405,
                            'message' => $this->codes['405'],
                        );
                        return $response;
                        die();
                    }
                }
            }
            
            $user = \App\User::where('email', $decrypted)->first();
            if (!$user) {
                \Log::error('Failed to find user: '.$email);
                $response = array(
                    'code' => 406,
                    'message' => $this->codes['406'],
                );
                return $response;
                die();
            }


            $first_ip = $_SERVER['REMOTE_ADDR'];
            $second_ip = \Request::getClientIp();

            if (filter_var($first_ip, FILTER_VALIDATE_IP)) {
                $ip = $first_ip;
            } else {
                if (filter_var($second_ip, FILTER_VALIDATE_IP)) {
                    $ip = $second_ip;
                } else {
                    \Log::error('Cannot detect valid IP: '.$first_ip.', '.$second_ip);
                    $response = array(
                        'code' => 407,
                        'message' => $this->codes['407'],
                    );
                    return $response;
                    die();
                }
            }

            $af = UserInstance::where('domain', $ip)->first();
            if (!$af) {
                \Log::error('Cannot find AppsForce with IP: '.$first_ip.', '.$second_ip);
                //we have the registered user, IP is valid but not on the system. In this case we will create a new instance
                $randomname = randomname();
                $af = new UserInstance;
                $af->user_id = $user->id;
                $af->appsforce_friendly_name = $randomname;
                $af->domain = $ip;
                $af->server = $ip;
                $urn = "URN:";
                $urn .= 'Domain: ' . $af->domain . ' ';
                $urn .= 'Server: ' . $af->server . ' ';
                $urn .= 'Random: ' . md5(uniqid(rand(), true)) . ' ';
                $urn = base64_encode($urn);
                $af->appsforce_urn = $urn;
                $af->status = 1;
                $af->save();
                \Log::info('AppsForce created: '.$urn);
            }

            //last lets check does the user have API token.
            if ($user->api_token == null) {
                $user->api_token = str_random(60);
                \Log::info('User automatically given API token: '.$user->api_token);
                $user->save();
            }

            $pieces = explode(" ", $user->name);
            try {
                $firstname = $pieces[0];
            } catch (\Exception $e) {
                $firstname = "None";
            }
            try {
                $lastname = $pieces[1];
            } catch (\Exception $e) {
                $lastname = "None";
            }
            $data = array(
                'firstname' => $firstname,
                'lastname' => $lastname,
                'middlename' => " ",
                'appsforce' => $af,
                'api_token' => $user->api_token
            );
            $response = array(
                'code' => 200,
                'message' => $this->codes['200'],
                'data' => $data,
            );
            return $response;
        } catch (\Exception $e) {
            \Log::error('Exception cought '.$e);
            $response = array(
                'code' => 500,
                'message' => $this->codes['500'],
            );
            return $response;
        }
    }

    function grant(Request $request, $urn, $appid, $users) {
        try {
            //$clientapplication = \DB::table('client_applications')->where('appsforce_urn', $urn)->where('app_id', $appid)->get();
            $ca = UserApp::where('appsforce_urn', $urn)->where('app_id', $appid)->first();
//            $limit = $clientapplication['0']->application_user_limit;
//            $license = $clientapplication['0']->application_license;
            \Log::info('Granting app request for urn and appid');
            \Log::info($urn);
            \Log::info($appid);

            if ($ca && $ca != null) {
                $limit = $ca->application_user_limit;
                $license = $ca->application_license;
                if ($users < $limit | $license == "Full" | $license == "Free") {
                    $data = 'OK';
                    \Log::info('Found the app and user limit check passed');
                } else {
                    $data = 'FAILED';
                    \Log::info('Found the app and user limit check failed');
                }
            } else {
                $appid = intval($appid);
                if ($appid >= 999999900 & $appid <= 999999999 | $appid == '100000000' | $appid == '100000001') {
                    $data = 'OK';
                    \Log::info('Did not find the app, but the app does not require check');
                } else {
                    $data = 'FAILED'; //we should not have this case
                    \Log::error('Did not find the app, and the app requires check');
                }
                
            }
            \Log::info('Granting app request finished');
            $response = array(
                'code' => 200,
                'message' => $this->codes['200'],
                'data' => $data,
            );
            return $response;
        } catch (Exception $ex) {
            \Log::error('Granting app caused exception');
            $response = array(
                'code' => 403,
                'message' => $this->codes['403'],
            );
        }
        return $response;
    }

}
