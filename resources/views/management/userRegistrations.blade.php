@extends('layouts.app')
@section('content')
    <div class="btn-group">
        <a href="/management/userregistrations" class="btn btn-primary">Show all</a>
        <a href="/management/userregistrations?payment=0" class="btn btn-success">Payment Not Approved Only</a>
        <a href="/management/userregistrations?payment=1" class="btn btn-info">Payment Approved Only</a>
        <a href="/management/userregistrations?payment=2" class="btn btn-warning">Manual Verification Required</a>

    </div>
    <table class="table table-bordered" id="tabletest">
        <thead>
        <th>Photo</th>
        <th>Citizenship</th>
        <th>Passport</th>
        <th>Payment</th>
        <th>Name</th>
        <th>Level</th>
        <th>Contact Number</th>
        <th>Submitted By</th>
        <th>Submitted On</th>
        <th>Payment Status</th>
        <th>Actions</th>
        </thead>
        <tbody>
        @foreach($urs as $ur)
            <tr>
                <td>
                    @if($ur->Photo)
                        <img src="{{config('app.url')}}/{{$ur->Photo->filename}}" width="40px">
                        @if($ur->Photo->approved)
                            Approved
                        @endif
                    @else
                        no
                    @endif
                </td>
                <td>
                    @if($ur->Citizenship)
                        <img src="{{config('app.url')}}/{{$ur->Citizenship->Photo->filename}}" width="40px">
                        @if($ur->Citizenship->Photo->approved)
                            Approved
                        @endif
                    @else
                        no
                    @endif
                </td>
                <td>
                    @if($ur->Passport)
                        <img src="{{config('app.url')}}/{{$ur->Passport->Photo->filename}}" width="40px">
                        @if($ur->Passport->Photo->approved)
                            Approved
                        @endif
                    @else
                        no
                    @endif
                </td>
                <td>
                    @if($ur->Payment)
                        <img src="{{config('app.url')}}/{{$ur->Payment->Photo->filename}}" width="40px">
                        @if($ur->Payment->Photo->approved)
                            Approved
                        @endif

                    @else
                        no
                    @endif
                </td>
                <td>{{$ur->name}}</td>
                <td>{{$ur->level}}</td>
                <td>@foreach($ur->User->Contact as $contact){{$contact->number}} @endforeach</td>
                <td>{{$ur->User->name}}</td>
                <td>{{\Carbon\Carbon::createFromTimeString($ur->created_at)->toDateString()}}
                    ({{\Carbon\Carbon::createFromTimeString($ur->created_at)->diffForHumans()}})
                </td>
                <td>@if($ur->payment){{$ur->payment->verified}}@else Not Paid @endif</td>
                <td>
                    @if($ur->Photo)
                        {{link_to_route('photo.show',"View Photo",[$ur->id,$ur->Photo->id])}}
                    @endif
                    @if($ur->Citizenship)
                        {{link_to_route('photo.show',"View Citizenship",[$ur->id,$ur->Citizenship->Photo->id])}}
                    @endif
                    @if($ur->Passport)
                        {{link_to_route('photo.show',"View Passport",[$ur->id,$ur->Passport->Photo->id])}}
                    @endif
                    @if($ur->payment)
                        {{link_to_route('payment.show',"View Payment",[$ur->id,$ur->payment->id])}}

                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection