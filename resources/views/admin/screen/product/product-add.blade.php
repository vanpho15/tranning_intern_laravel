@extends('admin.layouts.main')
@section('content')
@include('admin.partials.common.content-header', ['name'=>'Product', 'key'=>'Add'])
<div class="row container-fluid">
    <div class="col-md-12 ">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">{{$title}}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{route('product.handleAdd')}}" method="POST" enctype="multipart/form-data" id="product-form">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="name" maxlength="952">Product name</label>
                  <input type="text" class="form-control"  placeholder="Product name" value="{{ old('name') }}" name="name" data-label="Name">
                </div>
                <div class="form-group">
                  <label for="name_kana">Product name kana</label>
                  <input type="text" class="form-control"  placeholder="Product name kana" value="{{ old('name_kana') }}" name="name_kana" data-label="Product name kana">
                </div>
                <div class="form-group">
                  <label for="alias">Alias</label>
                  <input type="text" class="form-control"   placeholder="Alias" name="alias" value="{{ old('alias') }}" data-label="Alias">
                </div>
                <div class="form-group">
                    <label>Content</label>
                    <textarea class="form-control" rows="3" placeholder="Content" value="{{ old('content') }}" name="content" data-label="Content"></textarea>
                    </div>
                <div class="form-group">
                  <label for="amount">Amount</label>
                  <input type="text" class="form-control"  placeholder="Amount" value="{{ old('amount') }}" name="amount" data-label="Amount">
                </div>
                <div class="form-group">
                  <label for="price">Price</label>
                  <input type="text" class="form-control"  placeholder="price" value="{{ old('price') }}" name="price" data-label="Price">
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
                        <img id="imgPreview" src="#"  width="100px" />
                    </div>
                  </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary" >Create</button>
              </div>
            </form>
          </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
<script src="  {{ asset('/js/admin/views/product/product-add.js')}}"></script>
@endsection