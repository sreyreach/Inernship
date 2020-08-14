<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Auth;
use DB;
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
        $postcv = DB::table('postcv')->latest('id')->get();
        return response()->json($postcv);
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
            return response()->json(['error' => 'The file must be a filename.pdf'], 200);
        }

        $user = User::where('id', $request->user_id)->select('role')->first();
      //  dd($role->role);
        if ($user->role != '2') {

            $credential = $request->only('pdf', 'title', 'experience', 'description', 'user_id');

            //return $credential;
            if ($request->hasFile('file')) {
                $value = $request->file('file');
                $pdName = rand() . '.' .$value->getClientOriginalName();
                $value->move(public_path('pdfs'), $pdName);
                $request['pdf'] = $pdName;
               // return $pdName;
            } 
            else {
                return response()->json(['error' => 'Unauthorised'], 401);
            }

            //return $request;
            //return;
          
        } else {
            return response()->json(['error' => 'Wrong position'], 200);
        }
        //dd($postcv);
        $postcv = PostCv::create($request->toArray());
        $postcv['createdAt'] = Carbon::parse($postcv->created_at)->format("m d,Y H:i:s");
        $postcv['updatedAt'] = Carbon::parse($postcv->updated_at)->format("m d,Y H:i:s");
        return response()->json($postcv);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $postcv = PostCv::find($id);
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
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:pdf',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'The file must be a filename.pdf'], 200);
        }

        $user = User::where('id', $request->user_id)->select('role')->first();
      //  dd($role->role);
        if ($user->role == '3') {

            $credential = $request->only('pdf', 'title', 'experience', 'description', 'user_id');

            //return $credential;
            if ($request->hasFile('file')) {
                $value = $request->file('file');
                $pdName = rand() . '.' .$value->getClientOriginalName();
                $value->move(public_path('pdfs'), $pdName);
                $request['pdf'] = $pdName;
               // return $pdName;
            } 
            else {
                return response()->json(['error' => 'Unauthorised'], 401);
            }

            //return $request;
            //return;
          
        } else {
            return response()->json(['error' => 'Wrong position'], 200);
        }
        $form_data = array(
            'title'       =>  $request->title,
            'experience'  =>  $request->experience,
            'description' => $request->description,
            'pdf'         => $pdName,
        );
        //dd($postcv);
        PostCv::where('id',$id)->update($form_data);
        $postcv = PostCv::where('id',$id)->get(); 
        return response()->json($postcv);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            $postcv = PostCv::find($id);
            $postcv->delete();
            return response()->json($postcv);
            $postcv->save();
    
    }
    // public function showPDF($id)
    // {
    
    //     $filename = DB::table('postcv')
    //                      ->select(DB::raw('pdf'))
    //                      ->where('id','=', $id)
    //                      ->get();
    
    //     $name = $filename[0]->pdf;
    
    //     return response()->download("pdfs/$name");
    // }

    public function showPDF($id)
    {
        $user = PostCv::findOrFail($id);

        $file_path = public_path('pdfs/'.$user->pdf);
        return response()->download($file_path);
    }

    public function userId($id){
        $postcv = PostCv::where('user_id', $id)->get(); 
        return response()->json($postcv);
    }
    // $datas = User::where('first_name', 'like', '%'.$search.'%')
    // ->orWhere('last_name', 'like', '%'.$search.'%')
    // ->paginate(10);

    public function readTypeCv($title ,Request $request){
        // $stu = PostCv::where('title',$title)->get();
        $stu = PostCv::where('title', 'like', '%'.$title.'%')->get();
        return response()->json($stu);
     }

   
}
