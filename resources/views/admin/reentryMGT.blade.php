@extends('layouts.boot')

@section('content')

<div  align="center" class="container">

<div class="row">
        <div class="col-lg-12 pb-12">
        <div class="card mb-4">
          <div class="card-header">
             <h3>Manage Re-entry DM5 </h3>
             <small>
                 
                 Sini kita boleh handle Reentry DM5 yang dibuat oleh penguna yang ada balance DM3 .
            
                 <br>
             </small>
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
            Pending DM3 Redeem Requests</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered display" id="dataTable"  cellspacing="0">
                    <thead>
                  <tr>
                      <th>Name</th>
                      
                
                    <th>Amount</th>
      
                  
                      <th>Account</th>
                      <th>Plan / Approve</th>
                     
                  </tr>
                </thead>
             
                <tbody>
             
        @foreach($alldata as $d)      
                   
         <tr>
             <td>
                 
                 <small> Username : {{$d->username}}
             <br>Name: {{$d->name}}
             <br>Phone: {{$d->phone}}
             <br>Email :    {{$d->email}}
              
            
            <!--
            <br>IC:     {{$d->national_id}}
            <br>Country:  {{$d->country}}</td>
            
            -->
            
            </small>
            <td>
                {{$d->AMOUNT}}
            </td>
             <td>
                {{$d->TYPE}}
                
                @if($d->TYPE == 'USDT')
                <br>{{$d->usdt_wallet}}
                @else
                <br>{{$d->merchantrade_acc}}
                @endif
            
            </td>
                      
            
                       <td>
                 <!-- {{$d->STATUS}} -->
                 @if($d->STATUS == 'NEW')
                         <a href="{{env('absolute')}}/reentryMGT/{{$d->id}}/PlaceReentry"><button class="btn btn-info">Approve Payment</button></a> 
                         <a href="{{env('absolute')}}/reentryMGT/{{$d->id}}/CancelReentry"><button class="btn btn-warning">Cancel</button></a> 
                  @elseif($d->STATUS == 'COMPLETE')
                  
                  <div class='btn btn-success'> Complete</div>
                  @else
                  <div class='btn btn-danger'> Cancel</div>
                  
                         @endif       
                     </td>
                    </tr>

        @endforeach
        
        
        
                </tbody>
              </table>
            </div>
          </div></div>
            </div>  </div>

        
        
        
        
        
        
        
        
        
        
        
        
        
               <!-- DataTables Example -->
           <div class="row">
        <div class="col-lg-12 ">
        <div class="card mb-12">
          <div class="card-header" align="center">
            <i class="fas fa-table"></i>
             Re-entry DM5 History </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered display" id=""  cellspacing="0">
                    <thead>
                  <tr>
                      <th>Name</th>
                      
                
                    <th>Amount</th>
      
                  
                      <th>Account</th>
                      <th>Plan / Approve</th>
                     
                  </tr>
                </thead>
             
                <tbody>
             
        @foreach($alldataDone as $d)      
                   
         <tr> 
             <td>
                 <small>
                 Username : {{$d->username}}
             <br>Name: {{$d->name}}
             <br>Phone: {{$d->phone}}
             <br>Email :    {{$d->email}}
            
            
            <!--
            <br>IC:     {{$d->national_id}}
            <br>Country:  {{$d->country}}</td>
            
            --> </small>
            <td>
                {{$d->AMOUNT}}
            </td>
             <td>
                {{$d->TYPE}}
                      @if($d->TYPE == 'USDT')
                <br>{{$d->usdt_wallet}}
                @else
                <br>{{$d->merchantrade_acc}}
                @endif
            </td>
                      
            
                       <td>
                 <!-- {{$d->STATUS}} -->
                 @if($d->STATUS == 'NEW')
                         <a href="{{env('absolute')}}/reentryMGT/{{$d->id}}/PlaceReentry"><button class="btn btn-info">Approve Payment</button></a> 
                         <a href="{{env('absolute')}}/reentryMGT/{{$d->id}}/CancelReentry"><button class="btn btn-warning">Cancel</button></a> 
                  @elseif($d->STATUS == 'COMPLETE')
                  
                  <div class='btn btn-success'> Complete</div>
                  @else
                  <div class='btn btn-danger'> Cancel</div>
                  
                         @endif     
                     </td>
                    </tr>

        @endforeach
        
        
        
                </tbody>
              </table>
            </div>
          </div></div>
            </div>  </div>
        
               
               <script>
                   
                   $(document).ready(function() {
    $('table.display').DataTable();
} );
                   </script>
        
       
        
        
        
@endsection
