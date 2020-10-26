@extends('layouts.boot')

@section('content')
<div class="container">
    <form action="{{env('absolute')}}/Store/Widthdraw" enctype="multipart/form-data" method="post">
        @csrf
 
        <div class="row">
            <div class="col-lg-12">

                <div class="row">
                    <h1>Create Withdrawal request</h1>
                </div>
                
                         
                
                    <div class="form-group row">
                    <label for="Type" class="col-md-4 col-form-label">Select Preferred Account</label>

                    <select id="Type"
                           type="text"
                           class="form-control{{ $errors->has('Type') ? ' is-invalid' : '' }}"
                           name="Type"
                           value="{{ old('Type') }}"
                           autocomplete="title" autofocus>
                        <option value="USDT">USDT</option>
                         <option value="MERCHANTRADE">MERCHANTRADE</option>
                         
                        </select>

                    @if ($errors->has('Type'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('Type') }}</strong>
                        </span>
                    @endif
                </div>
              <div class="form-group row">
                    <label for="AMOUNT" class="col-md-4 col-form-label">AMOUNT</label>

                    <input id="phone"
                           type="text"
                           class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                           name="AMOUNT"
                           value="{{ old('AMOUNT') }}"
                           autocomplete="title" autofocus>

                    @if ($errors->has('phone'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('AMOUNT') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="row pt-4">
                    <button class="btn btn-primary">Continue</button>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection
