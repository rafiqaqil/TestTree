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
           
      
           return view('admin.newplans',compact('alldataMERCH','alldata','user','alldataApproved'));       
    
        
    }
        public function ActivateAccountThisID($id)
    { 
   
        $profile = Profile::find($id);
        $profile->membership_type = 0;
        $profile->save();
        //dd($profile);
        
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
         
          $alldataApproved = Profile::all()->where('membership_type','>', 0);
        //dd($alldataApproved);
           $user = auth()->user();
           $alldata = Profile::all()->where('payment_type','=', 'USDT');
            $alldataMERCH = Profile::all()->where('payment_type','=', 'MERCHANTRADE');
           //dd($alldata);
           
           
           //dd($alldata);
           return view('admin.ActivateUsers',compact('alldata','user','alldataApproved','alldataMERCH'));       
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
    
     public function ApprovePlanPayment(Profile $profile)
     {
         //dd($profile);
        // dd($profile);
         
         $profile['membership_paid']=1;
         //dd($temp['membership_type']);
        $profile->save();
          
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
            
                       
          // dd($all);
         //dd($profile);
         
         $sponsor = \App\Models\User::all()->where('username','=',$profile->affiliate_sponsor)->first();
              
        
         if($sponsor != null)
         if($sponsor->id == $profile->user_id)
             $sponsor = null;
         
         if($sponsor != null)
         if($sponsor->id <= 6)
              $sponsor = null;
         
       
         
         $newMember = \App\Models\User::find($profile->user_id);
             
           
          //dd($newMember->username); 
                    if( $profile['affiliate_paid']==0)
                    {
                        $profile['affiliate_paid']=1;
                        //dd($temp['membership_type']);

                        
                       
                             $DataAnakBaru = [
          
                    'name' => $newMember->username,
                     'user_id' => $newMember->id,
                     'balance' => 0,
                      'affiliate_type' => $profile->membership_type,
                                 
                                 
                     'logs' => '0',   
        ];
         
     //dd($DataAnakBaru);
         try{
             
              //dd($sponsor);
             
             if($sponsor != null)
             {
              $SponsorParent = \App\Models\sponsor::all()->where('user_id',$sponsor->id)->first();
             echo 'sponsorFound'.$sponsor ;
              
             }
             else
             {
                 $SponsorParent = \App\Models\sponsor::find(1);
                  echo 'No Sponsor';
             }
              
             //dd($SponsorParent);
          $anakBaru = \App\Models\sponsor::create($DataAnakBaru,$SponsorParent);
          
          \App\Models\sponsor::fixTree();
         }
         
         catch (\Exception $e){echo $e;}
         ////--------------------------------------------------------------------------------------------------------------------------------
          ////--------------------------------------------------------------------------------------------------------------------------------
          //
          //ADD DM5 
          //
          //
          //--------------------------------------------------------------------------------------------------------------------------------
         if($profile['membership_type']== 200)
            {self::DM5addSilently($newMember->username,$newMember->id);}
         else if($profile['membership_type']>= 1000)
            {
             //for ($loopa = 1; $loopa <=5; $loopa++) {self::DM5addSilently($newMember->username.'-'.$loopa,$newMember->id);}
             self::DM5addSilently($newMember->username,$newMember->id);
             self::DM3addSilently($newMember->username,$newMember->id);              
            }
         $profile->save();   
         
         self::UpdateDM5();
          self::UpdateDM3();
           self::UpdateSponsor();
         
         }
            
            
         
           return redirect('/ManagePlacements');       
    
        
    }
    
    
    
    
    
    function DM5addSilently($namaDia,$ownerID)
    {
        //dd($namaDia,$ownerID);
        
        for ($xzz = 0; $xzz <= 0; $xzz++) {
            
            
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
        //dd($maxOnLevel);

        // Check and add child to tree
        foreach($all as $d)
        {
            echo "<br>Checking Nodes: ".$d->id;
             
            $Zchildren = \App\Models\DM5tree::descendantsOf($d->id)->count();
            echo "This Node has Children:". $Zchildren;
            if($Zchildren >= 5){ echo "- FULL! ";}  
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
       //dd();
        $MemberBaru = ['name' => $namaDia,'user_id' => $ownerID,'balance' => 0,'logs' => '0'];
       //dd($lastChildBorned, "is even number ",($lastChildBorned%2 == 0));
        if($lastChildBorned%2 == 0){
            echo" <br><br><br>Its Even";
           
        //\App\Models\DM5tree::create($MemberBaru,$parent); 
        $New = \App\Models\DM5tree::create($MemberBaru);
        $parent->appendNode($New);
        //dd("EVEN NUMBER INSERTED");
        
        }
        else{
             echo" <br><br><br>Its Odd";
             
        $New = \App\Models\DM5tree::create($MemberBaru);
        $New->prependToNode($parent)->save(); 
        
        //dd("ODD NUMBER INSERTED");
         
            }}
       
        
        //return redirect('/DM5');
            
        
        
    }//return redirect('/DM5');
        
    
        }
        
        
        
        
         
    function DM3addSilently($namaDia,$ownerID)
    {
        //dd($namaDia,$ownerID);
        
        for ($xzz = 0; $xzz <= 0; $xzz++) {
            
            
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
        //dd($maxOnLevel);

        // Check and add child to tree
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
       //dd();
        $MemberBaru = ['name' => $namaDia,'user_id' => $ownerID,'balance' => 0,'logs' => '0'];
       //dd($lastChildBorned, "is even number ",($lastChildBorned%2 == 0));
        if($lastChildBorned%2 == 0){
            echo" <br><br><br>Its Even";
           
        //\App\Models\DM3tree::create($MemberBaru,$parent); 
        $New = \App\Models\DM3tree::create($MemberBaru);
        $parent->appendNode($New);
        //dd("EVEN NUMBER INSERTED");
        
        }
        else{
             echo" <br><br><br>Its Odd";
             
        $New = \App\Models\DM3tree::create($MemberBaru);
        $New->prependToNode($parent)->save(); 
        
        //dd("ODD NUMBER INSERTED");
         
            }}
       
        
        //return redirect('/DM3');
            
        
        
    }//return redirect('/DM3');
        
    
        }
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
         public function UpdateSponsor()
    {
          
          echo "Midnight Engine Update Sponsors V1.0 value <hr>";
          
          $all = \App\Models\sponsor::all();
          
          foreach($all as $a)
          {
              
              
              $groupsale = \App\Models\sponsor::descendantsAndSelf($a->id)->sum('affiliate_type');
              //dd($groupsale);
              $thisGuy = \App\Models\sponsor::descendantsAndSelf($a->id);
              //dd($thisGuy);
              $parentlevel = \App\Models\sponsor::withDepth()->find($a->id)->depth;
              
               $thisGuyFamily = \App\Models\sponsor::descendantsAndSelf($a->id)->count();
               
               echo "<br><br><br>CALCULATING FOR : ".$thisGuy->first()->name.' - ID:'.$thisGuy->first()->id;
              echo "<hr>Total Descendants : ".($thisGuyFamily-1);
               $bonus = 0;
               foreach($thisGuy as $b)
               {
                 
                   $descendantLevel = \App\Models\sponsor::withDepth()->find($b->id)->depth;
                   
                   if($b->id != $a->id)
                   {
                       echo '<br>------------------------------------------------------------------------------------------<br>'.($b);
                   echo "<br>Parent_ID:".$a->id;
                   echo " - Child_ID:".$b->id;
                   echo "<br>Name:".$b->name;
                   
                   $dlevel = $descendantLevel - $parentlevel;
                    echo "   Differences : ".$dlevel;
                   echo "   Descendant Level  ".$descendantLevel;
                   echo "   Parent Level".$parentlevel;
                   
                   
                   if($dlevel == 1)
                   {
              
                       $bonus +=   $b->affiliate_type * 0.10;  
                   }
                   else  if($dlevel == 2)
                   {
                  
                       $bonus +=   $b->affiliate_type * 0.02;  
                   }
                    else  if($dlevel == 3)
                   {
                      
                       $bonus +=   $b->affiliate_type * 0.02;  
                   } else  if($dlevel == 4)
                   {
              
                       $bonus +=  $b->affiliate_type * 0.01;  
                   }
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
          echo "Midnight Engine Update DM3 V1.0 <br>";
          $all = \App\Models\DM3tree::all();
          foreach($all as $a)
          {
         
               $thisGuyFamily = \App\Models\DM3tree::descendantsAndSelf($a->id)->count();
               $a->balance =($thisGuyFamily-1)*50;
               
               
               $a->save();
                     echo "<hr>User : ". $a->name . " Node ID: ".$a->id;
                           echo "<br>Descendants :".($thisGuyFamily-1);
                             echo "<br>Balance  90%:".$a->balance*0.9;
                              echo "<br>Redeem  10%:".$a->balance*0.1;
          }
    }
    
           public function UpdateDM5()
    {
          echo "Midnight Engine Update DM5 V1.0 <br>";
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
                     self::DM3addSilently($a->name."-DM5-",$a->user_id);
                   }

               if(($a->balance-(200*$a->RE_ENTRY_TIMES))*0.2 > 200)
                   {
                   $a->RE_ENTRY_TIMES = $a->RE_ENTRY_TIMES + 1;
                   self::DM5addSilently($a->name."-R".$a->RE_ENTRY_TIMES,$a->user_id);
                   }   
            $a->save(); 
          }
    }
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
}
