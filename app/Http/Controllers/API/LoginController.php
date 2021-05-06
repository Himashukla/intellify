<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'Enable','user_type'=> 'Merchant'])) {

            $find = User::where([
                'email' => $request->email,
            ])->first();

            //generate api token if not saved in db
            if (empty($find->api_token)) {
                $find->api_token = Str::random(60);
                $find->save();
            }

            $data['success'] = "1";
            $data['message'] = "Successful login.";
            $data['data'] = (['user' => $find]);
        } else {
            $check = User::where('email',$request->email)->first();
            if(!$check){
                $message = 'User does not Exist';
            }else if($check->status == 'Disable'){
                $message = 'You must be active to login.';
            }else if($check->user_type != 'Merchant'){
                $message = 'User type not supported for login.';
            }else{
                $message = 'Invalid login credentials.';
            }
            $data['success'] = "0";
            $data['message'] = $message;
            $data['data'] = "";
        }

        return response()->json($data);
    }
}
