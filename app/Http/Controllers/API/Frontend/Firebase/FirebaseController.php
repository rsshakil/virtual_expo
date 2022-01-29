<?php

namespace App\Http\Controllers\API\Frontend\Firebase;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Company\CompanyUser;
use App\Http\Controllers\Controller;

class FirebaseController extends Controller
{
    public function sendTokenResponseToReceiver($message, $token)
    {
        // Set POST variables
        $url = 'https://fcm.googleapis.com/fcm/send';
 
        $headers = array(
            'Authorization:key=AAAAzcpfwhk:APA91bHGdEE_kUxPl-TR71p02XKXVCT9g8JDrXwmzmmnwCo7ULkgix8A6mJ2VpHGO1_PH4L22t0gNR6fMnKwqHKwmMV14vnLylBbkmBFloG98SUosSX-uRsKw0mUWkVu-mnzcrwAJxNd',
            'Content-Type:application/json'
            
        );

        
        $data = array
        (
            'to'       => $token,
            'data'     => $message,
            'priority' => 'high',
            'sound' => 'default',
            // 'notification'     => array('sound' => 'default', 'title' => 'test title','body' => 'test message')
          );
        // Open connection
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
 
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
 
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
 
        // Close connection
        curl_close($ch);
        
        return $message;
    }

    public function makeCall(Request $request)
    {
        $userId = CompanyUser::where('company_id', $request->company_id)->first()->user_id;

        $company = User::find($userId);
        $stall_token = $company->web_token;

        $customer = Auth::user();

        $filterRoomId            = str_replace(' ','', strtolower(Auth::user()->name));
        $roomId                  = str_replace('.','', $filterRoomId);

        $message = [
            
            'call_state'         => 1,
            'call_status'        => 0,
            'roomId'             => $roomId,
            'company_user_token' => $stall_token,
            'company_id'         => $company->id,
            'customer_id'        => $customer->id,
            'customer_name'      => $customer->name,
            'customer_photo'     => 'public/images/user/'.$customer->photo,
            'company_user_name'  => $company->name,
            'company_user_photo' => 'public/images/user/'.$company->photo,

        ];

        self::sendTokenResponseToReceiver($message, $stall_token);
        
        return $message;
    }
    public function receiveCall(Request $request)
    {
        // return $request->all();
        $customer_id = $request->customer_id; 
        $customer = User::find($customer_id);

        $company = Auth::user();

        $customer_token = $customer->web_token;

        $message = [
            'call_state'  => 1,
            'call_status' => 'received',
            'company_user_token' => $company->web_token
        ]; 

        self::sendTokenResponseToReceiver($message, $customer_token);

        return $message;
    }
    public function joinCall(Request $request)
    {

    }
    public function cancelIncomingCall(Request $request)
    {
        
        $customer_id = $request->customer_id; 
        $customer = User::find($customer_id);

        $customer_token = $customer->web_token;

        $message = [
            'call_state' => 2
        ]; 

        self::sendTokenResponseToReceiver($message, $customer_token);

        return $message;
    }
    public function cancelOutgoingCall(Request $request)
    {
       

        $company = User::find($request->company_id);
        $stall_token = $request->company_user_token;

        $message = [
            'call_state'     => 2
        ];

        self::sendTokenResponseToReceiver($message, $stall_token);
        
        return $message;

    }
}
