<?php

namespace App\Http\Controllers\API\Frontend\Auth;

use Auth;
use Helper;
use App\Models\User;
use App\Mail\OtpSentMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\Types\Object_ as TypesObject_;
use PhpParser\Node\Expr\Cast\Object_;

class AuthController extends Controller
{
    public function signUp(Request $request)
    {
    
        $this->validate($request, [
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|max:255|unique:users,email',
            'password'  => 'required|string|min:3|confirmed'
        ]);

        $emailOrPhone = $request->email;

        $otp = Helper::autoOtp();  
        $message = "Your otp verification code: ". $otp;

        $name = $request['name'];
        $email = $request['email'];
 
        // if (strpos($emailOrPhone, '@') !== false) {
            
        //     $details = [
        //         'name' => $name,
        //         'body' => $message
        //     ];
           
        //     Mail::to($email)->send(new OtpSentMail($details));

        // } else {

        //     $message_status = Helper::sendSMS($email, $message);

        // }

        $fileName = Helper::imgProcess($request,'photo',$request->name, '', 'images/user', 'store', User::class); 


        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'photo'    => $fileName,
            'role'     => 'Customer',
            'otp'      => $otp,
            'password' => Hash::make($request->password), //bcrypt($request->password),
        ]);

        

        return response()->json([
            'status'   => 'success',
            'message'  => 'User has been created!',
            'email'    => $request->email,
            'password' => $request->password,
            'role'     => 'Customer',
            'otp'      => $otp
        ]);

    }

    public function resentOtp(Request $request)
    {
        
        $check = User::where('email', $request->resent_otp)->exists();

        if($check){
            
            $user = User::where('email', $request->resent_otp)->first();

            $emailOrPhone = $request->resent_otp;

            $otp = Helper::autoOtp();  

            $message = "Your otp verification resent code: ". $otp;

            $name = $user->name;
            $emailOrPhone = $request['resent_otp'];

            if (strpos($emailOrPhone, '@') !== false) {

                User::where('email', $user->email)->update(['otp' => $otp]);
                
                $details = [
                    'name' => $name,
                    'body' => $message
                ];
            
                Mail::to($email)->send(new OtpSentMail($details));

                return response()->json([
                    'status'   => 'success',
                    'otp_status'   => 'success',
                    'message'  => 'User has been created!',
                    'email'    => $user->email,
                    // 'password' => $request->password,
                    'role'     => 'Customer',
                    'otp'      => $otp
                ]);

            } else {

                User::where('email', $user->email)->update(['otp' => $otp]);

                $message_status = Helper::sendSMS($email, $message);

                return response()->json([
                    'status'   => 'success',
                    'otp_status'   => 'success',
                    'message'  => 'Verification has been created!',
                    'email'    => $request->email,
                    'password' => $request->password,
                    'role'     => 'Customer',
                    'otp'      => $otp
                ]);

            }
        } else {
            return response()->json([
                'status' => 'failed',
                'otp_status' => 'failed',
                'message' => 'Invalid Email or Phone'
            ]);
        }
        
    }

    public function otpVerify(Request $request)
    {
        
        $getData = $request->except([
            'confirm_otp',
            'confirm_otp_resent', 
            'digit_1',
            'digit_2',
            'digit_3',
            'digit_4',
            'digit_5',
            'digit_6',
            'otp_status',
            'role',
            'web_token'

            ]);

        //  $data =  ;
       

        $credential = Auth::attempt($getData);
        // return $user = Auth::user();  
        // return $credential;
       if($credential == true){

        User::where('email', $request->email)->update([
            'web_token' => $request->web_token
        ]);

        $user = Auth::user();
        $token = $user->createToken('nbyvirtualexpo')->plainTextToken;

        $response = [
            'user'              => $user,
            'token'             => $token,
            'status'            => 'success',
            'message'           => 'Login successful!'
        ];

        return response($response, 201);

       } 
       
    //    else {

    //         return response()->json([
    //             [
    //                 'message' => 'These credentials do not match our records.',
    //                 'status'  => false
    //             ], 404
    //         ]);

    //    }
       
    }



    public function signIn(Request $request)
    {
        // return $request->all();
        // $check = User::where('otp', $request->otp)->where('email', $request->email)->exists();


        // if($check){
        //     $user = User::where('email', $request->email)->where('role', $request->role)->where('otp', $request->otp)->first();

        //     if (!$user || !Hash::check($request->password, $user->password)) {
        //         return response([
        //             'message' => ['These credentials do not match our records.']
        //         ], 404);
        //     }

            
        //     //Only for doctor
        //     // User::find($user->id)->update([
        //     //     'web_token' => $request->web_token,
        //     // ]);
    
        //     $token = $user->createToken('nbyvirtualexpo')->plainTextToken;
    
        //     $response = [
        //         'user'      => $user,
        //         'token'     => $token,
        //         'web_token' => $request->web_token,
        //         'message'   => 'User Logged in successfully!'
        //     ];
        //     return response($response, 201);
        // } else {
        //     return response()->json([
        //         'status' => '404',
        //         'message' => 'OTP or credentials do not match our records.'
        //     ]);
        // }

        $this->validate($request, [
            'email'     => 'required|string',
            'password'  => 'required|string'
        ]);


        $credential = Auth::attempt($request->only('email', 'password'));

       if($credential){
        
        User::where('email', $request->email)->update([
            'web_token' => $request->web_token
        ]);

        $user = Auth::user();
        $token = $user->createToken('nbyvirtualexpo')->plainTextToken;

        $response = [
            'user'              => $user,
            'token'             => $token,
            'status'            => true,
            'message'           => 'Login successful!'
        ];

        return response($response, 201);

       } else {

            return response()->json([
                [
                    'message' => 'These credentials do not match our records.',
                    'status'  => false
                ], 404
            ]);

       }
    }
    
}
