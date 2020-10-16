@extends('layouts.boot')

@section('content')
<div  align="right" class="container">
    <div class="row">
     
        <div class="col-12 pt-2" align="left">
                                <div class="card shadow-lg border-0 rounded-lg mt-5 ">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">My Info</h3></div>
                                    <div class="card-body">
            
            <a href="{{env('absolute')}}/editMyProfile"><button class="btn btn-info">Edit Profile</button></a>
          
              
            <div class="h6"><br>ID : {{ $user->username }}</div>
            <div class=" font-weight-bold">Name :{{ $user->profile->title }}</div>
            <div class=" font-weight-bold" >Company: {{ $user->profile->description }}</div>
            <div class="font-weight-bold" >Current Position: {{ $user->profile->location }}</div>
            <div class=" font-weight-bold">Email: {{ $user->profile->contact }}</div> 
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
