@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            {!! Form::open(['route'=>'result.search']) !!}
            {!! Form::text('admission_number','',['placeholder'=>'Type Your Admission Number Here..','class'=>'form-control']) !!}
            {!! Form::submit('Search Result',['class'=>'btn btn-success form-control']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection