@extends('layouts.boot')

@section('content')
<div  align="right" class="container-fluid">
    <div class="row">
       <div class="col-12 mt-2" align="left">
        <div class="card   shadow-lg border-0 rounded-lg ">
            
        <div class="card-header"><h5 class="text-center font-weight-light my-2"><h4>DM3 Summary : </h4> </h5></div>
        <div class="card-body  rounded-lg ">
            
              <p style="color:green;font-size:50px" >Profit :  $ {{$Total}}</p>
            </div> </div> </div> </div>
    
     <div class="row">
     <?php $index = 1; ?>                         
            @foreach($Mine as $d)
             
        <div class="col-lg-3" align="left">
        <div class="card   shadow-lg border-0 rounded-lg mt-2 ">
        <div class="card-header"><h5 class="text-center font-weig  
                                     ht-light my-2">{{$index }}<hr>{{$d->name}}</h5></div>
        <div class="card-body  bg-dark rounded-lg ">
            
             
            <p style="color:greenyellow;font-size:50px" >${{$d->balance*0.8}}</p>
            <!--
             <small style="color:yellow;font-size:20px" >Redeem : ${{$d->balance*0.10}}</small><br>-->
            
            
            <a href="{{env('absolute')}}/MyDM3/{{$d->id}}"><button class="btn btn-info">Show</button></a>
          
            <?php $index =$index + 1; ?>  
                                    
                                    
                                    </div> </div> </div>   
            @endforeach         
           
   </div>   
            
    
    </div>
   
     
</div>
@endsection
