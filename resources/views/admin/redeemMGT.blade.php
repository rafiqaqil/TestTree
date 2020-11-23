@extends('layouts.boot')

@section('content')

<div  align="center" class="container">

<div class="row">
        <div class="col-lg-12 pb-12">
        <div class="card mb-4">
          <div class="card-header">
             <h3>Manage Redeem DM3 </h3>
             <small>
                 
                 Sini kita boleh handle REDEEM DM3 yang dibuat oleh penguna yang ada balance DM3 .
            
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
                      
                
                    <th>Amount</th>
      
                  
                      <th>Account</th>
                      <th>Plan / Approve</th>
                     
                  </tr>
                </thead>
             
                <tbody>
             
        @foreach($alldata as $d)      
                   
         <tr>
             <td>Username : {{$d->username}}
             <br>Name: {{$d->name}}
             <br>Phone: {{$d->phone}}
             <br>Email :    {{$d->email}}
            
            
            <!--
            <br>IC:     {{$d->national_id}}
            <br>Country:  {{$d->country}}</td>
            
            -->
            <td>
                {{$d->AMOUNT}}
            </td>
             <td>
                {{$d->TYPE}}
            </td>
                      
            
                       <td>
                 {{$d->STATUS}}
                         <a href="{{env('absolute')}}/redeemMGT/{{$d->id}}/COMPLETE_PAY"><button class="btn btn-info">Approve Payment</button></a> 
                         <a href="{{env('absolute')}}/redeemMGT/{{$d->id}}/CANCEL_PAY"><button class="btn btn-warning">Cancel</button></a> 
                        
                     </td>
                    </tr>

        @endforeach
        
        
        
                </tbody>
              </table>
            </div>
          </div></div>
            </div>  </div>

@endsection
