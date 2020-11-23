@extends('layouts.boot')

@section('content')
<div  align="right" class="container-fluid">
    <div class="row">
       <div class="col-12 mt-2" align="left">
        <div class="card   shadow-lg border-0 rounded-lg ">
            
        <div class="card-header"><h5 class="text-center font-weight-light my-2"><h4>Summary : </h4> </h5></div>
        <div class="card-body  rounded-lg ">
            
              <p style="color:green;font-size:50px" >Profit :  $ {{$Total}}</p>
             
             <!--
              <p style="color:blue;font-size:30px" >Reentry Balance :  $ {{$reentry}}</p>
              @if($reentry >= 200)
              @if($REENTRY_STATUS)
              <a href="{{env('absolute')}}/MyDM5/Apply/Reentry">
            <button class='btn btn-success'>Apply Reentry (fee 10$)</button>
            </a>
              @else
              <button class='btn btn-info'>Request Pending Please Make Sure you have paid 10$ </button>
              @endif
            @endif
            
            -->
            </div> </div> </div> </div>
    
     <div class="row">
     <?php $index = 1; ?>                         
            @foreach($Mine as $d)
             
        <div class="col-lg-3" align="left">
        <div class="card   shadow-lg border-0 rounded-lg mt-2 ">
        <div class="card-header"><h5 class="text-center font-weight-light my-2">{{$index }}<hr>{{$d->name}}</h5></div>
        <div class="card-body  bg-dark rounded-lg ">
            
             
            <p style="color:greenyellow;font-size:50px" >${{$d->balance*0.80}}</p>
            <small style="color:yellow;font-size:20px" >Reentry: ${{($d->balance*0.20)-(200*$d->RE_ENTRY_TIMES)}}</small><br>
          
            <a href="{{env('absolute')}}/MyDM5/{{$d->id}}"><button class="btn btn-info">Show</button></a>
            
            @if(($d->balance*0.20)-(200*$d->RE_ENTRY_TIMES) >= 200)
              <a href="{{env('absolute')}}/create/reentryDM5/{{$d->id}}"><button class="btn btn-success">Purchase Reentry Fee (10 USD)</button></a>
              @endif
              
              
          
            <?php $index =$index + 1; ?>  
                                    
                                    
                                    </div> </div> </div>   
            @endforeach         
           
   </div>   
       <!--     
            
                   
              
             Company -> profile -> description
                Current Position ->  profile -> location
                Name  ->  profile  -> title
                Email - > profile-> contacted

                @can('update', $user->profile)
                <a href="/p/create"><button class="btn btn-info">Add New Post</button></a> 
                @endcan
                
                @can('update', $user->profile)
               
               <a href="/profile/{{ $user->id }}/createMydata"> <button class="btn btn-info">Add MyData</button></a>
               <a href="/profile/{{ $user->id }}/ShowMyData"> <button class="btn btn-info">Show MyData</button></a>
               
                @endcan
-->
          


            
            
           
       
           
            
     
    </div>
   
     
</div>
@endsection
