@extends('layouts.boot')
@section('content')
<div class="container">

    <div class="row">
        <div class="col-12 pb-12">
        <div class="card mb-4">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Accounting Data</div>
            <div class="card-body">
                 @can('update', $user->profile)
                <a href="/profile/{{$user->id}}/printReport"><button class="btn btn-info">Print Report </button></a>
                @endcan
                <table  class='table' border="1">
                    <tr>
                        <td>TOTAL CASH IN: </td><td>{{$data['IN']}}</td>
                        <td>TOTAL CASH OUT:</td><td>{{$data['OUT']}}</td>
                        <td>Expenses: </td><td>545646</td>
                    </tr>
                    
                      <tr>
                        <td>Cash Sales: </td><td> 12</td>
                        <td>Credit Sale:</td><td>56456</td>
                        <td>Expenses: </td><td>56456465</td>
                    </tr>

                    </table>
            </div>
            </div>
            </div>
        </div>
        <!-- DataTables Example -->
                <div class="row">
        <div class="col-12 pb-12">
        <div class="card mb-4">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Data Table</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                  <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Amount ( MYR / RM )</th>
                    <th>Time Created</th>
                    <th>Last Updated</th>
                    <th>Description</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                     <th>Name</th>
                    <th>Type</th>
                    <th>Amount ( MYR / RM )</th>
                    <th>Time Created</th>
                    <th>Last Updated</th>
                    <th>Description</th>
                  </tr>
                </tfoot>
                <tbody>
             
        @foreach($user->transactions as $transactions)      
                    @if($transactions->category == "Expenses")
                    <tr bgcolor="#ffbc6b">
                    @else
                <tr bgcolor="#94f481">
                    @endif

                    <td>{{ $transactions->Name }}</td>
                    <td>{{ $transactions->category }}</td>
                    <td align="right">{{ $transactions->amount }}</td>
                    <td>{{ $transactions->created_at }}</td>
                    <td>{{ $transactions->updated_at }}</td>
                    <td>{{ $transactions->Desc }}</td>
                    </tr>

        @endforeach
        
        
        
                </tbody>
              </table>
            </div>
          </div></div>
            </div>  </div></div>
        
        
        
@endsection