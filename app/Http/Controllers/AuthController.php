<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //

    public function login(Request $request)
    {

        // validate data and make sure required fields are filled and the correct data is entered

        $this->validate($request, [
            'email' => 'required|email|string',
            'password' => 'required|string'
        ]);

        // attempt to login
        // if login is successful, create an oAuth token for the user
        // else return unauthorized message
        
        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('ChallengeApp')->accessToken;
                $response = ['token' => $token];
                return response()->json($response, 200);
            } 
            else {
                $response = ["message" => "Wrong password"];
                return response()->json($response, 422);
            }
        } 
        else {
            $response = ["message" => 'User does not exist'];
            return response()->json($response, 422);
        }
    }
}
