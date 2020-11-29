<?php

namespace App\Http\Controllers;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use \App\Console\Commands\calcAll;

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
    
       public function reentryMGT()
    {
         
         $reentry= Profile::whereRaw('D1 < D2')->get();
         //dd($reentry);
         
         return view('admin.reentry',compact('reentry'));       
    }
    /*
     * 
     * OLD REENTRY METHOD USING CUMULATIVE NODES REENTRY BALANBCE DEPRECIATED 23 NOV 2020
      public function CancelReentry($id)
    {
          $user = User::find($id);
          $profile = Profile::find($id);
      
            $profile->D2 = $profile->D1;
            $profile->save();

         return redirect('/reentryMGT');  
    }
    
      public function StoreReentry($id)
    {
          $user = User::find($id);
          $profile = Profile::find($id);
          if($profile->D1 != $profile->D2){
          
          //dd($profile);
          //dd($user->username.'-Re-'.$profile->D2);
            $profile->D1=$profile->D2;
            $profile->save();
          self::DM5addSilently($user->username.'-Re-'.$profile->D2,$user->id);
          }
         
         return redirect('/reentryMGT');  
    }
    */
  
        public function manageNewPlans()
    {
         
        $alldataApproved = Profile::orderBy('updated_at', 'desc')->get()->where('id','>',6)->where('membership_paid',1);
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
                
                \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\AccountActivatedMail());
                
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
         
          $alldataApproved = Profile::orderBy('updated_at', 'desc')->get()->where('id','>',6)->where('membership_type','==', 0);
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
            {(new  calcAll)->DM5addSilently($newMember->username,$newMember->id);}
         else if($profile['membership_type']>= 1000)
            {
             //for ($loopa = 1; $loopa <=5; $loopa++) {(new  calcAll)->DM5addSilently($newMember->username.'-'.$loopa,$newMember->id);}
             (new  calcAll)->DM5withDM3CREDITED($newMember->username,$newMember->id);
             (new  calcAll)->DM3addSilently($newMember->username,$newMember->id);              
            }
         $profile->save(); 
         
         
        (new  calcAll)->UpdateSponsor();  echo "2";
        (new  calcAll)->UpdateDM3();  echo "1";
        (new  calcAll)->UpdateDM5();  echo "1";
        
         
         $user = User::find($profile->id);
         \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\EDM5CreditedMail());
         }
           return redirect('/ManagePlacements');        
    }
      
   

        }

