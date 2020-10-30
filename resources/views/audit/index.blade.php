@extends('layouts.boot')

@section('content')

<div  align="center" class="container">
<div class="row">
        <div class="col-lg-12 pb-12">
        <div class="card mb-4">
          <div class="card-header">
             
              <strong>Auditing Panel</strong>
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
                      <th></th>
                     
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
                 
                         <a href="{{env('absolute')}}/Audit/View/{{$d->id}}"><button class="btn btn-info">View</button></a> 
                        
                
                     </td>
                    </tr>

        @endforeach
        
        
        
                </tbody>
              </table>
            </div>
          </div></div>
            </div>  </div>



@endsection
