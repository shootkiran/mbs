@extends('layouts.app')
@section('content')
    <h3> All Registrations of {{$collection->name}}<span class="float-right small"><button type="button"
                                                                                           class="btn btn-sm small btn-danger"
                                                                                           data-toggle="modal"
                                                                                           data-target="#deleteModel">
                Delete This Collection
            </button></span></h3>

    <div class="row">
        @foreach($collection->registration as $registration)
            @if($registration->dummy)
                <div class="col-md-4" id="formfor{{$registration->id}}">
                    <div class="ajaxForm">
                        {!! Form::open(['route' => ['registration.update',$registration->id], 'method' => 'PATCH']) !!}
                        {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
                        {!! Form::text('name', $registration->name, ['class' => 'form-control']) !!}
                        {!! Form::label('dobad', 'DOB in AD', ['class' => 'control-label']) !!}
                        {!! Form::date('dobad', $registration->dobad, ['class' => 'form-control']) !!}
                        {!! Form::label('Level', 'Level', ['class' => 'control-label']) !!}

                        {!! Form::select('level', ['choose level',1,2,3,4,5] , $registration->level , ['class' => 'form-control']) !!}
                        {!! Form::submit('Edit Registration', ['class' => 'form-control btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    @if($collection->registration()->where('dummy',0)->count())

        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Reg ID</th>
                <th>Name</th>
                <th>DOB</th>
                <th>Level</th>
            </tr>
            @foreach($collection->registration as $registration)
                @if(!$registration->dummy)
                    <tr>
                        <td>{{$registration->id}}</td>
                        <td>{{$registration->reg_number}}</td>
                        <td>{{$registration->name}}</td>
                        <td>{{$registration->dobad}}</td>
                        <td>{{$registration->level}}</td>
                        <td><a href="{{route('registration.edit',$registration->id)}}">Edit</a></td>
                    </tr>
                @endif
            @endforeach
        </table>

    @endif

    <br>
    <br>
    <br>
    <div class="row">
        <div class="col-md-6 offset-md-3">

        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you Sure to Delete This?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    This action is not reversible. Be Careful.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    {!! Form::open(['route'=>['collection.destroy',$collection->id],'method'=>'delete']) !!}
                    {!! Form::submit('Delete Confirmed', ['class' => 'btn btn-danger form-control']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
