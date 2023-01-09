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
                        <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
                    </div>
                </div>
            </div>
        <form role="form" action="{{ route('users.update',$user->id) }}" method="post">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <label for="name">Name</label>
                <div class="form-group">
                    <input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="Enter your name" >
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <label for="email">Email</label>
                <div class="form-group">
                    <input type="text" class="form-control" name="email" value="{{ $user->email }}" placeholder="Enter your email" >
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <label for="role">Role</label>
                <div class="form-group">
                    <select name="role" id="role" class="form-control">
                        <option value="">{{ 'Choose options' }}</option>
                        @foreach($roles as $key => $val)
                            <option value="{{ $val->id }}"
                                @if ($val->id == $user->role_id)
                                    selected="selected"
                                @endif
                            >{{ $val->name }}</option>
                        @endforeach
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
