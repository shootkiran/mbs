<?php

namespace App\Http\Controllers;

use App\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('result.index');
    }

    public function search(Request $request)
    {
        $request->validate(['admission_number' => 'required']);
        $an = $request->admission_number;
        $search_n1 = DB::table('n1_result')->where('admission_number', $an)->get();
        $search_n2 = DB::table('n2_result')->where('admission_number', $an)->get();
        $search_n3 = DB::table('n3_result')->where('admission_number', $an)->get();
        $search_n4 = DB::table('n4_result')->where('admission_number', $an)->get();
        $search_n5 = DB::table('n5_result')->where('admission_number', $an)->get();
        if ($search_n1->count() or $search_n2->count() or $search_n3->count() or $search_n4->count() or $search_n5->count()) {
            $result = true;
        } else {
            $result = false;
        }
        return view('result.result', compact('search_n1', 'search_n5', 'search_n4', 'search_n3', 'search_n2', 'result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Result $result
     * @return \Illuminate\Http\Response
     */
    public function show(Result $result)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Result $result
     * @return \Illuminate\Http\Response
     */
    public function edit(Result $result)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Result $result
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Result $result)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Result $result
     * @return \Illuminate\Http\Response
     */
    public function destroy(Result $result)
    {
        //
    }
}
