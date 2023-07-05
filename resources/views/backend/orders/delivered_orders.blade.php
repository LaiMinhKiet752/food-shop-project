@extends('admin.admin_dashboard')
@section('admin')
@section('title')
    Order
@endsection
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Order</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Orders Delivered: <span
                        class="badge rounded-pill bg-danger">{{ count($orders) }}</span></li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">

            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Order Date</th>
                            <th>Invoice Number</th>
                            <th>Total Amount</th>
                            <th>Payment Method</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $key => $item)
                            <tr>
                                <td> {{ $key + 1 }} </td>
                                @php
                                    $order_date = strtotime($item->order_date);
                                    $order_date_format = date('d-m-Y H:i:s', $order_date);
                                @endphp
                                <td>{{ $order_date_format }}</td>
                                <td>{{ $item->invoice_number }}</td>
                                <td>${{ $item->amount }}</td>
                                <td>{{ $item->payment_method }}</td>
                                <td> <span class="badge rounded-pill bg-success" style="font-size: 13px;">
                                        Delivered</span></td>
                                <td>
                                    <a href="{{ route('admin.order.details', $item->id) }}" class="btn btn-info"
                                        title="Details"><i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.invoice.download', $item->id) }}" class="btn btn-danger"
                                        title="Invoice Download PDF"><i class="fa fa-download"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Order Date</th>
                            <th>Invoice Number</th>
                            <th>Total Amount</th>
                            <th>Payment Method</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
