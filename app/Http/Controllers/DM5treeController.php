<?php

namespace App\Http\Controllers;

use App\Models\DM5tree;
use Illuminate\Http\Request;
use Auth;
use App\User;

class DM5treeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function updateBalance()
    {
      $all = \App\Models\DM5tree::all();
      foreach($all as $d)
      {
          echo $d;
          $keluarga =  \App\Models\DM5tree::descendantsOf($d)->count();
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
    
    public function index()
    {
        $shops = DM5tree::reversed()->get()->toTree();
        $jsondata = json_encode($shops);
        $jsondata = trim($jsondata, '[]');
        $all = \App\Models\DM5tree::max('id');
        //dd( $jsondata);
         $levels = \App\Models\DM5tree::withDepth()->find($all);
       //dd($levels->depth);
        //dd( $jsondata);
        return view('DM5.TREE', compact('shops','jsondata','all','levels'));
    }
    
        
    public function index2()
    {
       
        $shops = DM5tree::reversed()->get()->toTree();
        $chart = DM5tree::reversed()->get();
        
        //dd($chart->id);
       // dd($chart->parent_id);
        //dd($chart);
        $jsondata = json_encode($shops);

        

        $jsondata = trim($jsondata, '[]');
        $all = \App\Models\DM5tree::max('id');
        //dd( $jsondata);
         $levels = \App\Models\DM5tree::withDepth()->find($all);
       //dd($levels->depth);
        //dd( $jsondata);
        return view('DM5.GoogleTree', compact('shops','jsondata','all','levels','chart'));
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
        
      
       
            //dd(\App\Models\DM5tree::max('id')) ;
            
            $all = \App\Models\DM5tree::max('id');
         $est = intval($all/5-1,0);
         echo "<br> All Nodes:".$all;
         echo "<br> Next Parent : ".$est;
        $parent = null;
        $x = $est;

        while($parent == null) {
            echo "<br>Checking".$x;
            $all = \App\Models\DM5tree::max('id');
            if($all <= 3906){
                $childs = \App\Models\DM5tree::descendantsOf($x)->count();
                echo "</br>parent:".$x." HAS CHILD : ".$childs ;

             if($childs < 5){
                 $parent = \App\Models\DM5tree::where('id',$x)->first();
                 echo "</br>------------------------------------------------------------------------------------------------------------------------------------------------------------"; 
                 //dd($parent);
             }
  
             }
             else{
                  $childs = \App\Models\DM5tree::descendantsOf($x)->count();
                echo "</br>MAX parent:".$x." HAS CHILD : ".$childs ;

             if($childs < 1){
                 $parent = \App\Models\DM5tree::where('id',$x)->first();
                 echo "</br>------------------------------------------------------------------------------------------------------------------------------------------------------------"; 
                 //dd($parent);
             }}     
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
    
    
    
    
    
    
    
    
       public function ArrangeTree()
       {
    //
    //$node->afterNode($neighbor)->save();
    //$node->beforeNode($neighbor)->save();
        $all = \App\Models\DM5tree::all();

        foreach($all as $n)
        {
            $SiblingCount = $n->getSiblings()->count();
            
            
            
            if($SiblingCount == 0)
            {
                echo $n->id." has No Siblings<br>";
                echo "<hr>";
            }
            else
            {
                echo $n->id." has Siblings".$SiblingCount."<br>";
                $minSiblings = $n->getSiblings()->min('id');
                echo "Youngest Sibling = ".$minSiblings."<br>";
                 
                if($n->id ==$minSiblings){
                echo "Is the Most Min ID <br> ";
                $n->up();
                dd($minSiblings,$minSiblings->min('id'));
                
                }
            }
            
          
        }
     
        
        
            
    
    
       }
    
    
    public function AddOneTest($namaDia)
    {
        
        echo "Creating New node: ".$namaDia;
        
        $TotalNodes = \App\Models\DM5tree::all()->count();
         echo "<br>Tree Stats<br>Total Nodes: ".$TotalNodes;
        
        $lastChildBorned = \App\Models\DM5tree::max('id');
        
        echo "<br>Last Child :".$lastChildBorned;
        $Deepest = \App\Models\DM5tree::withDepth()->find($lastChildBorned);
        
       
        echo " on Level ".$Deepest->depth . '<br>';
        $all = \App\Models\DM5tree::all();
        $parent = null;
        
        
      
       // Calculate all max child on depth 
        $maxOnLevel=[1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1];
        $minOnLevel = [110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,110,101,110,110,10,0,0,0,0,0,0,0,0,0];
        foreach (range(0, $Deepest->depth) as $i)  
                {
        
                 foreach($all as $d) {                    
                   $ThisGuysDepth = \App\Models\DM5tree::withDepth()->find($d->id);
                   $ThisGuysDescendants = \App\Models\DM5tree::descendantsOf($d->id)->count();
                   if($ThisGuysDepth->depth == $i){
                       
                       echo "<br>His Depth ".$ThisGuysDepth->depth;
                       echo "  His Children ".$ThisGuysDescendants;
                       if($maxOnLevel[$i] < $ThisGuysDescendants)
                        $maxOnLevel[$i] = $ThisGuysDescendants;
                       
                       if($minOnLevel[$i] > $ThisGuysDescendants)
                        $minOnLevel[$i] = $ThisGuysDescendants;
                   }
                 }
        }
        
        echo "<br>";
         foreach (range(0, $Deepest->depth) as $i){
         echo 'Level '.$i."MAX = ".$maxOnLevel[$i];
          echo 'Min = '.$minOnLevel[$i].'<br>';
         
         }
         
         echo '<br><hr><br>';
        //dd($maxOnLevel);

        // Check and add child to tree
        foreach($all as $d)
        {
            echo "<br>Checking Nodes: ".$d->id;
             
            $Zchildren = \App\Models\DM5tree::descendantsOf($d->id)->count();
            echo "This Node has Children:". $Zchildren;
            if($Zchildren >= 5){ echo "- FULL! ";}  
            else
            {         
                    $level = \App\Models\DM5tree::withDepth()->find($d->id)->depth;
                    echo "<br>Node is on Level : ".$level;
                    if($level == 0)$parent = $d;
                    
                    $Zchildren= 0;
                    $Zchildren = \App\Models\DM5tree::descendantsOf($d->id)->count();
                    
                    foreach (range(0, $Deepest->depth) as $ii)  
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
            {
        echo "Next Parent ",$parent->id;
       //dd();
        $MemberBaru = ['name' => $namaDia,'user_id' => auth()->user()->id,'balance' => 0,'logs' => '0'];
       //dd($lastChildBorned, "is even number ",($lastChildBorned%2 == 0));
        if($lastChildBorned%2 == 0){
            echo" <br><br><br>Its Even";
           
        //\App\Models\DM5tree::create($MemberBaru,$parent); 
        $New = \App\Models\DM5tree::create($MemberBaru);
        $parent->appendNode($New);
        //dd("EVEN NUMBER INSERTED");
        
        }
        else{
             echo" <br><br><br>Its Odd";
             
        $New = \App\Models\DM5tree::create($MemberBaru);
        $New->prependToNode($parent)->save(); 
        
        //dd("ODD NUMBER INSERTED");
         
        }
       
        
        return redirect('/DM5');
            }
         
    }
}
