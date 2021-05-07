@extends('layouts.app')
@section('content')
    <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" type="text/javascript"></script>
<h3>Search Result for "{{$keyword}}"</h3>
    {{--<a href="{{route('collection.create')}}" class="btn btn-success">Create New</a>--}}
    <table class="table table-bordered small" id="tabletest">
        <thead>
        <tr>
            <th>ID</th>
            <th>Reg ID</th>
            <th>Name</th>
            <th>Date of Birth</th>
            <th>Level</th>
            <th>Admission Number</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($registrations as $registration)
            <tr>
                <td>{{$registration->id}}</td>
                <td>{{$registration->reg_number}}</td>
                <td>{{$registration->name}}</td>
                <td>{{$registration->dobad}}</td>
                <td>{{$registration->level}}</td>
                <td>{{$registration->admission_number}}</td>
                <td><a href="{{route('registration.edit',$registration->id)}}">Edit</a> </td>
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