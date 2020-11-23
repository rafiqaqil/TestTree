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
                 ->select('payments.*','users.email','users.username','users.name','users.phone','profiles.national_id','profiles.country','profiles.merchantrade_acc','profiles.usdt_wallet')
                  ->where('payments.STATUS','NEW')
                 ->where('payments.DETAIL','REDEEM_DM3')
                  ->get();
         
         $alldataDone = \Illuminate\Support\Facades\DB::table('users')
                  //->join('profiles','transfers.user_id','=','profiles.user_id')
                 ->join('payments','payments.user_id','=','users.id')
                 ->join('profiles','profiles.user_id','=','users.id')
                 ->select('payments.*','users.email','users.username','users.name','users.phone','profiles.national_id','profiles.country','profiles.merchantrade_acc','profiles.usdt_wallet')
                  ->where('payments.STATUS','!=','NEW')
                 ->where('payments.DETAIL','REDEEM_DM3')
                  ->get();
         
         
         //dd($redeem);
         
         return view('admin.redeemMGT',compact('alldata','alldataDone'));       
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function COMPLETE_PAY($pay)
    {
       
        
        
        
        $data = payment::find($pay);
       
        
        $user = \App\Models\User::find($data->user_id);
        $TDM3 =  \App\Models\DM3tree::all()->where('user_id',$user->id)->sum('balance')*0.1;
              
            $balance = \App\Models\payment::where('user_id',$user->id)
                    ->where('DETAIL','REDEEM_DM3')
                    ->where('STATUS','!=','CANCEL')->sum('AMOUNT');
        if(($TDM3 - ($balance+ $data['AMOUNT'])) < 0){
             $data->STATUS= 'CANCEL';
        $data->save();
            dd("Warning Negative Amount DM3 Redee"
                    . " Overflow. System Automatically Reject Redeem");   
        }
           
                    
                    
        
        
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
