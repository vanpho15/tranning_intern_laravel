@extends('admin.layouts.main')
@section('content')
@include('admin.partials.common.content-header', ['name'=>'Users', 'key'=>'Add'])
<div class="row container-fluid">
    <div class="col-md-12 ">
    <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('user.handleAdd')}}" method="POST" enctype="multipart/form-data" id="user-form">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="first_name" maxlength="952">First name</label>
                    <input type="text" class="form-control"  placeholder="First name" value="{{ old('first_name') }}" name="first_name" data-label="First name">
                  </div>
                  <div class="form-group">
                    <label for="first_name_hiragana">First name Hiragana</label>
                    <input type="text" class="form-control"  placeholder="First name Hiragana" value="{{ old('first_name_hiragana') }}" name="first_name_hiragana" data-label="First name Hiragana">
                  </div>
                  <div class="form-group">
                    <label for="last_name">Last name</label>
                    <input type="text" class="form-control"   placeholder="Last name" name="last_name" value="{{ old('last_name') }}" data-label="Last name">
                  </div>
                  <div class="form-group">
                    <label for="last_name_hiragana">Last name Hiragana</label>
                    <input type="text" class="form-control"  placeholder="Last name Hiragana" value="{{ old('last_name_hiragana') }}" name="last_name_hiragana" data-label="Last name Hiragana">
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control"  placeholder="Email" value="{{ old('email') }}" name="email" data-label="Email">
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control"  id="password" value="{{ old('password') }}" name="password" data-label="Password">
                  </div>
                  <div class="form-group">
                    <label for="re-password">Re-password</label>
                    <input type="password" class="form-control" value="{{ old('re-password') }}" name="re-password" data-label="Re-password">
                  </div>
                  <div class="form-group">
                        <label for="user_flg">Role</label>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="admin" name="user_flg" value="0" data-label="Role">
                          <label for="admin" class="custom-control-label">admin</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="user" name="user_flg" value="1" checked="" data-label="Role">
                          <label for="user" class="custom-control-label">user</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control"  placeholder="Phone" value="{{ old('phone') }}" name="phone" data-label="Phone">
                      </div>
                      <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control"  placeholder="Address" value="{{ old('address') }}" name="address" data-label="Address">
                      </div>
                      <div class="form-group">
                        <label for="birthday">Birthday</label>
                        <input type="text" class="form-control" placeholder="Birthday" id="datepicker" value="{{ old('birthday') }}" name="birthday" data-label="Birthday">
                      </div>
                      <div class="form-group">
                        <label for="image_link">Avatar</label>
                        <input type="file"  name="image_link" class="form-control" id="image_link" data-label="Avatar">
                        @csrf
                        <div class="holder" >
                          <img id="imgPreview" src="#"  width="100px" />
                      </div>
                    </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" onclick="saveImage()">Create</button>
                </div>
              </form>
            </div>
    </div>
</div>
@endsection
@section('footer')
<script src="  {{ asset('/js/admin/views/user/user-add.js')}}"></script>
@endsection