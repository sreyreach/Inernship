<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use \App\User;

class AuthController extends Controller
{
    public function login(Request $request){
        $credential = $request->only('email', 'password');
        // return $credential;
        if ('Auth'::attempt($credential)) {
            $api_token = str::random(60);
            User::where('id', 'Auth'::user()->id)->update(['api_token' => $api_token]);
            return response()->json(['token'=> $api_token,'success'=>1,'id'=>'Auth'::user()->id]);
        }else{
            return response()->json(['token'=>'Unauthorised','success'=>0,'id'=>null], 401); 
        }
    }

    public function register (Request $request) {

        $validator = Validator::make($request->all(), [
            'phone_number' => 'required|numeric|unique:App\User',
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'please chack your phone number and you password again'], 200);
        }

        $credential = $request->only('first_name','last_name','email', 'password','company_name', 
        'adress', 'birth');
        //return $credential;
        if ('Auth'::attempt($credential)) 
        {
             return response()->json(['error'=>'Unauthorised'], 401);
        }
        $request['password'] = Hash::make($request['password']);
        $api_token = str::random(60);
        $request['api_token'] = $api_token;
        $user = User::create($request->toArray());            
        $api_token = $user->createToken('Laravel Password Grant Client')->accessToken;
        $response = ['api_token' => $api_token];
        return response()->json(['Authorisation', $api_token]);   
    }

     
}

   
