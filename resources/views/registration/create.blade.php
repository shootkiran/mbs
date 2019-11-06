@extends('layouts.app')
@section('title',"Register For Test")
<title>Student Application Form</title>
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {!! Form::open(['route'=>'registration.index','enctype'=>'multipart/form-data']) !!}

                @if($user->type_id==2)
                    <div class="row">
                        <div class="col-md-12">
                            Choose Passport Sized Photo of Student.
                            <img src="https://via.placeholder.com/100.png/09f/fffC/O%20https://placeholder.com/"/>
                            {!! Form::file('photo') !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label("First Name") !!}
                                {!! Form::text('fname',old("fname"),['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label("Middle Name") !!}
                                {!! Form::text('mname',old("mname"),['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label("Last Name") !!}
                                {!! Form::text('lname',old("lname"),['class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>
                @endif
                @if($user->dobad=="" OR $user->type_id==2)
                    <div class="form-group">
                        {!! Form::label("Date Of Birth in AD") !!}
                        {!! Form::date('dobad',old("dobad"),['class'=>'form-control']) !!}
                    </div>
                @endif
                @if(!$user->Contact or $user->type_id==2)
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label("Contact Number(Main)") !!}
                                {!! Form::text('cnumber1',old("cnumber1"),['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label("Contact Number(Alternative)") !!}
                                {!! Form::text('cnumber2',old("cnumber2"),['class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>
                @endif
                <div class="form-group">
                    Choose Tests
                    <div class="row">
                        <div class="col">
                            {!! Form::checkbox('tests[]', 'level1',0,["id"=>"level1","onchange"=>"calculatePrice()"]) !!}
                            {!! Form::label('level1',"Level 1") !!}
                        </div>
                        <div class="col">
                            {!! Form::checkbox('tests[]', 'level2','0',["id"=>"level2","onchange"=>"calculatePrice()"]) !!}
                            {!! Form::label('level2',"Level 2") !!}</div>
                        <div class="col">
                            {!! Form::checkbox('tests[]', 'level3','0',["id"=>"level3","onchange"=>"calculatePrice()"]) !!}
                            {!! Form::label('level3',"Level 3") !!}
                        </div>
                        <div class="col">
                            {!! Form::checkbox('tests[]', 'level4','0',["id"=>"level4","onchange"=>"calculatePrice()"]) !!}
                            {!! Form::label('level4',"Level 4") !!}
                        </div>
                        <div class="col">
                            {!! Form::checkbox('tests[]', 'level5','0',["id"=>"level5","onchange"=>"calculatePrice()"]) !!}
                            {!! Form::label('level5',"Level 5") !!}
                        </div>

                    </div>

                    <br/>

                    <br/>
                </div>
                <h3>Examination Fee: Rs. <b id="total">0</b></h3>
                <div class="form-group">

                    IF You've deposited Examination Fee into Bank<br>
                    {!! Form::label('Voucher Number') !!}
                    {!! Form::text('voucher_number','',['class'=>'form-control','required'=>'required']) !!}
                    {!! Form::label('Bank Branch Address') !!}
                    {!! Form::text('bank_address','',['class'=>'form-control']) !!}

                    {!! Form::label('Deposit Date') !!}
                    {!! Form::date('deposit_date','',['class'=>'form-control']) !!}

                    {!! Form::label('Deposit By:') !!}
                    {!! Form::text('deposit_by','',['class'=>'form-control']) !!}

                </div>

                {!! Form::label('Upload Photo of Receipt from Bank Deposit') !!}

                <div>

                </div>
                {!! Form::file('voucher') !!}
                <br>

                {!! Form::submit("Register",['class'=>'btn btn-success form-control']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>


    <script>
        $('#datetimepicker').datetimepicker({
            format: 'yyyy-mm-dd'
        });

        function calculatePrice() {
            var prices = [1000, 2000, 3000, 4000, 5000];
            var l1 = $("#level1").prop("checked");
            var l2 = $("#level2").prop("checked");
            var l3 = $("#level3").prop("checked");
            var l4 = $("#level4").prop("checked");
            var l5 = $("#level5").prop("checked");
            var total = 0;
            total = l1 == true ? total + prices[0] : total;
            total = l2 == true ? total + prices[1] : total;
            total = l3 == true ? total + prices[2] : total;
            total = l4 == true ? total + prices[3] : total;
            total = l5 == true ? total + prices[4] : total;
            console.log(total);
            $("#total").html(total);
        }
    </script>

@endsection