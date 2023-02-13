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
                                <h3 class="card-title" >Orders detail</h3>
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-primary" href="{{ route('orders.index') }}"> Back</a>
                            </div>
                            <!-- /.card-header -->

                            <!-- Order detail -->
                            <div class="card-body">
                                <h5 class="card-header">Order Details</h5>
                                <table id="myTable" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th style="width: 30%">Product name</th>
                                        <th style="width: 30%">Product price</th>
                                        <th style="width: 10%">Quantity</th>
                                        <th style="width: 30%">Total amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sub_orders as $key => $row)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $row -> product_title }}</td>
                                            <td>{{ $row -> product_price }}</td>
                                            <td>{{ $row -> quantity }}</td>
                                            <td>{{ ($row -> product_price) * ($row -> quantity) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- User shipping -->
                            <div class="card-body">
                                <h5 class="card-header">Receiver</h5>
                                <table id="myTable" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th style="width: 15%">{{ 'Name' }}</th>
                                        <th style="width: 10%">{{ 'Phone' }}</th>
                                        <th style="width: 75%">{{ 'Address' }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <td>{{ $shipping -> name }}</td>
                                        <td>{{ '0'.$shipping -> phone }}</td>
                                        <td>{{ $shipping -> address }}</td>
                                    </tbody>
                                </table>
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
