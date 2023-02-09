@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Add New Product</h2>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
                    </div>
                </div>
            </div>

            <form role="form" action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <label for="name">Name</label>
                        <div class="form-group">
                            <input id="name" type="text" class="form-control" name="name" placeholder="Enter your name" >
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <label for="price">Price</label>
                        <div class="form-group">
                            <input id="price" type="number" class="form-control" name="price" placeholder="Enter price" >
                            @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <label for="quantity">Quantity</label>
                        <div class="form-group">
                            <input id="quantity" type="number" class="form-control" name="quantity" placeholder="Enter quantity" >
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
                                @foreach($categories as $key => $val)
                                    <option value="{{ $key }}">{{ $val }}</option>
                                @endforeach
                            </select>
                            @error('categories')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <label for="product_images">Image</label>
                        <div class="form-group">
                            <input id="product_images" type="file" name="product_images[]" placeholder="Choose image" multiple>
                            @error('product_images')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <label for="shortDescription">Short Description</label>
                        <div class="form-group">
                            <input id="shortDescription" type="text" class="form-control" name="shortDescription" placeholder="Enter short description" >
                            @error('shortDescription')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <label for="description">Description</label>
                        <div class="form-group">
                            <textarea id="description" type="text" class="form-control" name="description" placeholder="Describle your product"></textarea>
                            @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </section>
    </div>
@endsection
