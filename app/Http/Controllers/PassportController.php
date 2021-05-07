<?php

namespace App\Http\Controllers;

use App\Passport;
use App\Photo;
use App\UserRegistration;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use PHPUnit\Util\Filesystem;

class PassportController extends Controller
{
    public function create(UserRegistration $userRegistration)
    {
        $user = request()->user();
        return view('passport.create', compact('userRegistration', 'user'));
    }

    public function store(UserRegistration $userRegistration, Request $request)
    {
        $folder = storage_path()."/app/reg_photos/".$userRegistration->Examination->name."/passport/";
        !file_exists($folder)?Filesystem::createDirectory($folder):null;
        $db_filename = "/storage/app/reg_photos/".$userRegistration->Examination->name."/passport/" . $userRegistration->id . ".jpeg";
        $filename = storage_path() . "/app/reg_photos/".$userRegistration->Examination->name."/passport/" . $userRegistration->id . '.jpeg';
        $img = Image::make($request->file('photo'))->resize("500", "600")->save($filename, 100);
        $m = $userRegistration->Passport->Photo??new Photo();
        $m->filename = $db_filename;
        $m->save();
        $passport = Passport::firstorcreate(['user_registration_id' => $userRegistration->id, 'photo_id' => $m->id]);
        $userRegistration->passport_id = $passport->id;
        $userRegistration->save();
        return redirect()->route('userregistration.index');
    }

}
