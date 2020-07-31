@extends('layouts.app')

@section('content')

    <div class="jumbotron text-center">
        <h3>First Name : {{ $data->first_name }}</h3>
        <h3>Last Name : {{ $data->last_name }}</h3>
        <h3>Company Name: {{ $data->company_name}}</h3>
        <h3>Email : {{ $data->email }}</h3>
        <h3>Phone Number : {{ $data->phone_number }}</h3>
        <h3>Address : {{$data->address}}</h3>
    </div>

@endsection