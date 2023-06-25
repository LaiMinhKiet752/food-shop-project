@extends('admin.admin_dashboard')
@section('admin')
@section('title')
    Cancel Order
@endsection
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Cancel Order</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Cancel Request Orders</li>
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
                            <th>Invoice Number</th>
                            <th>Order Date</th>
                            <th>Cancel Date</th>
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
                                <td>{{ $item->invoice_number }}</td>
                                @php
                                    $order_date = strtotime($item->order_date);
                                    $order_date_format = date('d-m-Y H:i:s', $order_date);

                                    $cancel_date = strtotime($item->cancel_date);
                                    $cancel_date_format = date('d-m-Y H:i:s', $cancel_date);
                                @endphp
                                <td>{{ $order_date_format }}</td>
                                <td>{{ $cancel_date_format }}</td>
                                <td>${{ $item->amount }}</td>
                                <td>{{ $item->payment_method }}</td>
                                <td>
                                    <span class="badge rounded-pill bg-warning" style="font-size: 13px;">
                                        Pending</span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.cancel.order.details', $item->id) }}" class="btn btn-info"
                                        title="Details"><i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.cancel.request.approved', $item->id) }}"
                                        class="btn btn-danger" title="Approved" id="approved_cancel"><i
                                            class="fa-solid fa-check"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Invoice Number</th>
                            <th>Order Date</th>
                            <th>Cancel Date</th>
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
