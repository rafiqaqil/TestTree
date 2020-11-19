@extends('layouts.boot')

@section('content')

<div  align="right" class="container">

        @if($errors->any())
        <div class="row" align='center'>
           <div class="col-lg-12 pt-2  ">
             <div class="card-body  bg-danger rounded-lg ">
            <p style="color:greenyellow;font-size:25px"><h4>Error : {{$errors->first()}}</h4></p>
          </div>  </div> </div>

@endif
    
    
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
            <p style="color:greenyellow;font-size:25px">  Total Income: ${{$FinalBalance+$Negative-$Transfers}}</p>
          </div>  </div>
             
             
                 <div class="col-lg-12 pt-2 ">
             <div class="card-body  bg-dark rounded-lg ">
            <p style="color:yellow;font-size:25px">  (Credited & Pending )Withdrawals: ${{$Negative}}</p>
          </div>  </div>
                    <div class="col-lg-12 pt-2 ">
             <div class="card-body  bg-dark rounded-lg ">
            <p style="color:yellow;font-size:25px">  (Credited & Pending )Transfer: ${{$Transfers}}</p>
          </div>  </div>
               <div class="col-lg-12  pt-2 ">
             <div class="card-body  bg-dark rounded-lg ">
            <p style="color:greenyellow;font-size:25px">Available Balance : ${{$FinalBalance}}</p>
          </div>  </div>
              
             
             
             
              </div>                       
                                    
                                    
             
                <div class="row">
        <div class="col-lg-12 ">
        <div class="card mb-12">
            

            <div class="card-header" align="left"> 
                Note: Please make sure your accounts are updated, no withdrawal can be made without 
                <br>
          Merchantrade Account : {{ $profile->merchantrade_acc }}
          <br>
          
          
          USDT Account : {{ $profile->usdt_wallet }}
              <br>    <br>
              @if($profile->merchantrade_acc != null || $profile->usdt_wallet != null)
              
              <a href="{{env('absolute')}}/Create/Widthdraw">
                  <div class='btn btn-success'>Create Withdrawal</div></a>
                   <a href="{{env('absolute')}}/Create/Transfer">
                  <div class='btn btn-success'>Transfer </div></a>
            @else
            <a href="{{env('absolute')}}/editMyProfile">
            <div class='btn btn-danger'>Please Update Account to withdraw</div>
            </a>
            @endif
            
                <br>    <br>
            </div>
          
        
        </div></div></div>
        <!-- DataTables Example -->
           <div class="row">
        <div class="col-lg-12 ">
        <div class="card mb-12">
          <div class="card-header" align="center">
            <i class="fas fa-table"></i>
            Pending</div>
          <div class="card-body" align='left'>
              Please allow 3 working days for us to credit your withdrawal. The Account detail is taken from your profile. If the stated account is not correct please cancel the request immediately. Any errors in withdrawal will not be reversible.    
            <div class="table">
              <table class="table table-bordered" id=""  cellspacing="0">
                    <thead>
                  <tr>
                    
                      
                
                    <th>Account</th>
      
                    <th>Amount</th>
                    
                     
                       <th>Date</th>
                    
                     
                
                      <th>Status</th>
                     
                  </tr>
                </thead>
             
                <tbody>
             
        @foreach($alldata as $d)      
                   
         <tr>
                                  
                
                    <td>{{$d->Type}}
                        <br>
                        {{$d->Name}}
                      <br>Account :
                     @if($d->Type =='USDT')
                   
                        {{$d->USDT}}
                        @else
                        
                        {{$d->Merch}}
                        
                        @endif
                      <br>
                     
                      
                      Phone :
                    {{$d->Phone}}
                    
                    </td>
      
                    <td>{{$d->AMOUNT}}</td>
                      <td>{{$d->created_at}}</td>
                     
  
                    <td>
                        
                          @if($d->STATUS == 0)
                        <div class='btn btn-warning'>Pending</div>
                         <a href="{{env('absolute')}}/CancelMyWidthdraw/{{$d->id}}">
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
                      <br>Account :
                     @if($d->Type =='USDT')
                   
                        {{$d->USDT}}
                        @else
                        
                        {{$d->Merch}}
                        
                        @endif
                      <br>
                      
                      
                      Phone :
                    {{$d->Phone}}
                    
                    </td>
                    
                    <br>
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








        
 <!-- DataTables Example -->
           <div class="row">
        <div class="col-lg-12 ">
        <div class="card mb-12">
          <div class="card-header" align="center">
            <i class="fas fa-table"></i>
             Recently Credited Transfer</div>
          <div class="card-body" align='left'>
              
            <div class="table">
              <table class="table table-bordered" id=""  cellspacing="0">
                    <thead>
                  <tr>
                    
                      
                
                    <th>Sender Username</th>
      
                    <th>Amount</th>
                    
                     
                       <th>Date</th>
                    
                     
                
                      <th>Status</th>
                     
                  </tr>
                </thead>
             
                <tbody>
             
        @foreach($tIN as $d)      
                   
         <tr>
                                  
                
                      <td>{{$d->from_username}}</td>
      
      
                    <td>{{$d->AMOUNT}}</td>
                      <td>{{$d->created_at}}</td>
                     
  
                    <td>
                        
                  @if($d->STATUS == 0)
                        <div class='btn btn-warning'>Pending</div>
                         <a href="{{env('absolute')}}/CancelTransfer/{{$d->id}}">
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


 <!-- DataTables Example -->
           <div class="row">
        <div class="col-lg-12 ">
        <div class="card mb-12">
          <div class="card-header" align="center">
            <i class="fas fa-table"></i>
            Pending for approval</div>
          <div class="card-body" align='left'>
            
            <div class="table">
              <table class="table table-bordered" id=""  cellspacing="0">
                    <thead>
                  <tr>
                    
                      
                
                    <th>Receiver Username</th>
      
                    <th>Amount</th>
                    
                     
                       <th>Date</th>
                    
                     
                
                      <th>Status</th>
                     
                  </tr>
                </thead>
             
                <tbody>
             
        @foreach($tOUT as $d)      
                   
         <tr>
                                  
                
                    <td>Username: {{$d->to_username}}
                        <br>Name: {{$d->name}}
                    <br>Phone: {{$d->phone}}
                    <br>Email: {{$d->email}}
                    
                 
                    
                    
                    </td>
      
                    <td>{{$d->AMOUNT}}</td>
                      <td>{{$d->created_at}}</td>
                     
  
                    <td>
                        
                          @if($d->STATUS == 0)
                          <a href="{{env('absolute')}}/ConfirmTransdfer/{{$d->id}}">
                        <div class='btn btn-warning'>Approve Transfer</div></a>
                        
                         <a href="{{env('absolute')}}/CancelTransfer/{{$d->id}}">
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

</div>
@endsection
