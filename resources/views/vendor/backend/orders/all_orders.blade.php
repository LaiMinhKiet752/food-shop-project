@extends('vendor.vendor_dashboard')
@section('vendor')
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
                    <li class="breadcrumb-item active" aria-current="page">All Orders</li>
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
                            <th>Total Amount</th>
                            <th>Payment Method</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderdetails as $key => $item)
                            <tr>
                                <td> {{ $key + 1 }} </td>
                                <td>{{ $item['order']['invoice_number'] }}</td>
                                <td>{{ $item['order']['order_date'] }}</td>
                                <td>${{ $item['order']['amount'] }}</td>
                                <td>{{ $item['order']['payment_method'] }}</td>
                                <td>
                                    @if ($item['order']['status'] == 'pending' && $item['order']['cancel_order_status'] == 0)
                                        <span class="badge rounded-pill bg-warning" style="font-size: 13px;">
                                            Pending
                                        </span>
                                    @elseif (
                                        $item['order']['status'] == 'pending' &&
                                            ($item['order']['cancel_order_status'] == 1 || $item['order']['cancel_order_status'] == 2))
                                        <span class="badge rounded-pill bg-secondary" style="font-size: 13px;">
                                            Cancel
                                        </span>
                                    @elseif ($item['order']['status'] == 'confirmed' && $item['order']['cancel_order_status'] == 0)
                                        <span class="badge rounded-pill bg-info" style="font-size: 13px;">
                                            Confirmed
                                        </span>
                                    @elseif(
                                        $item['order']['status'] == 'confirmed' &&
                                            ($item['order']['cancel_order_status'] == 1 || $item['order']['cancel_order_status'] == 2))
                                        <span class="badge rounded-pill bg-secondary" style="font-size: 13px;">
                                            Cancel
                                        </span>
                                    @elseif ($item['order']['status'] == 'processing')
                                        <span class="badge rounded-pill bg-danger" style="font-size: 13px;">
                                            Processing
                                        </span>
                                    @elseif($item['order']['status'] == 'delivered' && $item['order']['return_order_status'] == 0)
                                        <span class="badge rounded-pill bg-success" style="font-size: 13px;">
                                            Delivered
                                        </span>
                                    @elseif ($item['order']['return_order_status'] == 1 || $item['order']['return_order_status'] == 2)
                                        <span class="badge rounded-pill bg-dark" style="font-size: 13px;">
                                            Return
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('vendor.order.details', $item['order']['id']) }}"
                                        class="btn btn-info" title="Details"><i class="fa fa-eye"></i>
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
