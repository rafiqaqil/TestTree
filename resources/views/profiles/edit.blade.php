@extends('layouts.boot')

@section('content')
<div class="container">
    <form action="/UpdateProfile/{{ $user->id }}" enctype="multipart/form-data" method="post">
        @csrf
        @method('PATCH')
        <input name="url"  id="url"  hidden=true value="Not Required" > 
        <input name="SSM" id="SSM" hidden=true value="Not Required" > 
        <input name="Adress" id="Adress" hidden=true value="Not Required" > 

        <div class="row">
            <div class="col-8 offset-2">

                <div class="row">
                    <h1>Edit My Profile</h1>
                </div>
                <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label">Name</label>

                    <input id="title"
                           type="text"
                           class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                           name="title"
                           value="{{ old('title') ?? $user->profile->title }}"
                           autocomplete="title" autofocus>

                    @if ($errors->has('title'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label">Current Position</label>

                    <input id="description"
                           type="text"
                           class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                           name="description"
                           value="{{ old('description') ?? $user->profile->description }}"
                           autocomplete="description" autofocus>

                    @if ($errors->has('description'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
                
                   <div class="form-group row">
                    <label for="contact" class="col-md-4 col-form-label">Email</label>

                    <input id="contact"
                           type="text"
                           class="form-control{{ $errors->has('contact') ? ' is-invalid' : '' }}"
                           name="contact"
                           value="{{ old('contact') ?? $user->profile->contact }}"
                           autocomplete="contact" autofocus>

                    @if ($errors->has('contact'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('contact') }}</strong>
                        </span>
                    @endif
                </div>
                
                   <div class="form-group row">
                    <label for="location" class="col-md-4 col-form-label">Company</label>

                    <input id="location"
                           type="text"
                           class="form-control{{ $errors->has('location') ? ' is-invalid' : '' }}"
                           name="location"
                           value="{{ old('location') ?? $user->profile->location }}"
                           autocomplete="location" autofocus>

                    @if ($errors->has('location'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('location') }}</strong>
                        </span>
                    @endif
                </div>
                
                    <!--
                <div class="form-group row">
                    <label for="url" class="col-md-4 col-form-label">URL</label>

                    <input id="url"
                           type="text"
                           class="form-control{{ $errors->has('url') ? ' is-invalid' : '' }}"
                           name="url"
                           value="{{ old('url') ?? $user->profile->url }}"
                           autocomplete="url" autofocus>

                    @if ($errors->has('url'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('url') }}</strong>
                        </span>
                    @endif
                </div>

                
                       <div class="form-group row">
                    <label for="SSM" class="col-md-4 col-form-label">SSM</label>

                    <input id="SSM"
                           type="text"
                           class="form-control{{ $errors->has('SSM') ? ' is-invalid' : '' }}"
                           name="SSM"
                           value="{{ old('SSM') ?? $user->profile->SSM }}"
                           autocomplete="SSM" autofocus>

                    @if ($errors->has('SSM'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('SSM') }}</strong>
                        </span>
                    @endif
                </div>
                  <div class="form-group row">
                    <label for="Adress" class="col-md-4 col-form-label">Adress</label>

                    <input id="Adress"
                           type="text"
                           class="form-control{{ $errors->has('Adress') ? ' is-invalid' : '' }}"
                           name="Adress"
                           value="{{ old('Adress') ?? $user->profile->Adress }}"
                           autocomplete="Adress" autofocus>

                    @if ($errors->has('Adress'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('Adress') }}</strong>
                        </span>
                    @endif
                </div>
                   
                <div class="row">
                    <label for="image" class="col-md-4 col-form-label">Profile Image</label>

                    <input type="file" class="form-control-file" id="image" name="image">

                    @if ($errors->has('image'))
                        <strong>{{ $errors->first('image') }}</strong>
                    @endif
                </div>
 -->
                <div class="row pt-4">
                    <button class="btn btn-primary">Save Profile</button>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection
