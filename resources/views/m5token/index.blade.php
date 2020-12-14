@extends('layouts.boot')

@section('content')

<div  align="right" class="container">

        @if($errors->any())
        <div class="row" align='center'>
           <div class="col-lg-12 pt-2  ">
             <div class="card-body  bg-danger rounded-lg ">
            <p style="color:greenyellow;font-size:25px"><h4>Error : {{$errors->first()}}</h4></p>
          </div>  </div> </div>

@endif
    
    
         <div class="row" align='left'>
    
               <div class="col-lg-12  pt-2 ">
             <div class="card-body  bg-dark rounded-lg ">
            <p style="color:aquamarine;font-size:25px">{{$FinalBalance}} M5 Tokens</p>
            
            <small style="color:white" >Note: M5 Tokens Credited to members only rewards are based on individual plans & efforts</small>
          </div>  </div>
              </div> 

            


</div>
@endsection
