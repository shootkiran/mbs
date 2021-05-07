@extends('layouts.app')
@section('title',"Create Examination")
@section('content')
    <h3>Create New Examination</h3>
    <div class="row">
        <div class="col-md-6 offset-md-3">
            {!! Form::open(['route'=>'examination.store']) !!}
            {!! Form::label('Name') !!}
            {!! Form::text('name',null,['class'=>'form-control']) !!}
            {!! Form::label('Exam Date') !!}
            {!! Form::date('exam_date',null,['class'=>'form-control']) !!}
            {!! Form::label('DeadLine') !!}
            {!! Form::date('deadline',null,['class'=>'form-control']) !!}
            {!! Form::label('Venue') !!}
            {!! Form::select('venue_id',\App\Models\Venue::all()->pluck('name','id'),null,['class'=>'form-control']) !!}
            {!! Form::submit('Create New Examination',['class'=>'btn btn-success form-control']) !!}
        </div>
    </div>
@endsection
