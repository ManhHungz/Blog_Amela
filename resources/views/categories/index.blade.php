@extends('layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title" >All Categories</h3>
                                <a class="btn btn-primary" href="{{ route('categories.create') }}" style="float:right;">Add new category</a>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="myTable" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th style="width: 10%">STT</th>
                                        <th style="width: 20%">Name</th>
                                        <th style="width: 20%">Code</th>
                                        <th style="width: 20%">Brand</th>
                                        <th style="width: 30%">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($datas as $key => $row)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $row -> name }}</td>
                                            <td>{{ $row -> code }}</td>
                                            <td>{{ $row -> brand }}</td>
                                            <td>
                                                <a class="btn btn-primary" href="/categories/{{$row->id}}/view">View</a>
                                                <a class="btn btn-primary" href="/categories/{{$row->id}}/edit">Edit</a>
                                                <form method="post" action="/categories/delete/{{$row->id}}">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger" type="submit" onclick="return confirm('You Sure Want Delete?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div style="float:right">
                                    {{ $datas->links() }}
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
