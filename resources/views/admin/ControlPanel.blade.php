@extends('layouts.boot')

@section('content')
<div  align="right" class="container">
    <div class="row">
     
        <div class="col-lg-12 pt-2" align="left">
                                <div class="card shadow-lg border-0 rounded-lg mt-5 ">
                                    <div class="card-header bg-warning"><h3 class="text-center font-weight-light my-4">Admin Control Panel</h3></div>
                                    <div class="card-body">
                                        <h4>Midnight Updates (Force Action)</h4>
                                        <p>DM5 Will automatically input new reentry nodes and DM3 if full with 5 Descendants</p>
                                        
                                        
            <hr>
             <p> Apabila ditekan balance akan update untuk dan reentry pun akan masuk jika balance reentry cukup , akan datang button ini akn auto run malam2 jam 12 bila market tutup for maintenance </p>
            <a href="{{env('absolute')}}/MDC/Update/DM3"><button class="btn btn-warning"> DM3 </button></a>
            <a href="{{env('absolute')}}/MDC/Update/DM5"><button class="btn btn-warning"> DM5 </button></a>
              <a href="{{env('absolute')}}/MDC/Update/Sponsor"><button class="btn btn-warning"> Sponsor </button></a>
              
              <hr>
                          <p> <i class="fa fa-arrow-circle-down" style="font-size:36px"></i>Bila tekan button Kuning (MIDNIGHT DM5) Semua yang dalam ppol akan masuk dan dapat lagi 4 DM5 dan 1  DM3</p>
               <button  onclick="ConfirmMe()" class="btn btn-warning"> MIDNIGHT DM5 Pool - Credit lagi 5 Kepada Package 1200 </button>
              
                                <script>function ConfirmMe() {
                                   if (confirm('Warning! Action is not reversable! Do wish to continue?')) {
                                                window.location.replace("{{env('absolute')}}/MDC/Credit4More");
                                            }else {return false;}
                               }</script>
              <br> <br>
              <p> <i class="fa fa-arrow-circle-down" style="font-size:36px"></i> Button Biru untuk view pool yang akan dimasukan kedalam DM5 & DM3 MALAM INI</p>
              
                <a href="{{env('absolute')}}/MDC/SHOW/Credit4More"><button class="btn btn-info">View Incoming MIDNIGHT DM5 Pool - Tengok pool untuk malam ni </button></a>
              
                
              <br>
                      
            <hr>  <h4>Master Tree Views</h4>
            <p> Boleh tengok perubahan pokok DM5 / DM3 DAN SPONSOR </p>
            <a class="nav-link" href="{{env('absolute')}}/DM5-G">
              <i class="fas fa-fw fa-table"></i>
              <span>DM-5 Master Tree</span></a>
               <a href="{{env('absolute')}}/DM5"><button class="btn btn-warning"> Mini View </button></a>
        
            <a class="nav-link" href="{{env('absolute')}}/DM3-G">
              <i class="fas fa-fw fa-table"></i>
              <span>DM-3 Master Tree</span></a>
              <a href="{{env('absolute')}}/DM3"><button class="btn btn-warning"> Mini View </button></a>
         
            <a class="nav-link" href="{{env('absolute')}}/sponsor-G">
              <i class="fas fa-fw fa-table"></i>
              <span>Sponsor Master Tree</span></a>
              <a href="{{env('absolute')}}/sponsor"><button class="btn btn-warning"> Mini View </button></a>
        
            <hr>
            
            <h4> Managerial Panels</h4>
                <hr>
                
                    <p>Activate New User</p>
            <a href='{{env('absolute')}}/ShowNewUsers'><div class='btn btn-info'>Activate New Users</div> </a> 
        <hr>
            <br>
           
             <p>Handle Pembayaran penguna baru untuk beli affiliate program approve payment</p>
            <a href='{{env('absolute')}}/manageNewPlans'><div class='btn btn-info'>Manage New Payments</div> </a>
            <hr>

             <p>Handle Pemberian DM5 & DM3 setelah penguna baru sudah membayar</p>
                              <a href='{{env('absolute')}}/ManagePlacements'><div class='btn btn-info'>Credit Placements</div> </a>    <hr>
             <p>Handle pengeluaran duit setelah penguna request untuk keluar duit</p>
            <a href='{{env('absolute')}}/ManageWithdrawal'><div class='btn btn-info'>Withdrawals</div> </a>    <hr>
            
            
               <p>Handle payment & pemberian DM5 Reentry kepada user </p>
            <a href='{{env('absolute')}}/reentryMGT'><div class='btn btn-info'>DM5 Reentry </div> </a>    <hr>

               <p>Redeem DM3</p>
            <a href='{{env('absolute')}}/redeemMGT'><div class='btn btn-info'>DM3 Redeem </div> </a>    <hr>

        </div>
    </div>
   
     
</div>
        </div>
    
@endsection
