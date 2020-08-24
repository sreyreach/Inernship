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
        $credential = $request->only('first_name','last_name','email','company_name', 
        'role', 'birth','phone_number','address');
        //return $credential;
        if ('Auth'::attempt($credential)) 
        {
            return response()->json(['error'=>'Unauthorised'], 401);
        } 
        $form_data = array(
            'first_name'   => $request->first_name,
            'last_name'    => $request->last_name,
            'company_name' => $request->company_name,
            'birth'        => $request->birth,
            'phone_number' => $request->phone_number,
            'address'      => $request->address,
            'email'        => $request->email,
            'role'         => $request->role
        ); 
        User::where('id',$id)->update($form_data);
        $user = User::findOrFail($id); 
        
        return response()->json($user);
    }

    // public function updateProfile($id, Request $request){
    //     $user = User::find($id);
    //     $user->profile = $request->input('profile');
    //     $user->save();
    //     $response["Users"] = $user;
    //     $response["success"] = "1";
    //     $user_data = array(
    //         $response
    //     );
    //     return response()->json($user_data);
    // }

    public function updateProfile( Request $request){
        $credential = $request->only( 'profile');
        if ('Auth'::attempt($credential)) 
        {
            return response()->json(['error'=>'please check fail'], 401);
        } 
        if ($request->hasFile('photo'))
        {
                $photo = $request->file('photo');    
                $new_name = rand() . '.' .$photo->getClientOriginalName();
                $photo->move(public_path('images'), $new_name);
                $request['profile'] = $new_name;
            //return $new_name;
        }else{

                return response()->json(['error'=>'Unauthorised'], 401);
        }
        $form_data = array(
            'profile' => $new_name,
        );

        User::where('id',$request->id)->update($form_data);
        $user = User::findOrFail($request->id); 
         
        return response()->json($user);
    }

    public function getDownloadProfile($id)
    {
        // $user = User::findOrFail($id)->first;
        // return response()->json($user,200);
        $user = User::findOrFail($id);

        $file_path = public_path('images/'.$user->profile);
        return response()->download($file_path);

       // return response()->json($user->image);
    }
    
}
