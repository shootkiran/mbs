@extends('layouts.app')
@section('content')

    {!! Form::open(['route'=>['user.update',$user->id],'method'=>'Patch']) !!}
    {!! Form::label('Full Official Name') !!}
    {!! Form::text('name',$user->name) !!}
    {!! Form::submit('Modify') !!}
    {!! Form::close() !!}
@endsection