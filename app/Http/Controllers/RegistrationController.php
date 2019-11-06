<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Registration;
use App\Voucher;
use Illuminate\Http\Request;
use Auth;

class RegistrationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //$availableTests = Test::where( 'available', 1 )->whereDate( 'deadline', '>=', date( 'Y-m-d' ) )->pluck( 'name', 'id' );
        $user = request()->user();
        if ($user->type_id == 1) {
            //personal
            if (!$user->Photo) {
                return redirect()->route('photo.create')->withErrors("Upload Your Passport Sized Photo Here");
            }
        } elseif ($user->type_id == 2) {
            //organisation
        } else {
            abort(404);
        }
        return view('registration.create', compact('user'));

    }

    public function store(Request $request)
    {
        $validate = $request->validate(
            ['tests' => 'required']
        );
        $user = $request->user();

        $reg = new Registration();
        $reg->user_id = $user->id;

        if ($user->type_id == 1) {

            $reg->name = $user->name;
            if ($request->dobad) {
                $reg->dobad = $request->dobad;
            } elseif ($user->dobad) {
                $reg->dobad = $user->dobad;
            } else {
                $reg->dobad = "";
            }
            $reg->photo_id = $user->Photo ? $user->Photo->id : null;
            $reg->tests = json_encode($request->tests);
            $reg->test_id = 1; //TODO show available dates of test to choose from;
            $reg->voucher_number = $request->voucher_number;
            $reg->bank_address = $request->bank_address;
            $reg->deposit_date = $request->deposit_date;
            $reg->deposit_by = $request->deposit_by;
            $voucher = new Voucher();
            $voucher->user_id = $user->id;
            $voucher->filename = $request->voucher->storeAs('voucher_photos', "voucher_" . $user->id . "_" . date('Y-m-d'));
            $voucher->save();
            $reg->voucher_id = $voucher->id;
            $reg->save();

        } elseif ($user->type_id == 2) {
            $name = $request->fname . " " . $request->mname . " " . $request->lname;
            $reg->name = $name;
            $reg->dobad = $request->dobad;
            $photo = new Photo();
            $photo->user_id = $user->id;
            $photo->filename = $request->photo->storeAs('reg_photos', "reg_" . $name . "_" . date('Y-m-ds'));
            $photo->save();
            $reg->photo_id = $photo->id;
            $reg->tests = json_encode($request->tests);
            $reg->test_id = 1; //TODO show available dates of test to choose from;
            $reg->voucher_number = $request->voucher_number;
            $reg->bank_address = $request->bank_address;
            $reg->deposit_date = $request->deposit_date;
            $reg->deposit_by = $request->deposit_by;
            $voucher = new Voucher();
            $voucher->user_id = $user->id;
            $voucher->filename = $request->voucher->storeAs('voucher_photos', "voucher_" . $user->id . "_" . date('Y-m-d'));
            $voucher->save();
            $reg->voucher_id = $voucher->id;
            $reg->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Registration $registration
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Registration $registration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Registration $registration
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Registration $registration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Registration $registration
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Registration $registration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Registration $registration
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Registration $registration)
    {
        //
    }
}
