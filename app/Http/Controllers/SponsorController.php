<?php

namespace App\Http\Controllers;

use App\Models\sponsor;
use Illuminate\Http\Request;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index3()
    {
            $shops = \App\Models\sponsor::get()->toTree();
        $chart = \App\Models\sponsor::all();
        
        //dd($chart->id);
       // dd($chart->parent_id);
        //dd($chart);
        $jsondata = json_encode($shops);

        

        $jsondata = trim($jsondata, '[]');
        $all = \App\Models\sponsor::max('id');
        //dd( $jsondata);
         $levels = \App\Models\sponsor::withDepth()->find($all);
       //dd($levels->depth);
        //dd( $jsondata);
        return view('Sponsor.GoogleTreeAdmin', compact('shops','jsondata','all','levels','chart'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function show(sponsor $sponsor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function edit(sponsor $sponsor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sponsor $sponsor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function destroy(sponsor $sponsor)
    {
        //
    }
}
