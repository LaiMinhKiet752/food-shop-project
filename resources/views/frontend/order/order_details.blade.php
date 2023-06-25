@extends('frontend.master_dashboard')
@section('main')
@section('title')
    Order Details
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> Your Orders
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
                        <div class="row">
                            <div class="col-md-6">
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
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h4>Order Details</h4>
                                            </div>
                                            <div class="col-md-6">
                                                <span style="font-weight: bold; font-size: 18px; color: red;">Invoice
                                                    Number :
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
                                                <th>Order Date :</th>
                                                <th>{{ $order_date_format }}</th>
                                            </tr>
                                            <tr>
                                                @if ($order->status == 'pending' && ($order->cancel_order_status == 1 || $order->cancel_order_status == 2))
                                                    <th>Cancel Date :</th>
                                                    <th>{{ $cancel_date_format }}</th>
                                                @elseif ($order->status == 'confirmed' && $order->cancel_order_status == 0)
                                                    <th>Confirmed Date :</th>
                                                    <th>{{ $confirmed_date_format }}</th>
                                                @elseif($order->status == 'confirmed' && ($order->cancel_order_status == 1 || $order->cancel_order_status == 2))
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
                                            @if (
                                                ($order->status == 'pending' && ($order->cancel_order_status == 1 || $order->cancel_order_status == 2)) ||
                                                    ($order->status == 'confirmed' && ($order->cancel_order_status == 1 || $order->cancel_order_status == 2)))
                                            @elseif(($order->status == 'pending' || $order->status == 'confirmed') && $order->cancel_order_status == 0)
                                                <form action="{{ route('user.cancel.order.submit') }}" method="post"
                                                    id="SubmitFormCancelOrder">
                                                    @csrf
                                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                    <tr>
                                                        <th></th>
                                                        <th>
                                                            <button type="submit"
                                                                class="btn btn-heading btn-block hover-up"
                                                                onclick="submitCancelOrder(event)">Cancel
                                                                Order</button>
                                                        </th>
                                                    </tr>
                                                </form>
                                            @endif
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

<div class="container">
    <div class="row">
        <div class="col-md-12">
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
        @if ($order->status !== 'delivered')
        @else
            @php
                $order_check = \App\Models\Order::where('id', $order->id)
                    ->where('return_reason', '=', null)
                    ->first();
            @endphp
            @if ($order_check)
                <form action="{{ route('user.return.order', $order->id) }}" method="POST" id="myFormOrderReturn">
                    @csrf
                    <div class="form-group"
                        style="font-weight: 600; font-size: initial; color: #000000; margin-top: 20px;">
                        <label class="form-group">Order Return Reason<span class="text-danger"> * </span></label>
                        <textarea name="return_reason" class="form-control" placeholder="Please enter a reason for the return of the order..."
                            style="height: 100px;"></textarea>
                    </div>
                    <button type="submit" class="btn-sm"
                        style="max-width: 10%; margin-left: 10px; margin-top: 20px; margin-bottom: 20px;">Order
                        Return</button>
                </form>
            @else
                <h5><span style="color: red;">You Have Send Return Request For This Invoice!</span>
                </h5><br><br>
            @endif
        @endif
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#myFormOrderReturn').validate({
            rules: {
                return_reason: {
                    required: true,
                    maxlength: 255,
                },
            },
            messages: {
                return_reason: {
                    required: 'Please enter order return reason.',
                    maxlength: 'The order return reason must not be greater than 255 characters.',
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });
    });
</script>

<script>
    function submitCancelOrder(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            timer: 5000,
            timerProgressBar: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, cancel it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("SubmitFormCancelOrder").submit();
            }
        })
    }
</script>

@endsection
