<?php

namespace App\Http\Controllers;

use App\Photo;
use App\UserRegistration;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Util\Filesystem;

class PhotoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    public function create(UserRegistration $userRegistration)
    {
        $user = request()->user();
        return view('photo.create', compact('userRegistration', 'user'));
    }

    public function store(UserRegistration $userRegistration, Request $request)
    {
        $folder = storage_path()."/app/reg_photos/".$userRegistration->Examination->name."/photo/";
        !file_exists($folder)?Filesystem::createDirectory($folder):null;
        $db_filename = "/storage/app/reg_photos/" . $userRegistration->Examination->name . "/photo/" . $userRegistration->id . ".jpeg";
        $filename = storage_path() . "/app/reg_photos/" . $userRegistration->Examination->name . "/photo/" . $userRegistration->id . '.jpeg';
        $img = Image::make($request->file('photo'))->resize("150", "200")->save($filename, 100);
        $m = $userRegistration->Photo??new Photo();
        $m->filename = $db_filename;
        $m->save();
        $userRegistration->photo_id = $m->id;
        $userRegistration->save();
        return redirect()->route('userregistration.index');
    }

    public function show(UserRegistration $userRegistration, Photo $photo)
    {
        if (Auth::user()->staff) {
            return view('photo.show', compact('photo', 'userRegistration'));
        }
    }

    public function edit(UserRegistration $userRegistration, Photo $photo)
    {
        $photo->approved = 1;
        $photo->save();
        return redirect()->route('management.userregistrations');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }


}
