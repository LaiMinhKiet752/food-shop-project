@extends('admin.admin_dashboard')
@section('admin')
@section('title')
    Report
@endsection
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Report</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    @if (count($orders) > 1)
                        <li class="breadcrumb-item active" aria-current="page">Report By Customer <span
                                class="badge rounded-pill bg-danger">{{ count($orders) }} invoices</span></li>
                    @else
                        <li class="breadcrumb-item active" aria-current="page">Report By Customer <span
                                class="badge rounded-pill bg-danger">{{ count($orders) }} invoice</span></li>
                    @endif
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <div class="btn-group">
                    <a href="{{ route('report.by.customer') }}" class="btn btn-primary"><i class="lni lni-arrow-left">
                            Go
                            Back</i></a>
                </div>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr />
    <label class="form-label" style="font-size: 20px; color: black; font-weight: bold;">Full Name:
        {{ $user_info->name }} </label> <br>
    <label class="form-label" style="font-size: 20px; color: black; font-weight: bold;">Email:
        {{ $user_info->email }} </label> <br>
    <label class="form-label" style="font-size: 20px; color: black; font-weight: bold;">Phone Number:
        {{ $user_info->phone }}</label>
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
                                <td>
                                    @if ($item['status'] == 'pending' && $item['cancel_order_status'] == 0)
                                        <span class="badge rounded-pill bg-warning" style="font-size: 13px;">
                                            Pending
                                        </span>
                                    @elseif ($item['status'] == 'pending' && ($item['cancel_order_status'] == 1 || $item['cancel_order_status'] == 2))
                                        <span class="badge rounded-pill bg-secondary" style="font-size: 13px;">
                                            Cancel
                                        </span>
                                    @elseif ($item['status'] == 'confirmed' && $item['cancel_order_status'] == 0)
                                        <span class="badge rounded-pill bg-info" style="font-size: 13px;">
                                            Confirmed
                                        </span>
                                    @elseif($item['status'] == 'confirmed' && ($item['cancel_order_status'] == 1 || $item['cancel_order_status'] == 2))
                                        <span class="badge rounded-pill bg-secondary" style="font-size: 13px;">
                                            Cancel
                                        </span>
                                    @elseif ($item['status'] == 'processing')
                                        <span class="badge rounded-pill bg-danger" style="font-size: 13px;">
                                            Processing
                                        </span>
                                    @elseif($item['status'] == 'delivered' && $item['return_order_status'] == 0)
                                        <span class="badge rounded-pill bg-success" style="font-size: 13px;">
                                            Delivered
                                        </span>
                                    @elseif ($item['return_order_status'] == 1 || $item['return_order_status'] == 2)
                                        <span class="badge rounded-pill bg-dark" style="font-size: 13px;">
                                            Return
                                        </span>
                                    @endif
                                </td>
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
