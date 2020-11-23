@extends('layouts.boot')

@section('content')
<div class="container">
    <form action="{{env('absolute')}}/Store/reentryDM5/{{$DM5_ID}}" enctype="multipart/form-data" method="post">
        @csrf
 
        <div class="row">
            <div class="col-lg-12">

                <div class="row">
                    <h1>Create DM5 Reentry request
                    </h1>
                    <br>
                    
                    <small>
                        A fee of 10 USD is required to be paid for this process to complete.
                    </small>
                </div>
                
                         
                @if($errors->any())
                <div class="btn btn-danger">
                <h4>{{$errors->first()}}</h4>
                
                </div>
                @endif
                    <div class="form-group row">
                    <label for="Type" class="col-md-4 col-form-label">Select Preferred Payment Method</label>

                    <select id="TYPE"
                           type="text"
                           class="form-control{{ $errors->has('Type') ? ' is-invalid' : '' }}"
                           name="TYPE"
                           value="{{ old('TYPE') }}"
                           autocomplete="title" autofocus>
                        <option value="USDT">USDT</option>
                         <option value="MERCHANTRADE">MERCHANTRADE</option>
                        </select>
                </div>
                
                     <div class="form-group row">
                    <label for="Type" class="col-md-4 col-form-label"></label>

                    <input hidden id="AMOUNT"
                           type="text"
                           class="form-control{{ $errors->has('Type') ? ' is-invalid' : '' }}"
                           name="AMOUNT"
                           value="10"
                           autocomplete="title" autofocus>                
                </div>
                
                 

                <div class="row pt-4">
                    <button class="btn btn-primary">Continue</button>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection
