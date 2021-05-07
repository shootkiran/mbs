@extends('layouts.app')
@section('content')
    @if($last_id)
        <div class="row">
            <div class="col-md-6">
                <a href="{{route('collection.show',$last_id)}}" class=" btn btn-danger">Show Last Print Out for
                    ID:{{$last_id}}</a>
                <br>
                <br>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            {!! Form::open(['route'=>'collection.store']) !!}
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Name</span>
                </div>
                {!! Form::text('name','',['id'=>'name','class'=>'form-control','autofocus']) !!}
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Contact</span>
                </div>
                {!! Form::text('contact','',['id'=>'contact','class'=>'form-control']) !!}
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Level5</span>
                </div>
                {!! Form::number('level5','',['id'=>'level5','class'=>'form-control','min'=>0]) !!}
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Level4</span>
                </div>
                {!! Form::number('level4','',['id'=>'level4','class'=>'form-control','min'=>0]) !!}
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Level3</span>
                </div>
                {!! Form::number('level3','',['id'=>'level3','class'=>'form-control','min'=>0]) !!}
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Level2</span>
                </div>
                {!! Form::number('level2','',['id'=>'level2','class'=>'form-control','min'=>0]) !!}

            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Level1</span>
                </div>
                {!! Form::number('level1','',['id'=>'level1','class'=>'form-control','min'=>0]) !!}
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Total Students</span>
                </div>
                {!! Form::text('students_count','',['id'=>'students_count','class'=>'form-control','readonly']) !!}
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Amount To Receive</span>
                </div>
                {!! Form::text('amount_received','',['id'=>'amount_received','class'=>'form-control','readonly']) !!}
            </div>

            {!! Form::submit("Save",['id'=>'submit','class'=>'btn btn-primary','style'=>'display:none']) !!}

        </div>
    </div>
    <script type="text/javascript">
        $('body').on('keydown', 'input, select', function (e) {
            if (e.key === "Enter") {
                var self = $(this), form = self.parents('form:eq(0)'), focusable, next;
                focusable = form.find('input,a,select,button,textarea').filter(':visible');
                console.log(focusable);
                next = focusable.eq(focusable.index(this) + 1);
                if (next.length) {
                    next.focus();
                } else {
                    var students = $("#students_count").val();
                    if (students < 1) {
                        $("#name").focus();
                    } else {
                        var answer = confirm('Do you want to Submit?');
                        if (answer) {
                            $("#submit").click();
                        }
                    }


                }
                return false;
            }
            if (e.keyCode === 32 && e.ctrlKey) {
                $("#submit").click();
                $("#confirm").focus();
                e.preventDefault();
            }
        }); //disable form submission on enter but act as tab;


        $("#level5").keyup(function () {
            calculateStudents();
        });
        $("#level4").keyup(function () {
            calculateStudents();
        });
        $("#level3").keyup(function () {
            calculateStudents();
        });
        $("#level2").keyup(function () {
            calculateStudents();
        });
        $("#level1").keyup(function () {
            calculateStudents();
        });
        $("#level5").change(function () {
            calculateStudents();
        });
        $("#level4").change(function () {
            calculateStudents();
        });
        $("#level3").change(function () {
            calculateStudents();
        });
        $("#level2").change(function () {
            calculateStudents();
        });
        $("#level1").change(function () {
            calculateStudents();
        });

        function calculateStudents() {

            var level5 = $.isNumeric($("#level5").val()) ? $("#level5").val() : 0;
            var level4 = $.isNumeric($("#level4").val()) ? $("#level4").val() : 0;
            var level3 = $.isNumeric($("#level3").val()) ? $("#level3").val() : 0;
            var level2 = $.isNumeric($("#level2").val()) ? $("#level2").val() : 0;
            var level1 = $.isNumeric($("#level1").val()) ? $("#level1").val() : 0;
            level5 = parseInt(level5);
            level4 = parseInt(level4);
            level3 = parseInt(level3);
            level2 = parseInt(level2);
            level1 = parseInt(level1);
            var price = 4500;

            var total = level5 + level4 + level3 + level2 + level1;
            if (total < 1) {
                $("#submit").hide();
            } else {
                $("#submit").show();
            }
            $("#students_count").val(total);
            $("#amount_received").val(total * price);
        }
    </script>
@endsection