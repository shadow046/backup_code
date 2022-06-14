@extends('layouts.app')

@section('content')
    <h1>Create Post</h1>
    {{ Form::open(array('url' => 'foo/bar')) }}
        echo Form::label('email', 'E-Mail Address');
{{ Form::close() }}
@endsection