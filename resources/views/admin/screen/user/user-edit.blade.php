@extends('admin.layouts.main')
@section('content')
@include('admin.partials.common.content-header', ['name'=>'Users', 'key'=>'Edit'])
<div class="row container-fluid">
    <div class="col-md-12 ">
    <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('user.handleEdit',$user->id)}}" method="POST" enctype="multipart/form-data" id="user-form">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="first_name">First name</label>
                    <input type="text" class="form-control" value="{{$user->first_name}}"  placeholder="First name" name="first_name" data-label="First name">
                  </div>
                  <div class="form-group">
                    <label for="first_name_hiragana">First name Hiragana</label>
                    <input type="text" class="form-control" value="{{$user->first_name_hiragana}}"  placeholder="First name Hiragana" name="first_name_hiragana" data-label="First name Hiragana">
                  </div>
                  <div class="form-group">
                    <label for="last_name">Last name</label>
                    <input type="text" class="form-control" value="{{$user->last_name}}"  placeholder="Last name" name="last_name" data-label="Last name">
                  </div>
                  <div class="form-group">
                    <label for="last_name_hiragana">Last name Hiragana</label>
                    <input type="text" class="form-control" value="{{$user->last_name_hiragana}}" placeholder="Last name Hiragana" name="last_name_hiragana" data-label="Last name Hiragana">
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" value="{{$user->email}}" placeholder="Email" name="email" data-label="Email" readonly>
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control"  id="password"  name="password" data-label="Password">
                  </div>
                  <div class="form-group">
                    <label for="re-password">Re-password</label>
                    <input type="password" class="form-control"  name="re-password" data-label="Re-password">
                  </div>
                  <div class="form-group">
                        <label for="user_flg">Role</label>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="admin" name="user_flg" value="0" data-label="Role" {{ $user->user_flg ==0 ? 'checked=""':'' }}>
                          <label for="admin" class="custom-control-label">Admin</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="user" name="user_flg" value="1"  data-label="Role" {{ $user->user_flg ==1 ? ' checked="" ':'' }}>
                          <label for="user" class="custom-control-label">user</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" value="{{$user->phone}}" placeholder="Phone" name="phone" data-label="Phone">
                      </div>
                      <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" value="{{$user->address}}" placeholder="Address" name="address" data-label="Address">
                      </div>
                      <div class="form-group">
                        <label for="birthday">Birthday</label>
                        <input type="text" class="form-control" value="{{$user->birthday == null ? '': date('Y/m/d', strtotime($user->birthday))}}" placeholder="Birthday" id="datepicker" name="birthday" data-label="Birthday">
                      </div>
                      <div class="form-group">
                        <label for="image_link">Avatar</label>
                        <input type="file"  name="image_link" class="form-control" id="image_link" data-label="Avatar">
                        @csrf
                        <div class="holder" >
                          <img id="imgPreview" src="/storage/{{$user->image_link }}"  width="100px" />
                          <div id="image_name" >
                            {{$user->image_link }}
                        </div>
                      </div>
                    </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" onclick="saveImage()">Update</button>
                </div>
              </form>
            </div>
    </div>
</div>
@endsection
@section('footer')
<script src="  {{ asset('/js/admin/views/user/user-edit.js')}}"></script>
@endsection