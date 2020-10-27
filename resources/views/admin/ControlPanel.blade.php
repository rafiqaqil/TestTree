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
              <br><br>
               <a href="{{env('absolute')}}/MDC/Credit4More"><button class="btn btn-warning"> MIDNIGHT DM5 Pool - Credit lagi 4 Kepada Package 1200 </button></a>
              
              
              
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
            <br>
           
             <p>Handle Pembayaran penguna baru untuk beli affiliate program approve payment</p>
            <a href='{{env('absolute')}}/manageNewPlans'><div class='btn btn-info'>Manage New Payments</div> </a>
            <hr>

             <p>Handle Pemberian DM5 & DM3 setelah penguna baru sudah membayar</p>
                              <a href='{{env('absolute')}}/ManagePlacements'><div class='btn btn-info'>Credit Placements</div> </a>    <hr>
             <p>Handle pengeluaran duit setelah penguna request untuk keluar duit</p>
            <a href='{{env('absolute')}}/ManageWithdrawal'><div class='btn btn-info'>Withdrawals</div> </a>    <hr>

            
        </div>
    </div>
   
     
</div>
        </div>
    
@endsection
