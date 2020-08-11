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
    
    <form method="post" id="form" action="{{route('post_cv.update', $data)}}" enctype="multipart/form-data" style="margin:80px" >
        @method('put')
        @csrf
        <div class="form-group">
            <div class="row">
                <h2 style="color:#334d4d; margin-left: 400px;">Create <b>Post CV</b></h2>
        </div>

        <label class="class= text1">Enter Title</label>
        <div class="col1">
            <input type="text" name="title" value="{{ $data->title }}" class="form-control input-lg"/>
        </div>

        <label class="class= text1">Enter Experience</label>
        <div class="col1">
            <input type="text" name=" experience" value="{{ $data->experience }}" class="form-control input-lg"/>
        </div>

        <label class="class= text1">Enter Description</label>
        <div class="col1">
            <input type="text" name="description" value="{{ $data->description }}" class="form-control input-lg"/>
        </div>
        

        <div class="form-group">
            <label class="text1">Select File</label>
            <div class="col1">
                <input type="file" name="file"/>
            </div>
        </div>
        <div class="form-group text-center">
            <input type="submit" name="create" class="btn btn-primary input-lg" style="margin-left:250px" value="create" />
        </div>
        </div>
    </form> 
@endsection