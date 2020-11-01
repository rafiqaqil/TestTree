<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  
  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Custom fonts for this template-->
   <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('css/sb-admin.css') }}" rel="stylesheet">
  
  
  

</head>

<body id="page-top" style="background: linear-gradient(to bottom left, #33ccff 14%, #3399ff 67%);">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
      
    <a class="navbar-brand mr-1" href="../../../../">
        
		
		@if ( (Auth::user()) != null) 
			@if ( (Auth::user()->email_verified_at) != null) 
			{{ env('APP_NAME') }}- MASTER ACCESS
			@else
			{{ env('APP_NAME') }}
			@endif
		@endif
    
    </a>
@guest
    @if (Route::has('register'))
    
     @endif
           @else
           
           <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>  @endguest
           <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">

    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">

       @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    
                            
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    
                                    
                                    
                                </div>
                            </li>
                        @endguest
    
    </ul>

  </nav>

  <div id="wrapper"> 
@guest

                             
                            
                        @if(Route::has('register'))
                         @yield('content')
                         
                         @endif
                        @else
                        
    <!-- Sidebar -->
        <ul class="sidebar navbar-nav toggled"> 


          <li class="nav-item">
            <a class="nav-link" href="{{env('absolute')}}/Myprofile">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>My Profile</span>
            </a>
          </li>
           @if(auth()->user()->profile->membership_type >= 0)
            <li class="nav-item">
            <a class="nav-link" href="{{env('absolute')}}/MyMembership">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>Membership</span>
            </a>
          </li>    <li class="nav-item">
            <a class="nav-link" href="{{env('absolute')}}/MyWallet">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>My Wallet</span>
            </a>
          </li>
          @else
             <li class="nav-item">
            <a class="nav-link" href="{{env('absolute')}}/ActivateAccount">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>Activate Account</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{env('absolute')}}/MyWallet">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>My Wallet</span>
            </a>
          </li>
          
          @endif
          
          @if(auth()->user()->profile->affiliate_paid >= 1)
           <li class="nav-item">
            <a class="nav-link" href="{{env('absolute')}}/Show/MyWidthdraw">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>Dashboard</span>
            </a>
          </li>
          
              <li class="nav-item">
            <a class="nav-link" href="{{env('absolute')}}/ShowMyDM3">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>DM3</span>
            </a>
          </li>
                <li class="nav-item">
            <a class="nav-link" href="{{env('absolute')}}/ShowMyDM5">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>DM5</span>
            </a>
          </li>
           </li>
                <li class="nav-item">
            <a class="nav-link" href="{{env('absolute')}}/ShowMySponsor">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>Sponsor</span>
            </a>
          </li>
                
          
          @endif
        <!-- 
          <li class="nav-item">
            <a class="nav-link" href="{{env('absolute')}}/profile/{{ auth()->user()->id }}/ShowMyData">
              <i class="fas fa-fw fa-table"></i>
              <span>My Claims</span></a>
          </li>
          -->
    
          
          @if ( (Auth::user()->email_verified_at) != null)
            
            <li class="nav-item">
            <a class="nav-link" href="{{env('absolute')}}/ControlPanel">
              <i class="fas fa-fw fa-table"></i>
              <span>Control Panel</span></a>
          </li>
          
           <li class="nav-item">
            <a class="nav-link" href="{{env('absolute')}}/users">
              <i class="fas fa-fw fa-table"></i>
              <span>Users Panel</span></a>
          </li>
          
            <li class="nav-item">
            <a class="nav-link" href="{{env('absolute')}}/Audit/Users">
              <i class="fas fa-fw fa-table"></i>
              <span>Audit Panel</span></a>
          </li>
          
          @endif
        </ul>
 @endguest

    <div id="content-wrapper">

     @yield('content')
      <!-- /.container-fluid -->
</div>  
      <!-- Sticky Footer -->
  

    
    <!-- /.content-wrapper -->
            



</div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('vendor/chart.js/Chart.bundle.min.js') }}"></script>
  <!-- Page level plugin JavaScript-->
  <script src="{{ asset('vendor/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('js/sb-admin.min.js') }}"></script>

  <!-- Demo scripts for this page-->
  <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

</body>

</html>
