@extends('layouts.app')
@section('content')

    @if(request()->exam_id and !$examination->available)
        <h3 class="text-center text-danger">You Are Viewing Non Active Examination({{$examination->name}})</h3>
    @endif
    <div class="row">
        <div class="col-md-6">
            <a href="{{route('collection.create')}}" class="btn btn-success">Create New Group</a>
            <a href="{{route('collection.createSingle')}}" class="btn btn-success">Create New Single</a>
        </div>
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-body">
                    {!! Form::open(['method'=>'get']) !!}
                    {!! Form::select('exam_id',\App\Models\Examination::all()->pluck('name','id'),'',['placeholder'=>"Choose Examination",'required','class'=>'form-control']) !!}
                    {!! Form::submit('Change Examination',['class'=>'btn btn-primary']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive small">
    <table class="table table-bordered small" id="tabletest">
        <thead>
        <tr>
            <th>Reg ID</th>
            <th>Date Time</th>
            <th>Name</th>
            <th>Contact</th>
            <th>Level5</th>
            <th>Level4</th>
            <th>Level3</th>
            <th>Level2</th>
            <th>Level1</th>
            <th>No. of Students</th>
            <th>Registrations</th>
            <th>Collected By</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($collections as $collection)
            <tr @if($collection->refunded)class="text-danger"@endif>
                <td><a href="{{route('collection.edit',$collection->id)}}">{{$collection->regid()}}</a></td>
                <td>{{$collection->datetime}}</td>
                <td>{{$collection->name}}</td>
                <td>{{$collection->contact}}</td>
                <td>{{$collection->level5}}</td>
                <td>{{$collection->level4}}</td>
                <td>{{$collection->level3}}</td>
                <td>{{$collection->level2}}</td>
                <td>{{$collection->level1}}</td>
                <td>{{$collection->students_count}}</td>
                <td>{{$collection->registration()->count()}}</td>
                <td>{{\App\User::find($collection->collected_by)->name}}</td>
                <td class="btn-group">
                    <a href="{{route('collection.show',$collection->id)}}" class="btn btn-info btn-sm"><i
                                class="fa fa-print"></i></a>
                    @if(!$collection->refunded)
                        <div class="modal fade" id="refund{{$collection->id}}" tabindex="-1" role="dialog"
                             aria-labelledby="refund{{$collection->id}}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        ARE YOU SURE?
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{route('collection.refund',$collection->id)}}" class="btn btn-danger">
                                            Yes, Refund
                                        </a>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No,Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                data-target="#refund{{$collection->id}}">
                            Refund
                        </button>

                    @endif
                    @if($collection->students_count!=$collection->registration()->count())
                        <a href="{{route('registrations.createfromcollection',$collection->id)}}"
                           class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> </a>

                        <a href="{{route('registration.dummy',$collection->id)}}" class="btn btn-sm btn-warning">
                            Create Dummy</a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>

        <tfoot>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{$level5_total}}</td>
            <td>{{$level4_total}}</td>
            <td>{{$level3_total}}</td>
            <td>{{$level2_total}}</td>
            <td>{{$level1_total}}</td>
            <td>{{$students_total}}</td>
            <td></td>
            <td></td>
        </tr>
        </tfoot>
    </table>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#tabletest').DataTable();
        });
    </script>
@endsection
