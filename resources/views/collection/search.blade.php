@extends('layouts.app')
@section('content')
    <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <h3>Search Results for "{{$keyword}}"</h3>
    <table class="table table-bordered small" id="tabletest">
        <thead>
        <tr>
            <th>Reg ID</th>
            <th>Date Time</th>
            <th>Name</th>
            <th>Examination Name</th>
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
            <tr>
                <td><a href="{{route('collection.edit',$collection->id)}}">{{$collection->regid()}}</a></td>
                <td>{{$collection->datetime}}</td>
                <td>{{$collection->name}}</td>
                <td>{{$collection->Examination->name}}</td>
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
                    <a href="{{route('collection.show',$collection->id)}}" class="btn btn-danger btn-sm"><i
                                class="fa fa-print"></i></a>
                    @if($collection->students_count!=$collection->registration()->count())
                        <a href="{{route('registrations.createfromcollection',$collection->id)}}"
                           class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> </a>

                        <a href="{{route('registration.dummy',$collection->id)}}">Create Dummy</a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#tabletest').DataTable();
        });
    </script>
@endsection