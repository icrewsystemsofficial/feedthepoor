<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class Mobile extends Controller
{
    public function index(){
        $response = array();

        $response['app_name'] = config('app.name');
        $response['environment'] = config('app.env');
        $response['version'] = config('app.version');
        return response()->json($response);
    }

    public function getPendingDonations(Request $request) {

    }

    public function authenticate(Request $request) {

        $response = array();

        $request->validate([
            'email' => 'email|required',
            'password' => 'required',
            // 'ngo_id' => 'required', NGO ID will be fetched from profile.
        ]);

        $email = request('email');
        $password = request('password');
        $ngo_id = request('ngo_id');
        //TODO: The NGO Stuff is for the future, when
        // we have multi tenency for different NGOs.
        $user = User::where('email', $email)->first();
        if(!$user) {
            $response['type'] = 'error';
            $response['message'] = 'No user found with email '.$email;
        } else if(Hash::check($password, $user->password)) {
            $response['type'] = 'success';
            $response['message'] = 'User authenticated';
            $response['user_id'] = $user->id;
            $response['user_email'] = $user->email;
            $token = $user->createToken('mobile-authentication-token');
            $response['token'] = $token->plainTextToken;
            $response['ngo_id'] = $ngo_id;
        } else {
            $response['type'] = 'error';
            $response['message'] = 'Incorrect email / password. Visit website to reset your password';
        }

        return response()->json($response);
    }

    public function getToken($email = '') {
        $response = array();
        //This is NOT to be used on prodcution.
        if(config('app.env') == 'local') {
            if($email == '') {
                $response['type'] = 'error';
                $response['message'] = 'Email cannot be empty';
            } else {
                $user = User::where('email', $email)->first();
                $user->tokens()->delete();

                $token = $user->createToken('token-generated-via-get-method');
                $response['token'] = $token->plainTextToken;
                //This will spit out the token.
            }
        } else {
            $response['type'] = 'error';
            $response['message'] = 'Application not on Local environment.';
        }

        return response()->json($response);
    }

}
