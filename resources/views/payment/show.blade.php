@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-md-6">
            <h3>Voucher Number:{{$payment->voucher_number}}</h3>
            <h3>bank_branch:{{$payment->bank_branch}}</h3>
            <h3>deposit_date:{{$payment->deposit_date}}</h3>
            <h3>deposit_by:{{$payment->deposit_by}}</h3>
            @if($payment->verified!=1)
                {{link_to_route('payment.verify',"This is a valid voucher as per statement of our company bank account.",[$payment->id,'pass'=>1],['class'=>'btn btn-success'])}}
                {{link_to_route('payment.verify',"This needs Manual Checking.Mark Failed.",[$payment->id,'pass'=>2],['class'=>'btn btn-danger'])}}
            @endif
        </div>
        <div class="col-md-6">
            <img width="100%" src="{{config('app.url')}}/{{$payment->photo->filename}}">

        </div>
    </div>

@endsection