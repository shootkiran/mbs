@extends('layouts.app')
@section('content')
    {!! Form::open(['route'=>['passport.store',$userRegistration->id],'enctype'=>'multipart/form-data']) !!}
    {!! Form::label('Upload Your Passport') !!}
    {!! Form::file('photo') !!}
    {!! Form::submit('Upload Passport') !!}
    {!! Form::close() !!}
@endsection