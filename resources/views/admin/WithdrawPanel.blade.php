@extends('layouts.boot')

@section('content')

<div  align="right" class="container">

         <div class="row" align='left'>
             
             <div class="col-lg-4 pt-2  ">
             <div class="card-body  bg-dark rounded-lg ">
            <p style="color:greenyellow;font-size:25px">DM5 : ${{$TDM5}}</p>
          </div>  </div>
               <div class="col-lg-4 pt-2 ">
             <div class="card-body  bg-dark rounded-lg ">
            <p style="color:greenyellow;font-size:25px">DM3 : ${{$TDM3}}</p>
          </div>  </div>
               <div class="col-lg-4 pt-2 ">
             <div class="card-body  bg-dark rounded-lg ">
            <p style="color:greenyellow;font-size:25px">SPONSOR : ${{$TSPN}}</p>
          </div>  </div>
             
             <div class="col-lg-12 pt-2 ">
             <div class="card-body  bg-dark rounded-lg ">
            <p style="color:yellow;font-size:25px"> Withdrawals: ${{$Negative}}</p>
             <small style="color:white">Wang yang sudah diberi kepada pelanggan </small>
          </div>  </div>
              
               <div class="col-lg-12 pt-2 ">
             <div class="card-body  bg-dark rounded-lg ">
            <p style="color:greenyellow;font-size:25px">Withdrawals Balance: ${{$FinalBalance}}</p>
            <small style="color:white">Wang yang perlu ada untuk diberi kepada pelanggan </small>
          </div>  </div>
              
               <div class="col-lg-12 pt-2 ">
             <div class="card-body  bg-warning rounded-lg ">
            <p style="color:black;font-size:25px">Total Recieved Balance: ${{$TotalRecieved}}</p>
             <small style="color:black">Wang yang diterima daripada pelanggan </small>
          </div>  </div>
             
             
              </div>                       
                                    
                                    
             
             
        <!-- DataTables Example -->
           <div class="row">
        <div class="col-lg-12 ">
        <div class="card mb-12">
          <div class="card-header" align="center">
            <i class="fas fa-table"></i>
            Pending</div>
          <div class="card-body" align='left'>
              Please allow 3 working days for us to credit your withdrawal
            <div class="table">
              <table class="table table-bordered" id=""  cellspacing="0">
                    <thead>
                  <tr>
                    
                      
                
                    <th>Details</th>
      
                    <th>Amount</th>
                    
                     
                       <th>Date</th>
                    
                     
                
                      <th>Status</th>
                     
                  </tr>
                </thead>
             
                <tbody>
             
        @foreach($alldata as $d)      
                   
         <tr>
                                  
                
                    <td> {{$d->Type}}
                    <br>Name:{{$d->Name}}
                    <br>Contact :{{$d->Phone}}
                    @if($d->Type ='MERCHANTRADE')
                    <br>Mechantrade Account : {{$d->Merch}}
                    @else
                    <br>USDT Wallet :  {{$d->USDT}}
                    @endif
                    
                    
                    
                    </td>
      
                    <td>{{$d->AMOUNT}}</td>
                      <td>{{$d->created_at}}</td>
                     
  
                    <td>
                        
                          @if($d->STATUS == 0)
                          <a href="{{env('absolute')}}/adminAction/{{$d->id}}/Credited">
                               <div class='btn btn-warning'>Approve Credit</div></a>
                             
                           <a href="{{env('absolute')}}/adminAction/{{$d->id}}/Cancel">
                               <div class='btn btn-danger'>Cancel</div></a>
                        @elseif($d->STATUS == 9)

                          <div class='btn btn-danger'>Canceled</div>
                          @else
                       <div class='btn btn-success'>Approved</div>
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
            Recently Credited</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable"  cellspacing="0">
                    <thead>
                  <tr>
                          
                
                    <th>Account</th>
      
                    <th>Amount</th>
                    
                      <th>Date</th>
                    
  
                
                      <th>Status</th>
                     
                  </tr>
                </thead>
             
                <tbody>
             
        @foreach($alldataApproved as $d)      
                   
         <tr>
              
                    <td>{{$d->Type}}
                    <br>
                    {{$d->Name}}
                    <br>
                    {{$d->Phone}}
                    </td>
      
                    <td>{{$d->AMOUNT}}</td>
                    
                    <td>{{$d->updated_at}}</td>
                    <td>
                        @if($d->STATUS == 0)
                        <div class='btn btn-warning'>Pending</div>
                        @elseif($d->STATUS == 9)
                        
                        
                          <div class='btn btn-danger'>Canceled</div>
                          @else
                       <div class='btn btn-success'>Credited</div>
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
