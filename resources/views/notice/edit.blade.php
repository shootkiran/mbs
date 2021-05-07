@extends('layouts.app')
@section('title','Edit Notice')
@section('content')
    {!! Form::open(['route'=>['notice.update',$notice->id], 'files'=>'true','method'=>'patch']) !!}
    {!! Form::label('Choose Validity') !!}
    {!! Form::date('valid_untill') !!}
    {!! Form::submit('Save') !!}


@endsection