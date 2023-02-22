<!DOCTYPE html>
<html lang="en">
<head>
  @include('admin.partials.common.head')
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>{{$title}}</b></a>
    </div>
    <div class="card-body">
      @include('admin.partials.common.alert')
      <form action="{{route('admin.store')}}" method="post" id="form-login">
      @csrf
        <div class="input-group mb-3">
        </div>
          <div class="form-group">
            <label for="exampleInputEmail1" style="max-width: 320px;">Email</label>
            <input type="email" name="email" id="Email" class="form-control" placeholder="Email" data-label="Email" >
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1" style="max-width: 320px;" >Password</label>
            <input type="password" name="password" id="Password" class="form-control" placeholder="Password" data-label="Password">
          </div>
        </div>
        <div class="row">
          
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- /.social-auth-links -->
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->
@include('admin.partials.common.footer')

</body>
</html>
