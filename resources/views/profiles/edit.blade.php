@extends('layouts.boot')

@section('content')
<div class="container">
    <form action="{{env('absolute')}}/UpdateProfile/{{ $user->profile->id }}" enctype="multipart/form-data" method="post">
        @csrf
        @method('PATCH')

        <div class="row">
            <div class="col-8 offset-2">

                <div class="row">
                    <h1>Edit My Profile</h1>
                </div>
                
                    <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label">name</label>

                    <input id="name"
                           type="text"
                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                           name="name"
                           value="{{ old('name') ?? $user->profile->name }}"
                           autocomplete="title" autofocus>

                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
              <div class="form-group row">
                    <label for="phone" class="col-md-4 col-form-label">phone</label>

                    <input id="phone"
                           type="text"
                           class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                           name="phone"
                           value="{{ old('phone') ?? $user->profile->phone }}"
                           autocomplete="title" autofocus>

                    @if ($errors->has('phone'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
                </div>
                
                
                        <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label">email</label>

                    <input id="email"
                           type="text"
                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           name="email"
                           value="{{ old('email') ?? $user->profile->email }}"
                           autocomplete="title" autofocus>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                
                
                    <div class="form-group row">
                    <label for="national_id" class="col-md-4 col-form-label">national_id</label>

                    <input id="national_id"
                           type="text"
                           class="form-control{{ $errors->has('national_id') ? ' is-invalid' : '' }}"
                           name="national_id"
                           value="{{ old('national_id') ?? $user->profile->national_id }}"
                           autocomplete="title" autofocus>

                    @if ($errors->has('national_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('national_id') }}</strong>
                        </span>
                    @endif
                </div>
                
                
                
                    <div class="form-group row">
                    <label for="country" class="col-md-4 col-form-label">country</label>

                    <input id="country"
                           type="text"
                           class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}"
                           name="country"
                           value="{{ old('country') ?? $user->profile->country }}"
                           autocomplete="title" autofocus>

                    @if ($errors->has('country'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('country') }}</strong>
                        </span>
                    @endif
                </div>
                
                    <div class="form-group row">
                    <label for="merchantrade_acc" class="col-md-4 col-form-label">merchantrade_acc</label>

                    <input id="merchantrade_acc"
                           type="text"
                           class="form-control{{ $errors->has('merchantrade_acc') ? ' is-invalid' : '' }}"
                           name="merchantrade_acc"
                           value="{{ old('merchantrade_acc') ?? $user->profile->merchantrade_acc }}"
                           autocomplete="title" autofocus>

                    @if ($errors->has('merchantrade_acc'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('merchantrade_acc') }}</strong>
                        </span>
                    @endif
                </div>
                
                    <div class="form-group row">
                    <label for="usdt_wallet" class="col-md-4 col-form-label">usdt_wallet</label>

                    <input id="usdt_wallet"
                           type="text"
                           class="form-control{{ $errors->has('usdt_wallet') ? ' is-invalid' : '' }}"
                           name="usdt_wallet"
                           value="{{ old('usdt_wallet') ?? $user->profile->usdt_wallet }}"
                           autocomplete="title" autofocus>

                    @if ($errors->has('usdt_wallet'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('usdt_wallet') }}</strong>
                        </span>
                    @endif
                </div>
                

                <div class="row pt-4">
                    <button class="btn btn-primary">Save Profile</button>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection
