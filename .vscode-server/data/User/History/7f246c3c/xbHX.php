@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    @if(count($posts) > 0)
        @foreach($posts as $post)
            <div class="well">
                        <h3><a href="/posts{{$post->id}}">{{$post->id}}</a></h3>
                        {{-- <small>{{$post->body}}</small> --}}
                        <small>written on {{$post->created_at}}</small>
            </div>
        @endforeach
        {{-- {{$posts->links()}} --}}
    @else
        <p>No posts found</p>
    @endif
@endsection