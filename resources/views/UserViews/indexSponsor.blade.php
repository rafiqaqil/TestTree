@extends('layouts.boot')

@section('content')
<div  align="right" class="container-fluid">
    <div class="row">
       <div class="col-12 mt-2" align="left">
        <div class="card   shadow-lg border-0 rounded-lg ">
            
        <div class="card-header"><h5 class="text-center font-weight-light my-2"><h4>My Sponsors Summary  
                
                    <br><small>Groupsale Accumulation : {{$Mine->logs}}</small></h4> </h5></div>
        <div class="card-body  bg-dark rounded-lg ">
               <a href="{{env('absolute')}}/ShowMySponsorTree">
        <div class="btn btn-success">Show SponsorTree</div></a>
              <p style="color:greenyellow;font-size:50px" >Profit :  $ {{$Total}}</p>
            </div> </div> </div> </div>
    
 
     <div class="row">
  
   </div>   



            
            
           
       
           
            
     
    </div>
   
     
</div>
@endsection
