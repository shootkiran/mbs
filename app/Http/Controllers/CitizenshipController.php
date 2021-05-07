<?php

namespace App\Http\Controllers;

use App\Citizenship;
use App\Photo;
use App\UserRegistration;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use PHPUnit\Util\Filesystem;

class CitizenshipController extends Controller
{
    public function create(UserRegistration $userRegistration)
    {
        $user = request()->user();
        return view('citizenship.create', compact('userRegistration', 'user'));
    }

    public function store(UserRegistration $userRegistration, Request $request)
    {
        $folder = storage_path()."/app/reg_photos/".$userRegistration->Examination->name."/citizenship/";
        !file_exists($folder)?Filesystem::createDirectory($folder):null;
        $db_filename = "/storage/app/reg_photos/".$userRegistration->Examination->name."/citizenship/" . $userRegistration->id . ".jpeg";
        $filename = storage_path() . "/app/reg_photos/".$userRegistration->Examination->name."/citizenship/" . $userRegistration->id . '.jpeg';
        $img = Image::make($request->file('photo'))->resize("500", "600")->save($filename, 100);
        $m = $userRegistration->Citizenship->Photo??new Photo();
        $m->filename = $db_filename;
        $m->save();
        $citizenship = Citizenship::firstorcreate(['user_registration_id' => $userRegistration->id, 'photo_id' => $m->id]);
        $userRegistration->citizenship_id = $citizenship->id;
        $userRegistration->save();
        return redirect()->route('userregistration.index');
    }
    public function show(UserRegistration $userRegistration, Citizenship $citizenship)
    {
        if (Auth::user()->staff) {
            return view('citizenship.show', compact('citizenship', 'userRegistration'));
        }
    }
}
