@extends('layouts.app')
@section('content')
    <h3>Create New Examination</h3>
    <div class="row">
        <div class="col-md-6 offset-md-3">
    {!! Form::open(['route'=>['examination.update',$examination->id],'method'=>'PATCH']) !!}

    {!! form::label('Name') !!}
    {!! form::text('name',$examination->name,['class'=>'form-control']) !!}

    {!! form::label('Examination Date') !!}
    {!! form::date('exam_date',$examination->exam_date,['class'=>'form-control']) !!}

    {!! form::label('Form Deadline') !!}
    {!! form::date('deadline',$examination->deadline,['class'=>'form-control']) !!}

    {!! form::label('Form Start Date') !!}
    {!! form::date('startline',$examination->startline,['class'=>'form-control']) !!}

    {!! form::label('Active Examination') !!}
    {!! form::text('available',$examination->available,['class'=>'form-control']) !!}

    {!! form::label('Venue ID') !!}
    {!! form::text('venue_id',$examination->venue_id,['class'=>'form-control']) !!}

    {!! form::submit('Update Data',['class'=>'btn btn-success form-control']) !!}
        </div>
    </div>


@endsection
