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
                    <li class="breadcrumb-item active" aria-current="page">Cancel Orders Details</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                @if ($order->cancel_order_status == 1)
                    <div class="btn-group">
                        <a href="{{ route('admin.cancel.request') }}" class="btn btn-primary"><i
                                class="lni lni-arrow-left"> Go Back</i></a>
                    </div>
                @elseif ($order->cancel_order_status == 2)
                    <div class="btn-group">
                        <a href="{{ route('admin.complete.cancel.request') }}" class="btn btn-primary"><i
                                class="lni lni-arrow-left"> Go Back</i></a>
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
                            <span style="font-weight: bold; font-size: 18px; color: red;">Invoice Number :
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
                        @php
                            $order_date = strtotime($order->order_date);
                            $order_date_format = date('d-m-Y H:i:s', $order_date);

                            $cancel_date = strtotime($order->cancel_date);
                            $cancel_date_format = date('d-m-Y H:i:s', $cancel_date);
                        @endphp
                        <tr>
                            <th>Order Date :</th>
                            <th>{{ $order_date_format }}</th>
                        </tr>
                        <tr>
                            <th>Cancel Date :</th>
                            <th>{{ $cancel_date_format }}</th>
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
                            <th>Order Cancel Status :</th>
                            <th>
                                @if ($order->cancel_order_status == 1)
                                    <span class="badge rounded-pill bg-warning" style="font-size: 13px;">
                                        Pending</span>
                                @elseif ($order->cancel_order_status == 2)
                                    <span class="badge rounded-pill bg-success" style="font-size: 13px;">
                                        Success</span>
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
                                            <label>Nest</label>
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
