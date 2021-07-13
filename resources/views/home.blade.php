@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    @if($user->type_id==1)
                        Personal
                    @elseif($user->type_id==2)
                        Organisational
                    @endif
                    Details
                </div>
                <div class="card-body">
                    <li class="list-group-item">Name:{{$user->name}} <a href="{{route('user.edit',$user->id)}}"
                                                                        class="small">Edit</a></li>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Registration Status</div>
                @if($user->type_id==1)
                    <div class="card-body">
                        @if(!$user->Registration->count())
                            You Don't have Any Registrations. <a href="{{route('userregistration.create')}}">Create
                                Now</a>
                        @else
                            @if($user->Registration()->where('photo_id')->count() || $user->Registration()->where('payment_id')->count())
                                <a href="{{route('userregistration.index')}}" class="btn btn-danger">Complete
                                    Registration Process</a>
                            @else
                                <a href="{{route('userregistration.index')}}">View Your Registrations</a>
                            @endif
                        @endif
                        {{--end of type 1--}}
                    </div>
                @elseif($user->type_id==2)
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{route('userregistration.create')}}" class="btn btn-success">Create New
                                    Registration</a>
                            </div>
                            <div class="col-md-6">
                                <a href="{{route('userregistration.index')}}" class="btn btn-primary">Show All
                                    Registrations</a>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <tr>
                                <td>No. of Registrations</td>
                                <td>{{$user->UserRegistration->count()}}</td>
                            </tr>
                            <tr>
                                <td>Photo Submission Pending</td>
                                <td  @if($user->UserRegistration()->where('photo_id',null)->count()) class="bg-danger" @endif>{{$user->UserRegistration()->where('photo_id',null)->count()}}</td>
                            </tr>
                            <tr>
                                <td>Payment Voucher Submission Pending</td>
                                <td @if($user->UserRegistration()->where('payment_id',null)->count()) class="bg-danger" @endif>{{$user->UserRegistration()->where('payment_id',null)->count()}}</td>
                            </tr>
                            <tr>
                                <td>Verified From NAT_TEST</td>
                                <td>{{$user->Payments()->where('verified',1)->count()}}</td>
                            </tr>
                            <tr>
                                <td>Verification Remaining</td>
                                <td>{{$user->Payments()->where('verified',0)->count()}}</td>
                            </tr>

                        </table>
                    </div>


                    {{--endof type 2--}}
                @endif





                {{--@if($user->Registration->count())
                    <div class="row">
                        <div class="col">
                            <i class="card-title">You are registered for {{$user->Registration->count()}} exams</i>
                            <a href="{{route('userregistration.index')}}" class="btn btn-primary">View
                                Registrations</a>
                        </div>
                        <div class="col">
                            <li>Registrations: {{$user->registration->count()}}</li>
                            <li>Unpaid Registrations: {{$user->registration()->where('payment_id')->count()}}</li>
                            <li>Paid Registrations: {{$user->registration()->where('payment_id','>',0)->count()}}</li>
                        </div>
                    </div>
                @else
                    You don't have registration. Please Register
                    <a href="{{route('userregistration.create')}}" class="btn btn-primary">Register</a>
                @endif--}}
            </div>
        </div>
    </div>
@endsection
