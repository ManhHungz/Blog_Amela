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
                                <h3 class="card-title">All Orders</h3>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="myTable" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th style="width: 15%">User name</th>
                                        <th style="width: 15%">User email</th>
                                        <th style="width: 10%">Amount</th>
                                        <th style="width: 20%">Order date</th>
                                        <th style="width: 10%">Status</th>
                                        <th style="width: 30%">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($datas as $key => $row)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $row -> name }}</td>
                                            <td>{{ $row -> email }}</td>
                                            <td>{{ $row -> total_amount }}</td>
                                            <td>{{ $row -> created_at }}</td>
                                            <td>{{ $row -> status }}</td>
                                            <td>
                                                <a class="btn btn-primary" href="/orders/view/{{ $row->id }}">View</a>
                                                <form class="btn btn-success" action=""
                                                      href="/orders/complete/{{ $row->id }}">Complete
                                                </form>

                                                {!! Form::model($fund, ['method' => 'PATCH', 'route' => ['funds.changeStatus', $fund->id]]); !!}
                                                <button type="submit"
                                                        class="btn btn-info">{{ $fund->status == false ? 'Marked Pending' : 'Marked complete' }}</button>
                                                {!! Form::close() !!}
                                                <a class="btn btn-danger"
                                                   href="/orders/refuse/{{ $row->id }}">Refuse</a>
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
