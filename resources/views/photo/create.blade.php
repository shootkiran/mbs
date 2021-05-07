@extends('layouts.app')
@section('content')
    {!! Form::open(['route'=>['photo.store',$userRegistration->id],'enctype'=>'multipart/form-data']) !!}
    {!! Form::label('Upload Your Photo') !!}
    {!! Form::file('photo') !!}
    {!! Form::submit('Upload Photo') !!}
    {!! Form::close() !!}
@endsection