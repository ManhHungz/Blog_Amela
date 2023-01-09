@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>View Product</h2>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <label for="name">Name</label>
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" value="{{ $product->name }}" readonly>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <label for="price">Price</label>
                    <div class="form-group">
                        <input type="text" class="form-control" name="price" value="{{ $product->price }}" readonly>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <label for="quantity">Quantity</label>
                    <div class="form-group">
                        <input id="quantity" type="text" class="form-control" name="quantity" value="{{ $product->quantity }}" readonly>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <label for="categories">Category</label>
                    <div class="form-group">
                        <input id="categories" type="text" class="form-control" name="categories[]" value="{{ $product_categories }}" readonly>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <label for="product_images">Product Images</label>
                </div>
                <div class="col-md-12 mb-2">
                    @foreach($product_images as $product_image)
                    <img id="preview-image-before-upload" src="{{ asset($product_image) }}"
                         alt="preview image" style="max-height: 150px;">
                    @endforeach
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <label for="shortDescription">Short Description</label>
                    <div class="form-group">
                        <input id="shortDescription" type="text" class="form-control" name="shortDescription" value="{{ $product->shortDescription }}" readonly>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <label for="description">Description</label>
                    <div class="form-group">
                        <textarea id="description" type="text" class="form-control" name="description" style="height: 500px" readonly>{{ $product->description }}</textarea>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
