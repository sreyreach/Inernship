<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index(){
        $user = User::latest('id')->get();
        return response()->json($user);
    }

    public function show($id){
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id){
        $credential = $request->only('first_name','last_name','email', 'password','company_name', 
        'role', 'birth','phone_number','address');
        //return $credential;
        if ('Auth'::attempt($credential)) 
        {
             return response()->json(['error'=>'Unauthorised'], 401);
        } 
       
        // $request->validate([
        //     'first_name'   => 'required',
        //     'last_name'    => 'required',
        //     'company_name' => 'required',
        //     'birth'        => 'required',
            // 'email'        => 'unique:App\User,email',
        //     'role'      => 'required',
        //     'phone_number' => 'numeric',
        // ]);
      //dd("sd");
        $form_data = array(
            'first_name'   =>  $request->first_name,
            'last_name'    => $request->last_name,
            'company_name' => $request->company_name,
            'birth'        => $request->birth,
            'phone_number' => $request->phone_number,
            'email'        => $request->email,
            'role'        => $request->role
        ); 
        User::where('id',$id)->update($form_data);
        $user = User::where('id',$id)->get(); 
        
        return response()->json($user);
    }
    
}
