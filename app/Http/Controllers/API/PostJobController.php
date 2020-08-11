<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Auth;
use DB;
use App\User;
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
        public function store(Request $request){

            $user = User::where('id', $request->user_id)->select('role')->first();

         //dd($request);
            if ($user->role == '2') {
                $credential = $request->only( 'company_name','title','term','requirement',
                'email','address','image','phone_number','user_id','description');
                    
                    //return $credential;
                    // if (Auth::attempt($credential)) 
                    // {
                    //     return response()->json(['error'=>'Unauthorised'], 401);
                    // } 

                if ($request->hasFile('photo'))
                {
                        $photo = $request->file('photo');    
                        $new_name = rand() . '.' . $photo->getClientOriginalName();
                        $photo->move(public_path('images'), $new_name);
                        $request['image'] = $new_name;
                    //  return $new_name;
                }else{

                        return response()->json(['error'=>'Unauthorised'], 401);
                    }

            } else {
                return response()->json(['error' => 'Wrong position'], 200);
            }
            //    return $request;
           $postjob = PostJob::create($request->toArray()); 

            return response()->json($postjob);
        }   
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
         $postjob = PostJob::latest('id')->where('id',$id)->get();
       // $postjob = DB::table('postjob')->where('id','=',$id)->get();
        return response()->json($postjob);
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
       
            
            $user = User::where('id', $request->user_id)->select('role')->first();

        //dd($request);
           if ($user->role == '2') {
               $credential = $request->only( 'company_name','term','title','requirement',
               'email','address','last_date','image','phone_number','user_id','experience');
               if ($request->hasFile('photo'))
               {
                       $photo = $request->file('photo');    
                       $new_name = rand() . '.' .$photo->getClientOriginalName();
                       $photo->move(public_path('images'), $new_name);
                       $request['image'] = $new_name;
                   // return $new_name;
               }else{

                       return response()->json(['error'=>'Unauthorised'], 401);
                   }

           } else {
               return response()->json(['error' => 'Wrong position'], 200);
           }
           // dd('sd');
           //    return $request;
          //$postjob = PostJob::create($request->toArray());
          //$postjob = PostJob::where('id',$request->user_id)->update($request->toArray());
          
          $form_data = array(
            'id' => $request->id,
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
        //dd($form_data);
        PostJob::where('id',$id)->update($form_data);
        $postjob = PostJob::where('id',$id)->get(); 
         
        return response()->json($postjob);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $postjob = PostJob::find($id);
        $postjob->delete();
        return response()->json($postjob);
        $postjob->save();
    }
    public function find($id)
    {
       
        $postjob = PostJob::findOrFail($id);

        return response()->json($postjob);
    }
    public function showImage($id)
    {

        $filename = DB::table('postjob')
                         ->select(DB::raw('image'))
                         ->where('id','=', $id)
                         ->get();
    
        $name = $filename[0]->image;
    
        return response()->download("images/$name");
    }

    public function getDownload($id)
    {
        // $user = User::findOrFail($id)->first;
        // return response()->json($user,200);
        $user = PostJob::findOrFail($id);

        $file_path = public_path('images/'.$user->image);
        return response()->download($file_path);

       // return response()->json($user->image);
    }

}
