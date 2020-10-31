@extends('layouts.boot')

@section('content')
<div  align="right" class="container">
    <div class="row">
     
        <div class="col-12 pt-2" align="left">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Activate Account
                         
                                     
                                        </h3></div>
                                    <div class="card-body pl-4 ">
                                        Please make payment of 10 USD to e-DM5 Blast Merchantrade Account to enjoy our services.
                                        <div class="container-fluid">
                                        <img src="{{env('absolute')}}/paymentDetails.png" width="95%" >
                                        </div>
                                       
                                        
                                        
                                        
                                        
                     <form action="{{env('absolute')}}/ActivateAccount/ConfirmPayment" enctype="multipart/form-data" method="post">
        @csrf                   
               <div class="form-group row">
                    <label for="payment_type" class="col-md-4 col-form-label">Select Preferred Payment Method</label>

                    <select id="payment_type"
                           type="text"
                           class="form-control{{ $errors->has('Type') ? ' is-invalid' : '' }}"
                           name="payment_type"
                           value="{{ old('payment_type') }}"
                           autocomplete="title" autofocus>
                          <option value="{{$profile->payment_type}}">
                               @if($profile->payment_type !='0')
                              {{$profile->payment_type}}
                              @else
                              NOT PAID
                              @endif
                          </option>
                         <option value="0">NOT PAID</option>
                       <option value="USDT">USDT</option>
                    <option value="MERCHANTRADE">MERCHANTRADE</option>
                        </select>

                    @if ($errors->has('payment_type'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('payment_type') }}</strong>
                        </span>
                    @endif
                </div>
        
                <div class="row pt-4">
                    <button class="btn btn-primary">Confirm Payment Method Done</button>
                </div>
                     </form>
                                        <br>
                                        
                                        @if($profile->payment_type !='0')
                                        <h3>Please wait until until we confirm your payment, any inquiries can be made through email or calls wit hour administrators</h3>
                                        @endif
        
             </div> </div> </div>
       
           
        </div>

    
    </div>

   
     
</div>
@endsection
