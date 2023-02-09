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
                                        <th style="width: 15%">{{ 'User order' }}</th>
                                        <th style="width: 15%">{{ 'User email' }}</th>
                                        <th style="width: 10%">{{ 'Amount' }}</th>
                                        <th style="width: 20%">{{ 'Order date' }}</th>
                                        <th style="width: 10%">{{ 'Status' }}</th>
                                        <th style="width: 30%">{{ 'Action' }}</th>
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

                                            @if($row -> status == -1)
                                                <td>{{ $row -> status_title }}</td>
                                            @else
                                                <td>{{ $row -> status_title }}</td>
                                            @endif
                                            <td>
                                                <a class="btn btn-primary" href="/orders/view/{{ $row->id }}">View</a>
                                            @if($row -> status == 1 || $row -> status == 0)
                                                <form method="post" action="/orders/complete/{{ $row->id }}">
                                                @csrf
                                                @method('put')
                                                <button class="btn btn-success" type="submit">Complete</button>
                                            @endif
                                            @if($row -> status == 0)
                                                    </form>
                                                    <form method="post" action="/orders/refuse/{{ $row->id }}">
                                                        @csrf
                                                        @method('put')
                                                        <button class="btn btn-danger" type="submit">Refuse</button>
                                                    </form>
                                                @endif
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
