@extends('frontend.master_dashboard')
@section('main')
@section('title')
    Thanh toán qua Paypal
@endsection
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang Chủ</a>
            <span></span> Thanh toán qua Paypal
        </div>
    </div>
</div>
<div class="container mb-80 mt-50">
    <div class="row">
        <div class="col-lg-8 mb-40">
            <h3 class="heading-2 mb-10">Chi tiết</h3>
            <div class="d-flex justify-content-between">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="border p-40 cart-totals ml-30 mb-50">
                <div class="d-flex align-items-end justify-content-between mb-30">
                    <h4>Số tiền phải thanh toán</h4>
                </div>
                <div class="divider-2 mb-30"></div>
                <div class="table-responsive order_table checkout">
                    <table class="table no-border">
                        <tbody>
                            @if (Session::has('coupon'))
                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Tạm tính</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">{{ number_format($cartTotal, 0, ',', '.') }}đ
                                        </h4>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Mã giảm giá</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h6 class="text-brand text-end">{{ session()->get('coupon')['coupon_code'] }}
                                            (-{{ session()->get('coupon')['coupon_discount'] }}%)</h6>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Giảm</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">
                                            {{ number_format(session()->get('coupon')['discount_amount'], 0, ',', '.') }}đ
                                        </h4>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Phí Ship</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">0đ</h4>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Tổng tiền</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">
                                            {{ number_format(session()->get('coupon')['total_amount'], 0, ',', '.') }}đ
                                        </h4>
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Tạm tính</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">{{ number_format($cartTotal, 0, ',', '.') }}đ</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Giảm</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">0đ</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Phí Ship</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">0đ</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Tổng tiền</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">{{ number_format($cartTotal, 0, ',', '.') }}đ</h4>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="border p-40 cart-totals ml-30 mb-50">
                <div class="d-flex align-items-end justify-content-between mb-30">
                    <h4>Phương thức thanh toán bạn chọn </h4>
                </div>
                <div class="divider-2 mb-30"></div>
                <div class="table-responsive order_table checkout">
                    <form action="{{ route('paypal.order') }}" method="post">
                        @csrf
                        <div class="form-row">
                            <input type="hidden" name="name" value="{{ $data['shipping_name'] }}">
                            <input type="hidden" name="email" value="{{ $data['shipping_email'] }}">
                            <input type="hidden" name="phone" value="{{ $data['shipping_phone'] }}">
                            <input type="hidden" name="address" value="{{ $data['shipping_address'] }}">
                            <input type="hidden" name="post_code" value="{{ $data['post_code'] }}">
                            <input type="hidden" name="notes" value="{{ $data['notes'] }}">
                        </div>
                </div>

                <div style="text-align: center;">
                    <img src="{{ asset('upload/paypal.png') }}" alt="" style="width: 300px; height: 120px;">
                </div>
                <br>
                <button class="btn" type="submit">Xác nhận</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
