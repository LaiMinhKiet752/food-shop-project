@extends('frontend.master_dashboard')
@section('main')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Return Orders
            </div>
        </div>
    </div>
    <div class="page-content pt-50 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 m-auto">
                    <div class="row">
                        {{-- Start col-md-2 --}}
                        @include('frontend.body.dashboard_sidebar_menu')
                        {{-- End col-md-2 --}}
                        <div class="col-md-10">
                            <div class="tab-content account dashboard-content pl-50">
                                <div class="tab-pane fade active show" id="dashboard" role="tabpanel"
                                    aria-labelledby="dashboard-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="mb-0">Your Return Orders</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table" style="background: #ddd; font-weight: 600;">
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Invoice Number</th>
                                                            <th>Order Date</th>
                                                            <th>Total Amount</th>
                                                            <th>Payment Method</th>
                                                            <th>Return Reason</th>
                                                            <th>Status</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($orders as $key => $order)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>{{ $order->invoice_number }}</td>
                                                                <td>{{ $order->order_date }}</td>
                                                                <td>${{ $order->amount }}</td>
                                                                <td>{{ $order->payment_method }}</td>
                                                                <td>{{ $order->return_reason }}</td>
                                                                <td>
                                                                    @if ($order->return_order_status == 0)
                                                                        <span class="badge rounded-pill bg-info"
                                                                            style="font-size: 13px;">
                                                                            No Return Request
                                                                        </span>
                                                                    @elseif($order->return_order_status == 1)
                                                                        <span class="badge rounded-pill bg-warning"
                                                                            style="font-size: 13px;">
                                                                            Pending
                                                                        </span>
                                                                    @elseif($order->return_order_status == 2)
                                                                        <span class="badge rounded-pill bg-success"
                                                                            style="font-size: 13px;">
                                                                            Return Successful
                                                                        </span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <a href="{{ url('user/order/details/' . $order->id) }}"
                                                                        class="btn-sm btn-success"><i class="fa fa-eye">
                                                                            View</i></a>
                                                                    <a href="{{ url('user/invoice/download/' . $order->id) }}"
                                                                        class="btn-sm btn-danger"><i class="fa fa-download">
                                                                            Invoice</i></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
