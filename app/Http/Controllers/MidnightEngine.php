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
          
          echo "Midnight Engine Update Sponsors V1.0 <br>";
          
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
               
               if($a->DM3_CREDITED == 0)
               {
                   if($thisGuyFamily > 5)
                   {
                       $a->DM3_CREDITED = 1;
                       
                       
                       //ADD DM3
                       

                                                                                $all = \App\Models\DM3tree::all()->count();

                                                                               $est = intval($all/3-1,0);

                                                                               if($est < 1)
                                                                                   $est = 1;
                                                                               echo "<br> All Nodes:".$all;
                                                                               echo "<br> Next Parent : ".$est;
                                                                              $parent = null;
                                                                              $x = $est;
                                                                              $tries = 0;
                                                                              while($tries < 1000) {
                                                                                  echo "<br>Checking".$x;
                                                                                  $all = \App\Models\DM3tree::all()->count();
                                                                                 
                                                                                      $childs = \App\Models\DM3tree::descendantsOf($x)->count();
                                                                                      echo "</br>parent:".$x." HAS CHILD : ".$childs ;

                                                                                   if($childs < 3){
                                                                                       $parent = \App\Models\DM3tree::where('id',$x)->first();
                                                                                       echo "</br>------------------------------------------------------------------------------------------------------------------------------------------------------------"; 

                                                                                   }

                                                                                 $x++;  
                                                                                 $tries++;
                                                                                  if($parent != null)
                                                                                  $tries = $tries+ 1000;

                                                                              }

                                                                              //dd($parent);

                                                                              //dd(DM5tree::descendantsAndSelf($id));

                                                                             // dd(auth()->user());


                                                                               $MemberBaru = [

                                                                                          'name' => $a->name.'-DM5-'.$a->ID,
                                                                                           'user_id' => $a->user_id,
                                                                                           'balance' => 0,
                                                                                           'logs' => '0',
                                                                                   //'parent_id' => $parent->id,    
                                                                              ];

                                                                               //dd($MemberBaru);
                                                                           //dd($parent);

                                                                              \App\Models\DM3tree::create($MemberBaru,$parent);















                                 
                                 
                                 
                                 
                                 
                                 
                                 
                       
                       
                       
                       
                       
                       
                       
                       
                       
                       
                       
                       
                       
                       
                       
                       
                       
                       
                       
                       
                       
                   }
               }
               if($a->balance*0.2 > 200)
                   {
                   $a->RE_ENTRY_TIMES = $a->RE_ENTRY_TIMES + 1;
                   
                   
                   //ADDD DM5 
                   
                                                                                $all = \App\Models\DM5tree::all()->count();

                                                                                $est = intval($all/5-1,0);

                                                                                if($est < 1)
                                                                                    $est = 1;
                                                                                echo "<br> All Nodes:".$all;
                                                                                echo "<br> Next Parent : ".$est;
                                                                               $parent = null;
                                                                               $x = $est;
                                                                               $tries = 0;
                                                                               while($tries < 1000) {
                                                                                   echo "<br>Checking".$x;
                                                                                   $all = \App\Models\DM5tree::max('id');
                                                                                   if($all <= 3906){
                                                                                       $childs = \App\Models\DM5tree::descendantsOf($x)->count();
                                                                                       echo "</br>parent:".$x." HAS CHILD : ".$childs ;

                                                                                    if($childs < 5){
                                                                                        $parent = \App\Models\DM5tree::find($x);

                                                                                        echo "</br>222------------------------------------------------------------------------------------------------------------------------------------------------------------"; 

                                                                                    }



                                                                                    }
                                                                                    else{
                                                                                         $childs = \App\Models\DM5tree::descendantsOf($x)->count();
                                                                                       echo "</br>MAX parent:".$x." HAS CHILD : ".$childs ;

                                                                                    if($childs < 1){
                                                                                        $parent = \App\Models\DM5tree::where('id',$x)->first();
                                                                                        echo "</br>------------------------------------------------------------------------------------------------------------------------------------------------------------"; 

                                                                                    }}     
                                                                                  $x++;  
                                                                                  $tries++;
                                                                                  if($parent != null)
                                                                                   $tries = $tries+ 1000;
                                                                               }



                                                                               //dd(DM5tree::descendantsAndSelf($id));

                                                                              // dd(auth()->user());


                                                                                $MemberBaru = [

                                                                                           'name' => $a->name."-R".$a->RE_ENTRY_TIMES,
                                                                                            'user_id' => $a->user_id,
                                                                                            'balance' => 0,
                                                                                            'logs' => '0',
                                                                                    //'parent_id' => $parent->id,    
                                                                               ];

                                                                                //dd($MemberBaru);
                                                                            //dd($parent);

                                                                               \App\Models\DM5tree::create($MemberBaru,$parent);
  
                   
                   }
                   
                   
                   
            $a->save(); 
          }
    }
    
         
    
    
}
