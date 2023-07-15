@extends('frontend.master_dashboard')
@section('main')
@section('title')
    Checkout Page
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>HOME</a>
            <span></span> Checkout
        </div>
    </div>
</div>
<form method="post" action="{{ route('checkout.store') }}" id="myForm">
    @csrf
    <div class="container mb-80 mt-50">
        <div class="row">
            <div class="col-lg-8 mb-40">
                <h3 class="heading-2 mb-10">Checkout</h3>
                <div class="d-flex justify-content-between">
                    <h6 class="text-body">There are <span class="text-brand">{{ $cartQty }}</span>
                        products in your cart</h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7">
                <div class="row">
                    <h4 class="mb-30">Billing Details</h4>

                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" required="" name="shipping_name"
                                value="{{ Auth::user()->name }}">
                        </div>
                        <div class="form-group col-lg-6">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input class="form-control" type="email" required="" name="shipping_email"
                                value="{{ Auth::user()->email }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                            <input class="form-control" required="" type="text" name="shipping_phone"
                                value="{{ Auth::user()->phone }}">
                        </div>
                        <div class="form-group col-lg-6">
                            <label class="form-label">Postal Code <span class="text-danger">*</span></label>
                            <input class="form-control" required="" type="text" name="post_code"
                                placeholder="Postal code...">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label class="form-label">Address <span class="text-danger">*</span></label>
                            <input class="form-control" required="" type="text" name="shipping_address"
                                placeholder="Street, No." value="{{ Auth::user()->address }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label class="form-label">Note </label>
                            <textarea rows="5" placeholder="Additional information . . ." name="notes"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="border p-40 cart-totals ml-30 mb-50">
                    <div class="d-flex align-items-end justify-content-between mb-30">
                        <h4>Your Order</h4>
                    </div>
                    <div class="divider-2 mb-30"></div>
                    <div class="table-responsive order_table checkout">
                        <table class="table no-border">
                            <tbody>
                                @foreach ($carts as $item)
                                    <tr>
                                        <td class="image product-thumbnail"><img
                                                src="{{ asset($item->options->image) }}" alt="#"
                                                style="width: 80px; height: 80px;">
                                        </td>
                                        <td>
                                            <h6 class="w-160 mb-5"><a href="shop-product-full.html"
                                                    class="text-heading">{{ $item->name }}</a></h6></span>
                                            <div class="product-rate-cover">
                                            </div>
                                        </td>
                                        <td>
                                            <h6 class="text-muted pl-20 pr-20">x {{ $item->qty }}</h6>
                                        </td>
                                        <td>
                                            <h4 class="text-brand">${{ $item->price }}</h4>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <table class="table no-border">
                            <tbody>
                                @if (Session::has('coupon'))
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Subtotal</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">${{ $cartTotal }}</h4>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Coupon Code</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h6 class="text-brand text-end">
                                                {{ session()->get('coupon')['coupon_code'] }}
                                                (-{{ session()->get('coupon')['coupon_discount'] }}%)
                                            </h6>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Coupon Discount</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">
                                                ${{ session()->get('coupon')['discount_amount'] }}</h4>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Grand Total</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">
                                                ${{ session()->get('coupon')['total_amount'] }}
                                            </h4>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Grand Total</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">${{ $cartTotal }}</h4>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="payment ml-30">
                    <h4 class="mb-30">Payment</h4>
                    <div class="payment_option">
                        <div class="custome-radio">
                            <input class="form-check-input" required="" type="radio" name="payment_option"
                                value="paypal" id="exampleRadios1" checked="">
                            <label class="form-check-label" for="exampleRadios1" data-bs-toggle="collapse"
                                data-target="#paypal" aria-controls="paypal">Paypal Payment</label>
                        </div>
                        <div class="custome-radio">
                            <input class="form-check-input" required="" type="radio" name="payment_option"
                                value="stripe" id="exampleRadios2">
                            <label class="form-check-label" for="exampleRadios2" data-bs-toggle="collapse"
                                data-target="#bankTranfer" aria-controls="bankTranfer">Stripe Payment</label>
                        </div>
                        <div class="custome-radio">
                            <input class="form-check-input" required="" type="radio" name="payment_option"
                                value="mollie" id="exampleRadios3">
                            <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse"
                                data-target="#paypal1" aria-controls="paypal1">Mollie Payment</label>
                        </div>
                        <div class="custome-radio">
                            <input class="form-check-input" required="" type="radio" name="payment_option"
                                value="cash" id="exampleRadios4">
                            <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse"
                                data-target="#checkPayment" aria-controls="checkPayment">Cash On Delivery</label>
                        </div>

                    </div>
                    <div class="payment-logo d-flex">
                        <img class="mr-15" src="{{ asset('frontend/assets/imgs/theme/icons/payment-paypal.svg') }}"
                            alt="" style="width: 110px; height: 50px; margin-top: 5px;">

                        <img class="mr-15" src="{{ asset('frontend/assets/imgs/theme/icons/payment-visa.svg') }}"
                            alt="">

                        <img class="mr-15" src="{{ asset('frontend/assets/imgs/theme/icons/payment-master.svg') }}"
                            alt="" style="width: 80px; height: 40px; margin-top: 10px;">

                        <img class="mr-15" src="{{ asset('upload/mollie.png') }}" alt=""
                            style="width: 80px; height: 35px; margin-top: 13px;">

                        <img src="{{ asset('upload/stripe.png') }}" alt=""
                            style="width: 90px; height: 50px; margin-top: 5px;">

                        <img src="{{ asset('upload/cash_on_delivery.png') }}" alt=""
                            style="width: 100px; height: 60px;">
                    </div>
                    <button type="submit" class="btn btn-fill-out btn-block mt-30">Place an Order<i
                            class="fi-rs-sign-out ml-15"></i></button>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function() {
        $('#myForm').validate({
            rules: {
                shipping_name: {
                    required: true,
                    maxlength: 255,
                },
                shipping_email: {
                    required: true,
                    maxlength: 255,
                    email: true,
                },
                shipping_phone: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                    digits: true,
                },
                post_code: {
                    required: true,
                    digits: true,
                },
                shipping_address: {
                    required: true,
                    maxlength: 255,
                },
            },
            messages: {
                shipping_name: {
                    required: 'Please enter your full name.',
                    maxlength: 'The full name must not be greater than 255 characters.',
                },
                shipping_email: {
                    required: 'Please enter your email.',
                    maxlength: 'The email must not be greater than 255 characters.',
                    email: 'The email must be a valid email address.',
                },
                shipping_phone: {
                    required: 'Please enter your phone number.',
                    minlength: 'Please enter 10 numeric characters correctly.',
                    maxlength: 'Please enter 10 numeric characters correctly.',
                    digits: 'Please enter 10 numeric characters correctly.',
                },
                post_code: {
                    required: 'Please enter your postal code.',
                    digits: 'Please enter numeric characters correctly.',
                },
                shipping_address: {
                    required: 'Please enter your address.',
                    maxlength: 'The address must not be greater than 255 characters.',
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
@endsection
