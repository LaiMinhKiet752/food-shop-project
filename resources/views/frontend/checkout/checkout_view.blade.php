@extends('frontend.master_dashboard')
@section('main')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
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
                @if (Auth::user()->address == null)
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

                            <div class="row shipping_calculator">
                                <div class="form-group col-lg-6">
                                    <div class="custom_select">
                                        <label class="form-label">Select City, Province <span
                                                class="text-danger">*</span></label>
                                        <select required="" name="city_id" class="form-control select-active">
                                            <option selected="" disabled="" value="">Select City, Province
                                            </option>
                                            @foreach ($cities as $item)
                                                <option value="{{ $item->id }}">{{ $item->city_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                                    <input class="form-control" required="" type="text" name="shipping_phone"
                                        value="{{ Auth::user()->phone }}">
                                </div>
                            </div>

                            <div class="row shipping_calculator">
                                <div class="form-group col-lg-6">
                                    <div class="custom_select">
                                        <label class="form-label">Select District <span class="text-danger">*</span></label>
                                        <select required="" name="district_id" class="form-control select-active">

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="form-label">Postal Code <span class="text-danger">*</span></label>
                                    <input class="form-control" required="" type="text" name="post_code"
                                        placeholder="Postal code...">
                                </div>
                            </div>

                            <div class="row shipping_calculator">
                                <div class="form-group col-lg-6">
                                    <div class="custom_select">
                                        <label class="form-label">Select Commune <span class="text-danger">*</span></label>
                                        <select required="" name="commune_id" class="form-control select-active">

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="form-label">Address <span class="text-danger">*</span></label>
                                    <input class="form-control" required="" type="text" name="shipping_address"
                                        placeholder="Street, No." value="{{ Auth::user()->address }}">
                                </div>
                            </div>

                            <div class="form-group mb-30">
                                <textarea rows="5" placeholder="Additional information" name="notes"></textarea>
                            </div>

                        </div>
                    </div>
                @else
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
                                    <label class="form-label">Postal Code <span class="text-danger">*</span></label>
                                    <input class="form-control" required="" type="text" name="post_code"
                                        placeholder="Postal code...">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                                    <input class="form-control" required="" type="text" name="shipping_phone"
                                        value="{{ Auth::user()->phone }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <label class="form-label">Address <span class="text-danger">*</span></label>
                                    <input class="form-control" required="" type="text" name="shipping_address"
                                        placeholder="Your address... " value="{{ Auth::user()->address }}">
                                </div>
                            </div>

                            <div class="form-group mb-30">
                                <textarea rows="5" placeholder="Additional information" name="notes"></textarea>
                            </div>

                        </div>
                    </div>
                @endif
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
                                    value="paypal" id="exampleRadios3" checked="">
                                <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse"
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
                                    value="mollie" id="exampleRadios4">
                                <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse"
                                    data-target="#paypal1" aria-controls="paypal1">Mollie Payment</label>
                            </div>
                            <div class="custome-radio">
                                <input class="form-check-input" required="" type="radio" name="payment_option"
                                    value="cash" id="exampleRadios5">
                                <label class="form-check-label" for="exampleRadios5" data-bs-toggle="collapse"
                                    data-target="#checkPayment" aria-controls="checkPayment">Cash on delivery</label>
                            </div>

                        </div>
                        <div class="payment-logo d-flex">
                            <img class="mr-15" src="{{ asset('frontend/assets/imgs/theme/icons/payment-paypal.svg') }}"
                                alt="">
                            <img class="mr-15" src="{{ asset('frontend/assets/imgs/theme/icons/payment-visa.svg') }}"
                                alt="">
                            <img class="mr-15" src="{{ asset('frontend/assets/imgs/theme/icons/payment-master.svg') }}"
                                alt="" style="width: 80px; height: 40px; margin-top: 10px;">
                            <img class="mr-15" src="{{ asset('upload/mollie.png') }}" alt=""
                                style="width: 80px; height: 35px; margin-top: 10px;">
                            <img src="{{ asset('upload/stripe.png') }}" alt=""
                                style="width: 90px; height: 50px; margin-bottom: 5px;">
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
            $('select[name="city_id"]').on('change', function() {
                var city_id = $(this).val();
                var rows = '';
                if (city_id) {
                    $.ajax({
                        url: "{{ url('/district-get/ajax') }}/" + city_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            rows =
                                `<option selected="" disabled="" value="">Select District</option>`;
                            $('select[name="district_id"]').html(rows);
                            $('select[name="commune_id"]').html('');
                            $.each(data, function(key, value) {
                                $('select[name="district_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .district_name + '</option>');
                            });
                        },

                    });
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="district_id"]').on('change', function() {
                var district_id = $(this).val();
                var rows = '';
                if (district_id) {
                    $.ajax({
                        url: "{{ url('/commune-get/ajax') }}/" + district_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            rows =
                                `<option selected="" disabled="" value="">Select Commune</option>`;
                            $('select[name="commune_id"]').html(rows);
                            $.each(data, function(key, value) {
                                $('select[name="commune_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .commune_name + '</option>');
                            });
                        },

                    });
                }
            });
        });
    </script>

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
                    city_id: {
                        required: true,
                    },
                    shipping_phone: {
                        required: true,
                        minlength: 10,
                        maxlength: 10,
                        digits: true,
                    },
                    district_id: {
                        required: true,
                    },
                    post_code: {
                        required: true,
                        digits: true,
                    },
                    commune_id: {
                        required: true,
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
                    city_id: {
                        required: 'Please select a city or province name.',
                    },
                    shipping_phone: {
                        required: 'Please enter your phone number.',
                        minlength: 'Please enter 10 numeric characters correctly.',
                        maxlength: 'Please enter 10 numeric characters correctly.',
                        digits: 'Please enter 10 numeric characters correctly.',
                    },
                    district_id: {
                        required: 'Please select a district name.',
                    },
                    post_code: {
                        required: 'Please enter your postal code.',
                        digits: 'Please enter numeric characters correctly.',
                    },
                    commune_id: {
                        required: 'Please select a commune name.',
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
