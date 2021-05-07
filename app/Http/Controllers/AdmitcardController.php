<?php

namespace App\Http\Controllers;

use App\Registration;
use Illuminate\Http\Request;
use Picqer\Barcode\BarcodeGeneratorSVG;

class AdmitcardController extends Controller
{
    public function index(){
        $admitcards = Registration::all()->where('admitcard_number');
        return view('admitcard.index',compact('admitcards'));
    }
    public function show($id){
        $registration = Registration::findorfail($id);
        return view('admitcard.show', compact('registration'));


    }
}
