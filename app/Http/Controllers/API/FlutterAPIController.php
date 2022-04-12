<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FlutterAPIController extends Controller
{

    /**
     * response
     *
     * @param  mixed $data
     * @return void
     */
    protected function response(array $data) {

        $response = array();
        foreach($data as $key => $value) {
            $response[$key] = $value;
        }

        return response()->json($response);
    }

    /**
     * authenticate
     *
     * @param  mixed $request
     * @return void
     */
    public function authenticate(Request $request) {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {

            // $request->session()->regenerate();
            // Creds match
            $user = User::find(auth()->id());

            // Clear existing tokens.
            $user->tokens()->delete();

            // Create token.
            $token = $user->createToken('login')->plainTextToken;

            return $this->response([
                'message' => 'Authenticated',
                'token' => $token,
                'user' => auth()->user(),
            ]);
        } else {
            return $this->response(['message' => 'Invalid credentials']);
        }

    }

    /**
     * app_details
     *
     * @return void
     */
    public function app_details() {
        return $this->response([
           'message' => 'Application Details',
           'data' => array(
            'app_name' => config('app.name'),
            'ngo_name' => config('app.ngo_name'),
            'api_version' => '1',
           ),
        ]);
    }

    public function user_details() {
        return $this->response([
            'message' => 'User details for '.auth()->user()->name,
            'data' => User::find(auth()->id())->with('roles')->first(),
        ]);
    }
}
