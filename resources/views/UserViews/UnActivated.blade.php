@extends('layouts.boot')

@section('content')
<div  align="right" class="container">
    <div class="row">
     
        <div class="col-12 pt-2" align="left">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Activate Account
                         
                                     
                                        </h3></div>
                                    <div class="card-body pl-4 ">
                                            Please make payment of 10 USD to e-DM5 Blast Account to enjoy our services.
                                            <br>
                                            Choose the payment options below after you payment have been made to notify our Accounts Payable Manager to approve your payment and activate your account.
                                            <br>
                                            For any inquiry please contact our staff member for help.
                                            <br>
                                            edigitm5.1112020@gmail.com
                                            <br>
                                            
                                        @if($profile->payment_type !='0')
                                        <h5>
                                            We have notified our  Accounts Payable Manager of your payment.
                                        <br>Please wait until until we confirm your payment, any inquiries can be made through email or calls with our administrators</h5>
                                        <hr>
                                        <h5>Payment Option Chosen :{{$profile->payment_type}}</h5>
                                            <center>
                                         @if($profile->payment_type =='MERCHANTRADE')
                                         <h5>MERCHANTRADE ACCOUNT : <br>4080020107474101</h5>
                                         <br>
                                         $10
                                         <img src="{{env('absolute')}}/MRpay.png" width="50%" align='center' >
                                             </center>
                                         @endif
                                         
                                           @if($profile->payment_type =='USDT')
                                           <center>
                                          <h5>USDT ACCOUNT : <br>0x8b472d40b9be8fF8d502Fbe6891690435F1680D0</h5>
                                        <br>
                                        10 USDT
                      
                                        <div class="container-fluid">
                                        <img src="{{env('absolute')}}/uspay.png" width="50%" align='center' >
                                        </div>
                                           </center>
                                         @endif
                                        
                                        <br>
                                        
                                        <h5>If you did not make any payment or wish select a new payment method please press the cancel button below</h5>
                                                                        <form action="{{env('absolute')}}/ActivateAccount/ConfirmPayment" enctype="multipart/form-data" method="post">
                                                                                  @csrf                   
                                                                                         <div class="form-group row">
                                                                                              <label for="payment_type" class="col-md-4 col-form-label"></label>

                                                                                              <select hidden id="payment_type"
                                                                                                     type="text"
                                                                                                     class="form-control{{ $errors->has('Type') ? ' is-invalid' : '' }}"
                                                                                                     name="payment_type"
                                                                                                     value="{{ old('payment_type') }}"
                                                                                                     autocomplete="title" autofocus>
                                                                                                  
                                                                                                   <option value="0">NOT PAID</option>
                                                                                             
                                                                                             

                                                                                                  </select>

                                                                                           
                                                                                          </div>
                                                                                  
                                                                                  <center>
                    <button class="btn btn-danger">Cancel<br>Payment</button></center>
          
                     </form>
                                        
                                        
                                        
                                    </div></div></div>
                                         @else
                                            </div></div></div>
                                         
                                        
                                         <div class="col-6 pt-2" align="center">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Pay Using MERCHANTRADE
                         
                                     
                                        </h3></div>
                                    <div class="card-body pl-4 ">
                                      
                                        <br>
                                        <h3>MERCHANTRADE ACCOUNT : <br>4080020107474101</h3>
                                        <br>
                                        $10
                                  
                      
                                        <div class="container-fluid">
                                        <img src="{{env('absolute')}}/mrpay.png" width="95%" >
                                        </div>
                                       
                                        
                                        
                                        
                                        
                     <form action="{{env('absolute')}}/ActivateAccount/ConfirmPayment" enctype="multipart/form-data" method="post">
        @csrf                   
               <div class="form-group row">
                    <label for="payment_type" class="col-md-4 col-form-label"></label>

                    <select hidden id="payment_type"
                           type="text"
                           class="form-control{{ $errors->has('Type') ? ' is-invalid' : '' }}"
                           name="payment_type"
                         
                           autocomplete="title" autofocus>
                  
                    <option value="MERCHANTRADE">MERCHANTRADE</option>
                     @if($FinalBalance >= 10 )
                     <!--
                    <option value="WALLET">WALLET</option>
                    -->@endif
                    
                    
                        </select>

                    @if ($errors->has('payment_type'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('payment_type') }}</strong>
                        </span>
                    @endif
                </div>
        
        
                    <center>
                    <button class="btn btn-primary ">Confirm Payment Done</button> </center>
           
                     </form>
                                        <br>
                                        
                                        
             </div> </div> </div>
        
        
        <div class="col-6 pt-2" align="center">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Pay Using USDT
                         
                                     
                                        </h3></div>
                                    <div class="card-body pl-4 ">
                                         <br>
                                        <h3>USDT ACCOUNT : <br>0x8b472d40b9be8fF8d502Fbe6891690435F1680D0</h3>
                                        <br>10
                      
                                        <div class="container-fluid">
                                        <img src="{{env('absolute')}}/uspay.png" width="95%" >
                                        </div>
                                       
                                        
                                        
                                        
                                        
                     <form action="{{env('absolute')}}/ActivateAccount/ConfirmPayment" enctype="multipart/form-data" method="post">
        @csrf                   
               <div class="form-group row">
                    <label for="payment_type" class="col-md-4 col-form-label"></label>

                    <select hidden id="payment_type"
                           type="text"
                           class="form-control{{ $errors->has('Type') ? ' is-invalid' : '' }}"
                           name="payment_type"
                           autocomplete="title" autofocus>
                    
                       <option value="USDT">USDT</option>
            
                        </select>

                </div>
               <center>
                    <button class="btn btn-primary ">Confirm Payment Done</button> </center>
           
                     </form>
                                        <br>
                                     
        
             </div> </div> </div>
       
           @endif
        </div>

    
    </div>

   
     
</div>
@endsection
