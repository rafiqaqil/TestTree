<?php

namespace App\Http\Controllers;

use App\Models\DM3tree;
use Illuminate\Http\Request;

class DM3treeController extends Controller
{
    
         public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function updateBalance()
    {
      $all = \App\Models\DM3tree::all();
      foreach($all as $d)
      {
          echo $d;
          $keluarga =  \App\Models\DM3tree::descendantsOf($d)->count();
          echo "<br>Keluarga : ".$keluarga;
          echo "<br> ";
          
         
          if($keluarga <= 3125)
               $d['balance'] = $keluarga*8;
          else
              $d['balance'] = 3125*8;
          
          $d['logs'] = $keluarga*2;
          
          $d->save();    
      }
    }
    
     public function index2()
    {
       
        $shops = DM3tree::get()->toTree();
        $chart = DM3tree::all();
        
        //dd($chart->id);
       // dd($chart->parent_id);
        //dd($chart);
        $jsondata = json_encode($shops);

        

        $jsondata = trim($jsondata, '[]');
        $all = \App\Models\DM3tree::max('id');
        //dd( $jsondata);
         $levels = \App\Models\DM3tree::withDepth()->find($all);
       //dd($levels->depth);
        //dd( $jsondata);
        return view('DM5.GoogleTree', compact('shops','jsondata','all','levels','chart'));
    }
    public function index()
    {
        
        $shops = DM3tree::get()->toTree();

        $jsondata = json_encode($shops);

        

        $jsondata = trim($jsondata, '[]');
        $all = \App\Models\DM3tree::max('id');
         $levels = \App\Models\DM3tree::withDepth()->find($all);
       //dd($levels->depth);
        //dd( $jsondata);
        return view('DM3.TREE', compact('shops','jsondata','all','levels'));
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
            
            $childs = \App\Models\DM3tree::descendantsOf($x)->count();
            //echo "</br>parent:".$x." HAS CHILD : ".$childs ;
            
         if($childs < 3){
             $parent = \App\Models\DM3tree::where('id',$x)->first();
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
     
         
        \App\Models\DM3tree::create($MemberBaru,$parent);
        
         //dd($MemberBaru);
         
        }
         return redirect('/DM3');
    }
    
           public function tambahMemberSoftly($namaDia)
    {
         ////select parent_id, count(*) FROM `d_m5trees`group by parent_id -- CHECK THE PARENTS ID MAX COUNT SHOULD BE 5
         //dd(intval(\App\Models\DM5tree::max('id')/5-1,0));
        
      
        for ($zzz = 1; $zzz <= 1; $zzz++)    
        {
            
            
            $all = \App\Models\DM3tree::max('id');
         $est = intval($all/3,0);
         echo "<br> All Nodes:".$all;
         echo "<br> Next Parent : ".$est;
        $parent = null;
        $x = $est;

        while($parent == null) {
            
            $childs = \App\Models\DM3tree::descendantsOf($x)->count();
            echo "</br>parent:".$x." HAS CHILD : ".$childs ;
            
         if($childs < 3){
             $parent = \App\Models\DM3tree::where('id',$x)->first();
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
     
         
        \App\Models\DM3tree::create($MemberBaru,$parent);
        
         //dd($MemberBaru);
         
        }
         return redirect('/DM3');
         
    }
    
    
      
    public function create()
    {
        //
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
     * @param  \App\Models\DM3tree  $dM3tree
     * @return \Illuminate\Http\Response
     */
    public function show(DM3tree $dM3tree)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DM3tree  $dM3tree
     * @return \Illuminate\Http\Response
     */
    public function edit(DM3tree $dM3tree)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DM3tree  $dM3tree
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DM3tree $dM3tree)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DM3tree  $dM3tree
     * @return \Illuminate\Http\Response
     */
    public function destroy(DM3tree $dM3tree)
    {
        //
    }
}
