@extends('layouts.app')
@section('content')
    <h3>You are registering for {{\App\Models\Examination::where('available',1)->first()->name}}</h3>
    {!! Form::open(['route'=>['userregistration.store']]) !!}
    <div class="form-group">
        {!! Form::label("Name") !!}
        {!! Form::text('name',"",['class'=>'form-control','required']) !!}
    </div>
    <div class="form-group">
        {!! Form::label("Date Of Birth in AD") !!}
        {!! Form::date('dobad',old("dobad"),['class'=>'form-control','required']) !!}
    </div>
    <div class="form-group">
        {!! Form::label("Contact Number") !!}
        {!! Form::text('contact',old("contact"),['class'=>'form-control','required']) !!}
    </div>
    {!! Form::text('examination_id',$examination->id,['hidden']) !!}


    <div class="form-group">
        {!! Form::label("Level") !!}


        {!! Form::select('level',\App\Level::where('available',1)->pluck('name','id'),0,['placeholder'=>'Choose Level','class'=>'form-control','required']) !!}
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

    </script>
@endsection

