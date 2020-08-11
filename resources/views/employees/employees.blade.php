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
                <a href="{{ route('employees.create')}}" class="btn btn-success"><i class="materil-icons" titile="Create"></i>
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
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Birth</th>
                    <th>Email </th>
                    <th>Phone Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user as $data)
                    <tr>
                        <td>{{ $data->first_name}}</td>
                        <td>{{ $data->last_name}}</td>
                        <td>{{ $data->birth}}</td>
                        <td>{{ $data->email}}</td>
                        <td>{{ $data->phone_number}}</td>
                        <td>
                            <div>
                                <a href="{{ route('employees.show', $data)}}" class="btn_btn-default" >Show</a>
                                <a href="{{ route('employees.edit', $data)}}" class="btn btn-warning">Edit</a>
                                <a href="{{ url('/employees/'.$data->id.'/destroy') }}" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger" >Delete</a>
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