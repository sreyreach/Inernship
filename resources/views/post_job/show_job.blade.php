@extends('layouts.app')

@section('content')

    <div class="jumbotron text-center">
        <h3>Title : {{ $data->title }}</h3>
        <img style="width: 300px; height: 300px;"src="{{ URL::to('/') }}/images/{{ $data->image }}" class="img-thumbnail" />
        <h3>Requirement: {{ $data->requirement}}</h3>
        
    </div>

@endsection