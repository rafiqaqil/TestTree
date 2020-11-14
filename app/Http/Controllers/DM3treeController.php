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
       
        $shops = DM3tree::reversed()->get()->toTree();
        $chart = DM3tree::reversed()->get();
        
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
        return view('DM3.GoogleTree', compact('shops','jsondata','all','levels','chart'));
    }
    public function index()
    {
        
        $shops = DM3tree::reversed()->get()->toTree();

        $jsondata = json_encode($shops);

        

        $jsondata = trim($jsondata, '[]');
        $all = \App\Models\DM3tree::all()->count();
        $max = \App\Models\DM3tree::max('id');
         $levels = \App\Models\DM3tree::withDepth()->find($max);
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
    
         
    function DM3addSilently($namaDia,$ownerID)
    {
        //dd($namaDia,$ownerID);
        
        for ($xzz = 0; $xzz <= 0; $xzz++) {
            
            
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
        //dd($maxOnLevel);

        // Check and add child to tree
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
       //dd();
        $MemberBaru = ['name' => $namaDia,'user_id' => $ownerID,'balance' => 0,'logs' => '0'];
       //dd($lastChildBorned, "is even number ",($lastChildBorned%2 == 0));
        if($lastChildBorned%2 == 0){
            echo" <br><br><br>Its Even";
           
        //\App\Models\DM3tree::create($MemberBaru,$parent); 
        $New = \App\Models\DM3tree::create($MemberBaru);
        $parent->appendNode($New);
        //dd("EVEN NUMBER INSERTED");
        
        }
        else{
             echo" <br><br><br>Its Odd";
             
        $New = \App\Models\DM3tree::create($MemberBaru);
        $New->prependToNode($parent)->save(); 
        
        //dd("ODD NUMBER INSERTED");
         
            }}
       
        
        //return redirect('/DM3');
            
        
        
    }//return redirect('/DM3');
        
    
        }
}
