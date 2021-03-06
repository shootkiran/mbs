@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">

            <?php
            $filename = base_path().$citizenship->photo->filename;
            $data = getimagesize($filename);
            $size = round(filesize($filename)/1000);
            $width = $data[0];
            $height = $data[1];
            ?>
            {{link_to_route('photo.edit',"Approve This Photo",[$userRegistration->id,$citizenship->id])}}
            <img src="{{config("app.url")}}/{{$citizenship->photo->filename}}" width="50%"/>
            The image is {{$width}}x{{$height}} and  {{$size}} kb in size.
        </div>
    </div>
@endsection
