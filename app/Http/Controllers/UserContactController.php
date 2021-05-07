<?php

namespace App\Http\Controllers;

use App\Models\UserContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = UserContact::all();
        foreach($contacts as $contact){
            $new =str_replace("-","",str_replace("+977","",str_replace(" ","",$contact->number)));
            $contact->number = $new;
            $contact->save();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('usercontact.create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $number =str_replace("+977","",str_replace(" ","",$request->number));
        UserContact::create(['user_id'=>$request->user()->id,'contact_type'=>$request->contact_type,'number'=>$number]);
        return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserContact  $userContact
     * @return \Illuminate\Http\Response
     */
    public function show(UserContact $userContact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserContact  $userContact
     * @return \Illuminate\Http\Response
     */
    public function edit(UserContact $userContact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserContact  $userContact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserContact $userContact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserContact  $userContact
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserContact $userContact)
    {
        //
    }
}
