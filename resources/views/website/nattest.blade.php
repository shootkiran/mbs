@extends('layouts.web')
@section('content')
    @foreach($notices as $notice)
        <img height="600px" src="{{config('app.url')}}/storage/app/{{$notice->img_file }}">
        @endforeach
    <div class="alert alert-success">
        <h3 class="text-center">Result for Examination NAT-TEST 2020-01 has been Published.</h3>
        <h4 class="text-center">Check Your Result Here</h4>
        <div class="col-md-6 offset-md-3 text-center">
            {!! Form::open(['route'=>'result.search']) !!}
            {!! Form::text('admission_number','',['placeholder'=>'Type Your Admission Number Here..','class'=>'form-control']) !!}
            {!! Form::submit('Search Result',['class'=>'btn btn-success form-control']) !!}
            {!! Form::close() !!}
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Contact Information of Test Center
                </div>
                <div class="card-body">
                    <table>
                        <tbody>
                        <tr>
                            <th class="t_top">Name</th>
                            <td class="t_top" colspan="3">East West Management Center</td>
                        </tr>
                        <tr>
                            <th width="20%">Contact Person</th>
                            <td width="30%">Raj Shrestha</td>
                            <th width="20%">Address</th>
                            <td width="30%">Chabahil-7,Chabahil Metropolitan City,Kathmandu,NEPAL</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>01-4582809</td>
                            <th>Email</th>
                            <td><a href="mailto:nattestkathmandu@gmail.com">nattestkathmandu@gmail.com</a><br><a
                                        href="mailto:info@eastwestmc.com.np">info@eastwestmc.com.np</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Registration
                </div>
                <div class="card-body">
                    <table>
                        <tbody>
                        <tr>
                        </tr>
                        <tr>
                            <th class="t_top" width="20%">How to apply</th>
                            <td class="t_top" width="80%">Click Here for <a href="/home">Online Form Registration.</a>
                            </td>
                        </tr>

                        <tr>
                            <th>Test Dates</th>
                            <td><img src="{{config('app.url')}}/img/testschedule2.png" alt="testschedule" width="700px">
                            </td>
                        </tr>
                        <tr>
                            <th><span class="t_top">Test Fee</span></th>
                            <td>4,500 NPR</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Location of Test Center
                </div>
                <div class="card-body">
                    <table>
                        <tbody>
                        <tr>
                            <th class="t_top" width="20%">Name</th>
                            <td class="t_top" width="80%">DAV SUSHIL KEDIA VISHWA BHARATI HIGHER SECONDARY SCHOOL</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>JAWALAKHEL(OPPOSITE OF CENTRAL ZOO), LALITPUR,NEPAL</td>
                        </tr>
                        <tr>
                            <th>Map</th>
                            <td>
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7066.8112969215135!2d85.30474886298181!3d27.67385477924916!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x7dc265f43c208141!2sDAV+Sushil+Kedia+Vishwa+Bharati!5e0!3m2!1sen!2snp!4v1553950313668!5m2!1sen!2snp"
                                        style="border:0" allowfullscreen="" width="600" height="450"
                                        frameborder="0"></iframe>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    About the test
                </div>
                <div class="card-body">
                    <table>
                        <tbody>
                        <tr>
                            <th class="t_top" width="20%">About the test</th>
                            <td class="t_top" width="80%">The Japanese Language NAT-TEST is an examination that measures
                                the Japanese language ability of students who are not native Japanese speakers. The
                                tests are separated by difficulty (five levels) and general ability is measured in three
                                categories: Grammar/Vocabulary, Listening and Reading Comprehension. The format of the
                                exam and the types of questions are equivalent to those that appear on the Japanese
                                Language Ability Test (JLPT).
                            </td>
                        </tr>
                        <tr>
                            <th>For more information</th>
                            <td><a href="http://www.nat-test.com/en/contents/aboutnat.htm">English</a> / <a
                                        href="http://www.nat-test.com/jp/contents/aboutnat.htm">Japanese</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Official Workbook
                </div>
                <div class="card-body">
                    <table>
                        <tbody>
                        <tr>
                            <th class="t_top" width="20%">Title<br>
                                <span class="english"></span></th>
                            <td class="t_top" width="60%">Japanese Language NAT-TEST Workbook<br>
                                <span class="english"></span></td>
                            <td class="t_top" rowspan="3" width="10%"><img
                                        src="http://www.nat-test.com/image/photo/5Qexercisebook_nepal.png" alt=""
                                        height="150" align="middle"></td>
                            <td class="t_top" rowspan="3" width="10%"><img
                                        src="http://www.nat-test.com/image/photo/4Qexercisebook_nepal.png" alt=""
                                        height="150" align="middle"></td>
                        </tr>
                        <tr>
                            <th>Price<br>
                                <span class="english"></span></th>
                            <td>5Q:<span class="badge badge-info">NPR 400</span>　4Q:<span class="badge badge-info">NPR 600</span>
                                <br>
                                <span class="english"></span></td>
                        </tr>
                        <tr>
                            <th>Contact Information<br>
                                <span class="english"></span></th>
                            <td>Name : LA GRANDEE INTERNATIONAL COLLEGE<br>
                                Phone : +977-61-523163<br>
                                URL : <a href="http://lagrandee.edu.np/nat-test/order-book/">http://lagrandee.edu.np/nat-test/order-book/</a><br>
                                <span class="english"></span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
