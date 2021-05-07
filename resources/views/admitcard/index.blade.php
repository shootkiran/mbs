@extends('layouts.app')
@section('content')
    <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" type="text/javascript"></script>

    {{--<a href="{{route('collection.create')}}" class="btn btn-success">Create New</a>--}}
    <table class="table table-bordered small" id="tabletest">
        <thead>
        <tr>
            <th>ID</th>
            <th>Reg ID</th>
            <th>Name</th>
            <th>Date of Birth</th>
            <th>Level</th>
            <th>Exam Center</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($admitcards as $admitcard)
            <tr>
                <td>{{$admitcard->id}}</td>
                <td>{{$admitcard->admitcard_number}}</td>
                <td>{{$admitcard->name}}</td>
                <td>{{$admitcard->dobad}}</td>
                <td>{{$admitcard->level}}</td>
                <td>{{$admitcard->Venue->name}}</td>
                <td><a href="{{route('admitcard.show',$admitcard->id)}}">Print Admit Card</a> </td>
            </tr>
        @endforeach
        </tbody>

        <tfoot>

        </tfoot>
    </table>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#tabletest').DataTable();
        });
    </script>
@endsection