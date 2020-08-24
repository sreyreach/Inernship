<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\User;
class EmployeesController extends Controller
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
        if(Auth::User()->role == 1){
            $user = User::where('role',3)->paginate(10);
        }else{
            $user = User::where('role',3)->where('id',Auth::User()->id)->paginate(10);
        }
        return view('\employees\employees', compact('user'))
                ->with('i', (request()->input('page',1) -1) *5);
    }

    public function search(Request $request)
    {
        $search = $request->search;
        
        $user = User::where('role',3)->where('first_name', 'like', '%'.$search.'%')
        ->orWhere('last_name', 'like', '%'.$search.'%')
        ->paginate(10);
        return view('\employees\employees', compact('user'))
                ->with('i', (request()->input('page',1) -1) *5);
    } 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees/create_employees');
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
            'birth'        => 'required',
            'email'        => 'required|unique:App\User,email',
            'phone_number' => 'required|numeric|unique:App\User',
            
        ]);
    
        $form_data = array(
            'first_name'   =>  $request->first_name,
            'last_name'    => $request->last_name,
            'birth'        =>  $request->birth,
            'email'        => $request->email,
            'password'     => 'test',
            'phone_number' => $request->phone_number,
            'role'         => 3,
        );
       

        User::create($form_data);
        return redirect('employees')->with('success', 'Data Added successfully!');
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
        return view('\employees\show_employees', compact('data'));
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
        return view('\employees\edit_employees', compact('data'));
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
            'birth'        => 'required',
            'email'        => 'unique:App\User,email,'.$id,
            //'email_address' =>'required|email|unique:users,email_address,'.$id,
            'phone_number' => 'required|numeric|unique:App\User',
        ]);
    
        $form_data = array(
            'first_name'   => $request->first_name,
            'last_name'    => $request->last_name,
            'birth'        => $request->birth,
            'email'        => $request->email,
            'phone_number' => $request->phone_number,
        );
        User::whereId($id)->update($form_data);
        return redirect('employees')->with('success', 'Data is successfully update !');
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
        return redirect('employees')->with('success','Data is successfully deleted!');
    }
}
