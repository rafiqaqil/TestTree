<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedeemController extends Controller
{
    //Save Redeem on user profile -> D4
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function createRedeem()
    {
        $profile = $user->profile();
        dd($profile);
        
        
        return view('redeem.create', compact('profile','user'));
    }
}
