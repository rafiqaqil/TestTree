<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReentryController extends Controller
{
    
          public function __construct()
    {
        $this->middleware('auth');
    }
    
     public function create(\App\Models\DM5tree $DM5tree)
    {
        //dd($DM5tree);
        
        $DM5_ID = $DM5tree->id;
        $user = auth()->user();   $profile = $user->profile()->first();
        
        $budget = $DM5tree->balance*0.20 - ($DM5tree->RE_ENTRY_TIMES*200);

        //$budget=2000;

        if($DM5tree->user_id == $user->id){  
             if($budget >= 200){return view('reentry.create', compact('profile','user','DM5_ID'));}
             else{ return redirect('/home');}
        }
        
       else
       { return redirect('/home');}
        
        
    }
    
      public function store(\App\Models\DM5tree $DM5tree)
    { $user = auth()->user();   $profile = $user->profile()->first();
            $data = request()->validate([

              'AMOUNT' => 'required|numeric|min:0',
              'TYPE' => 'required',
              
        ]);
            

            $data['user_id']= $user->id;
            $data['DETAIL']= "REENTRY_DM5";
            $data['WAY']='OUT';
            $data['INFO_ID']=$DM5tree->id;
            $data['INFO_STR']=$DM5tree->name;
            
         //dd($data);
         $budget = $DM5tree->balance*0.20 - ($DM5tree->RE_ENTRY_TIMES*200);
         $budget =2000;
         if($DM5tree->user_id == $user->id){  
             if($budget >= 200){
                 
                 $dupliacte = \App\Models\payment::all()->where('STATUS','NEW')->where('INFO_ID',$DM5tree->id)->count();
                 if($dupliacte){
                     
                     //dd($dupliacte);
                     $dupliacte = \App\Models\payment::all()->where('STATUS','NEW')->where('INFO_ID',$DM5tree->id)->first();
                     $dupliacte->TYPE =$data['TYPE'];
                     $dupliacte->save();
                     
                 return redirect('/ShowMyDM5')->withErrors('Request has Already been Made');}
                 
                 $new =  \App\Models\payment::create($data);
                 //dd($new);
              }
            
        }
         return redirect('/ShowMyDM5');
    }
}
