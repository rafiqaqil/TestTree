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

        //dd( $jsondata);
        return view('TREE', compact('shops','jsondata'));
    }
    
    public function index2()
    {
          $shops =\App\Models\sponsor::get()->toTree();
        $jsondata = json_encode($shops);

        $jsondata = trim($jsondata, '[]');

        //dd( $jsondata);
        return view('TREE', compact('shops','jsondata'));
    }
    
    
      public function SiapaAtok(\App\Models\sponsor $aku)
    {
        //dd($aku);
        $result =     \App\Models\sponsor::ancestorsOf($aku);
         //dd($result->count());
         
         if($result->count() >= 4)
         {
         $atokYgPao = array_slice($result->pluck('id')->toArray(), -4);
         
         //dd($atokYgPao);

        $Bapak =  $atokYgPao[3];
        $Atok =  $atokYgPao[2];
        $Moyang =  $atokYgPao[1];
        $BapakMoyang =  $atokYgPao[0];
        
        $Bapak = \App\Models\sponsor::where('id',$Bapak)->get()->pluck('id')[0];
           $Atok = \App\Models\sponsor::where('id',$Atok)->get()->pluck('id')[0];
           $Moyang = \App\Models\sponsor::where('id',$Moyang)->get()->pluck('id')[0];
           $BapakMoyang = \App\Models\sponsor::where('id',$BapakMoyang)->get()->pluck('id')[0];
           
           
           dd("Bapak (10%) : ", $Bapak,
              "Atok (2%)  : ", $Atok,
               "Moyang (2%)  : ", $Moyang,
                   "Bapak Moyang (1%) : ", $BapakMoyang
);
         }
        
           
        
        
    }
      

    
     public function buatanak(\App\Models\sponsor $parent)
    {
         //dd($parent);
         
         $DataAnakBaru = [
          
                    'name' => 'Anak Baru',
                     'user_id' => $parent->user_id,
                     'balance' => 0,
                     'logs' => '0',
             //'parent_id' => $parent->id,    
        ];
         
     //dd($DataAnakBaru);
         
          $anakBaru = \App\Models\sponsor::create($DataAnakBaru,$parent);
          \App\Models\sponsor::fixTree();

          //dd($AnakBaru->parent_id);
         
     //BAYAR SPONSOR ANAK BARU
          
          
          
          
           $aku = $anakBaru;
          
                   //dd($aku);
        $result =     \App\Models\sponsor::ancestorsOf($aku);
         //dd($result->pluck('id')->toArray());
         
         $atokYgPao = array_slice($result->pluck('id')->toArray(), -4);
         //dd($atokYgPao);
         
        $Bapak =  $atokYgPao[3];
        $Atok =  $atokYgPao[2];
        $Moyang =  $atokYgPao[1];
        $BapakMoyang =  $atokYgPao[0];
        
        $Bapak = \App\Models\sponsor::where('id',$Bapak)->get()->pluck('id')[0];
         
         
           $Atok = \App\Models\sponsor::where('id',$Atok)->get()->pluck('id')[0];
         
           $Moyang = \App\Models\sponsor::where('id',$Moyang)->get()->pluck('id')[0];
         
         
           $BapakMoyang = \App\Models\sponsor::where('id',$BapakMoyang)->get()->pluck('id')[0];
           
           
           
             $bayar = [
                 'nama_anak_baru' => $aku->id,
                     'nama_sponsor' => $Bapak,
                     'sponsor_id' => $Bapak,
                     'amount' => 10,
                 'desc' => 'BONUS ANAK BARU 10%',    
             ];
             \App\Models\transaction_sponsor::create($bayar);
             
             $bayar = [
                 'nama_anak_baru' => $aku->id,
                     'nama_sponsor' => $Atok,
                     'sponsor_id' => $Atok,
                     'amount' => 2,
                 'desc' => 'BONUS ANAK BARU 2%',    
             ];
             \App\Models\transaction_sponsor::create($bayar);
             
             
             $bayar = [
                 'nama_anak_baru' => $aku->id,
                     'nama_sponsor' => $Moyang,
                     'sponsor_id' =>$Moyang,
                     'amount' => 2,
                 'desc' => 'BONUS ANAK BARU 2%',    
             ];
             \App\Models\transaction_sponsor::create($bayar);
             
             
             //bayar BAPAK MOTANG
             
             $bayar = [
                 'nama_anak_baru' => $aku->id,
                     'nama_sponsor' => $BapakMoyang,
                     'sponsor_id' => $BapakMoyang,
                     'amount' => 1,
                 'desc' => 'BONUS ANAK BARU 1%',    
             ];
             \App\Models\transaction_sponsor::create($bayar);

          
          
     
          
          
          
            $shops =\App\Models\sponsor::get()->toTree();
          
        $jsondata = json_encode($shops);

        $jsondata = trim($jsondata, '[]');

        //dd( $jsondata);
        return view('TREE', compact('shops','jsondata'));
    }
    
    

}
