@extends('frontend.master_dashboard')
@section('main')
@section('title')
    Xác thực Email
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> Xác thực Email
        </div>
    </div>
</div>
<div class="page-content pt-150 pb-150">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-8 col-md-12 m-auto">
                <div class="row">
                    <div class="heading_s1">
                        <img class="border-radius-15" src="{{ asset('frontend/assets/imgs/page/reset_password.svg') }}"
                            alt="" />
                        <h2 class="mb-15 mt-15">Xác thực Email</h2>
                        <p class="mb-30">Cảm ơn bạn đã đăng ký! Trước khi bắt đầu, bạn có thể xác minh địa chỉ email của mình bằng cách nhấp vào liên kết mà chúng tôi vừa gửi qua email? Nếu bạn không nhận được email, vui lòng click vào nút "Gửi lại" bến dưới, chúng tôi sẽ gửi lại cho bạn.
                        </p>
                    </div>
                    <div class="col-lg-6 col-md-8">
                        <div class="login_wrap widget-taber-content background-white">
                            <div class="padding_eight_all bg-white">
                                @if (session('status') == 'verification-link-sent')
                                    <div class="alert alert-success" role="alert">
                                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('verification.send') }}">
                                    @csrf
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-heading btn-block hover-up"
                                            name="login">Gửi lại</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
