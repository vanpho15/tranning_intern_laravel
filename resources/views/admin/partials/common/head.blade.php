<meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{$title}}</title>
  <link rel="stylesheet" href="  {{ asset('/css/admin/error.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="  {{ asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="  {{ asset('/css/admin/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="  {{ asset('/css/admin/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="  {{ asset('/css/admin/adminlte.min.css')}}">
  <link rel="stylesheet" href="  {{ asset('/css/admin/jquery-ui.min.css')}}">
   <!-- bắt sự kiện ajack -->
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
 
  @yield('head')