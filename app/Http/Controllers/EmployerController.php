<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
//use App\Auth;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Auth;
class EmployerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = User::where('role',2)->andWhere('id',Auth::User()->id)->paginate(10);
        // return view('\employer\employer', compact('user'))
        //      ->with('i', (request()->input('page',1) -1) *5);

             if(Auth::User()->role == 1){
                $user = User::where('role',2)->paginate(10);
            }else{
                $user = User::where('role',2)->where('id',Auth::User()->id)->paginate(10);
            }
            return view('\employer\employer', compact('user'))
                 ->with('i', (request()->input('page',1) -1) *10);
    }

    // public function paginate($items, $perPage = 5, $page = null, $options = [])
    // {
    //     $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
    //     $items = $items instanceof Collection ? $items : Collection::make($items);
    //     return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    // }
    
    public function search(Request $request)
    {
        $search = $request->search;
        
        $user = User::where('role',2)->where('first_name', 'like', '%'.$search.'%')
        ->orWhere('last_name', 'like', '%'.$search.'%')
        ->paginate(10);
        return view('\employer\employer', compact('user'))
                ->with('i', (request()->input('page',1) -1) *5);
    } 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('\employer\create_employer');
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
            'company_name' => 'required',
            'email'        => 'required|unique:App\User,email',
            'phone_number' => 'required|numeric|unique:App\User',
            'address'      => 'required',
        ]);
    
        $form_data = array(
            'first_name'   =>  $request->first_name,
            'last_name'    => $request->last_name,
            'company_name' =>  $request->company_name,
            'email'        => $request->email,
            'password'     => 'test',
            'phone_number' => $request->phone_number,
            'address'      => $request->address,
            'role'         => 2,
        );
       

        User::create($form_data);
        return redirect('employer')->with('success', 'Data Added successfully!');
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
        return view('\employer\show_employer', compact('data'));
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
        return view('\employer\edit_employer', compact('data'));
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
            'company_name' => 'required',
            'email' => 'unique:App\User,numeric'.$id,
            //'email_address' =>'required|email|unique:users,email_address,'.$id,
            'phone_number' => 'required|numeric|unique:App\User',
            'address'  => 'required',
        ]);
    
        $form_data = array(
            'first_name'   => $request->first_name,
            'last_name'    => $request->last_name,
            'company_name' => $request->company_name,
            'email'        => $request->email,
            'phone_number' => $request->phone_number,
            'address'      => $request->address,
        );
        User::whereId($id)->update($form_data);
        return redirect('employer')->with('success', 'Data is successfully update !');
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
        return redirect('employer')->with('success','Data is successfully deleted!');
    }
}
