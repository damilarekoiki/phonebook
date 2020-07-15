<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhonebookRequest;
use App\Phonebook;
use Illuminate\Http\Request;

class PhonebookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function fetchUserPhonebook()
    {
        # code...
        return Phonebook::orderBy('friend_name', 'DESC')->get();
    }

    public function fetchPhonebookDetails(Request $request)
    {
        # code...
        return Phonebook::Where('id', $request->id)->get();
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PhonebookRequest $request)
    {
        //
        $phonebook = new Phonebook;

        $phonebook->user_id = 1;
        $phonebook->friend_name = $request->friend_name;
        $phonebook->friend_phone_number = $request->friend_phone_number;
        $phonebook->friend_email = $request->friend_email;
        
        $phonebook->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Phonebook  $phonebook
     * @return \Illuminate\Http\Response
     */
    public function show(Phonebook $phonebook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Phonebook  $phonebook
     * @return \Illuminate\Http\Response
     */
    public function edit(Phonebook $phonebook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Phonebook  $phonebook
     * @return \Illuminate\Http\Response
     */
    public function update(PhonebookRequest $request)
    {
        //
        $pb = Phonebook::find($request->id);
        $pb->friend_name = $request->friend_name;
        $pb->friend_phone_number = $request->friend_phone_number;
        $pb->friend_email = $request->friend_email;
        $pb->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Phonebook  $phonebook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Phonebook $phonebook)
    {
        //
    }
}
