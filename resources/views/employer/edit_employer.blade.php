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
    <form method="post" id="form" action="{{route('employer.update', $data)}}" enctype="multipart/form-data" style="margin:80px" >
        <div class="row">
                <h2 style="color:#334d4d; margin-left: 400px;">Update <b>Employer</b></h2>
            </div>
    
    
        @csrf
    
        @method('PATCH')
        <div class="form-group">

            <label class="class= text1">Enter First Name</label>
            <div class="col1">
                <input type="text" name="first_name" value="{{ $data->first_name }}" class="form-control input-lg"/>
            </div>

            <label class="text1">Enter Last name</div>
            <div class="col1">
                <input type="text" name="last_name" value="{{ $data->last_name }}" class="form-control input-lg"/>
            </div>

            <label class="class= text1">Enter Company Name</label>
            <div class="col1">
                <input type="text" name="company_name" value="{{ $data->company_name }}" class="form-control input-lg"/>
            </div>

            <div class="form-group">
                <label class="text1">Email</label>
                <div class="col1">
                <input type="text" name="email" value="{{ $data->email }}" class="form-control input-lg"/>
            </div>

            <div class="form-group">
                <label class="text1">Phone Number</label>
                <div class="col1">
                <input type="text" name="phone_number" value="{{ $data->phone_number }}"  class="form-control input-lg"/>
            </div>
           <div class="form-group">
                <label class="text1">Address</label>
                <div class="col1">
                <input type="text" name="address" value="{{ $data->address }}"  class="form-control input-lg"/>
            </div>
            </div>

        </div>

        <div class="form-group text-center">
            <input type="submit" name="edit" class="btn btn-primary input-lg"  style="margin-left:250px" value="edit" />
        </div>
    </form> 

@endsection