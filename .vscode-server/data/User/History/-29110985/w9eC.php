@extends('layouts.app')

@section('content')
<a href="/posts" class="btn btn-default">Go Back</a>

    @if(count($posts) > 0)
        @foreach($posts as $post)
            <div class="well">
                        <h1>{{$post->title}}</h1>
                        <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                        <small>{{$post->body}}</small> --}}
                        {{-- <small>written on {{$post->created_at}}</small> --}}
            </div>
        @endforeach
        {{-- {{$posts->links()}} --}}
    @else
        <p>No posts found</p>
    @endif
@endsection