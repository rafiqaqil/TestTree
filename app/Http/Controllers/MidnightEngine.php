<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Console\Commands\calcAll;

class MidnightEngine extends Controller
{
   
        public function __construct()
    {
        $this->middleware('auth');
    }
    
        public function MidnightCreditForDM5()
    {
        $newWork['WORKDONE'] = 'Manual DM5 - Push Mignight Pool';
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
                        for ($loopa = 1; $loopa <=5; $loopa++) {(new  calcAll)->DM5addSilently($Username->username.'-'.$loopa,$profile->user_id);}
                       }
                       catch (Exception $e) {
                            echo 'Caught exception: Duplicate Entry Prevented';
                        }
                       echo "Credited to Account ".$Username->username;
                 }
   
               }
                echo "<hr><hr>Update Complete Complete";
                

        (new  calcAll)->UpdateSponsor();  echo "2";
        (new  calcAll)->UpdateDM3();  echo "1";
        (new  calcAll)->UpdateDM5();  echo "1";
        
                
    }
    
     public function ShowMidnightCreditForDM5()
    {
             
          echo "Midnight Engine Update DM5 X5 Purchases (Credit Another 5 ) <hr>";
               $alluserProfile = \App\Models\Profile::where('affiliate_paid','1')->where('membership_type' , '1200')->get()->shuffle();
               
               if($alluserProfile->count() <= 0)
                   echo "NOTHING IN POOL FOR TONIGHT";
               foreach($alluserProfile as $user)
               {
                   
                        echo "ID : ".$user->id;
                         echo "<br>Username : ".$user->name;
                      
                       echo "    4 x DM5 Will Credited to Account".$user->name;     
               }
                echo "<hr> Review Complete ";
                
    }
    
           
        
  
     

        }

