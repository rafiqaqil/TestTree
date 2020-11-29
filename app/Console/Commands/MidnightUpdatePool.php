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
        echo "1";
        self::MidnightCreditForDM5();
        echo "1";
        (new  calcAll)->UpdateSponsor();  echo "2";
        (new  calcAll)->UpdateDM3();  echo "1";
        (new  calcAll)->UpdateDM5();  echo "1";
        
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
                        for ($loopa = 1; $loopa <=5; $loopa++) {(new  calcAll)->DM5addSilently($Username->username.'-'.$loopa,$profile->user_id);}
                       }
                       catch (Exception $e) {
                            echo 'Caught exception: Duplicate Entry Prevented';
                        }
                       echo "Credited to Account ".$Username->username;
                 }
   
               }
                echo "<hr><hr>Update Complete Complete";
                
              
                
    }
        

}