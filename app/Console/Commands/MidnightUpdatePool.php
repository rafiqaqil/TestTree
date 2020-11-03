<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
class MidnightUpdatePool extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'midnightupdatepool:now';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       

        self::MidnightCreditForDM5();
        self::UpdateSponsor();
        self::UpdateDM3();
        self::UpdateDM5();
        
        return 0;
    }
    
     public function MidnightCreditForDM5()
    {
        
             $newWork['WORKDONE'] = 'SERVER AUTO - Push Mignight Pool UPDATE DM5, DM3, SPONSOR';
        \App\Models\RecordAutoWork::create($newWork);
             
            
          echo "Midnight Engine Update DM5 X5 Purchases (Credit Another 4 ) <hr>";
               $alluserProfile = \App\Models\Profile::where('affiliate_paid','=','1')->where('membership_type' , '1200')->get()->shuffle();
               // dd($alluserProfile);
               foreach($alluserProfile as $profile)
               {
                 if($profile->affiliate_paid == 1 && $profile->membership_type == 1200){
                   $Username =  \App\Models\User::find($profile->id);
                   //dd($Username->username);
                    echo "Scanning : ".$profile->id;
                 
                       $profile['affiliate_paid']= 5;
                       $profile->affiliate_paid = 5;
                       $profile->save();
                       try{
                        for ($loopa = 1; $loopa <=5; $loopa++) {self::DM5addSilently($Username->username.'-'.$loopa,$profile->user_id);}
                       }
                       catch (Exception $e) {
                            echo 'Caught exception: Duplicate Entry Prevented';
                        }
                       echo "Credited to Account ".$Username->username;
                 }
   
               }
                echo "<hr><hr>Update Complete Complete";
                
              
                
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

