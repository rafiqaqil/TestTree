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
            <p style="color:greenyellow;font-size:25px">Available Balance : ${{$FinalBalance}}</p>
            
            <small style="color:white" >Note: You can get wallet credits from other users via transfers</small>
          </div>  </div>
              </div> 

            @if($FinalBalance >= 10 && $profile->membership_type == -1 )
            <div class="row" align='left'>
                <div class="col-lg-12  pt-2 ">
             <div class="card-body bg-white rounded-lg ">
            <p style="color:black;font-size:25px">Pay for Activation: ${{$FinalBalance}}</p>
          </div>  </div>
              </div> 
            @endif
            
                @if($FinalBalance >= 200 && $profile->membership_type == 200 && $profile->membership_paid ==0)
            <div class="row" align='left'>
                <div class="col-lg-12  pt-2 ">
             <div class="card-body bg-white rounded-lg ">
            <p style="color:black;font-size:25px">Purchase DM5 $200 PACKAGE: ${{$FinalBalance}}</p>
          </div>  </div>
              </div> 
            @endif
            
                  @if($FinalBalance >= 1200 && $profile->membership_type == 1200 && $profile->membership_paid ==0 )
            <div class="row" align='left'>
                <div class="col-lg-12  pt-2 ">
             <div class="card-body bg-white rounded-lg ">
            <p style="color:black;font-size:25px">Purchase DM5 $1200 PACKAGE: ${{$FinalBalance}}</p>
          </div>  </div>
                
              </div> 
            @endif
            


</div>
@endsection
