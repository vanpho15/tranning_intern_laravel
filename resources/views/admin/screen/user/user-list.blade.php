@extends('admin.layouts.main')
@section('content')
@include('admin.partials.common.content-header', ['name'=>'Users', 'key'=>'Search'])
<div class="container">
    <div class="row ">
        <div class="col-md-12 ">
        <form action="{{route('user.search')}}" method="POST" enctype="multipart/form-data" id="">
            @csrf
            <div class="row">
                <div class="col-4 form-group">
                    <label for="last_name">ID</label>
                    <input type="text" class="form-control"  placeholder="ID" name="id" >
                </div>
                <div class="col-4 form-group">
                    <label for="first_name">First name</label>
                    <input type="text" class="form-control"  placeholder="First name" name="first_name" data-label="First name">
                </div>
                <div class="col-4 form-group">
                    <label for="first_name_hiragana">First name Hiragana</label>
                        <input type="text" class="form-control"  placeholder="First name Hiragana"  name="first_name_hiragana" data-label="First name Hiragana">
                </div>
                <div class="col-4 form-group">
                    <label for="last_name">Last name</label>
                    <input type="text" class="form-control"  placeholder="Last name" name="last_name" data-label="Last name">
                </div>
                <div class="col-4 form-group">
                    <label for="last_name_hiragana">Last name Hiragana</label>
                        <input type="text" class="form-control"  placeholder="Last name Hiragana" name="last_name_hiragana" data-label="Last name Hiragana">
                </div>
                <div class="col-4 form-group">
                    <label for="email">Email</label>
                        <input type="text" class="form-control"  placeholder="Email" name="email" data-label="Email">
                </div>
                <div class="col-4 form-group">
                    <label for="user_flg">Role</label>
                            <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="admin" name="user_flg" value="0" data-label="Role">
                            <label for="admin" class="custom-control-label">admin</label>
                            </div>
                            <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="user" name="user_flg" value="1" data-label="Role">
                            <label for="user" class="custom-control-label">user</label>
                            </div>
                </div>
                <div class="col-4 form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control"  placeholder="Phone" value="{{ old('phone') }}" name="phone" data-label="Phone">
                </div>
                <div class="col-4 form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control"  placeholder="Address" value="{{ old('address') }}" name="address" data-label="Address">
                </div>
                <div class="col-12 form-group">
                    <button class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
    <div class="col-md-12 ">
        <form action="{{ route('user.import') }}" method="POST" enctype="multipart/form-data" id="importUser">
            @csrf
            <div class="form-group">
                <input type="file" name="file" class="form-control" id="customFile" data-label="customFile" hidden>
                <button class="btn btn-primary" id="btn_import" onclick="open_file()" hidden></button>
            </div>
        </form>
            <div class="form-group">
                <button class="btn btn-primary" onclick="open_file()">Import CSV</button>
                <a class="btn btn-warning float-end" href="{{ route('user.deleteSessionSearch') }}">Clear</a>
                <a class="btn btn-primary" href="{{ route('user.export') }}">Export CSV</a>
            </div>
    </div>
    </div>
        <div class="col-md-12 " >
            <table class="table" width="100%" style="1px solid black">
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Role</th>
                            <th>Avatar</th>
                            <th>Delete</th>
                        </tr>
                    @if(count($users)>0)
                    @foreach($users as  $user)
                        <tr >
                            <td scope="col">{!!$user->id == $userLogin || $user->user_flg==1 ? '<a href="/admin/user/edit/'.$user->id.'" class="btn btn-default">'.$user->id.'</a>':'<label class="btn btn-default">'.$user->id.'</label>'!!} </td>
                            <td><p>{{$user->first_name}} {{$user->last_name}}</p></td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}}</td>
                            <td >{{$user->address}}</td>
                            <td>{{$user->user_flg == 0 ? 'Admin':'User'}}</td>
                            <td>{!!$user->id == $userLogin || $user->user_flg==1 ? '<a href="/storage/'.$user->image_link.'" class="btn btn-default"><img height ="50px"  src="/storage/'.$user->image_link.'"></a>':'<img height ="50px" class="btn btn-default" src="/storage/'.$user->image_link.'">'!!}</td>
                            <td>
                                <a href="#" class="btn btn-default" {!!$user->id == $userLogin || $user->user_flg==0 ? 'style="display: none;"':''!!} onclick="removeRow({{$user->id}},'/admin/user/destroy')">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    @else
                    <div class="alert alert-danger">
                        There is no result.
                    </div>
                    @endif
            </table>  
        </div>
        <div class="col-md-12">
            <div class="card-footer clearfix">
                {{$users->links()}}
            </div>
        </div>
    </div>      
    </div>
    </div>
@endsection
@section('footer')
<script src="  {{asset('/js/admin/views/user/user-import.js')}}"></script>
<script src="  {{asset('/js/admin/views/common/open-file.js')}}"></script>
<script src="  {{asset('/js/admin/views/user/user-delete.js')}}"></script>
@endsection