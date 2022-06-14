@extends('layouts.app')
@section('content')
        <h1>Posts</h1>
       {{-- <p> count {{$count}}</p> --}}
       @if(count($posts) >1)
                @foreach ($posts as $post )
                <div class = "well">
                        <h3>{{$post->title}}</h3>
                </div>  
                @endforeach     
        @else
                <p>'No post found' </p>
        @endif
@endsection
