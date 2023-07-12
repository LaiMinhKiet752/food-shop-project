@extends('frontend.master_dashboard')
@section('main')
@section('title')
    Order Details
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<style type="text/css">
    /* body {}

    .container {}

    .card {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 0.10rem
    }

    .card-header:first-child {
        border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0
    }

    .card-header {
        padding: 0.75rem 1.25rem;
        margin-bottom: 0;
        background-color: #fff;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1)
    } */

    .track {
        position: relative;
        background-color: #ddd;
        height: 7px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        margin-bottom: 60px;
        margin-top: 50px
    }

    .track .step {
        -webkit-box-flex: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;
        width: 25%;
        margin-top: -18px;
        text-align: center;
        position: relative
    }

    .track .step.active:before {
        background: #3BB77E
    }

    .track .step.cancel:before {
        background: #ff0000
    }

    .track .step::before {
        height: 7px;
        position: absolute;
        content: "";
        width: 100%;
        left: 0;
        top: 18px
    }

    .track .step.active .icon {
        background: #3BB77E;
        color: #fff
    }

    .track .step.active.cancel .icon {
        background: #ff0000;
        color: #fff
    }

    .track .icon {
        display: inline-block;
        width: 40px;
        height: 40px;
        line-height: 40px;
        position: relative;
        border-radius: 100%;
        background: #ddd
    }

    .track .step.active .text {
        font-weight: 400;
        color: #000
    }

    .track .text {
        display: block;
        margin-top: 7px
    }

    .itemside {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        width: 100%
    }

    .itemside .aside {
        position: relative;
        -ms-flex-negative: 0;
        flex-shrink: 0
    }

    .img-sm {
        width: 80px;
        height: 80px;
        padding: 7px
    }

    ul.row,
    ul.row-sm {
        list-style: none;
        padding: 0
    }

    .itemside .info {
        padding-left: 15px;
        padding-right: 7px
    }

    .itemside .title {
        display: block;
        margin-bottom: 5px;
        color: #212529
    }

    p {
        margin-top: 0;
        margin-bottom: 1rem
    }

    .btn-warning {
        color: #ffffff;
        background-color: #3BB77E;
        border-color: #3BB77E;
        border-radius: 1px
    }

    .btn-warning:hover {
        color: #ffffff;
        background-color: #3BB77E;
        border-color: #3BB77E;
        border-radius: 1px
    }
