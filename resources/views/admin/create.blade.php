@extends('layouts.app')

@section('content')
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="post" id="form" action="{{ route('user.store') }}" enctype="multipart/form-data" style="margin:80px" >

        @csrf
        <div class="form-group">
            <div class="row">
                    <h2 style="color:#334d4d; margin-left: 400px;">Create <b>User</b></h2>
            </div>
            <label class="class= text1">Enter First Name</label>
            <div class="col1">
                <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control input-lg"/>
            </div>

            <label class="text1">Enter Last name</div>
            <div class="col1">
                <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control input-lg"/>
            </div>
            <div class="form-group">
                <label class="text1">Email</label>
                <div class="col1">
                <input type="text" name="email" value="{{ old('email') }}"  class="form-control input-lg"/>
            </div>

            <div class="form-group">
                <label class="text1">Phone Number</label>
                <div class="col1">
                <input type="text" name="phone_number" value="{{ old('phone_number') }}" class="form-control input-lg"/>
            </div>
            </div>

            <div class="form-group">
                <label class="text1">Role</label>
                <div class="col1">
                    <select name="role" id="role"  class="form-control input-lg">
                        <option value="1">Admin</option>
                        <option value="2">Employer</option>
                        <option value="3">Employees</option>
                    </select>
                </div>
            </div>

        </div>

        <div class="form-group text-center">
            <input type="submit" name="create" class="btn btn-primary input-lg" style="margin-left:250px" value="create" />
        </div>
    </form> 
@endsection