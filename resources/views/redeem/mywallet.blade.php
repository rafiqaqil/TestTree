@extends('layouts.boot')

@section('content')

<div  align="right" class="container">

        @if($errors->any())
        <div class="row" align='center'>
           <div class="col-lg-12 pt-2  ">
             <div class="card-body  bg-danger rounded-lg ">
            <p style="color:greenyellow;font-size:25px"><h4>Error : {{$errors->first()}}</h4></p>
          </div>  </div> </div>

@endif
    
    
         <div class="row" align='left'>
    
               <div class="col-lg-12  pt-2 ">
             <div class="card-body  bg-dark rounded-lg ">
            <p style="color:greenyellow;font-size:25px">Redeem DM3 Balance : {{$FinalBalance}}</p>
            
            <small style="color:white" >Note: Redeem Balance are from the DM3 (%) Bonus </small>
            @if($FinalBalance >= 0)
            <a href='{{env('absolute')}}/redeem/now'>
               <div class='btn btn-success'>Redeem Now</div> </a>
            @endif
          </div>  </div>
              </div> 

        <div class="row" align='left'>
    
               <div class="col-lg-12  pt-2 ">
             <div class="card-body  bg-dark rounded-lg ">
            <p style="color:yellow;font-size:20px">DM3 Redeem Withdrawn : {{$redeemed}}</p>
            
            <small style="color:white" >Note: This amount reflects to the amount you have redeemed in the past.</small>
          </div>  </div>
              </div> 


<br>

          
            






        
        
  
        
        
               <!-- DataTables Example -->
           <div class="row">
        <div class="col-lg-12 ">
        <div class="card mb-12">
          <div class="card-header" align="center">
            <i class="fas fa-table"></i>
            DM3 Redeem History </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered " id="dataTable"  cellspacing="0">
                    <thead>
                  <tr>
                 
                
                    <th>Amount</th>
      
                  
                      <th>Account</th>
                        <th>created_at</th>
                      
                      <th>Status</th>
                     
                  </tr>
                </thead>
             
                <tbody>
             
        @foreach($redeemlist as $d)      
                   
         <tr>
   
            <td>
                {{$d->AMOUNT}}
            </td>
             <td>
                  {{$d->TYPE}}
                  @if($d->TYPE == 'USDT')
                <br>{{$profile->usdt_wallet}}
                @else
                <br>{{$profile->merchantrade_acc}}
                @endif
            </td> 
            <td>
                {{$d->created_at}}
            </td>
                      
            
                       <td>
                 <!-- {{$d->STATUS}} -->
                 @if($d->STATUS == 'NEW')
                       <div class='btn btn-warning'> Pending</div>
                  @elseif($d->STATUS == 'COMPLETE')
                  
                  <div class='btn btn-success'> Complete</div>
                  @else
                  <div class='btn btn-danger'> Cancelled</div>
                  
                         @endif     
                     </td>
                    </tr>

        @endforeach
</div>

















              
              </div> 
@endsection
