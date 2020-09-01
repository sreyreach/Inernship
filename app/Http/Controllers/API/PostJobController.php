<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\PostJob;

class PostJobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $term=$request->term;
        $location = $request->location;
        $title = $request->title;
        if($term ==null and $location ==null and $title ==null){
            $postcv = DB::table('users')
        ->Join('postjob', 'users.id', '=', 'postjob.user_id')
        ->select(
            'postjob.id',
            'postjob.image',
            'postjob.title',
            'postjob.term',
            'postjob.requirement',
            'postjob.last_date',
            'postjob.address',
            'postjob.company_name',
            'postjob.updated_at',
            'postjob.experience',
            'postjob.phone_number',
            'postjob.email',
            'postjob.user_id',
            'users.profile')
        ->orderByDesc('postjob.updated_at')
        ->paginate(10);
        return response()->json($postcv);
        }elseif($term ==null and $location ==null){
            return $this->getPostJobByTitle("postjob.title",$title);
        }elseif($term ==null and $title ==null){
            return $this->getPostJobByTerm('postjob.address',$location);
        }
        elseif($title ==null and $location ==null){
            return $this->getPostJobByTerm("postjob.term",$term);
        }
        elseif($term ==null){
            return $this->getPostJobByTwoParam("postjob.address",$location,"postjob.title",$title);
        }elseif($location == null){
            return $this->getPostJobByTwoParam("postjob.term",$term,"postjob.title",$title);
        }elseif($title==null){
            return $this->getPostJobByTwoParam("postjob.term",$term,'postjob.address',$location);
        }else{
            return $this->getPostJobByTwoParam("postjob.term",$term,'postjob.address',$location,"postjob.title",$title);
        }
        
    }
    public function getPostJobByTerm($tableName,$param){
        $postcv = DB::table('users')
        ->Join('postjob', 'users.id', '=', 'postjob.user_id')
        ->where($tableName,$param)
        ->select(
            'postjob.id',
            'postjob.image',
            'postjob.title',
            'postjob.term',
            'postjob.requirement',
            'postjob.last_date',
            'postjob.address',
            'postjob.company_name',
            'postjob.updated_at',
            'postjob.experience',
            'postjob.phone_number',
            'postjob.email',
            'postjob.user_id',
            'users.profile')
        ->orderByDesc('postjob.updated_at')
        ->paginate(10);
        return response()->json($postcv);
    }
    public function getPostJobByTitle($tableName,$param){
        $postcv = DB::table('users')
        ->Join('postjob', 'users.id', '=', 'postjob.user_id')
        ->where($tableName,'like', '%'.$param.'%')
        ->select(
            'postjob.id',
            'postjob.image',
            'postjob.title',
            'postjob.term',
            'postjob.requirement',
            'postjob.last_date',
            'postjob.address',
            'postjob.company_name',
            'postjob.updated_at',
            'postjob.experience',
            'postjob.phone_number',
            'postjob.email',
            'postjob.user_id',
            'users.profile')
        ->orderByDesc('postjob.updated_at')
        ->paginate(10);
        return response()->json($postcv);
    }

    public function getPostJobByTwoParam($tableName1,$param1,$tableName2,$param2){
        $postcv = DB::table('users')
        ->Join('postjob', 'users.id', '=', 'postjob.user_id')
        // ->where("postjob.title",$keyword)
        ->where($tableName1,$param1)
        ->where($tableName2,$param2)
        ->select(
            'postjob.id',
            'postjob.image',
            'postjob.title',
            'postjob.term',
            'postjob.requirement',
            'postjob.last_date',
            'postjob.address',
            'postjob.company_name',
            'postjob.updated_at',
            'postjob.experience',
            'postjob.phone_number',
            'postjob.email',
            'postjob.user_id',
            'users.profile')
        ->orderByDesc('postjob.updated_at')
        ->paginate(10);
        return response()->json($postcv);
    }
    public function getPostJobByTreeParam($tableName1,$param1,$tableName2,$param2,$tableName3,$param3){
        $postcv = DB::table('users')
        ->Join('postjob', 'users.id', '=', 'postjob.user_id')
        // ->where("postjob.title",$keyword)
        ->where($tableName1,$param1)
        ->where($tableName2,$param2)
        ->where($tableName3,$param3)
        ->select(
            'postjob.id',
            'postjob.image',
            'postjob.title',
            'postjob.term',
            'postjob.requirement',
            'postjob.last_date',
            'postjob.address',
            'postjob.company_name',
            'postjob.updated_at',
            'postjob.experience',
            'postjob.phone_number',
            'postjob.email',
            'postjob.user_id',
            'users.profile')
        ->orderByDesc('postjob.updated_at')
        ->paginate(10);
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
        public function store(Request $request){

            $user = User::where('id', $request->user_id)->select('role')->first();

         //dd($request);
            if ($user->role != '3') {
                $credential = $request->only( 'company_name','title','term','requirement','last_date',
                'email','address','image','phone_number','user_id');
                    
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

           dd($postjob);
    
           $postjob['createdAt'] = Carbon::parse($postjob->created_at)->format("m d,Y H:i:s");
           $postjob['updatedAt'] = Carbon::parse($postjob->updated_at)->format("m d,Y H:i:s");
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
        
        $postjob = PostJob::find($id);
        $postjob['createdAt'] = Carbon::parse($postjob->created_at)->format("m d,Y H:i:s");
        $postjob['updatedAt'] = Carbon::parse($postjob->updated_at)->format("m d,Y H:i:s");
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
       
        //    dd($request->all());
            $user = User::where('id', $request->user_id)->first();

            //dd($user);

        //dd($request);
           if ($user->role == '2') {
               $credential = $request->only( 'company_name','term','title','requirement',
               'email','address','last_date','image','phone_number','user_id');
               if ($request->hasFile('photo'))
               {
                $photo = $request->file('photo');    
                $new_name = rand() . '.' .$photo->getClientOriginalName();
                $photo->move(public_path('images'), $new_name);
                $request['image'] = $new_name;
                   // return $new_name;
               }else{

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
                    'user_id'       => $request->user_id,
                ); 

                PostJob::where('id',$id)->update($form_data);
                $postjob = PostJob::where('id',$id)->get();
               // dd($postjob);
                return response()->json($postjob);
                   }

           } else {
               return response()->json(['error' => 'Wrong position'], 200);
           }
           // dd('sd');
           //    return $request;
          //$postjob = PostJob::create($request->toArray());
          //$postjob = PostJob::where('id',$request->user_id)->update($request->toArray());
          
          $form_data = array(
            'id' => $request->user_id,
            'company_name' => $request->company_name,
            'term'         => $request->term,    
            'title'        =>  $request->title,
            'requirement'  =>  $request->requirement,
            'experience'   =>  $request->experience,
            'email'        =>  $request->email,
            'last_date'    =>  $request->last_date,
            'address'      =>  $request->address,
            'phone_number' =>  $request->phone_number,
            'image'        =>  $request->image
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

    public function userId($id){
        $postjob = DB::table('postjob')->where('user_id', $id)
                                ->orderByDesc('postjob.updated_at')
                                ->get(); 
        return response()->json($postjob);
    }

    public function readTypeJob($title ,Request $request){
        // $stu = PostJob::where('title',$title)->get();
        $stu = PostJob::where('title', 'like', '%'.$title.'%')->get();
        return response()->json($stu);
    }

}
