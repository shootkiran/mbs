@extends('layouts.app')
@section('content')
    <h1>Create Contact Information</h1>
    <div class="col-md-6 offset-md-3">
        {!! Form::open(['route'=>'usercontact.store']) !!}
        {!! Form::hidden('user_id',$user->id) !!}
        <table class="table">
            <tr>
                <td>Contact Type:</td>
                <td>  {!! Form::select('contact_type',['mobile'=>"Mobile",'office'=>"Office",'home'=>"Home"],0,['class'=>'form-control']) !!}</td>
            </tr>
        <tr>
                <td>Contact Number:</td>
                <td>  {!! Form::text('number',"",['class'=>'form-control']) !!}</td>
            </tr>
            <tr>
                <td colspan="2">
                    {!! Form::submit('Save',['class'=>'form-control btn btn-success']) !!}
                </td>
            </tr>

            {!! Form::close() !!}
        </table>
    </div>
@endsection