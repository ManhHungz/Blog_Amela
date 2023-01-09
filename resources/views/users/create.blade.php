@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Add New User</h2>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
                    </div>
                </div>
            </div>

            <form role="form" action="{{ route('users.store') }}" method="post">
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
                        <label for="email">Email</label>
                        <div class="form-group">
                            <input id="email" type="text" class="form-control" name="email" placeholder="Enter your email" >
                            @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <label for="password">Password</label>
                        <div class="form-group">
                            <input id="password" type="password" class="form-control" name="password" placeholder="Enter your password" >
                            @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <label for="confirm-password">Confirm Password:</label>
                        <div class="form-group">
                            <input id="confirm-password" type="password" class="form-control" name="confirm-password" placeholder="Confirm your password" >
                            @error('confirm-password')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <label for="role">Role</label>
                        <div class="form-group">
                            <select name="role" id="role" class="form-control" >
                                <option value="">Choose role</option>
                                <option value="1">Admin</option>
                                <option value="2">Customer</option>
                            </select>
                            @error('role')
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
