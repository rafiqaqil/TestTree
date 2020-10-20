<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MidnightEngine extends Controller
{
   
        public function __construct()
    {
        $this->middleware('auth');
    }
    
      public function UpdateSponsor()
    {
          
          echo "Midnight Engine V1.0 <br>";
          
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
                       $bonus += $b->affiliate_type * 0.10;  
                   }
                   else  if($dlevel == 2)
                   {
                       $bonus += $b->affiliate_type * 0.02;  
                   }
                    else  if($dlevel == 3)
                   {
                       $bonus += $b->affiliate_type * 0.02;  
                   } else  if($dlevel == 4)
                   {
                       $bonus += $b->affiliate_type * 0.01;  
                   }
                   echo 'Accumulated credit : '.$bonus;
                       
                   }
                   
               }
               echo "<br>Calculated Sponosr Bonus : ".$bonus;
               
               $a->balance =$bonus;
               $a->save();
          }
          
          
          dd();
         
        
        
        
    
        
    }
    
}
