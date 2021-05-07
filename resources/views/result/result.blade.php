@extends('layouts.app')
@section('content')
    @if($result)
        <h3 class="alert alert-success">Congratulations, Your Admission Number was found.</h3>
        @foreach($search_n5 as $result)
            <div class="alert-info">You have Passed in N5.</div>
        @endforeach
        @foreach($search_n4 as $result)
            <div class="alert-info">You have Passed in N4.</div>
        @endforeach
        @foreach($search_n3 as $result)
            <div class="alert-info">You have Passed in N3.</div>
        @endforeach
        @foreach($search_n2 as $result)
            <div class="alert-info">You have Passed in N2.</div>
        @endforeach
        @foreach($search_n1 as $result)
            <div class="alert-info">You have Passed in N1.</div>
        @endforeach


    @else
        <h3 class="alert alert-danger">Sorry, Your Admission Number was not found.</h3>
        <div class="alert alert-info">For Further verification please check <a
                    href="http://www.nat-test.com/contents/result/result-id20-1.html">Nat-Test Official Result Page</a>
        </div>
    @endif
    <a href="{{route('result.index')}}" class="btn btn-secondary">Search Again</a>
@endsection