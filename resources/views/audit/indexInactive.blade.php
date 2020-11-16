@extends('layouts.boot')

@section('content')

<div  align="center" class="container">
<div class="row">
        <div class="col-lg-12 pb-12">
        <div class="card mb-4">
          <div class="card-header">
             
              <strong>Auditing Panel</strong>
              
    <a href='{{env("absoulte")}}/Audit/Users'>
              <div class='btn btn-success'>
                  Show Active Users
              </div></a>
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
            All users</div>
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
                      <th>Views</th>
                     
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
                           @if($d->affiliate_paid == '0')
                         <button class="btn btn-secondary">Inactive</button> 
                        @else
                       <a href="{{env('absolute')}}/Audit/View/{{$d->id}}"><button class="btn btn-info">View</button></a> 
                        @endif
                
                     </td>
                    </tr>

        @endforeach
        
        
        
                </tbody>
              </table>
            </div>
          </div></div>
            </div>  </div>



@endsection
