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
         
                @else
                
            <h5>Thank you for choosing a plan, please make payment of {{$user->profile->membership_type}}$ to our account and confirm payment method  </h5>
            
            
                @if($FinalBalance >= 0 && $profile->placement_payment_type =='0' )
                <hr>
                You have available ballance in your wallet.
                <br>Wallet Balance Available : {{$FinalBalance}}<br>

                                        @if($FinalBalance  >= $user->profile->membership_type)
                                        

                                          <form action="{{env('absolute')}}/Placement/ConfirmPayment" enctype="multipart/form-data" method="post">
                                                    @csrf                   
                                                           <div class="form-group row">
                                                                <label for="placement_payment_type" class="col-md-4 col-form-label"></label>

                                                                <select hidden id="placement_payment_type"
                                                                       type="text"
                                                                       class="form-control{{ $errors->has('Type') ? ' is-invalid' : '' }}"
                                                                       name="placement_payment_type"
                                                                       autocomplete="title" autofocus>
                                                                   <option value="WALLET">WALLET</option>
                                                                    </select>
                                                                    </div>
                                                           <center>
                                                                <button class="btn btn-primary ">Confirm Wallet Payment </button> </center>
                                         </form>
                                        @endif
               
                @endif
                       <br>  <hr>
                                            <br>
               
                
                <br>
                @if($profile->placement_payment_type =='0')
                If you wish to choose another plan please press cancel and you will be able to select another plan.    <br>
            <a href="{{env('absolute')}}/PurchaseMembership/Clear" class="btn btn-danger">Cancel Order</a>
            <small> 
           
            </small>    
            @endif
 
          @if($profile->placement_payment_type =='0')
            <hr>
           Please select the payment method you wish to complete the transaction.
            
            
            <hr>
            <div class='row'>

            
              <div class="col-lg-6 pt-2" align="center">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Pay Using MERCHANTRADE
                         
                                     
                                        </h3></div>
                                    <div class="card-body pl-4 ">
                                      
                                        <br>
                                        <h5>MERCHANTRADE ACCOUNT : <br>4080020107474101</h5>
                                        <br>
                                         
                                        ${{$user->profile->membership_type}}
                      
                                        <div class="container-fluid">
                                        <img class='img-fluid' src="{{env('absolute')}}/mrpay.png" width="95%" >
                                        </div>
                                       
                                        
                                        
                                        
                                        
                     <form action="{{env('absolute')}}/Placement/ConfirmPayment" enctype="multipart/form-data" method="post">
        @csrf                   
               <div class="form-group row">
                    <label for="placement_payment_type" class="col-md-12 col-form-label"></label>

                    <select hidden id="placement_payment_type"
                           type="text"
                           class="form-control{{ $errors->has('Type') ? ' is-invalid' : '' }}"
                           name="placement_payment_type"
                         
                           autocomplete="title" autofocus>
                  
                    <option value="MERCHANTRADE">MERCHANTRADE</option>
                     @if($FinalBalance >= 10 )
                     <!--
                    <option value="WALLET">WALLET</option>
                    -->@endif
                    
                    
                        </select>

                    @if ($errors->has('placement_payment_type'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('placement_payment_type') }}</strong>
                        </span>
                    @endif
                </div>
        
        
                    <center>
                    <button class="btn btn-primary ">Confirm Payment Done</button> </center>
           
                     </form>
                                        <br>
                                        
        </div></div></div>


        
        <div class="col-lg-6 pt-2" align="center">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Pay Using USDT
                         
                                     
                                        </h3></div>
                                    <div class="card-body ">
                                         <br>
                                        <h5>USDT ACCOUNT : <br>0x8b472d40b9be8fF8d502Fbe6891690435F1680D0</h5>
                                        <br>
                                        {{$user->profile->membership_type*1.1}} USDT
                      
                                        <div class="container-fluid">
                                        <img class='img-fluid' src="{{env('absolute')}}/uspay.png" width="95%" >
                                        </div>
                                       
                                        
                                        
                                        
                                        
                     <form action="{{env('absolute')}}/Placement/ConfirmPayment" enctype="multipart/form-data" method="post">
        @csrf                   
               <div class="form-group row">
                    <label for="placement_payment_type" class="col-md-4 col-form-label"></label>

                    <select hidden id="placement_payment_type"
                           type="text"
                           class="form-control{{ $errors->has('Type') ? ' is-invalid' : '' }}"
                           name="placement_payment_type"
                           autocomplete="title" autofocus>
                       <option value="USDT">USDT</option>
                        </select>

               
               <center>
                    <button class="btn btn-primary ">Confirm Payment Done</button> </center>
           
                     </form>
                                        <br>
                   </div>                   
        
          
            
            </div>
            
             </div>
            
             </div>
             </div>
            
             @endif
            

            
            <div class='row'>
           
                  @if($profile->placement_payment_type !='0')
                  <h5>
                                            We have notified our  Accounts Payable Manager of your payment.
                                        <br><br>Please wait until until we confirm your payment, any inquiries can be made through email or calls with our administrators
                                        <br>
                                        <center>
                                            <br>
                                      Payment Option Chosen :{{$profile->placement_payment_type}}
                                        
                                            <br>
                                         @if($profile->placement_payment_type =='MERCHANTRADE')
                                         
                                         <h5>MERCHANTRADE ACCOUNT <br>4080020107474101</h5>
                                         <br>
                                           ${{$user->profile->membership_type}}<br>
                                           <div class="container-fluid">
                                              <br>
                                         <img class='img-fluid' src="{{env('absolute')}}/MRpay.png" width="50%">
                                                 
                                         </div>
                                      
                                         @endif
                                         
                                         @if($profile->placement_payment_type =='USDT')
                                         
                                          <h5>USDT ACCOUNT <br>0x8b472d40b9be8fF8d502Fbe6891690435F1680D0</h5>
                                               <br> <br>
                                        
                                        {{$user->profile->membership_type*1.1}} USDT
                                        <br>  <div class="container-fluid">
                      
                                       
                                        <img class='img-fluid' src="{{env('absolute')}}/uspay.png" width="50%"  >
                                        </div>
                                         @endif
                                        
                                        <br>
                                        
                                        <h5>If you did not make any payment or wish select a new payment method please press the cancel button below</h5>
                                                                        <form action="{{env('absolute')}}/Placement/ConfirmPayment" enctype="multipart/form-data" method="post">
                                                                                  @csrf                   
                                                                                         <div class="form-group row">
                                                                                              <label for="placement_payment_type" class="col-md-4 col-form-label"></label>

                                                                                              <select hidden id="payment_type"
                                                                                                     type="text"
                                                                                                     class="form-control{{ $errors->has('Type') ? ' is-invalid' : '' }}"
                                                                                                     name="placement_payment_type"
                                                                                                     value="{{ old('payment_type') }}"
                                                                                                     autocomplete="title" autofocus>
                                                                                                  
                                                                                                   <option value="0">NOT PAID</option>
                                                                                             
                                                                                             

                                                                                                  </select>

                                                                                           
                                                                                          </div>
                                                                                  
                                                                               
                    <button class="btn btn-danger">Cancel<br>Payment</button></center>
          
                     </form>
                                        
                                        
                                        
                                    </div></div></div>
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                                        @endif
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
