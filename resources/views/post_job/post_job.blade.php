@extends('layouts.app')

@section('content')

<div class="container">
    @include('message')
    <div class="table-wrapper">
        <div class="table-title">
            <div class="sarch">
                <form method="GET" action="\search">
                    <input type="text" class="search" name="search" placeholder="Search..."></input>
                    <button class="btn btn-primary">Search</button>
                </form>
                <a href="{{ route('post_job.create')}}" class="btn btn-success"><i class="materil-icons" titile="Create"></i>
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
                    <th style="text-align:center" width="7%">Image</th>
                    <th style="text-align:center" width="13%">Company Name</th>
                    <th style="text-align:center" width="9%">Title</th>
                    <th style="text-align:center" width="10%">Requirement</th>
                    <th style="text-align:center" width="10%">email</th>
                    <th style="text-align:center" width="10%">Address</th>
                    <th style="text-align:center" width="13%">Phone Number</th>
                    <th style="text-align:center" width="20%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($postjob as $data)
                    <tr>
                        <td style="text-align:center">
                            <img src="{{ URL::to('/') }}/images//{{ $data->image}}"class="img-thumbnail" width="75"/>
                        </td>
                        <td>{{ $data->company_name }}</td>
                        <td>{{ $data->title }}</td>
                        <td>{{ $data->requirement}}</td>
                        <td>{{ $data->email }}</td>
                        <td>{{ $data->address}}</td>
                        <td>{{ $data->phone_number}}</td>
                        
                         
                        <td> 
                            <div>
                                <a href="{{ route('post_job.show', $data)}}" class="btn_btn-default" >Show</a>
                                <a href="{{ route('post_job.edit', $data)}}" class="btn btn-warning">Edit</a>
                                <a href="{{ url('/post_job/'.$data->id.'/destroy') }}" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger" >Delete</a>
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