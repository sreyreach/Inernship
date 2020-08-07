<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PostCv;
use App\PostJob;
use Auth;
class PostCvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::User()->role == 1){
            $postcv = PostCv::latest()->paginate(10);
           // $user = User::where('role',2)->paginate(10);
        }else{
            $postcv = PostCv::where('user_id', Auth::User()->id)->paginate(10);
        }
        return view('\post_cv\post_cv', compact('postcv'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('\post_cv\create_cv');
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
            'title'       =>  'required',
            'experience'  =>  'required',
            'email'       => 'required',
            'phone_number'=>'required',
            'file'        => 'file',
        ]);

        $pd = $request->file('file');
        $pdName = rand() . '.' . $pd-> getClientOriginalExtension();
        $pd->move(public_path('pdfs'), $pdName);
    
        $form_data = array(
            'title'  =>  $request->title,
            'experience'  =>  $request->experience,
            'email' => $request->email,
            'phone_number'=> $request->phone_number,
            'pdf'  => $pdName,
            // 'pdf' => ''
        );
        // dd($form_data);
    
        PostCv::create($form_data);
        return redirect('post_cv')->with('success', 'Data Added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = PostCv::findOrFail($id);
        return view('post_cv/show_cv', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = PostCv::findOrFail($id);
        return view('post_cv/edit_cv', compact('data'));
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
            'title'       =>  'required',
            'experience'  =>  'required',
            'email'       => 'required',
            'phone_number'=>'required',
            'file'        => 'file',
        ]);

        $pd = $request->file('file');
        $pdName = rand() . '.' . $pd-> getClientOriginalExtension();
        $pd->move(public_path('pdfs'), $pdName);
    
        $form_data = array(
            'title'  =>  $request->title,
            'experience'  =>  $request->experience,
            'email' => $request->email,
            'phone_number'=> $request->phone_number,
            'pdf'  => $pdName,
        );
        // dd($form_data);
    
        PostCv::whereId($id)->update($form_data);
        return redirect('post_cv')->with('success', 'Data Added successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = PostCv::findOrFail($id);
        $data->delete();
        return redirect('post_cv')->with('success','Data is successfully deleted!');
    }
}
