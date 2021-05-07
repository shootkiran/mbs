@extends('layouts.app')
@section('content')

                <h3>Payment Entry Form</h3>
                <div class="form-group">
                    {!! Form::open(['route'=>['payment.store',$userRegistration->id],'enctype'=>'multipart/form-data']) !!}
                    {!! Form::label('Voucher Number') !!}
                    {!! Form::text('voucher_number','',['class'=>'form-control','required'=>'required']) !!}
                    {!! Form::label('Bank Branch Address') !!}
                    {!! Form::text('bank_branch','',['class'=>'form-control','required']) !!}

                    {!! Form::label('Deposit Date') !!}
                    {!! Form::date('deposit_date','',['class'=>'form-control','required']) !!}

                    {!! Form::label('Deposit By:') !!}
                    {!! Form::text('deposit_by','',['class'=>'form-control','required']) !!}

                </div>

                {!! Form::label('Upload Photo of Receipt from Bank Deposit') !!}

                <div>

                </div>
                {!! Form::file('voucher',['required']) !!}
                <br>

                {!! Form::submit("Register",['class'=>'btn btn-success form-control']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    @endsection()