<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
         public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
         
        $user = auth()->user();
        $profile = $user->profile();
        //dd($profile);
        
        return view('profiles.index', compact('profile','user'));
    
        
    }

    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        
         $user = auth()->user();
        //dd($user);
           return view('profiles.edit', compact('profile','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function UpdateProfile(Profile $profile)
    {
        
        
      $data = request()->validate([

              'name' => '',
              'phone' => '',
              'email' => '',
              'national_id' => '',
              'country' => '',
              'merchantrade_acc' => '',
              'usdt_wallet' => '',
        ]);
      
      auth()->user()->profile->update($data);
      
      
      dd( auth()->user()->profile);
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
