@extends('layouts.app')
@section('content')
    <h3>Edit Registration Details</h3>
    <div class="col-md-6 offset-md-3">
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
    <br>
    <br>
    <br>
    <div class="row">

        <div class="col-md-6 offset-md-3">
            <a href="{{route('collection.edit',$registration->collection_id)}}" class="btn btn-secondary">Go To Collection</a>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModel">
                Delete This Registration
            </button>
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
                    {!! Form::open(['route'=>['registration.destroy',$registration->id],'method'=>'delete']) !!}
                    {!! Form::submit('Delete Confirmed', ['class' => 'btn btn-danger form-control']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection