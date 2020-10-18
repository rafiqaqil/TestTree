@extends('layouts.boot')

@section('content')

<div  align="right" class="container">
<div class="row">
        <div class="col-lg-12 pb-12">
        <div class="card mb-4">
          <div class="card-header">
             
            </div>
            
            </div>
            
            </div>
        </div>
        <!-- DataTables Example -->
           <div class="row">
        <div class="col-lg-12 ">
        <div class="card mb-12">
          <div class="card-header" align="center">
            <i class="fas fa-table"></i>
            Pending Approval</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable"  cellspacing="0">
                    <thead>
                  <tr>
                      <th>Name</th>
                      
                
                    <th>Phone</th>
      
                    <th>Email</th>
                    
                     
  
                    <th>national_id</th>
                      <th>Country</th>
                      <th>Plan / Approve</th>
                     
                  </tr>
                </thead>
             
                <tbody>
             
        @foreach($alldata as $d)      
                   
         <tr>
            <td>{{$d->name}}</td>
                      
                
                    <td>{{$d->phone}}</td>
      
                    <td>{{$d->email}}</td>
                    
                     
  
                    <td>{{$d->national_id}}</td>
                      <td>{{$d->country}}</td>
                      
                       <td>
                      @if($d->affiliate_paid != 1)
                       {{$d->membership_type}} USD 
                        
                         <a href="{{env('absolute')}}/adminAction/{{$d->id}}/ApprovePlacement"><button class="btn btn-info">Confirm Placement</button></a> 
                        
                        @else
                        <button class="btn btn-success">Placement Done</button>
                        
                        
                        @endif
                     </td>
                    </tr>

        @endforeach
        
        
        
                </tbody>
              </table>
            </div>
          </div></div>
            </div>  </div>




       <div class="row">
        <div class="col-lg-12 ">
        <div class="card mb-12">
          <div class="card-header" align="center">
            <i class="fas fa-table"></i>
            Recently Approved</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable"  cellspacing="0">
                    <thead>
                  <tr>
                      <th>Name</th>
                      
                
                    <th>Phone</th>
      
                    <th>Email</th>
                    
                     
  
                    <th>national_id</th>
                      <th>Country</th>
                      <th>Plan / Approve</th>
                     
                  </tr>
                </thead>
             
                <tbody>
             
        @foreach($alldataApproved as $d)      
                   
         <tr>
            <td>{{$d->name}}</td>
                      
                
                    <td>{{$d->phone}}</td>
      
                    <td>{{$d->email}}</td>
                    
                     
  
                    <td>{{$d->national_id}}</td>
                      <td>{{$d->country}}</td>
                      
                       <td>
                      @if($d->membership_paid != 1)
                       {{$d->membership_type}} USD 
                        
                         <a href="{{env('absolute')}}/adminAction/{{$d->id}}/ApprovePayment"><button class="btn btn-info">Approve Payment</button></a> 
                        
                        @else
                        <button class="btn btn-success">Approved</button>
                        
                        
                        @endif
                     </td>
                    </tr>

        @endforeach
        
        
        
                </tbody>
              </table>
            </div>
          </div></div>
            </div>  </div>







</div>
        

@endsection
