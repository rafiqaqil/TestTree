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
          </div>  </div>
              </div> 

        <div class="row" align='left'>
    
               <div class="col-lg-12  pt-2 ">
             <div class="card-body  bg-dark rounded-lg ">
            <p style="color:yellow;font-size:20px">DM3 Redeem Withdrawn : {{$redeemed}}</p>
            
            <small style="color:white" >Note: This amount reflects to the amount you have redeemed in the past.</small>
          </div>  </div>
              </div> 

          
            


</div>
@endsection
