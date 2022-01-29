<?php

namespace App\Http\Controllers\API\Backend\Auth;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function signIn(Request $request)
    {
        $user = $request->validate([
            'email'             => 'required|email',
            'password'          => 'required'
        ]);

        User::where('email', $request->email)->update(['web_token' => $request->web_token]);

        $loginData = $request->except(['web_token']);


       $credential = Auth::attempt($loginData);

       if($credential){

        $user = Auth::user();

       } else {

            // if (! $user || ! Hash::check($request->password, $user->password)) {

            //     // throw ValidationException::withMessages([
            //     //     'email' => ['The provided credentials are incorrect.'],
            //     // ]);

            //     return response([
            //         'message' => ['These credentials do not match our records.']
            //     ], 404);

            // }

            return response([
                'message' => ['These credentials do not match our records.']
            ], 404);

       }
    
        $token = $user->createToken('nbyvirtualexpo')->plainTextToken;

        $response = [
            'user'              => $user,
            'token'             => $token,
            'status'            => 200,
            'message'           => 'Login successful!'
        ];

        return response($response, 201);


    }

    public function register(Request $request)
    {

    }

    public function signOut()
    {
        Auth::logout();
        return response()->json([
            'status' => 200,
            'message' => 'Sign Out Successfully!'
        ]);
    }

}
