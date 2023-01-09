@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Edit Category</h2>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('categories.index') }}"> Back</a>
                    </div>
                </div>
            </div>
        <form role="form" action="{{ route('categories.update',$category->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <label for="name">Name</label>
                <div class="form-group">
                    <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" placeholder="Enter your name" >
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <label for="code">Code</label>
                <div class="form-group">
                    <input type="text" class="form-control" id="code" name="code" value="{{ $category->code }}" placeholder="Enter code" >
                    @error('code')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <label for="brand">Brand</label>
                <div class="form-group">
                    <input type="text" class="form-control" id="brand" name="brand" value="{{ $category->brand }}" placeholder="Enter brand" >
                    @error('brand')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <label for="category_image">Image</label>
                <div class="form-group">
                    <input type="file" id="category_image" name="category_image" placeholder="Choose image" >
                    @error('category_image')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-12 mb-2">
                <img id="preview-image-before-upload" src="{{ asset($category->category_image) }}"
                     alt="preview image" style="max-height: 250px;">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <label for="description">Description</label>
                <div class="form-group">
                    <input type="text" class="form-control" id="description" name="description" value="{{ $category->description }}" placeholder="Enter description" >
                    @error('code')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
        </form>
        </section>
    </div>
@endsection
