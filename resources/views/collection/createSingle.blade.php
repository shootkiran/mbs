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
            {!! Form::open(['route'=>'collection.storeSingle']) !!}
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Name</span>
                </div>
                {!! Form::text('name','',['id'=>'name','class'=>'form-control','autofocus','required']) !!}
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Contact</span>
                </div>
                {!! Form::text('contact','',['id'=>'contact','class'=>'form-control','required']) !!}
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Date Of Birth</span>
                </div>
                {!! Form::date('dobad','',['id'=>'dobad','class'=>'form-control','required']) !!}
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Level</span>
                </div>
                {!! Form::select('level',[0,1,2,3,4,5],'',['id'=>'level','class'=>'form-control','min'=>0]) !!}
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Amount To Receive</span>
                </div>
                {!! Form::text('amount_received','0',['id'=>'amount_received','class'=>'form-control','readonly']) !!}
            </div>

            {!! Form::submit("Save",['id'=>'submit','class'=>'btn btn-primary','style'=>'display:none']) !!}

        </div>
    </div>
    <script type="text/javascript">
        $('body').on('keydown', 'input, select', function (e) {
            if (e.key === "Enter") {
                var self = $(this), form = self.parents('form:eq(0)'), focusable, next;
                focusable = form.find('input,a,select,button,textarea').filter(':visible');
                //   console.log(focusable);
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


        $("#level").change(function () {
            levelChange();
        });

        function levelChange() {

            var level = $.isNumeric($("#level").val()) ? $("#level").val() : 0;
            level = parseInt(level);
            var price = 4500;
            if (level) {
                var total = 1;
            } else {
                var total = 0;
            }
            if (total < 1) {
                $("#submit").hide();
            } else {
                $("#submit").show();
            }
            $("#amount_received").val(total * price);
        }
    </script>
@endsection