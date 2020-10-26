<?php

namespace App\Http\Controllers;
use App\Models\Profile;
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
           $alldata = Profile::all()->where('membership_paid',0)->where('membership_type','!=',0);
           
           
           //dd($alldata);
           return view('admin.newplans',compact('alldata','user','alldataApproved'));       
    
        
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
         
         
         $profile['membership_paid']=1;
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
         else if($profile['membership_type']== 1000)
            {for ($loopa = 1; $loopa <=5; $loopa++) {self::DM5addSilently($newMember->username.'-'.$loopa,$newMember->id);}
             self::DM3addSilently($newMember->username,$newMember->id);              
             }
         $profile->save();           
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
}
