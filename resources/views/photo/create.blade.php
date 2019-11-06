@extends('layouts.app')
@section('content')
    @if($user->type_id==1)
        {!! Form::open(['route'=>'photo.store','enctype'=>'multipart/form-data']) !!}
        {!! Form::label('Upload Your Photo') !!}
        {!! Form::file('photo') !!}
        {!! Form::submit('Upload Photo') !!}
        {!! Form::close() !!}

    @elseif($user->type_id==2)
        @foreach($user->Registration as $registration)
            {{dump($registration)}}
        @endforeach

    @endif



@endsection