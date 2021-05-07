@extends('layouts.app')
@section('title','Create Notice')
@section('content')
    {!! Form::open(['route'=>'notice.store', 'files'=>'true']) !!}
    {!! Form::label('Choose Image File') !!}
    {!! Form::file('img_file',['accept'=>"image/jpeg"]) !!}
    {!! Form::label('Choose Validity') !!}
    {!! Form::date('valid_untill') !!}
    {!! Form::submit('Save') !!}

@endsection