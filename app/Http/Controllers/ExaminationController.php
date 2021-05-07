<?php

namespace App\Http\Controllers;

use App\Models\Examination;
use Illuminate\Http\Request;

class ExaminationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = Examination::all();
        return view('examination.index', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('examination.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $exam = new Examination();
        $exam->name = $request->name;
        $exam->exam_date = $request->exam_date;
        $exam->deadline = $request->deadline;
        $exam->startline = $request->startline;
        $exam->available = 0;
        $exam->venue_id = $request->venue_id;
        $exam->save();
        return redirect()->route('examination.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Examination $examination
     * @return \Illuminate\Http\Response
     */
    public function show(Examination $examination)
    {
        return view('examination.show', compact('examination'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Examination $examination
     * @return \Illuminate\Http\Response
     */
    public function edit(Examination $examination)
    {
        if ($examination->available) {
            $examination->available = 0;
        } else {
            Examination::where('available', 1)->update(['available' => 0]);
            $examination->available = 1;
        }
        $examination->save();
        return redirect()->route('examination.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Examination $examination
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Examination $examination)
    {
        $request->validate([
            'name' => 'required',
            'exam_date' => 'required',
            'deadline' => 'required',
            'startline' => 'required',
            'available' => 'required',
            'venue_id' => 'required',
        ]);
        $examination->name = $request->name;
        $examination->exam_date = $request->exam_date;
        $examination->deadline = $request->deadline;
        $examination->startline = $request->startline;
        $examination->available = 0;
        $examination->venue_id = $request->venue_id;
        $examination->save();
        return redirect()->route('examination.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Examination $examination
     * @return \Illuminate\Http\Response
     */
    public function destroy(Examination $examination)
    {
        //
    }
}
