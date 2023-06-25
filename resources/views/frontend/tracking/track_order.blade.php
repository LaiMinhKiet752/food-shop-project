@extends('frontend.master_dashboard')
@section('main')
@section('title')
    Order Tracking Page
@endsection
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<style type="text/css">
    body {}

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
    }

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

<div class="container">
    <article class="card">
        <header class="card-header"> My Orders / Tracking </header>
        <div class="card-body">
            <p style="font-size: 18px; font-weight: bold; color: red;">Invoice Number : {{ $track->invoice_number }}
            </p>
            <article class="card">
                <div class="card-body row" style="justify-content: space-evenly;">
                    @php
                        $order_date = strtotime($track->order_date);
                        $order_date_format = date('d-m-Y H:i:s', $order_date);
                    @endphp
                    <div class="col"> <strong>Order Date:</strong> <br>{{ $order_date_format }} </div>
                    <div class="col"> <strong>Shipping By: </strong> <br> <i class="fa fa-shop">
                        </i> Nest Shop | 1900 - 999 <br>
                    </div>

                    <div class="col"> <strong>Shipping To: </strong> <br> <i class="fa fa-person">
                        </i> {{ $track->name }} | <i class="fa fa-phone"></i> {{ $track->phone }} <br>
                        Address :
                        {{ $track->address }},
                        {{ $track->commune->commune_name }},
                        {{ $track->district->district_name }}, {{ $track->city->city_name }}</div>

                    <div class="col"> <strong>Payment Method:</strong> <br>{{ $track->payment_method }} </div>
                    <div class="col"> <strong>Total Amount (USD):</strong> <br>${{ $track->amount }}</div>
                </div>
            </article>
            <div class="track">
                @if ($track->status == 'pending')
                    <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span
                            class="text">Order Pending</span> </div>

                    <div class="step"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text">
                            Order Confirmed</span> </div>

                    <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span
                            class="text">Order Processing </span> </div>

                    <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span
                            class="text">Delivered </span> </div>
                @elseif($track->status == 'confirmed')
                    @php
                        $confirmed_date = strtotime($track->confirmed_date);
                        $confirmed_date_format = date('d-m-Y H:i:s', $confirmed_date);
                    @endphp
                    <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span
                            class="text">Order Pending</span> </div>

                    <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span
                            class="text">
                            Order Confirmed</span>
                        Confirmed Date: {{ $confirmed_date_format }}
                    </div>

                    <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span
                            class="text">Order Processing </span> </div>

                    <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span
                            class="text">Delivered </span> </div>
                @elseif($track->status == 'processing')
                    @php
                        $confirmed_date = strtotime($track->confirmed_date);
                        $confirmed_date_format = date('d-m-Y H:i:s', $confirmed_date);
                        $processing_date = strtotime($track->processing_date);
                        $processing_date_format = date('d-m-Y H:i:s', $processing_date);
                    @endphp
                    <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span
                            class="text">Order Pending</span> </div>

                    <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span
                            class="text">
                            Order Confirmed</span>
                        Confirmed Date: {{ $confirmed_date_format }}
                    </div>

                    <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span
                            class="text">Order Processing </span>
                        Processing Date: {{ $processing_date_format }}
                    </div>

                    <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span
                            class="text">Delivered </span> </div>
                @elseif($track->status == 'delivered')
                    @php
                        $confirmed_date = strtotime($track->confirmed_date);
                        $confirmed_date_format = date('d-m-Y H:i:s', $confirmed_date);
                        $processing_date = strtotime($track->processing_date);
                        $processing_date_format = date('d-m-Y H:i:s', $processing_date);
                        $delivered_date = strtotime($track->delivered_date);
                        $delivered_date_format = date('d-m-Y H:i:s', $delivered_date);
                    @endphp
                    <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span
                            class="text">Order Pending</span> </div>

                    <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span
                            class="text">
                            Order Confirmed</span>
                        Confirmed Date: {{ $confirmed_date_format }}
                    </div>

                    <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span
                            class="text">Order Processing </span>
                        Processing Date: {{ $processing_date_format }}
                    </div>

                    <div class="step active"> <span class="icon"> <i class="fa fa-box"></i> </span> <span
                            class="text">Delivered </span>
                        Delivered Date: {{ $delivered_date_format }}
                    </div>
                @endif

            </div><br>

            <hr>
            <a href="{{ route('user.track.order.page') }}" class="btn btn-warning" data-abc="true"> <i
                    class="fa fa-chevron-left"></i> Go back</a>
        </div>
    </article>
</div>
@endsection
