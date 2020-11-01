@extends('layouts.boot')

@section('content')
<div  align="right" class="container">
    <div class="row">
     
        <div class="col-12 pt-2" align="left">
                                <div class="card shadow-lg border-0 rounded-lg mt-5 ">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">My Info</h3></div>
                                    <div class="card-body">
            
            <a href="{{env('absolute')}}/editMyProfile"><button class="btn btn-info">Edit Profile</button></a>
          
              
            <div class="h6"><br>Username : {{ $user->username }}</div>
            <div class=" font-weight-bold">Name :{{ $user->profile->name }}</div>
            <div class=" font-weight-bold" >phone: {{ $user->profile->phone }}</div>
            <div class="font-weight-bold" >email Position: {{ $user->profile->email }}</div>
            <div class=" font-weight-bold">national_id: {{ $user->profile->national_id }}</div> 
            
            
            <div class=" font-weight-bold">merchantrade_acc: {{ $user->profile->merchantrade_acc }}</div> 
            
            
            <div class=" font-weight-bold">usdt_wallet: {{ $user->profile->usdt_wallet }}</div> 
                     
            @if($user->profile->affiliate_paid >= 1)  
            <center>
            <small>Start getting more profit by sharing your affiliate link</small>
            
            <div id='doubleLink' class='btn btn-success'>Register Now</div>
            <script>
            document.getElementById("doubleLink").onclick = function() {
                
   window.open("{{env('absolute')}}/logoutNow");  
   sleep(1);
        window.location.replace("{{env('absolute')}}/register/{{$user->username}}");
}
            </script>
            
            <h6>Affiliate Link :<br><br>{{env('absolute')}}/register/{{$user->username}}</h6> 
                 
                      <img  id='barcode' 
            src="https://api.qrserver.com/v1/create-qr-code/?data=www%2Ee-dm5%2Euk%2Fmembers%2Fregister%2F{{$user->username}}&amp;size=250x250" 
            alt="" 
            title="Link" 
            width="250" 
            height="250" />
                   </center>
                     @endif
            
            
                     
            
  
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
