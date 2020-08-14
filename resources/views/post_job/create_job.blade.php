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
    <form method="post" id="form" action="{{ route('post_job.store') }}" enctype="multipart/form-data" style="margin:80px" >
        @csrf
        <div class="form-group">
            <div class="row">
                    <h2 style="color:#334d4d; margin-left: 400px;">Create <b>Post Job</b></h2>
            </div>

            <label class="class= text1">Enter Company Name</label>
            <div class="col1">
                <input type="text" name="company_name" value="{{ old('company_name') }}" class="form-control input-lg"/>
            </div>

            <label class="class= text1">Enter Term</label>
            <div class="col1">
                <input type="text" name="term" value="{{ old('term') }}" class="form-control input-lg"/>
            </div>

            <label class="class= text1">Enter Title</label>
            <div class="col1">
                <input type="text" name="title" value="{{ old('title') }}" class="form-control input-lg"/>
            </div>

            <label class="text1">Enter Requirement</div>
            <div class="col1">
                <input type="text" name="requirement" value="{{ old('requirement') }}" class="form-control input-lg"/>
            </div>

            <label class="class= text1">Enter Experience</label>
            <div class="col1">
                <input type="text" name="experience" value="{{ old('experience') }}" class="form-control input-lg"/>
            </div>

            <label class="class= text1">Enter Email</label>
            <div class="col1">
                <input type="text" name="email" value="{{ old('email') }}" class="form-control input-lg"/>
            </div>

            <label class="class= text1">Enter Last date</label>
            <div class="col1">
                <input type="text" name="last_date" value="{{ old('last_date') }}" class="form-control input-lg"/>
            </div>

            <label class="class= text1">Enter Address</label>
            <div class="col1">
                <input type="text" name="address" value="{{ old('address') }}" class="form-control input-lg"/>
            </div>

            <label class="class= text1">Enter Phone Number</label>
            <div class="col1">
                <input type="text" name="phone_number" value="{{ old('phone_number') }}" class="form-control input-lg"/>
            </div>

            <label class="class= text1">Enter Ueser id post</label>
            <div class="col1">
                <input type="text" name="user_id" value="{{ old('user_id') }}" class="form-control input-lg"/>
            </div>
            

            <div class="form-group">
                <label class="text1">Select Image</label>
                <div class="col1">
                    <input type="file" name="image"/>
                </div>
            </div>
            <div class="form-group text-center">
                <input type="submit" name="create" class="btn btn-primary input-lg" style="margin-left:250px" value="create" />
            </div>
        </div>
    </form> 
@endsection