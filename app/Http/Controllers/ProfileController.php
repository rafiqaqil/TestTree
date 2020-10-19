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
      
      
      //dd( auth()->user()->profile);
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    
    
     public function MySponsor()
    {
         
         $user = auth()->user()->id;
         //dd($user);
         $aku = \App\Models\sponsor::all()->where('user_id',$user)->first();
         //dd($aku);
        $shops = \App\Models\sponsor::descendantsAndSelf($aku->id)->toTree()->first();
        $jsondata = json_encode($shops);      
        $jsondata = trim($jsondata, '[]');
         $all = \App\Models\sponsor::descendantsAndSelf($aku->id)->count();
         $lastnode = \App\Models\sponsor::descendantsAndSelf($aku->id)->max('id');
         //dd($lastnode);
         $levels = \App\Models\sponsor::withDepth()->find($lastnode);
        return view('Sponsor.MiniTree', compact('shops','jsondata','all','levels'));
    }
    
         public function MyDM3()
    {
         
         $user = auth()->user()->id;
         //dd($user);
         $aku = \App\Models\DM3tree::all()->where('user_id',$user)->first();
         //dd($aku);
         
         if($aku == null)
             return redirect('/home');
        $shops = \App\Models\DM3tree::descendantsAndSelf($aku->id)->toTree()->first();
        $jsondata = json_encode($shops);      
        $jsondata = trim($jsondata, '[]');
        
         $all = \App\Models\DM3tree::descendantsAndSelf($aku->id)->count();
         $lastnode = \App\Models\DM3tree::descendantsAndSelf($aku->id)->max('id');
         //dd($lastnode);
         $levels = \App\Models\DM3tree::withDepth()->find($lastnode);
        return view('DM3.MiniTree', compact('shops','jsondata','all','levels'));
    }
    public function MyDM5()
    {
         
         $user = auth()->user()->id;
         //dd($user);
         $aku = \App\Models\DM5tree::all()->where('user_id',$user)->first();
         //dd($aku);
         
         if($aku == null)
             return redirect('/home');
        $shops = \App\Models\DM5tree::descendantsAndSelf($aku->id)->toTree()->first();
        $jsondata = json_encode($shops);      
        $jsondata = trim($jsondata, '[]');
        
         $all = \App\Models\DM5tree::descendantsAndSelf($aku->id)->count();
         $lastnode = \App\Models\DM5tree::descendantsAndSelf($aku->id)->max('id');
         //dd($lastnode);
         $levels = \App\Models\DM5tree::withDepth()->find($lastnode);
        return view('DM5.MiniTree', compact('shops','jsondata','all','levels'));
    }
        
     public function MySponsorData()
    {
         
         $user = auth()->user()->id;
         //dd($user);
         $aku = \App\Models\sponsor::all()->where('user_id',$user)->first();
         //dd($aku);
        $shops = \App\Models\sponsor::descendantsAndSelf($aku->id);
       
        return view('Sponsor.MiniTree', compact('shops','jsondata','all','levels'));
    }

    
    
    public function destroy(Profile $profile)
    {
        //
    }
}
