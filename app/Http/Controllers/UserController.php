<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $applicants = Applicant::where('id', '!=', Auth::guard('applicant')->user()->id)->get();
        //return view('applicant.index', compact('applicants'));
        // $users = DB::table('users')->paginate(10);

        // return view('user.index', ['users' => $users]);

       $user = User::where('role',1)->get();
       return view('\admin\admin', compact('user'));
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $request->validate([
            'first_name'   => 'required',
            'last_name'    => 'required',
            'email'        => 'unique:App\User,email',
            'phone_number' => 'numeric',
        ]);
    
        $form_data = array(
            'first_name'   =>  $request->first_name,
            'last_name'    => $request->last_name,
            'email'        => $request->email,
            'password'     => 'test',
            'phone_number' => $request->phone_number,
            'role'         => $request->role,
        );

        User::create($form_data);
        return redirect('user')->with('success', 'Data Added successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::findOrFail($id);
        return view('admin/show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::findOrFail($id);
        return view('admin/edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name'   => 'required',
            'last_name'    => 'required',
            'email'        => 'unique:App\User,email,'.$id,
            //'email_address' =>'required|email|unique:users,email_address,'.$id,
            'phone_number' => 'numeric',
        ]);
    
        $form_data = array(
            'first_name'   =>  $request->first_name,
            'last_name'    => $request->last_name,
            'email'        => $request->email,
            'phone_number' => $request->phone_number,
        );
        User::whereId($id)->update($form_data);
        return redirect('user')->with('success', 'Data is successfully update !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::findOrFail($id);
        $data->delete();
        return redirect('user')->with('success','Data is successfully deleted!');
    }
}
