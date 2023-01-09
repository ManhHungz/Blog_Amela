@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Edit User</h2>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
                    </div>
                </div>
            </div>
            <form role="form" action="{{ route('products.update',$product->id) }}" method="post"
                  enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <label for="name">Name</label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" value="{{ $product->name }}"
                                   placeholder="Enter your name">
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <label for="price">Price</label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="price" value="{{ $product->price }}"
                                   placeholder="Enter price">
                            @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <label for="quantity">Quantity</label>
                        <div class="form-group">
                            <input id="quantity" type="text" class="form-control" name="quantity"
                                   value="{{ $product->quantity }}">
                        </div>
                        @error('quantity')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <label for="categories">Category</label>
                    <div class="form-group" style="border: solid 1px rgb(195 195 195 / 80%);
    border-radius: 5px">
                        <select name="categories[]" id="categories" class="selectpicker form-control" multiple>
                            @foreach($categories  as $key => $val)
                                <option value="{{ $val->id }}"
                                    {{ in_array($val->id,$product_categories) ? "selected" : "" }}>
                                {{ $val->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('categories')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <label for="product_images">Product Images</label>
                    <div class="form-group">
                        <input id="product_images" type="file" name="product_images[]" placeholder="Choose image" multiple>
                    </div>
                    @error('product_images')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-12 mb-2">
                    @foreach($product_images as $product_image)
                    <img id="preview-image-before-upload" src="{{ asset($product_image) }}"
                         alt="preview image" style="max-height: 250px;">
                    @endforeach
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <label for="shortDescription">Short Description</label>
                    <div class="form-group">
                        <input id="shortDescription" type="text" class="form-control" name="shortDescription"
                               value="{{ $product->shortDescription }}">
                    </div>
                    @error('shortDescription')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <label for="description">Description</label>
                    <div class="form-group">
                        <textarea id="description" type="text" class="form-control" name="description"
                                  style="height: 500px">{{ $product->description }}</textarea>
                    </div>
                    @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
    </div>
    </form>
    </section>
    </div>
@endsection
