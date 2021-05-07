@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Organisational Details
                </div>
                <div class="card-body">
                    <li class="list-group-item">Name:{{$user->name}}
                        <a href="{{route('user.edit',$user->id)}}" class="small">Edit</a></li>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Registration Status</div>

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
                            <td @if($user->UserRegistration()->where('photo_id',null)->count()) class="bg-danger" @endif>{{$user->UserRegistration()->where('photo_id',null)->count()}}</td>
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
            </div>
        </div>

        <div class="col-md-6">
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
