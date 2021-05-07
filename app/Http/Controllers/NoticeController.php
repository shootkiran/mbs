<?php

namespace App\Http\Controllers;

use App\Notice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NoticeController extends Controller
{
    function __construct()
    {
        $this->middleware("auth");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notices = request()->active?Notice::wheredate('valid_untill','>=',Carbon::today()->toDateString())->get():Notice::all();
        return view('notice.index',compact('notices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('notice.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'img_file'=>'required',
            'valid_untill'=>'required'
        ]);
        $img = $request->file('img_file')->storeAs('notices', "notice_" . date('Y-m-d-h-i-s').rand(0,10). ".jpeg");
        $notice = new Notice();
        $notice->img_file = $img;
        $notice->valid_untill = $request->valid_untill;
        $notice->save();
        return redirect()->route('notice.index')->withErrors("Create Successful.");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function show(Notice $notice)
    {
        return redirect()->route('notice.index');
       // return view('notice.show',compact('notice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function edit(Notice $notice)
    {
        return view('notice.edit',compact('notice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notice $notice)
    {
        $request->validate([
            'valid_untill'=>'required',
        ]);
        $notice->valid_untill=$request->valid_untill;
        $notice->save();
        return redirect()->route('notice.index')->withErrors("Edit Successful.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notice $notice)
    {

        $files = Storage::delete($notice->img_file);
        $notice->delete();
        return redirect()->route('notice.index')->withErrors("Delete Successful.");
    }
}
