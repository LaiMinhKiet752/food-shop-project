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
                    <li class="breadcrumb-item active" aria-current="page">Order Details</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                @if ($order->status == 'pending' && $order->cancel_order_status == 0)
                    <div class="btn-group">
                        <a href="{{ route('pending.order') }}" class="btn btn-primary"><i class="lni lni-arrow-left"> Go
                                Back</i></a>
                    </div>
                @elseif($order->status == 'pending' && $order->cancel_order_status == 1)
                    <div class="btn-group">
                        <a href="{{ route('admin.complete.cancel.request') }}" class="btn btn-primary"><i
                                class="lni lni-arrow-left"> Go
                                Back</i></a>
                    </div>
                @elseif($order->status == 'confirmed' && $order->cancel_order_status == 0)
                    <div class="btn-group">
                        <a href="{{ route('admin.confirmed.order') }}" class="btn btn-primary"><i
                                class="lni lni-arrow-left"> Go
                                Back</i></a>
                    </div>
                @elseif($order->status == 'confirmed' && $order->cancel_order_status == 1 )
                    <div class="btn-group">
                        <a href="{{ route('admin.complete.cancel.request') }}" class="btn btn-primary"><i
                                class="lni lni-arrow-left"> Go
                                Back</i></a>
                    </div>
                @elseif($order->status == 'processing')
                    <div class="btn-group">
                        <a href="{{ route('admin.processing.order') }}" class="btn btn-primary"><i
                                class="lni lni-arrow-left"> Go
                                Back</i></a>
                    </div>
                @elseif($order->status == 'delivered' && $order->return_order_status == 0)
                    <div class="btn-group">
                        <a href="{{ route('admin.delivered.order') }}" class="btn btn-primary"><i
                                class="lni lni-arrow-left"> Go
                                Back</i></a>
                    </div>
                @elseif($order->status == 'delivered' && ($order->return_order_status == 1 || $order->return_order_status == 2))
                    <div class="btn-group">
                        <a href="{{ route('admin.complete.return.request') }}" class="btn btn-primary"><i
                                class="lni lni-arrow-left"> Go
                                Back</i></a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr />
    <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-2">
        <div class="col">
            <div class="card">
                <div class="card-header" style="padding: 10px 12px 23px 12px;">
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
                            <span style="font-weight: bold; font-size: 18px; color: red;">Invoice Number :
                                {{ $order->invoice_number }}</span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="card-body">
                    <table class="table" style="background: #F4F6FA; font-weight: 600;">
                        @php
                            $order_date = strtotime($order->order_date);
                            $order_date_format = date('d-m-Y H:i:s', $order_date);

                            $cancel_date = strtotime($order->cancel_date);
                            $cancel_date_format = date('d-m-Y H:i:s', $cancel_date);

                            $confirmed_date = strtotime($order->confirmed_date);
                            $confirmed_date_format = date('d-m-Y H:i:s', $confirmed_date);

                            $processing_date = strtotime($order->processing_date);
                            $processing_date_format = date('d-m-Y H:i:s', $processing_date);

                            $delivered_date = strtotime($order->delivered_date);
                            $delivered_date_format = date('d-m-Y H:i:s', $delivered_date);

                            $return_date = strtotime($order->return_date);
                            $return_date_format = date('d-m-Y H:i:s', $return_date);
                        @endphp
                        <tr>
                            <th>Order Number :</th>
                            <th>{{ $order->order_number }}</th>
                        </tr>
                        <tr>
                            <th>Order Date :</th>
                            <th>{{ $order_date_format }}</th>
                        </tr>
                        <tr>
                            @if ($order->status == 'pending' && $order->cancel_order_status == 1 )
                                <th>Cancel Date :</th>
                                <th>{{ $cancel_date_format }}</th>
                            @elseif ($order->status == 'confirmed' && $order->cancel_order_status == 0)
                                <th>Confirmed Date :</th>
                                <th>{{ $confirmed_date_format }}</th>
                            @elseif($order->status == 'confirmed' && $order->cancel_order_status == 1 )
                                <th>Cancel Date :</th>
                                <th>{{ $cancel_date_format }}</th>
                            @elseif($order->status == 'processing')
                                <th>Processing Date :</th>
                                <th>{{ $processing_date_format }}</th>
                            @elseif($order->status == 'delivered' && $order->return_order_status == 0)
                                <th>Delivered Date :</th>
                                <th>{{ $delivered_date_format }}</th>
                            @elseif($order->status == 'delivered' && ($order->return_order_status == 1 || $order->return_order_status == 2))
                                <th>Return Date :</th>
                                <th>{{ $return_date_format }}</th>
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
                                @elseif($order->status == 'pending' && $order->cancel_order_status == 1 )
                                    <span class="badge bg-secondary" style="font-size: 13px;">
                                        Cancel
                                    </span>
                                @elseif($order->status == 'confirmed' && $order->cancel_order_status == 0)
                                    <span class="badge bg-info" style="font-size: 13px;">
                                        Confirmed
                                    </span>
                                @elseif($order->status == 'confirmed' && $order->cancel_order_status == 1)
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
                        <tr>
                            <th></th>
                            <th>
                                @if ($order->status == 'pending' && $order->cancel_order_status == 0)
                                    <a href="{{ route('pending-confirm', $order->id) }}"
                                        class="btn btn-block btn-success" style="font-weight: bold;"
                                        id="confirm">Confirm Order</a>
                                @elseif($order->status == 'confirmed' && $order->cancel_order_status == 0)
                                    <a href="{{ route('confirm-processing', $order->id) }}"
                                        class="btn btn-block btn-success" style="font-weight: bold;"
                                        id="processing">Processing
                                        Order</a>
                                @elseif($order->status == 'processing')
                                    <a href="{{ route('processing-delivered', $order->id) }}"
                                        class="btn btn-block btn-success" style="font-weight: bold;"
                                        id="delivered">Delivered
                                        Order</a>
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
                                <td class="col-md-1" colspan="4" style="text-align: center;">
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
