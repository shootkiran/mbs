@extends('layouts.app')
@section('content')
    {!! Form::open(['route'=>['registration.storeSingleNew',$collection->id]]) !!}
    <div class="form-group">
        {!! Form::label("Name") !!}
        {!! Form::text('name',$collection->name,['class'=>'form-control','required']) !!}
    </div>
    <div class="form-group">
        {!! Form::label("Date Of Birth in AD") !!}
        {!! Form::date('dobad',old("dobad"),['class'=>'form-control','required']) !!}
    </div>

    <div class="form-group">
        {!! Form::label("Level") !!}
        <?php
        $level ="";
        $level5=$collection->level5;
        $level4=$collection->level4;
        $level3=$collection->level3;
        $level2=$collection->level2;
        $level1=$collection->level1;
        if($level5>0){
            $level=5;
        }elseif($level4>0){
            $level=4;
        }elseif($level3>0){
            $level=3;
        }elseif($level2>0){
            $level=2;
        }elseif($level1>0){
            $level=1;
        }else{
            $level=0;
        }
        ?>

        {!! Form::select('level',["Choose Level","1",'2','3','4','5'],$level,['class'=>'form-control','required']) !!}
    </div>
    {!! Form::submit("Save",['id'=>'submit','class'=>'btn btn-primary']) !!}

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
                    var answer = confirm('Do you want to Submit?');
                    if (answer) {
                        $("#submit").click();
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