<!DOCTYPE html>
<html lang="en">
<head>
@include('admin.partials.common.head')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  @include('admin.partials.common.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('admin.partials.common.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  @include('admin.partials.common.alert')
    <!-- Main content -->

    @yield('content')

  </div>

  <!-- Main footer -->
@include('admin.partials.common.footer')

<!-- jQuery -->

@stack('scripts')
</body>
</html>
