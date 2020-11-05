@extends('layouts.boot')

@section('content')


<style>
.loaderaa {
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9999;
	background: url(load.gif) center no-repeat #000000;
}
</style>

	<div id='loader' name='loader' class="loaderaa">0</div>

<script type="text/javascript">

  (function(){
    var myDiv = document.getElementById("loader"),

      show = function(){
        myDiv.style.display = "block";
        setTimeout(hide, 3000); // 5 seconds
        
      },

      hide = function(){
        myDiv.style.display = "none";
      };

    show();
  })();

</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Welcome to e-DM5 Blast') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in! Welcome') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
