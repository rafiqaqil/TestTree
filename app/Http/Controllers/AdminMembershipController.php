<?php

namespace App\Http\Controllers;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class AdminMembershipController extends Controller
{
    
    
    
         public function __construct()
    {
        $this->middleware('auth');
    }
    
    
        public function ControlPanel()
    {
           return view('admin.ControlPanel');       
    }
  
        public function manageNewPlans()
    {
         
        $alldataApproved = Profile::all()->where('membership_paid',1);
        //dd($alldataApproved);
           $user = auth()->user();
            $alldata = Profile::all()->where('membership_paid',0)->where('affiliate_paid',0)->where('placement_payment_type','=', 'USDT');
           $alldataMERCH = Profile::all()->where('membership_paid',0)->where('affiliate_paid',0)->where('placement_payment_type','=', 'MERCHANTRADE');
             $alldataWALLET = Profile::all()->where('membership_paid',0)->where('affiliate_paid',0)->where('placement_payment_type','=', 'WALLET');
           
      
           return view('admin.newplans',compact('alldataMERCH','alldata','user','alldataApproved','alldataWALLET'));       
    
        
    }
        public function ActivateAccountThisID($id)
    { 
            $user = User::find($id);
            $profile = Profile::find($id);
               //dd($profile);
          	if($profile->placement_payment_type == 'WALLET')
                {
                   
                    $FinalBalance = self::checkWalletByID($profile->id);
                    
                    
                     //dd($profile->membership_type);
                    if($FinalBalance >= 10)
                    {
                          $userProfile = \App\Models\Profile::find($user->id);
                            $data['to_user_id'] = '1';
                            $data['to_username'] = 'Admin_A';
                             $data['from_username'] = $user->username;
                            $data['user_id'] = $profile->id;
                            $data['AMOUNT'] = 10;
                            \App\Models\transfer::create($data);
          
                        $profile = Profile::find($id);
                        $profile->membership_type = 0;
                        $profile->save();
                        
                    }
                }
                else{ 
                    //dd("WORKING NOW");
        $profile = Profile::find($id);
        $profile->membership_type = 0;
        $profile->save();
        //dd($profile);
                }
                
        return redirect('/ShowNewUsers');
    }
    
           public function CancelActivateAccountThisID($id)
    { 
   
        $profile = Profile::find($id);
        $profile->payment_type = 0;
        
        $profile->save();
        //dd($profile);
        
        return redirect('/ShowNewUsers');
    }
     public function ListActivateAccount()
    {
         
          $alldataApproved = Profile::all()->where('membership_type','>=', 0);
        //dd($alldataApproved);
           $user = auth()->user();
           $alldata = Profile::all()->where('payment_type','=', 'USDT')->where('membership_type','<', 0);
            $alldataMERCH = Profile::all()->where('payment_type','=', 'MERCHANTRADE')->where('membership_type','<', 0);;
            $alldataWALLET = Profile::all()->where('payment_type','=', 'WALLET')->where('membership_type','<', 0);;
           //dd($alldata);
           
           
           //dd($alldata);
           return view('admin.ActivateUsers',compact('alldata','user','alldataApproved','alldataMERCH','alldataWALLET'));       
    }
     
       
          public function ManagePlacements()
    {
         
        $alldataApproved = Profile::all()->where('membership_paid',1)->where('affiliate_paid',1);
        //dd($alldataApproved);
           $user = auth()->user();
           $alldata = Profile::all()->where('membership_paid',1)->where('affiliate_paid',0);
           
           
           //dd($alldata);
           return view('admin.placementApproval',compact('alldata','user','alldataApproved'));       
    
        
    }
    
        public function checkWalletByID($id)
    {         
            $user = User::find($id); 
            $profile = $user->profile()->first();
         
           //dd($profile);
         $alldata =    \App\Models\widthdraw::all()->where('user_id',$user->id)->where('STATUS','=',0);
         $alldataApproved =     \App\Models\widthdraw::all()->where('user_id',$user->id)->where('STATUS','!=',0);
         $Negative =     \App\Models\widthdraw::all()->where('user_id',$user->id)->where('STATUS','!=',9)->sum('AMOUNT');
          $TDM5 =  \App\Models\DM5tree::all()->where('user_id',$user->id)->sum('balance')*0.8;
          $TDM3 =  \App\Models\DM3tree::all()->where('user_id',$user->id)->sum('balance')*0.9;
          $TSPN = \App\Models\sponsor::all()->where('user_id',$user->id)->sum('balance');    
          $transfersIN = \App\Models\transfer::all()->where('to_user_id',$user->id)->where('STATUS','==',1)->sum('AMOUNT');
          $transfersOUT = \App\Models\transfer::all()->where('user_id',$user->id)->where('STATUS','!=',9)->sum('AMOUNT');
         $Transfers = $transfersIN -$transfersOUT;
          $FinalBalance = $TDM5+ $TDM3 +$TSPN + $transfersIN - $transfersOUT- $Negative;
     
        return $FinalBalance; 
    }
    
     public function ApprovePlanPayment(Profile $profile)
     {
         $user = User::find($profile->id);
          	if($profile->placement_payment_type == 'WALLET')
                {
                   
                    $FinalBalance = self::checkWalletByID($profile->id);
                    $FinalBalance =  $FinalBalance - $profile->membership_type;
                    
                     //dd($profile->membership_type);
                    if($FinalBalance >= 0)
                    {
                          $userProfile = \App\Models\Profile::find($user->id);
                            $data['to_user_id'] = '1';
                            $data['from_username'] = $user->username;
                            $data['user_id'] = $profile->id;
                            $data['AMOUNT'] = $profile->membership_type;
                            \App\Models\transfer::create($data);
          
                       $profile['membership_paid']=1;
                       $profile->save();
                        
                    }
                    
                }
                else{
         $profile['membership_paid']=1;
         //dd($temp['membership_type']);
        $profile->save();
                }
          
           return redirect('/manageNewPlans');       
    
        
    }
    
        public function CancelApprovePayment(Profile $profile)
     {
         //dd($profile);
         
        $profile->placement_payment_type = 0;
         $profile['membership_type']=0;
         //dd($temp['membership_type']);
        $profile->save();
          
           return redirect('/manageNewPlans');       
    
        
    }
    
        public function ApprovePlacement(Profile $profile)
     {

         $sponsor = \App\Models\User::all()->where('username','=',$profile->affiliate_sponsor)->first();
         if($sponsor != null)
         if($sponsor->id == $profile->user_id)
             $sponsor = null;
         if($sponsor != null)
         if($sponsor->id <= 6)
              $sponsor = null;
         $newMember = \App\Models\User::find($profile->user_id);
                    if( $profile['affiliate_paid']==0)
                    {
                        $profile['affiliate_paid']=1;
                        //dd($temp['membership_type']);
                             $DataAnakBaru = ['name' => $newMember->username,
                     'user_id' => $newMember->id,
                     'balance' => 0,
                      'affiliate_type' => $profile->membership_type,          
                     'logs' => '0', ];

         try{
             if($sponsor != null){$SponsorParent = \App\Models\sponsor::all()->where('user_id',$sponsor->id)->first();echo 'sponsorFound'.$sponsor ;}
             else{$SponsorParent = \App\Models\sponsor::find(1);echo 'No Sponsor';}
          $anakBaru = \App\Models\sponsor::create($DataAnakBaru,$SponsorParent);
          \App\Models\sponsor::fixTree();
         }
         catch (\Exception $e){echo $e;}
  //--------------------------------------------------------------------------------------------------------------------------------
         if($profile['membership_type']== 200)
            {self::DM5addSilently($newMember->username,$newMember->id);}
         else if($profile['membership_type']>= 1000)
            {
             //for ($loopa = 1; $loopa <=5; $loopa++) {self::DM5addSilently($newMember->username.'-'.$loopa,$newMember->id);}
             self::DM5withDM3CREDITED($newMember->username,$newMember->id);
             self::DM3addSilently($newMember->username,$newMember->id);              
            }
         $profile->save();   
         self::UpdateDM5();
         self::UpdateDM3();
         self::UpdateSponsor();
         }
           return redirect('/ManagePlacements');        
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
