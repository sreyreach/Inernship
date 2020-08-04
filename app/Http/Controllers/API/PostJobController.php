<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Auth;
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
        public function store(Request $request){

            // $validator = Validator::make($request->all(), [
            //     //'image' => 'required|mimes:pdf|mimes:image',
            //     'image'  => 'required|image',
            //  ]);
    
            // if($validator->fails()){
            //   return response()->json(['error'=>'Wrong extension'], 200);
            // }
         //dd($request);
            $credential = $request->only( 'company_name','title','term','requirement','email','address','image','phone_number');
            
            //return $credential;
            // if (Auth::attempt($credential)) 
            // {
            //     return response()->json(['error'=>'Unauthorised'], 401);
            // } 

           if ($request->hasFile('photo')) {
                $photo = $request->file('photo');    
                $new_name = $photo->getClientOriginalName();
                $photo->move(public_path('images'), $new_name);
                $request['image'] = $new_name;
               //  return $new_name;
            }
            else{

                return response()->json(['error'=>'Unauthorised'], 401);
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
    public function show()
    {
        $postjob = PostJob::latest('id')->get();

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
