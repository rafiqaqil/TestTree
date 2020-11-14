@extends('layouts.boot')

@section('content')

<div  align="center" class="container">

<div class="row">
        <div class="col-lg-12 pb-12">
        <div class="card mb-4">
          <div class="card-header">
             <h3>Manage New User Account Activation 10$</h3>
             <small>
                 
                 Sini kita boleh handle bayaran yang sudah dibayar oleh customer,  jika tiada bayaran dibuat oleh customer kitqa boleh cancel dan beritahu customer bayaran tidak dapat dibuktikan.
                 <br>
                 Bayaran dibahgikan kepada tiga jenis USDT, Merchantrade, Wallet. 
                 <br>
             </small>
            </div>
            
            </div>
            
            </div>
        </div>
        <!-- DataTables Example -->
           <div class="row">
        <div class="col-lg-12 ">
        <div class="card mb-12">
          <div class="card-header" align="center">
            <i class="fas fa-table"></i>
            USDT Pending Approval</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable"  cellspacing="0">
                    <thead>
                  <tr>
                      <th>Name</th>
                      
                
                    <th>Phone</th>
      
                    <th>Email</th>
                    
                     
  
                    <th>national_id</th>
                      <th>Country</th>
                      <th>Plan / Approve</th>
                     
                  </tr>
                </thead>
             
                <tbody>
             
        @foreach($alldata as $d)      
                   
         <tr>
            <td>{{$d->name}}</td>
                      
                
                    <td>{{$d->phone}}</td>
      
                    <td>{{$d->email}}</td>
                    
                     
  
                    <td>{{$d->national_id}}</td>
                      <td>{{$d->country}}</td>
                      
                       <td>
                 
                         <a href="{{env('absolute')}}/adminAction/{{$d->id}}/ActivateAccount"><button class="btn btn-info">Approve Payment</button></a> 
                         <a href="{{env('absolute')}}/adminAction/{{$d->id}}/CancelActivateAccount"><button class="btn btn-warning">Cancel</button></a> 
                        
                     </td>
                    </tr>

        @endforeach
        
        
        
                </tbody>
              </table>
            </div>
          </div></div>
            </div>  </div>

  <div class="row">
        <div class="col-lg-12 ">
        <div class="card mb-12">
          <div class="card-header" align="center">
            <i class="fas fa-table"></i>
            MERCHANTRADE Pending Approval</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable"  cellspacing="0">
                    <thead>
                  <tr>
                      <th>Name</th>
                      
                
                    <th>Phone</th>
      
                    <th>Email</th>
                    
                     
  
                    <th>national_id</th>
                      <th>Country</th>
                      <th>Plan / Approve</th>
                     
                  </tr>
                </thead>
             
                <tbody>
             
        @foreach($alldataMERCH as $d)      
                   
         <tr>
            <td>{{$d->name}}</td>
                      
                
                    <td>{{$d->phone}}</td>
      
                    <td>{{$d->email}}</td>
                    
                     
  
                    <td>{{$d->national_id}}</td>
                      <td>{{$d->country}}</td>
                      
                       <td>
                 
                         <a href="{{env('absolute')}}/adminAction/{{$d->id}}/ActivateAccount"><button class="btn btn-info">Approve Payment</button></a> 
                         <a href="{{env('absolute')}}/adminAction/{{$d->id}}/CancelActivateAccount"><button class="btn btn-warning">Cancel</button></a> 
                        
                
                     </td>
                    </tr>

        @endforeach
        
        
        
                </tbody>
              </table>
            </div>
          </div></div>
            </div>  </div>
        
        
 <!-- DataTables Example -->
           <div class="row">
        <div class="col-lg-12 ">
        <div class="card mb-12">
          <div class="card-header" align="center">
            <i class="fas fa-table"></i>
            WALLET Pending Approval</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable"  cellspacing="0">
                    <thead>
                  <tr>
                      <th>Name</th>
                      
                
                    <th>Phone</th>
      
                    <th>Email</th>
                    
                     
  
                    <th>national_id</th>
                      <th>Country</th>
                      <th>Plan / Approve</th>
                     
                  </tr>
                </thead>
             
                <tbody>
             
        @foreach($alldataWALLET as $d)      
                   
         <tr>
            <td>{{$d->name}}</td>
                      
                
                    <td>{{$d->phone}}</td>
      
                    <td>{{$d->email}}</td>
                    
                     
  
                    <td>{{$d->national_id}}</td>
                      <td>{{$d->country}}</td>
                      
                       <td>
   
                        
                              <a href="{{env('absolute')}}/adminAction/{{$d->id}}/ActivateAccount"><button class="btn btn-info">Approve Payment</button></a> 
                         <a href="{{env('absolute')}}/adminAction/{{$d->id}}/CancelActivateAccount"><button class="btn btn-warning">Cancel</button></a> 
                        
                        
                        
                      
                     </td>
                    </tr>

        @endforeach
        
        
        
                </tbody>
              </table>
            </div>
          </div></div>
            </div>  </div>

@endsection
