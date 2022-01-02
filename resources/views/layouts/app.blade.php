<!DOCTYPE html>
<!--
   This is a starter template page. Use this page to start your new project from
   scratch. This page gets rid of all links and provides the needed markup only.
   -->
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>{{env('APP_NAME')}}</title>
      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="{{asset('vendor/plugins/fontawesome-free/css/all.min.css')}}">
      <!-- icheck bootstrap -->
      <link rel="stylesheet" href="{{asset('vendor/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
      <!-- Theme style -->
      <link rel="stylesheet" href="{{asset('vendor/dist/css/adminlte.min.css')}}">
      <!-- Custom style -->
      <link rel="stylesheet" href="{{asset('/css/styles.css')}}">
   </head>
   <body class="hold-transition layout-top-nav">
      <div class="wrapper">
         <!-- Navbar -->
         <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
               <a href="/dashboard" class="navbar-brand">
                <!-- Navbar <img src="{{asset('media/img/baselogo.png')}}" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">-->
               <span class="brand-text font-weight-light">{{env('APP_NAME')}}</span>
               </a>
              <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                  <!-- Left navbar links -->
                  <ul class="navbar-nav">
                     <li class="nav-item">
                        <a href="/dashboard" class="nav-link">Inicio</a>
                     </li>
                     @if (\App\Http\Controllers\DashboardController::isAdmin(auth()->user()->id))
                     <li class="nav-item">
                          <a href="/admin/activities" class="nav-link">Actividades</a>
                      </li> 
                     <li class="nav-item">
                          <a href="/admin/users" class="nav-link">Socios</a>
                      </li>
                      @else
                      @endif
                  </ul>
               </div>
               <!-- Right navbar links -->
               <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                  <!-- Messages Dropdown Menu -->
                  <li class="nav-item dropdown">
                     <a class="nav-link" href="{{ route('logout') }}">
                     <span class="mr-2">{{ auth()->user()->name }}</span>
                     <i class="fas fa-power-off"></i>
                     </a>
                  </li>
               </ul>
            </div>
         </nav>
         <!-- /.navbar -->
         <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('vendor/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('vendor/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('vendor/dist/js/adminlte.min.js')}}"></script>
</body>
</html>
