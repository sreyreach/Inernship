@extends('layouts.app')

@section('content')

    <div class="jumbotron text-center">
        <h3>Title : {{ $data->title }}</h3>
        <h3>Description : {{ $data-> discription}}</h3>
        <a href="{{ asset('pdfs')}}/{{ $data->pdf}}" style="width: 110; height: 100%;" > 
             <img  style="width: 300px; height: 300px;"src="{{  asset('/images/pdf_cv.png') }}"alt="" >
        </a> 
    </div>

@endsection