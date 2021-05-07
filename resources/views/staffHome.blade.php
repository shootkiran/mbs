@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h3>Search Collection</h3>
            {!! Form::open(['route' => 'collection.search', 'method' => 'post']) !!}
            {!! Form::text('keyword', '', ['placeholder'=>'Search in collection...','autofocus','class' => 'form-control']) !!}
            {!! Form::close() !!}

        </div>
    </div>
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h3>Search Regsitration</h3>
            {!! Form::open(['route' => 'registration.search', 'method' => 'post']) !!}
            {!! Form::text('keyword', '', ['placeholder'=>'Search in registration...','autofocus','class' => 'form-control']) !!}

            {!! Form::close() !!}

        </div>
    </div>
@endsection