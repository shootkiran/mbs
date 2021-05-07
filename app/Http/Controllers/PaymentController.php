<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Photo;
use App\UserRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use PHPUnit\Util\Filesystem;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(UserRegistration $userRegistration)
    {
        return view('payment.create', compact('userRegistration'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, UserRegistration $userRegistration)
    {
        $folder = storage_path()."/app/reg_photos/".$userRegistration->Examination->name."/payment/";
        !file_exists($folder)?Filesystem::createDirectory($folder):null;
        $db_filename = "/storage/app/reg_photos/" . $userRegistration->Examination->name . "/payment/" . $userRegistration->id . ".jpeg";
        $filename = storage_path() . "/app/reg_photos/" . $userRegistration->Examination->name . "/payment/" . $userRegistration->id . '.jpeg';
        $img = Image::make($request->file('voucher'))->resize("500", "600")->save($filename, 100);
        $m = $userRegistration->Payment->Photo??new Photo();
        $m->filename = $db_filename;
        $m->save();
        $payment = Payment::firstorcreate(['user_registration_id' => $userRegistration->id, 'photo_id' => $m->id],
            [
                'voucher_number' => $request->voucher_number,
                'bank_branch' => $request->bank_branch,
                'deposit_date' => $request->deposit_date,
                'deposit_by' => $request->deposit_by,
                'verified' =>0,
            ]);
        $payment->voucher_number = $request->voucher_number;
        $payment->bank_branch = $request->bank_branch;
        $payment->deposit_date = $request->deposit_date;
        $payment->deposit_by = $request->deposit_by;
        $payment->verified = 0;
        $payment->photo_id = $m->id;
        $payment->save();

        $userRegistration->payment_id = $payment->id;
        $userRegistration->save();
        return redirect()->route('userregistration.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function show(UserRegistration $userRegistration, Payment $payment)
    {
        if (Auth::user()->staff) {
            return view('payment.show', compact('payment'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function verify(Payment $payment)
    {
        $userRegistration = $payment->userRegistration;
        $pass = isset(request()->pass) ? request()->pass : null;
        if ($pass) {
            $payment->verified = $pass;

            $reg = new RegistrationController();
            if ($pass == 1) {
                $reg->storeOneRegistration("0", $userRegistration->name, $userRegistration->dobad, $userRegistration->level, $userRegistration->user_id,$userRegistration->contact);
            }
            $payment->save();
            return redirect('management/userregistrations');
        }
    }

    public function edit(UserRegistration $userRegistration, Payment $payment)
    {
        //  echo "EDIT DISABLED.";
        abort(404, "Edit Disabled");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserRegistration $userRegistration, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserRegistration $userRegistration, Payment $payment)
    {
        //
    }
}
