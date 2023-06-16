@extends('vendor.vendor_dashboard')
@section('vendor')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Order</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Order Details</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <div class="btn-group">
                        <a href="{{ route('vendor.all.order') }}" class="btn btn-primary"><i class="lni lni-arrow-left"> Go
                                Back</i></a>
                    </div>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <hr />
        <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-2">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4>Shipping Details</h4>
                    </div>
                    <hr>
                    <div class="card-body">
                        <table class="table" style="background: #F4F6FA; font-weight: 600;">
                            <tr>
                                <th>Full Name :</th>
                                <th>{{ $order->name }}</th>
                            </tr>
                            <tr>
                                <th>Email :</th>
                                <th>{{ $order->email }}</th>
                            </tr>
                            <tr>
                                <th>Phone Number :</th>
                                <th>{{ $order->phone }}</th>
                            </tr>
                            <tr>
                                <th>Address :</th>
                                <th>{{ $order->address }}</th>
                            </tr>
                            <tr>
                                <th>City/Province :</th>
                                <th>{{ $order['city']['city_name'] }}</th>
                            </tr>
                            <tr>
                                <th>District :</th>
                                <th>{{ $order['district']['district_name'] }}</th>
                            </tr>
                            <tr>
                                <th>Commune :</th>
                                <th>{{ $order['commune']['commune_name'] }}</th>
                            </tr>
                            <tr>
                                <th>Postal Code :</th>
                                <th>{{ $order->post_code }}</th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Order Details</h4>
                            </div>
                            <div class="col-md-6">
                                <span class="text-danger" style="font-weight: bold; font-size: 15px;">Invoice Number :
                                    {{ $order->invoice_number }}</span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="card-body">
                        <table class="table" style="background: #F4F6FA; font-weight: 600;">
                            <tr>
                                <th>Order Number :</th>
                                <th>{{ $order->order_number }}</th>
                            </tr>
                            <tr>
                                <th>Order Date :</th>
                                <th>{{ $order->order_date }}</th>
                            </tr>
                            <tr>
                                @if ($order->status == 'confirmed' && $order->cancel_order_status == 0)
                                    <th>Confirmed Date :</th>
                                    <th>{{ $order->confirmed_date }}</th>
                                @elseif($order->status == 'confirmed' && ($order->cancel_order_status == 1 || $order->cancel_order_status == 2))
                                    <th>Cancel Date :</th>
                                    <th>{{ $order->cancel_date }}</th>
                                @elseif($order->status == 'processing')
                                    <th>Processing Date :</th>
                                    <th>{{ $order->processing_date }}</th>
                                @elseif($order->status == 'delivered' && $order->return_order_status == 0)
                                    <th>Delivered Date :</th>
                                    <th>{{ $order->delivered_date }}</th>
                                @elseif($order->status == 'delivered' && ($order->return_order_status == 1 || $order->return_order_status == 2))
                                    <th>Return Date :</th>
                                    <th>{{ $order->return_date }}</th>
                                @endif
                            </tr>
                            <tr>
                                <th>Discount :</th>
                                <th>${{ $order->discount }}</th>
                            </tr>
                            <tr>
                                <th>Total Amount :</th>
                                <th>${{ $order->amount }}</th>
                            </tr>
                            <tr>
                                <th>Payment Method :</th>
                                <th>{{ $order->payment_method }}</th>
                            </tr>
                            <tr>
                                <th>Payment Type :</th>
                                <th>{{ $order->payment_type }}</th>
                            </tr>
                            <tr>
                                <th>Order Status :</th>
                                <th>
                                    @if ($order->status == 'pending' && $order->cancel_order_status == 0)
                                        <span class="badge bg-warning" style="font-size: 13px;">
                                            Pending
                                        </span>
                                    @elseif($order->status == 'pending' && ($order->cancel_order_status == 1 || $order->cancel_order_status == 2))
                                        <span class="badge bg-secondary" style="font-size: 13px;">
                                            Cancel
                                        </span>
                                    @elseif($order->status == 'confirmed' && $order->cancel_order_status == 0)
                                        <span class="badge bg-info" style="font-size: 13px;">
                                            Confirmed
                                        </span>
                                    @elseif($order->status == 'confirmed' && ($order->cancel_order_status == 1 || $order->cancel_order_status == 2))
                                        <span class="badge bg-secondary" style="font-size: 13px;">
                                            Cancel
                                        </span>
                                    @elseif($order->status == 'processing')
                                        <span class="badge bg-danger" style="font-size: 13px;">
                                            Processing
                                        </span>
                                    @elseif($order->status == 'delivered' && $order->return_order_status == 0)
                                        <span class="badge bg-success" style="font-size: 13px;">
                                            Delivered
                                        </span>
                                    @elseif($order->status == 'delivered' && ($order->return_order_status == 1 || $order->return_order_status == 2))
                                        <span class="badge bg-dark" style="font-size: 13px;">
                                            Return
                                        </span>
                                    @endif
                                </th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-1">
            <div class="col">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table" style="font-weight: 600;">
                            <tbody>
                                <tr style="background: #F4F6FA;">
                                    <td class="col-md-1">
                                        <label>Image </label>
                                    </td>
                                    <td class="col-md-2">
                                        <label>Product Code </label>
                                    </td>
                                    <td class="col-md-2">
                                        <label>Product Name </label>
                                    </td>
                                    <td class="col-md-2">
                                        <label>Vendor Name </label>
                                    </td>
                                    <td class="col-md-2">
                                        <label>Quantity </label>
                                    </td>
                                    <td class="col-md-3">
                                        <label>Price </label>
                                    </td>
                                </tr>
                                @php
                                    $subtotal = 0;
                                @endphp
                                @foreach ($orderItem as $item)
                                    @php
                                        $subtotal = $subtotal + $item->price * $item->quantity;
                                    @endphp
                                    <tr>
                                        <td class="col-md-1">
                                            <label><img src="{{ asset($item->product->product_thumbnail) }}" alt=""
                                                    style="width: 100px; height: 100px;">
                                            </label>
                                        </td>
                                        <td class="col-md-2">
                                            <label>{{ $item->product->product_code }} </label>
                                        </td>
                                        <td class="col-md-2">
                                            <label>{{ $item->product->product_name }} </label>
                                        </td>
                                        @if ($item->vendor_id == null)
                                            <td class="col-md-2">
                                                <label>Owner</label>
                                            </td>
                                        @else
                                            <td class="col-md-2">
                                                <label>{{ $item->product->vendor->shop_name }} </label>
                                            </td>
                                        @endif
                                        <td class="col-md-2">
                                            <label>{{ $item->quantity }} </label>
                                        </td>
                                        <td class="col-md-3">
                                            <label>${{ $item->price }} <br> Total =
                                                ${{ $item->price * $item->quantity }}
                                            </label>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="col-md-1" colspan="5" style="text-align: center;">
                                        <label>Subtotal </label>
                                    </td>
                                    <td class="col-md-1">
                                        <label> = ${{ $subtotal }}</label>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
