<?php

namespace App\Http\Controllers;


use App\Models\Notice;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function show($page){
        $pages = ['nattest'];
        if(in_array($page,$pages)){
            return $this->$page;
        }else{
            return abort(404);
        }
    }
    public function nattest(){
        $notices = Notice::whereDate('valid_untill','>=',Carbon::today()->toDateString())->get();
        return view('website.nattest',compact('notices'));
    }
}
