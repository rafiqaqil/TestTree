<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>> e-DM5 Blast Live Stats</title>

    <!-- Custom fonts for this template-->
    <link href="sb2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="sb2/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
               <br>
    
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><strong>ADMINISTRATOR MASTER VIEW</strong> <br>e-DM5 Live Statistics
                        </h1>
                        <a href="{{env('absolute')}}/ControlPanel" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm"><i
                                class="fas fa-back fa-sm text-white-50"></i> Return to Contol Panel</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total DM5 Balance (80%) <br> (User Boleh Withdraw)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{
                                             number_format (
                                             $reentry*4
                                             ,2)}}</div>
                                            
                                            
                                             <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total DM5 Reentry (20%)<br> </div>
                                             <div class="h5 mb-0 font-weight-bold text-gray-800">${{
                                             number_format (
                                             $reentry
                                             ,2)}}</div>
                                        </div>
                                        
                                       
                                    
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                             Total DM3 Balance (80%) <br> (User Boleh Withdraw)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{
                                             number_format (
                                             $redeem*8
                                             ,2)}}</div>
                                            
                                            
                                             <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total DM3 Redeem (10%)<br> </div>
                                             <div class="h5 mb-0 font-weight-bold text-gray-800">${{
                                             number_format (
                                             $redeem
                                             ,2)}}</div>
                                                    
                                                    
                                                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                System (10%)<br> </div>
                                             <div class="h5 mb-0 font-weight-bold text-gray-800">${{
                                             number_format (
                                             $redeem
                                             ,2)}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Nilai Bayaran kepada Sponsor (10% 2% 2% 1% ) 
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">${{$sponsorPayable}}</div>
                                                </div>
                                             
                                            </div>
                                            
                                              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Groupsale Total
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">${{$groupsaleTotal}}</div>
                                                </div>
                                             
                                            </div>
                                            
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Groupsale Estimated Payout (10%)
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">${{$groupsaleTotal*0.1}}</div>
                                                </div>
                                             
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                               Total Users Registered</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dataToShow->max('id') }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user-circle fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    
                     
                     <div class="row">

                       
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                               Total Membership payment received (Bayaran diterima daripada penguna)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{
                                             number_format (
                                              $TotalEarnings
                                             ,2)}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                       
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Withdraw Given (Pengeluaran Duit yang sudah diberi)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{
                                             number_format (
                                             $TotalW
                                             ,2)
                                             }}</div>
                                            
                                           
                                            
                                            
                                            
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

         
                    </div> 

                    <!-- Content Row -->

                    
                    
                    <div class="row">

                       
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                               Balance SEMASA EDM-5 (MEMEBRSHIP PAYMENTS - WITHDRAW)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{
                                             number_format (
                                              $TotalEarnings - $TotalW
                                             ,2)}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                       
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                BALANCE SELEPAS PEMBERIAN PENUH (MEMBERSHIP PAYMENT - REENTRY - DM5 BALANCE - DM3 BALANCE - REDEEM BALANCE - Group sale) </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{
                                             number_format (
                                             ($TotalEarnings)*1- $redeem*10 - $reentry*5 -($groupsaleTotal*0.1) 
                                             ,2)
                                             }}</div>
                                            
                                           
                                            
                                            
                                            
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

         
                    </div> 

                    <!-- Content Row -->
                    
                    
                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-lg-6 col-lg-6">
                            <div class="card shadow mb-4">
                               <canvas id="pie-chart" width="400" height="250"></canvas>

                                
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

                                <script>
                                                    new Chart(document.getElementById("pie-chart"), {
                                        type: 'pie',
                                        data: {
                                          labels: ["EDM-3", "EDM-5", "Sponsor", ],
                                          datasets: [{
                                            label: "Revenue Distribution",
                                            backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f",],
                                            data: [{{$data3->count()}},{{$data5->count()}},{{$data6->count()}},]
                                          }]
                                        },
                                        options: {
                                          title: {
                                            display: true,
                                            text: 'Size Network DM3, DM5 & Sponsor'
                                          }
                                        }
                                    });

                                </script>
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                          
                            </div>
                        </div>
                        
                        
                        
                        
                          <!-- Area Chart -->
                        <div class="col-lg-6 col-lg-6">
                            <div class="card shadow mb-4">
                               <canvas id="pie-chart2" width="400" height="250"></canvas>

                                
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

                                <script>
                                                    new Chart(document.getElementById("pie-chart2"), {
                                        type: 'pie',
                                        data: {
                                          labels: ["DM-3(80%)","DM-3 Redeem(10%)","DM-3 Redeem System (10%)", "DM-5(80%)", "DM-5 Reentry(20%)", "Sponsor Payout (10% 2% 2% 1%)","Groupsale Payout  10%", "System Administration" ],
                                          datasets: [{
                                            label: "Revenue Distribution",
                                            backgroundColor: ["#3e95cf","#3e95cF","#3e95cF", "#8e5ea2", "#8e5eaf","#3cba9f","#00FFFF"],
                                            data: [{{$redeem*9}},
                                                {{$redeem}},
                                                {{$redeem}},
                                                {{$reentry*4}},
                                                {{$reentry}},
                                                {{$sponsorPayable}},
                                                {{$groupsaleTotal*0.1}},
                                                {{($TotalEarnings)*1- $redeem*10 - $reentry*5 - $groupsaleTotal*0.1}}
                                                
                                                
                                                
                                            ]
                                          }]
                                        },
                                        options: {
                                          title: {
                                            display: true,
                                            text: 'Revenue Distribution'
                                          }
                                        }
                                    });

                                </script>
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                          
                            </div>
                        </div>
                        
                        
                        
                        

       
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                           
                        <div class="col-lg-12">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Midnight Pooling List</h6>
                                </div>
                                <div class="card-body">
                                    <table>
                                    @foreach($pool as $d)
                                    <tr>
                                        
                                        <td>

                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div></td>
                                    <td>
                                    <div>
                                        <div class="small text-gray-500">EDM-5 Blast Midnight Pool </div>
                                        {{$d->name}} Strike 5 EDM5 1+5
                                    </div>
                                    
                                    <hr></td>
                                    
                                    </tr>
                                    @endforeach
                                    
                                    </table>
                    
                                    
                                </div>
                            </div>

                            <!-- Approach -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Latest Registrations</h6>
                                </div>
                                
                               
                                  
                               
                                      <div class="card-body">
                                        <div class="table-responsive">
                                          <table class="table table-bordered" id="dataTable"  cellspacing="0">
                                            <thead>
                                              <tr>
                                                  <th>Name</th>
                                                  <th>Country</th>
                                                  <th>Date</th>
                                              </tr>
                                            </thead>
                                            <tbody>    
                                    @foreach($dataToShow as $d)       
                                     <tr>
                                        <td>{{$d->username}}</td>
                                        <td>
                                            @if($d->country == null)
                                            <img src='https://www.iqtutors.com.au/nkflags/rect/my.svg' height=30px width=45px > Malaysia 
                                            
                                           
                                            @elseif($d->country == 'Malaysia')
                                             <img src='https://www.iqtutors.com.au/nkflags/rect/my.svg' height=30px width=45px > Malaysia 
                                            @else
                                           
                                            {{$d->country}}
                                            @endif
                                        
                                        
                                        </td>  
                                          <td>{{$d->created_at}}</td>
                                     </tr>
                                    @endforeach
                                            </tbody>
                                          </table>
                                    </div></div>
                              
                                
                                
                            </div>

                        </div>
                    </div>

              
                <!-- /.container-fluid -->
                
                
                
                
                     <!-- Approach -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Top E-DM5 Sponsors</h6>
                                </div>
                                
                               
                                  
                               
                                      <div class="card-body">
                                        <div class="table-responsive">
                                          <table class="table table-bordered" id="dataTable"  cellspacing="0">
                                            <thead>
                                              <tr>
                                                  <th>Name</th>
                                                  <th>Group Sales</th>
                                                   
                                                  <th>Age</th>
                                                   
                                              </tr>
                                            </thead>
                                            <tbody>    
                                    @foreach($topsponsor as $d)       
                                     <tr>
                                        <td>{{$d->name}}</td>
                                        <td>{{$d->logs}}</td>
                                      
                                        <td>
                                            {{ number_format (
                                                        Carbon\Carbon::now()->diffInHours($d->created_at)/24 
                                                ,1)
                                            
                                            }} Days
                                        </td> 
                                        
                                     </tr>
                                    @endforeach
                                            </tbody>
                                          </table>
                                    </div></div>
                              
                                
                                
                            </div>


               
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; e-DM5 Blast LLC 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="sb2/vendor/jquery/jquery.min.js"></script>
    <script src="sb2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="sb2/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="sb2/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="sb2/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="sb2/js/demo/chart-area-demo.js"></script>
    <script src="sb2/js/demo/chart-pie-demo.js"></script>

</body>

</html>