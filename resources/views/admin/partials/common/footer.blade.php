@yield('footer')
<!-- jQuery -->
<script src="  {{ asset('/js/admin/jquery.min.js')}}"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
<!-- Bootstrap 4 -->
<script src="  {{ asset('/js/admin/bootstrap.bundle.min.js')}}"></script>
<script src="  {{ asset('/js/admin/jquery-3.6.3.min.js')}}"></script>
<script src="  {{ asset('/js/admin/jquery-ui.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="  {{ asset('/js/admin/adminlte.min.js')}}"></script>
<script src="  {{ asset('/js/admin/common.js')}}"></script>
<script src="  {{ asset('/js/admin/views/auth/auth.js')}}"></script>
<script src="  {{ asset('/js/admin/views/upload/upload.js')}}"></script>
<script src="  {{ asset('/js/admin/jquery.validate.js')}}"></script>
<script src="  {{ asset('/js/admin/additional-methods.js')}}"></script>
<script src="  {{ asset('/js/admin/additional-setting.js')}}"></script>
@yield('footer')
@stack('scripts')
