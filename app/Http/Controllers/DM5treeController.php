<?php

namespace App\Http\Controllers;

use App\Models\DM5tree;
use Illuminate\Http\Request;
use Auth;
use App\User;

class DM5treeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
         public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
       
        $shops = DM5tree::get()->toTree();

        $jsondata = json_encode($shops);

        

        $jsondata = trim($jsondata, '[]');
        $all = \App\Models\DM5tree::max('id');
        //dd( $jsondata);
         $levels = \App\Models\DM5tree::withDepth()->find($all);
       //dd($levels->depth);
        //dd( $jsondata);
        return view('DM5.TREE', compact('shops','jsondata','all','levels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tambahMember($namaDia)
    {
        for ($zzz = 1; $zzz <= 10; $zzz++)
        
        {
        $parent = null;
        $x = 1;

        while($parent == null) {
            
            $childs = \App\Models\DM5tree::descendantsOf($x)->count();
            //echo "</br>parent:".$x." HAS CHILD : ".$childs ;
            
         if($childs < 5){
             $parent = \App\Models\DM5tree::where('id',$x)->first();
             //echo "</br>------------------------------------------------------------------------------------------------------------------------------------------------------------"; 
             //dd($parent);
         }
         $x++;
         
        }
    
        //dd($parent);
        
        //dd(DM5tree::descendantsAndSelf($id));
        
       // dd(auth()->user());
        
        
         $MemberBaru = [
          
                    'name' => $namaDia,
                     'user_id' => auth()->user()->id,
                     'balance' => 0,
                     'logs' => '0',
             //'parent_id' => $parent->id,    
        ];
     
         
        \App\Models\DM5tree::create($MemberBaru,$parent);
        
         //dd($MemberBaru);
         
        }
         return redirect('/DM5');
         
    }
    
     public function tambahMemberSoftly($namaDia)
    {
         ////select parent_id, count(*) FROM `d_m5trees`group by parent_id -- CHECK THE PARENTS ID MAX COUNT SHOULD BE 5
         //dd(intval(\App\Models\DM5tree::max('id')/5-1,0));
        
      
        for ($zzz = 1; $zzz <= 1000; $zzz++)    
        {
            
            
            $all = \App\Models\DM5tree::max('id');
         $est = intval($all/5,0);
         echo "<br> All Nodes:".$all;
         echo "<br> Next Parent : ".$est;
        $parent = null;
        $x = $est;

        while($parent == null) {
            
            $childs = \App\Models\DM5tree::descendantsOf($x)->count();
            echo "</br>parent:".$x." HAS CHILD : ".$childs ;
            
         if($childs < 5){
             $parent = \App\Models\DM5tree::where('id',$x)->first();
             echo "</br>------------------------------------------------------------------------------------------------------------------------------------------------------------"; 
             //dd($parent);
         }
         $x++;
         
        }
    
        //dd($parent);
        
        //dd(DM5tree::descendantsAndSelf($id));
        
       // dd(auth()->user());
        
        
         $MemberBaru = [
          
                    'name' => $namaDia,
                     'user_id' => auth()->user()->id,
                     'balance' => 0,
                     'logs' => '0',
             //'parent_id' => $parent->id,    
        ];
     
         
        \App\Models\DM5tree::create($MemberBaru,$parent);
        
         //dd($MemberBaru);
         
        }
         return redirect('/DM5');
         
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DM5tree  $dM5tree
     * @return \Illuminate\Http\Response
     */
    public function show(DM5tree $dM5tree)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DM5tree  $dM5tree
     * @return \Illuminate\Http\Response
     */
    public function edit(DM5tree $dM5tree)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DM5tree  $dM5tree
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DM5tree $dM5tree)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DM5tree  $dM5tree
     * @return \Illuminate\Http\Response
     */
    public function destroy(DM5tree $dM5tree)
    {
        //
    }
}
