<?php

namespace App\Http\Controllers;

use App\Models\widthdraw;
use Illuminate\Http\Request;

class WidthdrawController extends Controller
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
    
    public function CreateWidthdraw()
    {
        $user = auth()->user();
        $profile = $user->profile();
        return view('Widthdraw.createW', compact('profile','user'));
    }

 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function StoreWidthdraw()
    {
        
         $data = request()->validate([

              'AMOUNT' => 'required',
              'Type' => 'required',
              
        ]);
         
        $user = auth()->user();
        $data['user_id'] = $user->id;
        
        widthdraw::
        dd($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\widthdraw  $widthdraw
     * @return \Illuminate\Http\Response
     */
    public function show(widthdraw $widthdraw)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\widthdraw  $widthdraw
     * @return \Illuminate\Http\Response
     */
    public function edit(widthdraw $widthdraw)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\widthdraw  $widthdraw
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, widthdraw $widthdraw)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\widthdraw  $widthdraw
     * @return \Illuminate\Http\Response
     */
    public function destroy(widthdraw $widthdraw)
    {
        //
    }
}
