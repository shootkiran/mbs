@extends('layouts.app')
@section('content')
    <div class="condensed">
        <table id="tabletest" class="table table-hover table-striped">
            <thead>
            <tr>
                <td>Name</td>
                <td>Date OF Birth</td>
                <td>Contact</td>
                <td>Level</td>
                <td>Photo</td>
                <td>Citizenship</td>
                <td>Passport</td>
                <td>Payment Voucher</td>
                <td>Status</td>
                <td>Created At</td>
                <td>Updated At</td>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>
            @foreach($regs as $reg)
                <tr>
                    <td>{{$reg->name}}</td>
                    <td>{{$reg->dobad}}</td>
                    <td>{{$reg->contact}}</td>
                    <td>{{$reg->level}}</td>
                    @if($reg->photo)
                        <td>
                            <img width='100px' src='{{config('app.url')}}/{{$reg->photo->filename }}'>
                            @if(!$reg->photo->approved )
                                <br>
                                {{link_to_route('photo.create',"Change Photo",$reg->id)}}@endif
                        </td>
                    @else
                        <td>{{link_to_route('photo.create',"Upload Photo",$reg->id)}}
                        </td>
                    @endif
                    @if($reg->Citizenship)
                        <td>
                            <img width='100px'
                                 src='{{config('app.url')}}/{{$reg->citizenship->photo->filename }}'>
                            @if($reg->citizenship->verified!=1)
                                <br>{{link_to_route('citizenship.create',"Change Citizenship",$reg->id)}}
                            @endif
                        </td>

                    @else
                        <td>{{link_to_route('citizenship.create',"Upload Citizenship",$reg->id)}}</td>
                    @endif
                            @if($reg->Passport)
                                    <td>
                                        <img width=' 100px'
                            src='{{config('app.url')}}/{{$reg->passport->photo->filename }}'>
                            @if($reg->Passport->verified!=1)
                                <br>{{link_to_route('passport.create',"Change Passport",$reg->id)}}

                            @endif
                        </td>

                        @else
                                <td>{{link_to_route('passport.create',"Upload Passport",$reg->id)}}</td>
                        @endif
                        @if($reg->payment)
                            <td>
                                <img width='100px'
                                     src='{{config('app.url')}}/{{$reg->payment->photo->filename }}'>
                                @if($reg->payment->verified!=1)
                                    <br> <a href='{{route('payment.create',$reg->id)}}'>Edit</a>
                                @endif
                            </td>
                        @else
                            <td><a href='{{route('payment.create',$reg->id)}}'>Upload Voucher Details</a></td>
                        @endif
                        <td>{!! $reg->Status() !!}
                        </td>
                        <td>{{$reg->created_at}}</td>
                        <td>{{$reg->updated_at}}</td>
                        <td>{!! Form::open(['route'=>['userregistration.destroy',$reg->id],'method'=>'delete']) !!}{!! Form::submit('Delete')!!}{!! Form::close() !!}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection