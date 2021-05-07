<?php

namespace App\Http\Controllers;

use App\Models\Examination;
use App\Payment;
use App\UserRegistration;
use Illuminate\Http\Request;

class ManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function userRegistrations(){
        $examination =Examination::where('available',1)->first();
        $payment_filter=isset(request()->payment)?request()->payment:null;
        if(!is_null($payment_filter)){
            $p_user_ids = Payment::where('verified',$payment_filter)->pluck('user_registration_id');
            $urs = $examination->UserRegistrations()->whereIn('id',$p_user_ids)->get();
        }else{
            $urs =$examination->UserRegistrations;
        }

        return view('management.userRegistrations',compact('urs'));
    }
}
