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
    
          public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function redeemMGT()
    {
        
        //check if user is an admin
         if(auth()->user()->id > 7){return redirect('/home');}
        
        
        
      
         
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
       //check if user is an admin
         if(auth()->user()->id > 7){return redirect('/home');}
        
        
        
        
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
        //check if user is an admin
         if(auth()->user()->id > 7){return redirect('/home');}
        
         
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
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
        public function reentryMGT()
    {
      //check if user is an admin
         if(auth()->user()->id > 7){return redirect('/home');}
        
         
         $reentry= payment::all()->where('STATUS','NEW');
         
         $alldata = \Illuminate\Support\Facades\DB::table('users')
                  //->join('profiles','transfers.user_id','=','profiles.user_id')
                 ->join('payments','payments.user_id','=','users.id')
                 ->join('profiles','profiles.user_id','=','users.id')
                 ->select('payments.*','users.email','users.username','users.name','users.phone','profiles.national_id','profiles.country','profiles.merchantrade_acc','profiles.usdt_wallet')
                  ->where('payments.STATUS','NEW')
                 ->where('payments.DETAIL','REENTRY_DM5')
                  ->get();
         
         $alldataDone = \Illuminate\Support\Facades\DB::table('users')
                  //->join('profiles','transfers.user_id','=','profiles.user_id')
                 ->join('payments','payments.user_id','=','users.id')
                 ->join('profiles','profiles.user_id','=','users.id')
                 ->select('payments.*','users.email','users.username','users.name','users.phone','profiles.national_id','profiles.country','profiles.merchantrade_acc','profiles.usdt_wallet')
                  ->where('payments.STATUS','!=','NEW')
                 ->where('payments.DETAIL','REENTRY_DM5')
                  ->get();
         
         //dd($redeem);
         
         return view('admin.reentryMGT',compact('alldata','alldataDone'));       
    
    }
    
    
      public function PlaceReentry($pay)
    {
          //check if user is an admin
         if(auth()->user()->id > 7){return redirect('/home');}
        
         
        $data = payment::find($pay);
        
        
        $DM5 = \App\Models\DM5tree::find($data->INFO_ID);
         //dd($DM5); 
        
        //check the budget is shoudl be 200 min to procees
        $budget = $DM5->balance*0.20 - ($DM5->RE_ENTRY_TIMES*200);
        if($budget < 200)// block mishaps
        {
            
             $data->STATUS= 'CANCEL';
        $data->save();
         return redirect('/reentryMGT');
        }

        self::DM5addSilently($DM5->name.'-Re-'.($DM5->RE_ENTRY_TIMES+1),$DM5->user_id);
        $DM5->RE_ENTRY_TIMES = $DM5->RE_ENTRY_TIMES+1;
        $DM5->save();
        
        $data->STATUS= 'COMPLETE';
        $data->save();
         return redirect('/reentryMGT');
    }

  
    public function CancelReentry($pay)
    {
        //check if user is an admin
         if(auth()->user()->id > 7){return redirect('/home');}
        
        $data = payment::find($pay);
        //dd($data);  
        $data->STATUS= 'CANCEL';
        $data->save();
         return redirect('/reentryMGT');
    }
    
    
    
    
    
   /*--------------------------------------------------------------------------------------------                                          
                                        8b           d8      88        ad888888b,  
                                        `8b         d8'    ,d88       d8"     "88  
                                         `8b       d8'   888888               a8P  
                                          `8b     d8'        88            ,d8P"   
                                           `8b   d8'         88          a8P"      
                                            `8b d8'          88        a8P'        
                                             `888'           88  888  d8"          
                                              `8'            88  888  88888888888
         * 
         * THERE ARE 5 COPIES OF THIS METHOD MAKE SURE ALL IS UPDATED AT ONCE 
         * AdminMembershipController.php
         * CONSOLE - COMMANDS - MIDNIGHT UPDATE
         * 
        ------------------------------------------------------------------------------------------------   
        */
        
         public function UpdateSponsor(){echo "Midnight Engine Update Sponsors V1.2 value <hr>";
          $all = \App\Models\sponsor::all();
          
          foreach($all as $a)
          {$groupsale = \App\Models\sponsor::descendantsAndSelf($a->id)->sum('affiliate_type');
           $thisGuy = \App\Models\sponsor::descendantsAndSelf($a->id);
           $parentlevel = \App\Models\sponsor::withDepth()->find($a->id)->depth;
           $thisGuyFamily = \App\Models\sponsor::descendantsAndSelf($a->id)->count();
           echo "<br><br><br>CALCULATING FOR : ".$thisGuy->first()->name.' - ID:'.$thisGuy->first()->id;
           echo "<hr>Total Descendants : ".($thisGuyFamily-1);
               $bonus = 0;
               foreach($thisGuy as $b)
               {   $descendantLevel = \App\Models\sponsor::withDepth()->find($b->id)->depth;
                   if($b->id != $a->id)
                   {echo '<br>------------------------------------------------------------------------------------------<br>'.($b);
                   echo "<br>Parent_ID:".$a->id;  echo " - Child_ID:".$b->id; echo "<br>Name:".$b->name;
                   $dlevel = $descendantLevel - $parentlevel;
                   echo "   Differences : ".$dlevel;echo "   Descendant Level  ".$descendantLevel;echo "   Parent Level".$parentlevel;

                   if($dlevel == 1){$bonus +=   $b->affiliate_type * 0.10;}
                   else  if($dlevel == 2){$bonus +=   $b->affiliate_type * 0.02;}
                   else  if($dlevel == 3){$bonus +=$b->affiliate_type * 0.02;} 
                   else  if($dlevel == 4){$bonus +=  $b->affiliate_type * 0.01;}
                   echo 'Accumulated credit : '.$bonus;   
                   }         
               }
               echo "<br>Calculated Sponosr Bonus : ".$bonus;
               $a->balance =$bonus;
               $a->logs =$groupsale;
               $a->save();
          }
    }
    
    
         public function UpdateDM3()
            {
          echo "Midnight Engine Update DM3 V1.2 <br>";
          $all = \App\Models\DM3tree::all();
            foreach($all as $a)
            {    $thisGuyFamily = \App\Models\DM3tree::descendantsAndSelf($a->id)->count();
                 $a->balance =($thisGuyFamily-1)*50; 
                 $a->save();
                 echo "<hr>User : ". $a->name . " Node ID: ".$a->id;echo "<br>Descendants :".($thisGuyFamily-1);
                 echo "<br>Balance  80%:".$a->balance*0.8;echo "<br>Redeem  20%:".$a->balance*0.2;}
           }
    
           public function UpdateDM5()
    {
          echo "Midnight Engine Update DM5 V1.2 <br>";
          $all = \App\Models\DM5tree::all();
          foreach($all as $a)
          {
              echo "<hr>User : ". $a->name . " Node ID: ". $a->id. "DM3 CREDITED".$a->DM3_CREDITED .  " RE_ENTRY_TIMES :  ". $a->RE_ENTRY_TIMES;;
               $thisGuyFamily = \App\Models\DM5tree::descendantsAndSelf($a->id)->count();
               $a->balance =(($thisGuyFamily-1)*10)-(200*($a->RE_ENTRY_TIMES));
               echo "Calculate Descendants : ".($thisGuyFamily-1). "  <br>End Balance 80%: " .$a->balance*0.8. "  <br>Re-ENTRY Balance 20%: " .$a->balance*0.2;
                   if($thisGuyFamily > 5 && $a->DM3_CREDITED == 0)
                   {
                     $a->DM3_CREDITED = 1;
                     self::DM3addSilently($a->name,$a->user_id);
                   }
            $a->save(); 
          }
    }
        
        
        
    function DM5addSilently($namaDia,$ownerID)
    {   for ($xzz = 0; $xzz <= 0; $xzz++) {    
        echo "Creating New node: ".$namaDia;
        $TotalNodes = \App\Models\DM5tree::all()->count();
         echo "<br>Tree Stats<br>Total Nodes: ".$TotalNodes;
        $lastChildBorned = \App\Models\DM5tree::max('id');
        echo "<hr>SKIPPING TO ID ".$lastChildBorned;
        echo "<br>Last Child :".$lastChildBorned;
        $Deepest = \App\Models\DM5tree::withDepth()->find($lastChildBorned);
        echo " on Level ".$Deepest->depth . '<br>';
        $parent = null;
          if($Deepest->depth == 0){
            $parent = \App\Models\DM5tree::find(1);
          goto SkipAll; }
        
       $all = \App\Models\DM5tree::all();
       // Calculate all max child on depth 
        $maxOnLevel=[1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1];
        $minOnLevel = [110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,101,110,110,10,0,0,0,0,0,0,0,0,0];
        foreach (range($Deepest->depth-1, $Deepest->depth) as $i)  
                {
        
                 foreach($all as $d) {                    
                   $ThisGuysDepth = \App\Models\DM5tree::withDepth()->find($d->id);
                   
                   
                   if($ThisGuysDepth->depth == $i){
                       $ThisGuysDescendants = \App\Models\DM5tree::descendantsOf($d->id)->count();
                       echo "<br>His Depth ".$ThisGuysDepth->depth;
                       echo "  His Children ".$ThisGuysDescendants;
                       if($maxOnLevel[$i] < $ThisGuysDescendants)
                        $maxOnLevel[$i] = $ThisGuysDescendants;
                       
                       if($minOnLevel[$i] > $ThisGuysDescendants)
                        $minOnLevel[$i] = $ThisGuysDescendants;
                       
                       if($ThisGuysDescendants == 0){
                       echo "Skipping loop for max child cacluaction";
                       goto stopSearching;
                   }
                   }
                 }
                 
        }
        stopSearching:
        echo "<br>";
         foreach (range($Deepest->depth-1, $Deepest->depth) as $i){
         echo 'Level '.$i."MAX = ".$maxOnLevel[$i];
          echo 'Min = '.$minOnLevel[$i].'<br>';
         }
         echo '<br><hr><br>';
        foreach($all as $d)
        {
            echo "<br>Checking Nodes: ".$d->id;
             
            $Zchildren = \App\Models\DM5tree::descendantsOf($d->id)->count();
            echo "This Node has Children:". $Zchildren;
              $maxChildNow = 5;
            if($TotalNodes >= 3906)
             $maxChildNow = 1;
            if($Zchildren >= $maxChildNow){ echo "- FULL! ";}  
            else
            {         
                    $level = \App\Models\DM5tree::withDepth()->find($d->id)->depth;
                    echo "<br>Node is on Level : ".$level;
                    if($level == 0)$parent = $d;
                    
                    $Zchildren= 0;
                    $Zchildren = \App\Models\DM5tree::descendantsOf($d->id)->count();
                    
                    foreach (range($Deepest->depth-1, $Deepest->depth) as $ii)  
                    if($level == $ii){
                       if($Zchildren == $minOnLevel[$ii])
                           $parent = $d;     
                    }
            }
            if($parent == null)
            echo "NOPE! ";
            else
                goto jumpOut;     
        }
        jumpOut:

            if($parent == null)
                dd("NO PARENTS WORHTY");
            else
            {SkipAll:
        echo "Next Parent ",$parent->id;
        $MemberBaru = ['name' => $namaDia,'user_id' => $ownerID,'balance' => 0,'logs' => '0'];
        if($lastChildBorned%2 == 0){
            echo" <br><br><br>Its Even";
        $New = \App\Models\DM5tree::create($MemberBaru);
        $parent->appendNode($New);
        }
        else{
             echo" <br><br><br>Its Odd";  
        $New = \App\Models\DM5tree::create($MemberBaru);
        $New->prependToNode($parent)->save(); 
        }}}}

         
    function DM3addSilently($namaDia,$ownerID)
    {   for ($xzz = 0; $xzz <= 0; $xzz++) {   
        echo "Creating New node: ".$namaDia;
        $TotalNodes = \App\Models\DM3tree::all()->count();
        echo "<br>Tree Stats<br>Total Nodes: ".$TotalNodes;
        $lastChildBorned = \App\Models\DM3tree::max('id');
        echo "<hr>SKIPPING TO ID ".$lastChildBorned;
        echo "<br>Last Child :".$lastChildBorned;
        $Deepest = \App\Models\DM3tree::withDepth()->find($lastChildBorned);
        echo " on Level ".$Deepest->depth . '<br>';   
        $parent = null;
          if($Deepest->depth == 0){
            $parent = \App\Models\DM3tree::find(1);
          goto SkipAll; }
       $all = \App\Models\DM3tree::all();
       // Calculate all max child on depth 
        $maxOnLevel=[1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1];
        $minOnLevel = [110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,101,110,110,10,0,0,0,0,0,0,0,0,0];
        foreach (range($Deepest->depth-1, $Deepest->depth) as $i)  
                {
                 foreach($all as $d) {                    
                   $ThisGuysDepth = \App\Models\DM3tree::withDepth()->find($d->id);
                   if($ThisGuysDepth->depth == $i){
                       $ThisGuysDescendants = \App\Models\DM3tree::descendantsOf($d->id)->count();
                       echo "<br>His Depth ".$ThisGuysDepth->depth;
                       echo "  His Children ".$ThisGuysDescendants;
                       if($maxOnLevel[$i] < $ThisGuysDescendants)
                        $maxOnLevel[$i] = $ThisGuysDescendants;
                       if($minOnLevel[$i] > $ThisGuysDescendants)
                        $minOnLevel[$i] = $ThisGuysDescendants;
                       if($ThisGuysDescendants == 0){
                       echo "Skipping loop for max child cacluaction";
                       goto stopSearching;
                   }
                   }
                 }      
        }
        stopSearching:
        echo "<br>";
         foreach (range($Deepest->depth-1, $Deepest->depth) as $i){
         echo 'Level '.$i."MAX = ".$maxOnLevel[$i];
          echo 'Min = '.$minOnLevel[$i].'<br>';
         }
         echo '<br><hr><br>';
        foreach($all as $d)
        {
            echo "<br>Checking Nodes: ".$d->id;
            $Zchildren = \App\Models\DM3tree::descendantsOf($d->id)->count();
            echo "This Node has Children:". $Zchildren;
            if($Zchildren >= 3){ echo "- FULL! ";}  
            else
            {         
                    $level = \App\Models\DM3tree::withDepth()->find($d->id)->depth;
                    echo "<br>Node is on Level : ".$level;
                    if($level == 0)$parent = $d;
                    
                    $Zchildren= 0;
                    $Zchildren = \App\Models\DM3tree::descendantsOf($d->id)->count();
                    
                    foreach (range($Deepest->depth-1, $Deepest->depth) as $ii)  
                    if($level == $ii){
                       if($Zchildren == $minOnLevel[$ii])
                           $parent = $d;     
                    }
            }
            if($parent == null)
            echo "NOPE! ";
            else
                goto jumpOut;   
        }
        jumpOut:
            if($parent == null)
                dd("NO PARENTS WORHTY");
            else
            {SkipAll:
        echo "Next Parent ",$parent->id;
        $MemberBaru = ['name' => $namaDia,'user_id' => $ownerID,'balance' => 0,'logs' => '0'];
        if($lastChildBorned%2 == 0){
            echo" <br><br><br>Its Even";
        $New = \App\Models\DM3tree::create($MemberBaru);
        $parent->appendNode($New);
        }
        else{
             echo" <br><br><br>Its Odd";    
        $New = \App\Models\DM3tree::create($MemberBaru);
        $New->prependToNode($parent)->save();  
        }}}//return redirect('/DM3');} 
}




  function DM5withDM3CREDITED($namaDia,$ownerID)
    {   for ($xzz = 0; $xzz <= 0; $xzz++) {    
        echo "Creating New node: ".$namaDia;
        $TotalNodes = \App\Models\DM5tree::all()->count();
         echo "<br>Tree Stats<br>Total Nodes: ".$TotalNodes;
        $lastChildBorned = \App\Models\DM5tree::max('id');
        echo "<hr>SKIPPING TO ID ".$lastChildBorned;
        echo "<br>Last Child :".$lastChildBorned;
        $Deepest = \App\Models\DM5tree::withDepth()->find($lastChildBorned);
        echo " on Level ".$Deepest->depth . '<br>';
        $parent = null;
          if($Deepest->depth == 0){
            $parent = \App\Models\DM5tree::find(1);
          goto SkipAll; }
        
       $all = \App\Models\DM5tree::all();
       // Calculate all max child on depth 
        $maxOnLevel=[1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1];
        $minOnLevel = [110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,101,110,110,10,0,0,0,0,0,0,0,0,0];
        foreach (range($Deepest->depth-1, $Deepest->depth) as $i)  
                {
        
                 foreach($all as $d) {                    
                   $ThisGuysDepth = \App\Models\DM5tree::withDepth()->find($d->id);
                   
                   
                   if($ThisGuysDepth->depth == $i){
                       $ThisGuysDescendants = \App\Models\DM5tree::descendantsOf($d->id)->count();
                       echo "<br>His Depth ".$ThisGuysDepth->depth;
                       echo "  His Children ".$ThisGuysDescendants;
                       if($maxOnLevel[$i] < $ThisGuysDescendants)
                        $maxOnLevel[$i] = $ThisGuysDescendants;
                       
                       if($minOnLevel[$i] > $ThisGuysDescendants)
                        $minOnLevel[$i] = $ThisGuysDescendants;
                       
                       if($ThisGuysDescendants == 0){
                       echo "Skipping loop for max child cacluaction";
                       goto stopSearching;
                   }
                   }
                 }
                 
        }
        stopSearching:
        echo "<br>";
         foreach (range($Deepest->depth-1, $Deepest->depth) as $i){
         echo 'Level '.$i."MAX = ".$maxOnLevel[$i];
          echo 'Min = '.$minOnLevel[$i].'<br>';
         }
         echo '<br><hr><br>';
        foreach($all as $d)
        {
            echo "<br>Checking Nodes: ".$d->id;
             
            $Zchildren = \App\Models\DM5tree::descendantsOf($d->id)->count();
            echo "This Node has Children:". $Zchildren;
              $maxChildNow = 5;
            if($TotalNodes >= 3906)
             $maxChildNow = 1;
            if($Zchildren >= $maxChildNow){ echo "- FULL! ";}  
            else
            {         
                    $level = \App\Models\DM5tree::withDepth()->find($d->id)->depth;
                    echo "<br>Node is on Level : ".$level;
                    if($level == 0)$parent = $d;
                    
                    $Zchildren= 0;
                    $Zchildren = \App\Models\DM5tree::descendantsOf($d->id)->count();
                    
                    foreach (range($Deepest->depth-1, $Deepest->depth) as $ii)  
                    if($level == $ii){
                       if($Zchildren == $minOnLevel[$ii])
                           $parent = $d;     
                    }
            }
            if($parent == null)
            echo "NOPE! ";
            else
                goto jumpOut;     
        }
        jumpOut:

            if($parent == null)
                dd("NO PARENTS WORHTY");
            else
            {SkipAll:
        echo "Next Parent ",$parent->id;
        $MemberBaru = ['name' => $namaDia,'user_id' => $ownerID,'balance' => 0,'logs' => '0','DM3_CREDITED' => '1'];
        if($lastChildBorned%2 == 0){
            echo" <br><br><br>Its Even";
        $New = \App\Models\DM5tree::create($MemberBaru);
        $parent->appendNode($New);
        }
        else{
             echo" <br><br><br>Its Odd";  
        $New = \App\Models\DM5tree::create($MemberBaru);
        $New->prependToNode($parent)->save(); 
        }}}}

     

}