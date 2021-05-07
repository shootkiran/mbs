@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Personal Details
                </div>
                <div class="card-body">
                    <li class="list-group-item">Name:{{$user->name}} <a href="{{route('user.edit',$user->id)}}"
                                                                        class="small">Edit</a></li>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Registration Status</div>
                <div class="card-body">
                    @if(!$user->UserRegistration->count())
                        You Don't have Any Registrations. <a href="{{route('userregistration.create')}}">Create
                            Now</a>
                    @else
                        @if($user->UserRegistration()->where('photo_id')->count() || $user->UserRegistration()->where('payment_id')->count())
                            <a href="{{route('userregistration.index')}}" class="btn btn-danger">
                                Complete Registration Process
                            </a>
                        @else
                            <a href="{{route('userregistration.index')}}">
                                View Your Registration
                            </a>
                        @endif
                    @endif
                    {{--end of type 1--}}
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Contact Information
                </div>
                <div class="card-body">
                   <i class="fa fa-phone"></i>{{link_to("tel:014582809")}}
                   <i class="fa fa-phone"></i>{{link_to("tel:9851126834")}}
                </div>
            </div>
            <div class="card">
                <div class="card-header">Bank Deposit Details</div>
                <div class="card-body">
                    <h5 class="text-center">Please Deposit the registration fee in one of following bank accounts and
                        upload voucher after completing registration for exam.</h5>
                    <div class="card ">
                        <div class="card-header bg-info">Civil Bank Ltd</div>
                        <div class="card-body">
                            <p>Account Name: East West Management Center</p>
                            <p>Account Number: 047 10275184014</p>
                            <p>Account Branch: Chabahil Branch</p>
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-info">NMB Bank Ltd</div>
                        <div class="card-body">
                            <p>Account Name: East West Management Center</p>
                            <p>Account Number: 0830085004700014</p>
                            <p>Account Branch: Pulchowk Branch</p>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
