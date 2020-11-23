<?php

namespace App\Http\Controllers;

use App\Models\transfer;
use Illuminate\Http\Request;
 use \App\Models\widthdraw;

class TransferController extends Controller
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
    
      public function create()
    {
        $user = auth()->user();
        $profile = $user->profile();    
        return view('transfer.create', compact('profile','user'));
    }

   
    public function Cancel($id)
        {
         $user = auth()->user();
         
            $with = transfer::find($id);
            
            //dd($with);
            if($user->id != $with->user_id)
                return redirect('/Show/MyWidthdraw')->withErrors(['Access Denied', 'Access Denied']);
            $with['STATUS'] = 9;
            $with->save();
           return redirect('/Show/MyWidthdraw');
        }
        
        
            public function Approve($id)
        {
         $user = auth()->user();
         
            $with = transfer::find($id);
            
            //dd($with);
            if($user->id != $with->user_id)
                return redirect('/Show/MyWidthdraw')->withErrors(['Access Denied', 'Access Denied']);
            $with['STATUS'] = 1;
            $with->save();
           return redirect('/Show/MyWidthdraw');
        }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $user = auth()->user();   $profile = $user->profile()->first();
        
         
         $alldata = widthdraw::all()->where('user_id',$user->id)->where('STATUS','=',0);
         $alldataApproved =  widthdraw::all()->where('user_id',$user->id)->where('STATUS','!=',0);
         
         $Negative =  widthdraw::all()->where('user_id',$user->id)->where('STATUS','!=',9)->sum('AMOUNT');
         
         
          $TDM5 =  \App\Models\DM5tree::all()->where('user_id',$user->id)->sum('balance')*0.8;
          $TDM3 =  \App\Models\DM3tree::all()->where('user_id',$user->id)->sum('balance')*0.8;
          $TSPN = \App\Models\sponsor::all()->where('user_id',$user->id)->sum('balance');
         
         
        $transfersIN = \App\Models\transfer::all()->where('to_user_id',$user->id)->where('STATUS','==',1)->sum('AMOUNT');
          $transfersOUT = \App\Models\transfer::all()->where('user_id',$user->id)->where('STATUS','!=',9)->sum('AMOUNT');
         
         
         
        
         $data = request()->validate([

              'AMOUNT' => 'required|numeric|min:0',
              'to_username' => [ 'string','min:5', 'max:40', 'exists:App\Models\User,username', 'alpha_dash'],
              
        ]);
         
         
         
          $FinalBalance = $TDM5+ $TDM3 +$TSPN + $transfersIN - $transfersOUT- $Negative - $data['AMOUNT'];
         //dd($FinalBalance);
          
          
         
        //-------------------------------------------------------------------------
         if($FinalBalance >= 0)
         {
        
         
        $user = auth()->user();
        $userProfile = \App\Models\Profile::find($user->id);
        $data['to_user_id'] = \App\Models\User::where('username',$data['to_username'])->first()->id;
        
        $userProfile = \App\Models\Profile::find($user->id);
        $data['from_username'] = $user->username;
        
        $data['user_id'] = $user->id;
       
        
        $newTrans = \App\Models\transfer::create($data);
        //dd($newTrans);
        
      return redirect('/Show/MyWidthdraw');
         }
         else{
          return redirect('/Show/MyWidthdraw')->withErrors(['Not Enough Balance', 'Not Enough Balance']);
         }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function show(transfer $transfer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function edit(transfer $transfer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, transfer $transfer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function destroy(transfer $transfer)
    {
        //
    }
}
