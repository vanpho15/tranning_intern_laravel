@extends('admin.layouts.main')
@section('content')
@include('admin.partials.common.content-header', ['name'=>'Users', 'key'=>''])
<div class="container">
    <div class="row container-fluid">
        <div class="col-md-12 ">
            <form action="{{route('category.search')}}" method="POST" enctype="multipart/form-data" id="">
                @csrf
                <div class="row">
                    <div class="col-4 form-group">
                        <label>ID</label>
                        <input type="text" class="form-control"  placeholder="ID" name="id" >
                    </div>
                    <div class="col-4 form-group">
                        <label>Name</label>
                        <input type="text" class="form-control"  placeholder="Name" name="name" >
                    </div>
                    <div class="col-4 form-group">
                        <label>Alias</label>
                        <input type="text" class="form-control"  placeholder="Alias" name="alias" >
                    </div>
                </div>
                <div class="col-12 form-group">
                    <button class="btn btn-primary">Search</button>
                    <a class="btn btn-warning float-end" href="{{ route('category.deleteSessionSearch') }}">Clear</a>
                </div>
            </form>
            <table class="table" >
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Alias</th>
                    <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                @if(count($categories)>0)
                 @foreach($categories as  $category)
                    <tr>
                        <td scope="col"><a href="/admin/category/edit/{{$category->id}}" class="btn btn-default">{{$category->id}}</a></td>
                        <td scope="col">{{$category->name}}</td>
                        <td scope="col">{{$category->alias}}</td>
                        <td>
                            <a href="#" class="btn btn-default" onclick="removeRow({{$category->id}},'/admin/category/destroy')">Delete</a>
                        </td>
                    </tr>
                 @endforeach
                 @else
                    <div class="alert alert-danger">
                        There is no result.
                    </div>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer clearfix">
        {{ $categories->links() }}
    </div>
</div>
@endsection
@section('footer')
<script src="  {{asset('/js/admin/views/category/category-delete.js')}}"></script>
@endsection
