<?php

namespace App\Http\Controllers;

use App\Models\Examination;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $user = Auth::user();
        if (!$user->Contact()->count()) {
            return redirect()->route('usercontact.create')->withErrors('You have no Contact Number.Please Update');
        } else {
            if ($user->type_id == 1) {
                return view('individualHome', compact('user'));
            } elseif ($user->type_id == 2) {
                return view('organisationHome', compact('user'));
            } elseif ($user->type_id == 3) {
                if (!$user->examination_id) {
                    $user->examination_id = Examination::where('available', 1)->first()->id;
                    $user->save();
                }
                return view('staffHome', compact('user'));
            }
        }
    }

    public function show($id)
    {
        $user = request()->user();
        if ($id == 1) {
            return view('individualHome', compact('user'));
        } elseif ($id == 2) {
            return view('organisationHome', compact('user'));
        } elseif ($id == 3) {
            if (!$user->examination_id) {
                $user->examination_id = Examination::where('available', 1)->first()->id;
                $user->save();
            }
            return view('staffHome', compact('user'));
        }
    }
}
