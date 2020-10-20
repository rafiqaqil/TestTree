@extends('layouts.boot')

@section('content')
<div  align="right" class="container">
    <div class="row">
     
        <div class="col-lg-12 pt-2" align="left">
                                <div class="card shadow-lg border-0 rounded-lg mt-5 ">
                                    <div class="card-header bg-warning"><h3 class="text-center font-weight-light my-4">Admin Control Panel</h3></div>
                                    <div class="card-body">
                                        <h4>Midnight Updates (Force Action)</h4>
                                        <p>DM5 Will automatically input new reentry nodes and DM3 if full with 5 Dexcendants</p>
            <hr>
            <a href="{{env('absolute')}}/MDC/Update/DM3"><button class="btn btn-warning"> DM3 </button></a>
            <a href="{{env('absolute')}}/MDC/Update/DM5"><button class="btn btn-warning"> DM5 </button></a>
              <a href="{{env('absolute')}}/MDC/Update/Sponsor"><button class="btn btn-warning"> Sponsor </button></a>
              <br>
                      
            <hr>  <h4>Master Tree Views</h4>
            
            <a class="nav-link" href="{{env('absolute')}}/DM5-G">
              <i class="fas fa-fw fa-table"></i>
              <span>DM-5 Master Tree</span></a>
        
            <a class="nav-link" href="{{env('absolute')}}/DM3-G">
              <i class="fas fa-fw fa-table"></i>
              <span>DM-3 Master Tree</span></a>
         
            <a class="nav-link" href="{{env('absolute')}}/sponsor-G">
              <i class="fas fa-fw fa-table"></i>
              <span>Sponsor Master Tree</span></a>
        
            <hr>

            
        </div>
    </div>
   
     
</div>
        </div>
    
@endsection
