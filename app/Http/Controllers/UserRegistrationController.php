<?php

namespace App\Http\Controllers;

use App\Models\Examination;
use App\Level;
use App\User;
use App\UserRegistration;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $examination = Examination::where('available', 1)->first();
        $regs = $examination->UserRegistrations()->where('user_id', Auth::user()->id)->get();
        /*$regs = $examination->UserRegistrations()->get();*/
        return view('userregistration.index', compact('regs'));
    }

    public function create()
    {
       // $update = Level::where('available',0)->update(['available'=>1]);
        $examination = Examination::where('available', 1)->first();
        if($examination){
            return view('userregistration.create', compact('examination'));
        }else{
            return redirect()->route('examination.index');
            return abort(403,"No Available Examinations");
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'level' => 'gt:0',
            'contact' => 'required',
            'name' => 'required',
            'dobad' => 'required',
        ]);
        $reg = new UserRegistration();
        $reg->name = strtoupper($request->name);
        $reg->dobad = $request->dobad;
        $reg->contact = $request->contact;
        $reg->examination_id = $request->examination_id;
        $reg->user_id = $request->user()->id;
        $reg->level = $request->level;
        $reg->save();
        return redirect()->route('userregistration.index');
    }

    public function show(UserRegistration $userRegistration)
    {
        //
    }

    public function edit(UserRegistration $userRegistration)
    {
        //
    }

    public function update(Request $request, UserRegistration $userRegistration)
    {
        //
    }

    public function destroy($userRegistration_id)
    {
        $userRegistration = UserRegistration::find($userRegistration_id);
        //dd($userRegistration);
        //  echo "Deleting";
        //dump($userRegistration);
        $fs = new Filesystem();
        $regphotos=storage_path()."/app/reg_photos/".$userRegistration->Examination->name."/";
        $photofile = $regphotos."photo/".$userRegistration_id.".jpeg";
        $citizenshipfile = $regphotos."citizenship/".$userRegistration_id.".jpeg";
        $passportfile = $regphotos."passport/".$userRegistration_id.".jpeg";
        $paymentfile = $regphotos."payment/".$userRegistration_id.".jpeg";
        file_exists($photofile)? $fs->delete($photofile):null;
        file_exists($citizenshipfile)? $fs->delete($citizenshipfile):null;
        file_exists($passportfile)? $fs->delete($passportfile):null;
        file_exists($paymentfile)? $fs->delete($paymentfile):null;
        $userRegistration->Photo()->delete();
        $userRegistration->Payment()->delete();
        $userRegistration->delete();
        return redirect()->route('userregistration.index');
    }
}
