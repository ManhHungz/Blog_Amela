@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>View Category</h2>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('categories.index') }}"> Back</a>
                    </div>
                </div>
            </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <label for="name">Name</label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" value="{{ $category->name }}" readonly>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <label for="code">Code</label>
                        <div class="form-group">
                            <input id="text" type="text" class="form-control" name="code" value="{{ $category->code }}" readonly>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <label for="brand">Brand</label>
                        <div class="form-group">
                            <input id="brand" type="text" class="form-control" name="brand" value="{{ $category->brand }}" readonly>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <label for="category_image">Image</label>
                    </div>
                    <div class="col-md-12 mb-2">
                        <img id="preview-image-before-upload" src="{{ asset($category->category_image) }}"
                             alt="preview image" style="max-height: 250px;">
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <label for="description">Description</label>
                        <div class="form-group">
                            <input id="description" type="text" class="form-control" name="description" value="{{ $category->description }}" readonly>
                        </div>
                    </div>
                </div>

        </section>
    </div>
@endsection
