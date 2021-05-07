@extends('layouts.app')
@section('title',"All Notices")
@section('content')
    <a href="{{route('notice.create')}}" class="btn btn-success">Create New Notice</a>
    <a href="?active=1" class="btn btn-warning">View Active Notices Only</a>
    <a href="?active=0" class="btn btn-info">View All Notices</a>
    <hr/>
    @if(count($notices))
        <table class="table table-bordered" id="notices">
            <tr>
                <td>Image of Notice</td>
                <td>Validity of Notice</td>
                <td>Status</td>
                <td>Created at</td>
                <td>Actions</td>
            </tr>
            @foreach ($notices as $notice)
                <tr>
                    <td width="25%">
                        <div class="img-responsive">
                            <img width="100px" height="200px"
                                 src="{{config('app.url')}}/storage/app/{{$notice->img_file }}">
                        </div>
                    </td>
                    <td>
                        {{$notice->valid_untill}}
                    </td>
                    <td>
                        {!! $notice->status() !!}
                    </td>
                    <td>
                        {{$notice->created_at}}
                    </td>
                    <td>
                        <a class="btn btn-primary" href="{{route('notice.edit',$notice->id)}}">Edit Notice</a>
                        {!! Form::open(['route'=>['notice.destroy',$notice->id],'method'=>'DELETE']) !!}
                        {!! form::submit("Delete Notice") !!}
                        {!! form::close() !!}
                    </td>
                </tr>

            @endforeach
        </table>
    @else
        No Notices has been published. Please create new One.
    @endif
@endsection