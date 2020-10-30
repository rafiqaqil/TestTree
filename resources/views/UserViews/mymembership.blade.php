@extends('layouts.boot')

@section('content')
<div  align="right" class="container">
    <div class="row">
     
        <div class="col-12 pt-2" align="left">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">My Membership Plan
                         
                                     
                                        </h3></div>
                                    <div class="card-body pl-4 ">
         @if($user->profile->membership_paid == 0)
                        <br><br>
                                        @if(Session::has('message'))       <div class="alert alert-info">         {{Session::get('message')}}       </div>     @endif
                                        
                                        <br><h4>My Sponsor :   
                                            
                                            @if($user->profile->affiliate_sponsor == 'ADMIN_A')
                                            NO SPONSOR
                                            @elseif($user->profile->affiliate_sponsor == '0')
                                            NO SPONSOR
                                            
                                            @else
                                            {{$user->profile->affiliate_sponsor }}
                                            @endif

                                        
                                        </h4> 
                                        <small>Please confirm the sponsor code from your sponsor to avoid any problems</small>                                        <small>Please confirm the code from your sponsor to avoid any problems</small>

                                  
                                     
              
                <hr>
            @if($user->profile->membership_type == 0 )
            <h3>Welcome New user please sign up for a plan to experience the full extent of digital marketing</h3>
           
           <meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
* {
  box-sizing: border-box;
}

.columns {
  float: left;
  width: 50%;
  padding: 8px;
}

.price {
  list-style-type: none;
  border: 1px solid #eee;
  margin: 0;
  padding: 0;
  -webkit-transition: 0.3s;
  transition: 0.3s;
}

.price:hover {
  box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2)
}

.price .header {
  background-color: #111;
  color: white;
  font-size: 25px;
}

.price li {
  border-bottom: 1px solid #eee;
  padding: 20px;
  text-align: center;
}

.price .grey {
  background-color: #eee;
  font-size: 20px;
}

.button {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 10px 25px;
  text-align: center;
  text-decoration: none;
  font-size: 18px;
}

@media only screen and (max-width: 600px) {
  .columns {
    width: 100%;
  }
}
</style>


<h2 style="text-align:center">e-DM5 Plans</h2>
<p style="text-align:center">Reminder, this is a 1-Time purchase choose carefully</p>
<!--
<div class="columns">
  <ul class="price">
    <li class="header">Basic</li>
    <li class="grey">$ 10 / Lifetime</li>
    <li>Premium Access</li>
      <li>-</li>
    <li>-</li>
    <li>-</li>
  
    <li class="grey"><a href="{{env('absolute')}}/PurchaseMembership/X" class="button">Sign Up</a></li>
  </ul>
</div>
-->
<div class="columns">
  <ul class="price">
    <li class="header" style="background-color:#4CAF50">DM5-X1 Premium</li>
    <li class="grey">$ 200</li>
   <li>Premium Access</li>
      <li>1 x DM5</li>
    <li>-</li>
    <li>-</li>
    <li class="grey"><a href="{{env('absolute')}}/PurchaseMembership/X1" class="button">Sign Up</a></li>
  </ul>
</div>

<div class="columns">
  <ul class="price">
    <li class="header">DM5-X5 Premium</li>
    <li class="grey">$ 1200</li>
     <li>Premium Access</li>
    <li>1 + 5 x DM5</li>
    <li>1 x DM3 </li>
      <li>-</li>
  
    <li class="grey"><a href="{{env('absolute')}}/PurchaseMembership/X5" class="button">Sign Up</a></li>
  </ul>
</div>

            @elseif($user->profile->membership_type == 10 )
            <h3>Thank you for choosing the basic plan, please make payment of {{$user->profile->membership_type}} USD to our merchantrade account of USDT </h3>
            <a href="{{env('absolute')}}/PurchaseMembership/Clear" class="btn btn-danger">Cancel Order</a>    <div class="container-fluid">
                                        <img src="{{env('absolute')}}/paymentDetails.png" width="95%" >
                                        </div>
            
             @elseif($user->profile->membership_type == 1000 )
            <h3>Thank you for choosing a plan, please make payment of 1210 USD to our merchantrade account of USDT </h3>
             <a href="{{env('absolute')}}/PurchaseMembership/Clear" class="btn btn-danger">Cancel Order</a>
            <small>     <div class="container-fluid">
                                        <img src="{{env('absolute')}}/paymentDetails.png" width="95%" >
                                        </div>
              
             @else
            <h3>Thank you for choosing a plan, please make payment of {{$user->profile->membership_type}}+10 USD to our merchantrade account of USDT </h3>
             <a href="{{env('absolute')}}/PurchaseMembership/Clear" class="btn btn-danger">Cancel Order</a>
            <small> 
            Please include your contact information to avoid any problems
            
            </small>    <div class="container-fluid">
                                        <img src="{{env('absolute')}}/paymentDetails.png" width="95%" >
                                        </div>
            @endif
           
            
            @else
            @if($user->profile->affiliate_paid >= 1 )
             <h3>Your payment have been recieved & (DM5) has been credited to your account  </h3>
            @else
             <h3>Your payment have been recieved & approved please allow some time for our server to apply your placements.</h3>
             @endif
             <br> Details : <br>
             @if($user->profile->membership_type == 200 )
              <div class="btn btn-info">Plan : 200 USD </div>
              @elseif($user->profile->membership_type == 1000 )
             <div class="btn btn-info">Plan : 1200 USD </div>
             @endif
              <div class="btn btn-success">Payment Successful </div>
               <div class="btn btn-success"> Sponsor : {{ $user->profile->affiliate_sponsor }} </div>
             
           
             
           @endif
           
           <!--
                <div class=" font-weight-bold">affiliate_type: {{ $user->profile->affiliate_type }}</div> 
           <div class=" font-weight-bold"> affiliate_paid: {{ $user->profile->affiliate_paid }}</div> 
-->
                     
            <!DOCTYPE html>
<html>
<head>


  
       <!--     
            
                   
              
             Company -> profile -> description
                Current Position ->  profile -> location
                Name  ->  profile  -> title
                Email - > profile-> contacted

                @can('update', $user->profile)
                <a href="/p/create"><button class="btn btn-info">Add New Post</button></a> 
                @endcan
                
                @can('update', $user->profile)
               
               <a href="/profile/{{ $user->id }}/createMydata"> <button class="btn btn-info">Add MyData</button></a>
               <a href="/profile/{{ $user->id }}/ShowMyData"> <button class="btn btn-info">Show MyData</button></a>
               
                @endcan
-->
          


            
            
             </div> </div> </div>
       
           
            
        </div>
    </div>
   
     
</div>
@endsection
