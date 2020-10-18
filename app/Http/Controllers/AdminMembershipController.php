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
         
        $alldataApproved = Profile::all()->where('affiliate_paid',1);
        //dd($alldataApproved);
           $user = auth()->user();
           $alldata = Profile::all()->where('affiliate_paid',0);
           
           
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
              
         //dd($sponsor); 
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
              
             // dd($SponsorParent);
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
                                 {
                                     
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
          
                    'name' => $newMember->username,
                     'user_id' => $newMember->id,
                     'balance' => 0,
                     'logs' => '0',
             //'parent_id' => $parent->id,    
        ];
         
         //dd($MemberBaru);
     //dd($parent);
         
        \App\Models\DM5tree::create($MemberBaru,$parent);
        
                                     
                                     
                                     
                                     
                                     
                        }
                        
                        
                        
                        
                        //
                        // IF 100USD 5 D5
                        //
                        //
                        //
                          else if($profile['membership_type']== 1000)
                                 {
                                     for ($loopa = 1; $loopa <=5; $loopa++) {
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
                 $parent = \App\Models\DM5tree::where('id',$x)->first();
                 echo "</br>------------------------------------------------------------------------------------------------------------------------------------------------------------"; 
               
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
    
        //dd($parent);
        
        //dd(DM5tree::descendantsAndSelf($id));
        
       // dd(auth()->user());
        
        
         $MemberBaru = [
          
                    'name' => $newMember->username.'-'.$loopa,
                     'user_id' => $newMember->id,
                     'balance' => 0,
                     'logs' => '0',
             //'parent_id' => $parent->id,    
        ];
         
         //dd($MemberBaru);
     //dd($parent);
         
        \App\Models\DM5tree::create($MemberBaru,$parent);
        
                                     
                                     
                                     
                                     
                                     
                                 }
                                 
                                 
                                 
             //addddddddddddddddddddd             dmmmmmmmmmm3 333333333
                                 
                                 
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
            if($all <= 3906){
                $childs = \App\Models\DM3tree::descendantsOf($x)->count();
                echo "</br>parent:".$x." HAS CHILD : ".$childs ;

             if($childs < 5){
                 $parent = \App\Models\DM3tree::where('id',$x)->first();
                 echo "</br>------------------------------------------------------------------------------------------------------------------------------------------------------------"; 
               
             }
             
                 
                 
             }
             else{
                  $childs = \App\Models\DM3tree::descendantsOf($x)->count();
                echo "</br>MAX parent:".$x." HAS CHILD : ".$childs ;

             if($childs < 1){
                 $parent = \App\Models\DM3tree::where('id',$x)->first();
                 echo "</br>------------------------------------------------------------------------------------------------------------------------------------------------------------"; 
                
             }}     
           $x++;  
           $tries++;
            if($parent != null)
            $tries = $tries+ 1000;

        }
    
        //dd($parent);
        
        //dd(DM5tree::descendantsAndSelf($id));
        
       // dd(auth()->user());
        
        
         $MemberBaru = [
          
                    'name' => $newMember->username,
                     'user_id' => $newMember->id,
                     'balance' => 0,
                     'logs' => '0',
             //'parent_id' => $parent->id,    
        ];
         
         //dd($MemberBaru);
     //dd($parent);
         
        \App\Models\DM3tree::create($MemberBaru,$parent);
        
                                     
                                     
                                     
                                     
                                     
                                 
                                 
                                 
                                 
                                 
                                 
                                 
                                 
                                 
                                 
                                 
                                 
                                 
                                 
                                 
                                 
                                 
                                 
                                 
                                 
                                 
                                 
                                 
                                 
                                 
                                 
             }
                        
                       $profile->save();
                    }
            
            
         
           return redirect('/manageNewPlans');       
    
        
    }
    
}
