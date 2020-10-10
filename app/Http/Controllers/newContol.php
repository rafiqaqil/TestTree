<?php

namespace App\Http\Controllers;
use App\Models\Shop;
use Illuminate\Http\Request;

class newContol extends Controller
{
    public function index()
    {
        
       

        $shops = Shop::get()->toTree();

        $jsondata = json_encode($shops);

        

        $jsondata = trim($jsondata, '[]');

        dd( $jsondata);
        return view('TREE', compact('shops','jsondata'));
    }
    
    

}
