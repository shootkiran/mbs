@extends('layouts.app')
@section('content')
    <h3>ALl Examinations</h3>
    <a href="{{route('examination.create')}}" class="btn btn-success">Create New</a>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Exam Date</th>
            <th>Startline</th>
            <th>Deadline</th>
            <th>Active</th>
            <th>Action</th>
        </tr>
        @foreach($exams as $exam)
            <tr>
                <td>{{$exam->id}}</td>
                <td>{{$exam->name}}</td>
                <td>{{$exam->exam_date}}</td>
                <td>{{$exam->startline}}</td>
                <td>{{$exam->deadline}}</td>
                <td>{{$exam->available}}</td>
                <td>
                    {{link_to_route('examination.show',"Edit",$exam->id,['class'=>'btn btn-sm btn-primary'])}}
                    @if(!$exam->available)
                    {{link_to_route('examination.edit',"Set Active",$exam->id,['class'=>'btn btn-sm btn-info'])}}
                    @else
                    {{link_to_route('examination.edit',"Set Inactive",$exam->id,['class'=>'btn btn-sm btn-danger'])}}
                    @endif
                    </a></td>
            </tr>
        @endforeach
    </table>
@endsection
