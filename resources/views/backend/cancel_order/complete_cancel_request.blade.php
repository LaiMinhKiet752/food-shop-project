@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Cancel Order</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Completed Cancel Orders</li>
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
                                    <td>{{ $item->order_date }}</td>
                                    <td>{{ $item->cancel_date }}</td>
                                    <td>${{ $item->amount }}</td>
                                    <td>{{ $item->payment_method }}</td>
                                    <td>
                                        @if ($item->cancel_order_status == 1)
                                            <span class="badge rounded-pill bg-warning" style="font-size: 13px;">
                                                Pending</span>
                                        @elseif ($item->cancel_order_status == 2)
                                            <span class="badge rounded-pill bg-success" style="font-size: 13px;">
                                                Success</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.cancel.order.details', $item->id) }}" class="btn btn-info"
                                            title="Details"><i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Invoice Number</th>
                                <th>No.</th>
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
