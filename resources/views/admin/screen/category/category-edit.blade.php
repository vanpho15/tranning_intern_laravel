@extends('admin.layouts.main')
@section('content')
@include('admin.partials.common.content-header', ['name'=>'Category', 'key'=>'Edit'])
<div class="row container-fluid">
    <div class="col-md-12 ">
        <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title">{{$title}}</h3>
            </div>
            <form action="{{route('category.handleEdit', $category->id)}}" method="POST" enctype="multipart/form-data" id="category-form">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" value="{{ $category->name }}" placeholder="Name" name="name" data-label="Name">
                  </div>
                  <div class="form-group">
                    <label for="alias">Alias</label>
                    <input type="text" class="form-control" value="{{ $category->alias }}" placeholder="Alias" name="alias" data-label="Alias">
                  </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('footer')
<script src="  {{ asset('/js/admin/views/category/category-edit.js')}}"></script>
@endsection