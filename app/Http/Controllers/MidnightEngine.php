<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MidnightEngine extends Controller
{
   
        public function __construct()
    {
        $this->middleware('auth');
    }
    
        public function MidnightCreditForDM5()
    {
             
          echo "Midnight Engine Update DM5 X5 Purchases (Credit Another 4 ) <hr>";
               $alluser = \App\Models\User::all();
               foreach($alluser as $user)
               {
                   $profile = \App\Models\Profile::find($user->id);
                    echo "Scanning : ".$profile->id;
                   if($profile->affiliate_paid == 1 && $profile->membership_type == 1000)
                   {
                        for ($loopa = 2; $loopa <=5; $loopa++) {self::DM5addSilently($user->username.'-'.$loopa,$user->id);}
                       $profile->affiliate_paid == 5;
                       self::DM3addSilently($user->username,$user->id);      
                       $profile->save();
                       echo "Credited to Account".$user->username;
                       
                   }
                   
                   
               }
                echo "<hr><hr>Update Complete Complete";
    }
    
     public function ShowMidnightCreditForDM5()
    {
             
          echo "Midnight Engine Update DM5 X5 Purchases (Credit Another 4 ) <hr>";
               $alluser = \App\Models\User::all();
               foreach($alluser as $user)
               {
                   $profile = \App\Models\Profile::find($user->id);
                    echo "<hr>";//Scanning : ".$profile->id;
                   if($profile->affiliate_paid == 1 && $profile->membership_type == 1000)
                   {
                        echo "ID : ".$user->id;
                         echo "<br>Username : ".$user->username;
                      
                       echo "4 x DM5 + DM3Will Credited to Account".$user->username;
                   }
                   
                   
               }
                echo "<hr> Review Complete ";
                
    }
    
    
      public function UpdateSponsor()
    {
          
          echo "Midnight Engine Update Sponsors V1.0 <hr>";
          
          $all = \App\Models\sponsor::all();
          
          foreach($all as $a)
          {
              $thisGuy = \App\Models\sponsor::descendantsAndSelf($a->id);
              //dd($thisGuy);
              $parentlevel = \App\Models\sponsor::withDepth()->find($a->id)->depth;
              
               $thisGuyFamily = \App\Models\sponsor::descendantsAndSelf($a->id)->count();
               
               echo "<br><br><br>CALCULATING FOR : ".$thisGuy->first()->name;
              echo "<hr>Total Descendants and self : ".$thisGuyFamily;
               $bonus = 0;
               foreach($thisGuy as $b)
               {
                 
                   $descendantLevel = \App\Models\sponsor::withDepth()->find($b->id)->depth;
                   
                   if($b->id != $a->id)
                   {
                       echo '<br>------------------------------------------------------------------------------------------<br>'.($b);
                   echo "<br>Parent_ID:".$a->id;
                   echo "<br>Child_ID:".$b->id;
                   echo "<br>Name:".$b->name;
                   
                   $dlevel = $descendantLevel - $parentlevel;
                    echo "Differences : ".$dlevel;
                   echo "Descendant Level".$descendantLevel;
                   echo "Parent Level".$parentlevel;
                   
                   
                   if($dlevel == 1)
                   {
                       if($b->affiliate_type == 200)
                       $bonus +=  200 * 0.10;  
                        if($b->affiliate_type == 1000)
                       $bonus +=  1200 * 0.10;  
                   }
                   else  if($dlevel == 2)
                   {
                       if($b->affiliate_type == 200)
                       $bonus +=  200 * 0.02;  
                        if($b->affiliate_type == 1000)
                       $bonus +=  1200 * 0.02;  
                   }
                    else  if($dlevel == 3)
                   {
                        if($b->affiliate_type == 200)
                       $bonus +=  200 * 0.02;  
                        if($b->affiliate_type == 1000)
                       $bonus +=  1200 * 0.02;  
                   } else  if($dlevel == 4)
                   {
                        if($b->affiliate_type == 200)
                       $bonus +=  200 * 0.01;  
                        if($b->affiliate_type == 1000)
                       $bonus +=  1200 * 0.01;  
                   }
                   echo 'Accumulated credit : '.$bonus;
                       
                   }
                   
               }
               echo "<br>Calculated Sponosr Bonus : ".$bonus;
               
               $a->balance =$bonus;
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
               $a->balance =($thisGuyFamily-1)*10;
               $a->save();
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
}
