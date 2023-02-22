@extends('admin.layouts.main')
@section('content')
@include('admin.partials.common.content-header', ['name'=>'Product', 'key'=>'Edit'])
<div class="row container-fluid">
    <div class="col-md-12 ">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">{{$title}}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{route('product.handleEdit', $product->id)}}" method="POST" enctype="multipart/form-data" id="product-form">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="name" maxlength="952">Product name</label>
                  <input type="text" class="form-control"  placeholder="Product name" value="{{$product->name}}" name="name" data-label="Name">
                </div>
                <div class="form-group">
                  <label for="name_kana">Product name kana</label>
                  <input type="text" class="form-control"  placeholder="Product name kana" value="{{ $product->name_kana }}" name="name_kana" data-label="Product name kana">
                </div>
                <div class="form-group">
                  <label for="alias">Alias</label>
                  <input type="text" class="form-control"   placeholder="Alias" name="alias" value="{{ $product->alias }}" data-label="Alias">
                </div>
                <div class="form-group">
                    <label>Content</label>
                    <textarea class="form-control" rows="3" placeholder="Content"  name="content" data-label="Content">{{$product->content}}</textarea>
                    </div>
                <div class="form-group">
                  <label for="amount">Amount</label>
                  <input type="text" class="form-control"  placeholder="Amount" value="{{ $product->amount}}" name="amount" data-label="Amount">
                </div>
                <div class="form-group">
                  <label for="price">Price</label>
                  <input type="text" class="form-control"  placeholder="price" value="{{number_format($product->price,3,',','')}}" name="price" data-label="Price">
                </div>
                <div class="form-group">
                    <label>Category name</label>
                    <select class="form-control" name="category_id">
                        @foreach($category as $categories)
                            <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="form-group">
                      <label for="image_link">Product image</label>
                      <input type="file"  name="image_link" class="form-control" id="image_link" data-label="Product image">
                      
                      @csrf
                      <div class="holder" >
                        <img id="imgPreview" src="/storage/{{$product->image_link }}"  width="100px" />
                        <div id="image_name" >
                          {{$product->image_link }}
                      </div>
                  </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary" >Update</button>
              </div>
            </form>
          </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
<script src="  {{ asset('/js/admin/views/product/product-edit.js')}}"></script>
@endsection