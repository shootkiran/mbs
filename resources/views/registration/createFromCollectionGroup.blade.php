@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            Total Number of Student: {{$collection->students_count}}
            @if($collection->level1)<br>Level 1:{{$collection->level1}}@endif
            @if($collection->level2)<br>Level 2:{{$collection->level2}}@endif
            @if($collection->level3)<br>Level 3:{{$collection->level3}}@endif
            @if($collection->level4)<br>Level 4:{{$collection->level4}}@endif
            @if($collection->level5)<br>Level 5:{{$collection->level5}}@endif
            <span class="pull-right"> Registered:<i id="registered">{{$collection->registration()->count()}}</i></span>
        </div>
        <h3 id="loadingDiv">LOADING</h3>
        <div class="card-body">
            <div class="col-md-6 offset-3">
                <div class="card">
                    <div class="card-header bg-info">Create New</div>
                    <div class="card-body">
                        <form class="form">
                            {!! Form::hidden('collection_id',$collection->id) !!}
                            {!! Form::text('name',"",['class'=>'form-control']) !!}
                            {!! Form::date('dobad',"",['class'=>'form-control']) !!}
                            {!! Form::select('level',["Chooose Level",1,2,3,4,5],0,['class'=>'form-control']) !!}
                            {!! Form::button('submit',['onclick'=>"sendRegistration()",'class'=>'form-control btn btn-success']) !!}
                        </form>
                    </div>
                </div>
            </div>
            <div class="registered col-md-12">
                <h3 class="text-center">Registrations</h3>
                <table class="table table-bordered">
                    <tr>
                        <td>Reg Number</td>
                        <td>Name</td>
                        <td>DOB</td>
                        <td>Level</td>
                    </tr>
                    <tbody id="registrations">
                    @foreach($collection->registration as $registration)
                        <tr>
                            <td>{{$registration->reg_number}}</td>
                            <td>{{$registration->name}}</td>
                            <td>{{$registration->dobad}}</td>
                            <td>{{$registration->level}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <script type="text/javascript">
        $('#loadingDiv')
            .hide()  // Hide it initially
            .ajaxStart(function () {
                $(this).show();
            })
            .ajaxStop(function () {
                $(this).hide();
            })
        ;

        function sendRegistration() {
            var valid;
            valid = validateForm();
            if (valid) {
                jQuery.ajax({
                    url: "{{route('registrations.ajaxreg')}}",
                    data: $(".form").serialize(),
                    type: "GET",
                    success: function (data) {
                       //load table
                        $("#registrations").html(data['table']);
                        //reset form
                        alert("Your Form is Successfully Submitted.");
                        $(".form").trigger("reset");
                        //load registration count
                        $("#registered").html(data['count']);
                    },
                    error: function () {
                    }
                });
            }
        }

        function validateForm() {
            var valid = true;
            return valid;
        }
    </script>

@endsection