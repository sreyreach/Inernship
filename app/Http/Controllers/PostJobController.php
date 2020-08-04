<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PostJob;
class PostJobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postjob = PostJob::all();
        return view('\post_job\post_job', compact('postjob'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('\post_job\create_job');
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
            'company_name' => 'required',
            'term'         => 'required',
            'title'        =>  'required',
            'requirement'  =>  'required',
            'experience'   =>  'required',
            'email'        =>  'required',
            'last_date'    =>  'required',
            'address'      =>  'required',
            'phone_number' =>  'required',
            'image'  => 'required|image|max:2048',
        ]);
        
        $image = $request->file('image');
        $new_name = rand() . '.' . $image-> getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);
    
        $form_data = array(
            'company_name' => $request->company_name,
            'term'         => $request->term,    
            'title'        =>  $request->title,
            'requirement'  =>  $request->requirement,
            'experience'   =>  $request->experience,
            'email'        =>  $request->email,
            'last_date'    =>  $request->last_date,
            'address'      =>  $request->address,
            'phone_number' =>  $request->phone_number,
            'image'        =>  $new_name
        );
    
        PostJob::create($form_data);
        return redirect('post_job')->with('success', 'Data Added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = PostJob::findOrFail($id);
        return view('post_job/show_job', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = PostJob::findOrFail($id);
        return view('\post_job\edit_job', compact('data'));
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
            'company_name' => 'required',
            'term'         => 'required',
            'title'        =>  'required',
            'requirement'  =>  'required',
            'experience'   =>  'required',
            'email'        =>  'required',
            'last_date'    =>  'required',
            'address'      =>  'required',
            'phone_number' =>  'required',
            'image'  => 'required|image|max:2048',
        ]);
        $image = $request->file('image');

        $new_name = rand() . '.' . $image-> getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);
    
        $form_data = array(
            'company_name' => $request->company_name,
            'term'         => $request->term,    
            'title'        =>  $request->title,
            'requirement'  =>  $request->requirement,
            'experience'   =>  $request->experience,
            'email'        =>  $request->email,
            'last_date'    =>  $request->last_date,
            'address'      =>  $request->address,
            'phone_number' =>  $request->phone_number,
            'image'        =>  $new_name
        );
    
        PostJob::whereId($id)->update($form_data);
        return redirect('post_job')->with('success', 'Data is successfully update !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = PostJob::findOrFail($id);
        $data->delete();
        return redirect('post_job')->with('success','Data is successfully deleted!');
    }
}
