@extends('layouts.boot')

@section('content')
<div class="container">
    <form action="{{env('absolute')}}/StoreRequestDM5RE" enctype="multipart/form-data" method="post">
        @csrf
 
        <div class="row">
            <div class="col-lg-12">

                <div class="row">
                    <h1>Create DM5 Reentry request</h1>
                </div>
                
                         
                
                    <div class="form-group row">
                    <label for="Type" class="col-md-4 col-form-label">Select Preferred Payment Method <br>(Reentry Fee - 10$)</label>

                    <select id="Type"
                           type="text"
                           class="form-control{{ $errors->has('Type') ? ' is-invalid' : '' }}"
                           name="Type"
                           value="{{ old('Type') }}"
                           autocomplete="title" autofocus>
                        <option value="USDT">USDT</option>
                         <option value="MERCHANTRADE">MERCHANTRADE</option>
                        </select>

                </div>
           

                <div class="row pt-4">
                    <button class="btn btn-primary">Continue</button>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection
