<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>e-DM5 Blast Live Stats</title>

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
                        <h1 class="h3 mb-0 text-gray-800">e-DM5 Live Statistics
                        
                        
                        </h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-back fa-sm text-white-50"></i> Home</a>
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
                                                Cumulative Earnings</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{
                                             number_format (
                                             $TotalEarnings*($random/20)
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
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Passive Distributed Earnings </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{
                                             number_format (
                                             $TotalW*$random/3
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

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">e-DM5 Midnight Pooling (Today)
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$pool->count()}}</div>
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
                                            text: 'e-DM5 Blast Revenue Distribution'
                                          }
                                        }
                                    });

                                </script>
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                          
                            </div>
                        </div>
                        
                        
                        
                        
                        
                        
                        
                        
                        
                         <div class="col-lg-6 col-lg-6">
                            <div class="card shadow mb-4">
                             <canvas id="line-chart" width="800" height="450"></canvas>

                                <script>
                                         new Chart(document.getElementById("line-chart"), {
                                                        type: 'line',
                                                        data: {
                                                          labels: ['June 2020','July 2020','Aug 2020','Sept 2020','Oct 2020','Nov 2020','Dec 2020'],
                                                          datasets: [{ 
                                                              data: [5,20,40,60,80,150,200],
                                                              label: "Vietnam",
                                                              borderColor: "#3e95cd",
                                                              fill: false
                                                            }, { 
                                                              data: [5,6,10,18,20,29,40],
                                                              label: "Malaysia",
                                                              borderColor: "#8e5ea2",
                                                              fill: false
                                                            }, { 
                                                              data: [5,9,10,16,150,160,260],
                                                              label: "Britain",
                                                              borderColor: "#3cba9f",
                                                              fill: false
                                                            }
                                                    
                                                          ]
                                                        },
                                                        options: {
                                                          title: {
                                                            display: true,
                                                            text: 'EDM5 Blast Users & Expected Growth '
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