<?php

namespace App\Http\Controllers;

use App\Models\payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function redeemMGT()
    {
      
         
         $reentry= payment::all()->where('STATUS','NEW');
         
         $alldata = \Illuminate\Support\Facades\DB::table('users')
                  //->join('profiles','transfers.user_id','=','profiles.user_id')
                 ->join('payments','payments.user_id','=','users.id')
                 ->join('profiles','profiles.user_id','=','users.id')
                 ->select('payments.*','users.email','users.username','users.name','users.phone','profiles.national_id','profiles.country')
                  
                  ->get();
         
         
         //dd($redeem);
         
         return view('admin.redeemMGT',compact('alldata'));       
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function COMPLETE_PAY($pay)
    {
       
        $data = payment::find($pay);
        //dd($data);
        $data->STATUS= 'COMPLETE';
        $data->save();
        
        return redirect('/redeemMGT');
       
    }

  
    public function CANCEL_PAY($pay)
    {
        $data = payment::find($pay);
        //dd($data);  
        $data->STATUS= 'CANCEL';
        $data->save();
         return redirect('/redeemMGT');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(payment $payment)
    {
        //
    }
}
