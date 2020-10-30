<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
         public function registerWithSponsor($sponsor)
    { 
             
             $Data =\App\Models\User::all()->where('username',$sponsor);
             //dd($Data);
          //dd($sponsor);
             if($Data->count() <= 0)
                  return redirect('/register');
             
           return view('registerWithSponsor', compact('sponsor'));
    }
}