</style>
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>HOME</a>
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
                            <div class="col-md-12">
                                <div class="track">
                                    @if ($order->status == 'pending' && $order->cancel_order_status == 0)
                                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span
                                                class="text">Order Pending</span> </div>

                                        <div class="step"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">
                                                Order Confirmed</span> </div>

                                        <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span
                                                class="text">Order Processing </span> </div>

                                        <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span
                                                class="text">Delivered </span> </div>
                                    @elseif(
                                        $order->status == 'pending' &&
                                            $order->confirmed_date == null &&
                                            ($order->cancel_order_status == 1 || $order->cancel_order_status == 2))
                                        @php
                                            $cancel_date = strtotime($order->cancel_date);
                                            $cancel_date_format = date('d-m-Y H:i:s', $cancel_date);
                                        @endphp
                                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span
                                                class="text">Order Pending</span> </div>
                                        <div class="step active cancel"> <span class="icon"> <i class="fa-solid fa-rectangle-xmark"></i>
                                            </span> <span class="text">
                                                Cancel</span>
                                            Date: {{ $cancel_date_format }}
                                        </div>
                                    @elseif($order->status == 'confirmed' && $order->cancel_order_status == 0)
                                        @php
                                            $confirmed_date = strtotime($order->confirmed_date);
                                            $confirmed_date_format = date('d-m-Y H:i:s', $confirmed_date);
                                        @endphp
                                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span
                                                class="text">Order Pending</span> </div>

                                        <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span
                                                class="text">
                                                Order Confirmed</span>
                                            Date: {{ $confirmed_date_format }}
                                        </div>

                                        <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span
                                                class="text">Order Processing </span> </div>

                                        <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span
                                                class="text">Delivered </span> </div>
                                    @elseif($order->status == 'confirmed' && ($order->cancel_order_status == 1 || $order->cancel_order_status == 2))
                                        @php
                                            $confirmed_date = strtotime($order->confirmed_date);
                                            $confirmed_date_format = date('d-m-Y H:i:s', $confirmed_date);

                                            $cancel_date = strtotime($order->cancel_date);
                                            $cancel_date_format = date('d-m-Y H:i:s', $cancel_date);
                                        @endphp
                                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span
                                                class="text">Order Pending</span> </div>

                                        <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span
                                                class="text">
                                                Order Confirmed</span>
                                            Date: {{ $confirmed_date_format }}
                                        </div>
                                        <div class="step active cancel"> <span class="icon"> <i class="fa-solid fa-rectangle-xmark"></i>
                                            </span> <span class="text">
                                                Cancel</span>
                                            Date: {{ $cancel_date_format }}
                                        </div>
                                    @elseif($order->status == 'processing')
                                        @php
                                            $confirmed_date = strtotime($order->confirmed_date);
                                            $confirmed_date_format = date('d-m-Y H:i:s', $confirmed_date);

                                            $processing_date = strtotime($order->processing_date);
                                            $processing_date_format = date('d-m-Y H:i:s', $processing_date);
                                        @endphp
                                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span
                                                class="text">Order Pending</span> </div>

                                        <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span
                                                class="text">
                                                Order Confirmed</span>
                                            Date: {{ $confirmed_date_format }}
                                        </div>

                                        <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span
                                                class="text">Order Processing </span>
                                            Date: {{ $processing_date_format }}
                                        </div>

                                        <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span
                                                class="text">Delivered </span> </div>
                                    @elseif($order->status == 'delivered' && $order->return_order_status == 0)
                                        @php
                                            $confirmed_date = strtotime($order->confirmed_date);
                                            $confirmed_date_format = date('d-m-Y H:i:s', $confirmed_date);

                                            $processing_date = strtotime($order->processing_date);
                                            $processing_date_format = date('d-m-Y H:i:s', $processing_date);

                                            $delivered_date = strtotime($order->delivered_date);
                                            $delivered_date_format = date('d-m-Y H:i:s', $delivered_date);
                                        @endphp
                                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span
                                                class="text">Order Pending</span> </div>

                                        <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span
                                                class="text">
                                                Order Confirmed</span>
                                            Date: {{ $confirmed_date_format }}
                                        </div>

                                        <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span
                                                class="text">Order Processing </span>
                                            Date: {{ $processing_date_format }}
                                        </div>

                                        <div class="step active"> <span class="icon"> <i class="fa fa-box"></i> </span> <span
                                                class="text">Delivered </span>
                                            Date: {{ $delivered_date_format }}
                                        </div>
                                    @elseif($order->status == 'delivered' && ($order->return_order_status == 1 || $order->return_order_status == 2))
                                        @php
                                            $confirmed_date = strtotime($order->confirmed_date);
                                            $confirmed_date_format = date('d-m-Y H:i:s', $confirmed_date);

                                            $processing_date = strtotime($order->processing_date);
                                            $processing_date_format = date('d-m-Y H:i:s', $processing_date);

                                            $delivered_date = strtotime($order->delivered_date);
                                            $delivered_date_format = date('d-m-Y H:i:s', $delivered_date);

                                            $return_date = strtotime($order->return_date);
                                            $return_date_format = date('d-m-Y H:i:s', $return_date);
                                        @endphp
                                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span
                                                class="text">Order Pending</span> </div>

                                        <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span
                                                class="text">
                                                Order Confirmed</span>
                                            Date: {{ $confirmed_date_format }}
                                        </div>

                                        <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span
                                                class="text">Order Processing </span>
                                            Date: {{ $processing_date_format }}
                                        </div>

                                        <div class="step active"> <span class="icon"> <i class="fa fa-box"></i> </span> <span
                                                class="text">Delivered </span>
                                            Date: {{ $delivered_date_format }}
                                        </div>

                                        <div class="step active cancel"> <span class="icon"> <i class="fa-solid fa-arrow-rotate-left"></i>
                                            </span> <span class="text">
                                                Return</span>
                                            Date: {{ $return_date_format }}
                                        </div>
                                    @endif

                                </div><br>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header" style="padding: 16px 27px 38px 27px;">
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
                                            @endphp
                                            <tr>
                                                <th>Order Date :</th>
                                                <th>{{ $order_date_format }}</th>
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
                        <textarea name="return_reason" class="form-control" placeholder="Please enter a reason for returning the order..."
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
                    maxlength: 500,
                },
            },
            messages: {
                return_reason: {
                    required: 'Please enter order return reason.',
                    maxlength: 'The order return reason must not be greater than 500 characters.',
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
