<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Auth;
use App\User;
use App\PostCv;

class PostCvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($request);


        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:pdf',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Wrong extension'], 200);
        }

        $user = User::where('id', $request->user_id)->select('role')->first();
        //dd($role->role);
        if ($user->role == '3') {

            $credential = $request->only('pdf', 'title', 'experience', 'email', 'phone_number', 'user_id');

            // return $credential;
            if ($request->hasFile('file')) {
                $value = $request->file('file');
                $pdName = $value->getClientOriginalName();
                $value->move(public_path('pdfs'), $pdName);
                $request['pdf'] = $pdName;
            } 
            else {
                return response()->json(['error' => 'Unauthorised'], 401);
            }

            // return $request;
            //return;
          
        } else {
            return response()->json(['error' => 'Wrong position'], 200);
        }
        //dd($postcv);
        $postcv = PostCv::create($request->toArray());
        return response()->json($postcv);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $postcv = PostCv::latest('id')->get();
        return response()->json($postcv);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
