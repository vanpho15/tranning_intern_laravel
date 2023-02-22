@extends('admin.layouts.main')
@section('content')
@include('admin.partials.common.content-header', ['name'=>'Products', 'key'=>'Search'])
<div class="container">
    <div class="row ">
        <div class="col-md-12 ">
        <form action="{{route('product.search')}}" method="POST" enctype="multipart/form-data" id="">
            @csrf
            <div class="row">
                <div class="col-4 form-group">
                    <label for="name">Product name</label>
                    <input type="text" class="form-control"  placeholder="Name" name="name" >
                </div>
                <div class="col-4 form-group">
                    <label for="name_kana">Product name kana</label>
                    <input type="text" class="form-control"  placeholder="Product name kana" name="name_kana" >
                </div>
                <div class="col-4 form-group">
                    <label for="alias">Alias</label>
                        <input type="text" class="form-control"  placeholder="Alias"  name="alias">
                </div>
                <div class="col-4 form-group">
                    <label for="amount">Amount</label>
                    <input type="text" class="form-control"  placeholder="Amount" name="amount">
                </div>
                <div class="col-4 form-group">
                    <label for="price">Price</label>
                        <input type="text" class="form-control"  placeholder="Price" name="price">
                </div>
                <div class="col-4 form-group">
                    <label>Category name</label>
                    <select class="form-control" name="category_id">
                        <option value=""></option>
                        @foreach($category as $categories)
                            <option value="{{$categories->id}}">{{$categories->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 form-group">
                    <button class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
    <div class="col-md-12 ">
        <form action="{{ route('product.import') }}" method="POST" enctype="multipart/form-data" id="importUser">
            @csrf
            <div class="form-group">
                <input type="file" name="file" class="form-control" id="customFile" data-label="customFile" hidden>
                <button class="btn btn-primary" id="btn_import" onclick="open_file()" hidden></button>
            </div>
        </form>
            <div class="form-group">
                <button class="btn btn-primary" onclick="open_file()">Import CSV</button>
                <a class="btn btn-warning float-end" href="{{ route('product.deleteSessionSearch') }}">Clear</a>
                <a class="btn btn-primary" href="{{ route('product.export') }}">Export CSV</a>
            </div>
    </div>
    </div>
        <div class="col-md-12 " >
            <table class="table" width="100%" style="1px solid black">
                        <tr>
                            <th>ID</th>
                            <th>Product name</th>
                            <th>Alias</th>
                            <th>Amount</th>
                            <th>Price</th>
                            <th>Content</th>
                            <th>Category name</th>
                            <th>Product image</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Delete</th>
                        </tr>
                    @if(count($products)>0)
                    @foreach($products as  $product)
                        <tr >
                            <td scope="col"><a href="/admin/product/edit/{{$product->id}}" class="btn btn-default">{{$product->id}}</a></td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->alias}}</td>
                            <td>{{$product->amount}}</td>
                            <td >{{number_format($product->price,3,',',',')}}</td>
                            <td >{{$product->content}}</td>
                            <td >{{$product->categories->name}}</td>
                            <td >{{$product->created_at}}</td>
                            <td >{{$product->updated_at}}</td>
                            <td><a href="/storage/{{$product->image_link}}" class="btn btn-default"><img height ="50px"  src="/storage/{{$product->image_link}}"></a></td>
                            <td>
                                <a href="#" class="btn btn-default" onclick="removeRow({{$product->id}},'/admin/product/destroy')">Delete</a>
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
                {{$products->links()}}
            </div>
        </div>
    </div>      
    </div>
    </div>
@endsection
@section('footer')
<script src="  {{asset('/js/admin/views/product/product-import.js')}}"></script>
<script src="  {{asset('/js/admin/views/common/open-file.js')}}"></script>
<script src="  {{asset('/js/admin/views/product/product-delete.js')}}"></script>
@endsection