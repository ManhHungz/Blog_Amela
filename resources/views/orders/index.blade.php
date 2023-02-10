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
                                <form action="" id="search_lucky" method="get">
                                <div class="row">
                                    <div class="col-md-12" style="display: flex">
                                        <div class="col-md-2">
                                            <label for="from_date">{{ __('From') }}</label>
                                            <?php
                                            $from_date = '';
                                            if (isset($_GET['from_date'])) {
                                                $from_date = trim($_GET['from_date']);
                                            }
                                            ?>
                                            <input type="date" placeholder="Từ ngày" class="form-control"
                                                   name="from_date" id="from_date"
                                                   value="@if($from_date != ''){{$from_date}}@endif"
                                                   max="{{ date("Y-m-d") }}">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="to_date">{{ __('To') }}</label>
                                            <?php
                                            $to_date = date('Y-m-d');
                                            if (isset($_GET['to_date'])) {
                                                $to_date = trim($_GET['to_date']);
                                            }
                                            ?>
                                            <input type="date" placeholder="Từ ngày" class="form-control"
                                                   name="to_date" id="to_date"
                                                   value="{{$to_date}}"
                                                   max="{{ date("Y-m-d") }}">
                                        </div>
                                        <div class="col-md-2" style="align-items: flex-end;
    display: flex;">
                                            <button type="submit" class="btn btn-primary mr-2 search"><i
                                                    class="fa fa-search"></i> Tìm kiếm
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                </form>
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
