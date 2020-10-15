<?php

namespace App\Http\Controllers;
use App\Models\Shop;
use Illuminate\Http\Request;

class newContol extends Controller
{
    
      public function __construct()
    {
        $this->middleware('auth');
    }
    
     public function keluargaku(\App\Models\sponsor $aku)
    {
        
       $shops = \App\Models\sponsor::descendantsAndSelf($aku->id)->toTree()->first();
        

        $jsondata = json_encode($shops);

        
        //dd( $root);
        $jsondata = trim($jsondata, '[]');

        //dd( $jsondata);
        return view('TREE', compact('shops','jsondata'));
    }

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
    
    
      public function punyaAtok(\App\Models\sponsor $aku)
    {
        //dd($aku);
        $result =     \App\Models\sponsor::ancestorsOf($aku);
         //dd($result->count());
         //
         if($result->count() >= 4)
         {
         $atokYgPao = array_slice($result->pluck('id')->toArray(), -4);
        $Bapak =  $atokYgPao[3];
        $Atok =  $atokYgPao[2];
        $Moyang =  $atokYgPao[1];
        $BapakMoyang =  $atokYgPao[0];
        dd("Bapak (10%) : ", $Bapak,"Atok (2%)  : ", $Atok,"Moyang (2%)  : ", $Moyang,"Bapak Moyang (1%) : ", $BapakMoyang);
         }
         else if($result->count() == 3)
         {
         $atokYgPao = array_slice($result->pluck('id')->toArray(), -3);
        $Bapak =  $atokYgPao[2];
        $Atok =  $atokYgPao[1];
        $Moyang =  $atokYgPao[0];
         dd("Bapak (10%) : ", $Bapak,"Atok (2%)  : ", $Atok,"Moyang (2%)  : ", $Moyang,"Bapak Moyang (1%) : Xde" );
         }
         else if($result->count() == 2)
         {
         $atokYgPao = array_slice($result->pluck('id')->toArray(), -2);
        $Bapak =  $atokYgPao[1];
        $Atok =  $atokYgPao[0];
        dd("Bapak (10%) : ", $Bapak,"Atok (2%)  : ", $Atok,"Moyang (2%)  : Xde","Bapak Moyang (1%) : Xde");
         }
              else if($result->count() == 1)
         {
         $atokYgPao = array_slice($result->pluck('id')->toArray(), -1);
         dd("Bapak (10%) : ", $atokYgPao,"Atok (2%)  :xde ", "Moyang (2%)  : Xde","Bapak Moyang (1%) : Xde" );
         }
    }
    
    
    
        public function UntungSponsor(\App\Models\sponsor $aku)
        {
            $untung = \App\Models\transaction_sponsor::where('sponsor_id',$aku->id)->get()->toArray();
            $Totaluntung = \App\Models\transaction_sponsor::where('sponsor_id',$aku->id)->sum('amount');
            dd($aku->id,"TOTAL RM ",$Totaluntung,"Untungku :", $untung);
  
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
         
     //BAYAR SPONSOR ANAK BARU ==========================FORMULA===============================>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> 
        $aku = $anakBaru;
        $result =     \App\Models\sponsor::ancestorsOf($aku);
        if($result->count() >= 4)
         {
         $atokYgPao = array_slice($result->pluck('id')->toArray(), -4);
        $Bapak =  $atokYgPao[3];
        $Atok =  $atokYgPao[2];
        $Moyang =  $atokYgPao[1];
        $BapakMoyang =  $atokYgPao[0];
        //dd("Bapak (10%) : ", $Bapak,"Atok (2%)  : ", $Atok,"Moyang (2%)  : ", $Moyang,"Bapak Moyang (1%) : ", $BapakMoyang);
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
         }
         else if($result->count() == 3)
         {
         $atokYgPao = array_slice($result->pluck('id')->toArray(), -3);
        $Bapak =  $atokYgPao[2];
        $Atok =  $atokYgPao[1];
        $Moyang =  $atokYgPao[0];
         //dd("Bapak (10%) : ", $Bapak,"Atok (2%)  : ", $Atok,"Moyang (2%)  : ", $Moyang,"Bapak Moyang (1%) : Xde" );
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
 
         }
         else if($result->count() == 2)
         {
         $atokYgPao = array_slice($result->pluck('id')->toArray(), -2);
        $Bapak =  $atokYgPao[1];
        $Atok =  $atokYgPao[0];
        //dd("Bapak (10%) : ", $Bapak,"Atok (2%)  : ", $Atok,"Moyang (2%)  : Xde","Bapak Moyang (1%) : Xde");
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
         }
         else if($result->count() == 1)
         {
         $atokYgPao = array_slice($result->pluck('id')->toArray(), -1);
         $Bapak = $atokYgPao[0];
         //dd("Bapak (10%) : ", $atokYgPao,"Atok (2%)  :xde ", "Moyang (2%)  : Xde","Bapak Moyang (1%) : Xde" );
              $bayar = [
                 'nama_anak_baru' => $aku->id,
                     'nama_sponsor' => $Bapak,
                     'sponsor_id' => $Bapak,
                     'amount' => 10,
                 'desc' => 'BONUS ANAK BARU 10%',    
             ];
             \App\Models\transaction_sponsor::create($bayar);
         }
        //BAYAR SPONSOR ANAK BARU ==========================FORMULA===============================>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  
          

          
             
             
             
             
             
             
             
             
             
             
             
             
             
             
             
          
     
          
          
          
            $shops =\App\Models\sponsor::get()->toTree();
          
        $jsondata = json_encode($shops);

        $jsondata = trim($jsondata, '[]');

        //dd( $jsondata);
        return view('TREE', compact('shops','jsondata'));
    }
    
    

}
