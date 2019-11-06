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
                    @if($user->type_id==1)
                        <li class="list-group-item">Date of Birth (AD):{{$user->dobad}}</li>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Registration Status</div>

                <div class="card-body">
                    @if($user->Registration->count())
                        <div class="">
                            You are registered for {{$user->Registration->count()}} exams
                        </div>
                        <div class="row">
                            @if($user->type_id==2)
                                <div class="col-md-6">
                                    <ul class="list-group">
                                        @foreach($user->Registration as $registration)
                                            <li class="list-group-item">
                                                <a href="{{route('registration.show',$registration->id)}}">
                                                    {{$registration->name}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if($user->type_id==1)

                                @foreach($user->Registration as $registration)
                                    <div class="col-md-6">
                                        <h4>Exam Detail</h4>
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                {{$registration->Examination->name}}
                                            </li>
                                            <li class="list-group-item">
                                                Date: {{$registration->Examination->exam_date}}
                                                ({{\Carbon\Carbon::createFromTimeStamp(strtotime($registration->Examination->exam_date))->diffForHumans()}}
                                                )

                                            </li>
                                            <li class="list-group-item">
                                                Venue: {{$registration->Examination->Venue->name}}<a
                                                        href="{{route('venue.show',$registration->Examination->Venue->id)}}">Show
                                                    Details.</a>
                                            </li>
                                        </ul>

                                    </div>
                                @endforeach
                            @endif
                        </div>
                    @else
                        You don't have registration. Please Register
                        <a href="{{route('registration.create')}}" class="btn btn-primary">Register</a>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
