@extends('layouts.app')

@section('content')

<div class="container">
    @include('message')
    <div class="table-wrapper">
        <div class="table-title">
            <div class="sarch">
                <form method="GET" action="\search_postcv">
                    <input type="text" class="search" name="search" placeholder="Search..."></input>
                    <button class="btn btn-primary">Search</button>
                </form>
                <a href="{{ route('post_cv.create')}}" class="btn btn-success"><i class="materil-icons" titile="Create"></i>
                    <span>Add</span>
                </a>
            </div>
        </div>
    </div>
    <div>
        <div class="alert alert-success alert-block">
            <button type="Button" class="close" data-dimiss="alert"></button>
            <strong><strong>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th  style="text-align:center" width="10%">PDF</th>
                    <th  style="text-align:center" width="15%">Title</th>
                    <th  style="text-align:center" width="10%">Experience</th>
                    <th  style="text-align:center" width="15%">Description</th>
                    <th  style="text-align:center" width="20%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($postcv as $data)
                    <tr>
                        <td style="text-align:center">
                        <a href="{{ asset('pdfs')}}/{{ $data->pdf}}" style="width: 110; height: 100%;" >  <img  style="width: 110; height: 100%;"src="{{  asset('/images/pdf_cv.png') }}"alt="" ></a> 
                        </td>
                        <td >{{ $data->title }}</td>
                        <td>{{ $data->experience }}</td>
                        <td >{{ $data->description }}</td>
                        <td> 
                            <div>
                                <a href="{{ route('post_cv.show', $data)}}" class="btn_btn-default" >Show</a>
                                <a href="{{ route('post_cv.edit', $data)}}" class="btn btn-warning">Edit</a>
                                <a href="{{ url('/post_cv/'.$data->id.'/destroy') }}" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger" >Delete</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @yield('content')
    </div>
</div>

@endsection