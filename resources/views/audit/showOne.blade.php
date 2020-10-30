@extends('layouts.boot')

@section('content')
<div  align="right" class="container">
    <div class="row">
     
        <div class="col-12 pt-2" align="left">
                                <div class="card shadow-lg border-0 rounded-lg mt-5 ">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">View User Info</h3></div>
                                    <div class="card-body">
            
   
              
            <div class="h6"><br>Username : {{ $user->username }}</div>
            <div class=" font-weight-bold">Name :{{ $user->profile->name }}</div>
            <div class=" font-weight-bold" >phone: {{ $user->profile->phone }}</div>
            <div class="font-weight-bold" >email Position: {{ $user->profile->email }}</div>
            <div class=" font-weight-bold">national_id: {{ $user->profile->national_id }}</div> 
            
            
            <div class=" font-weight-bold">merchantrade_acc: {{ $user->profile->merchantrade_acc }}</div> 
            
            
            <div class=" font-weight-bold">usdt_wallet: {{ $user->profile->usdt_wallet }}</div> 
                     
            <hr>
            <h4>Sponsor Summary </h4>
            Total Sponsor Profit : {{$sponsorTotal}}<br>
            Total Group Sale : {{$sponsorTotal*10}}<br>
             <a href="{{env('absolute')}}/Audit/View/{{ $user->id }}/SponsorTree"> <button class="btn btn-info">Show Sponsor Tree</button></a>
                     
             <h5>Sponsor List</h5>
             @foreach($sponsored AS $d)
             
             <h5> {{ $d->name }} -- $ {{$d->membership_type}} - {{$d->created_at}}</h5><br>
            
            @endforeach
             
             
            <hr>
            <h4>DM5 Summary : $ {{$DM5_Bal}}</h4>
            
            @foreach($DM5_IDs AS $d)
            <h5>Placement : {{$d->id}} -- $ {{$d->balance*0.8}}</h5><br>
            @endforeach
            
               <hr>
            <h4>DM3 Summary : $ {{$DM3_Bal}}</h4>
            
              @foreach($DM3_IDs AS $d)
            <h5>Placement :  {{$d->id}} -- $ {{$d->balance*0.8}}</h5><br>
            @endforeach
                    <hr>
            <h4>Withdraw Summary </h4>
            
            
                @foreach($Withdraw AS $d)
            <h5>Placement :  {{$d->id}} -- $ {{$d->balance*0.8}}</h5><br>
            @endforeach
  
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
          


            
            
             </div> </div> </div>
       
           
            
        </div>
    </div>
   
     
</div>
@endsection
