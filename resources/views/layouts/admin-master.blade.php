<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
    @include('admin.partials._header')
    
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">

          <!-- Navbar -->
          @include('admin.partials._navbar')
          <!-- /.navbar -->

          <!-- Main Sidebar Container -->
          @include('admin.partials._sidebar')

          <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @yield('content')
            
          </div>
          <!-- /.content-wrapper -->

          <!-- Control Sidebar -->
          <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
              <h5>Title</h5>
              <p>Sidebar content</p>
            </div>
          </aside>
          <!-- /.control-sidebar -->

          <!-- Main Footer -->
          @include('admin.partials._foot')
        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED SCRIPTS -->

        @include('admin.partials._footer')
        @yield('script')
    </body>
  </html>
