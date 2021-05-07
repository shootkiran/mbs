@extends('layouts.app')
@section('content')
    {!! Form::open(['route'=>['citizenship.store',$userRegistration->id],'enctype'=>'multipart/form-data']) !!}
    {!! Form::label('Upload Your Citizenship') !!}
    {!! Form::file('photo') !!}
    {!! Form::submit('Upload Citizenship') !!}
    {!! Form::close() !!}
@endsection