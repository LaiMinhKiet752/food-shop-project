@extends('frontend.master_dashboard')
@section('main')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Verify Email Address
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
                            <h2 class="mb-15 mt-15">Verify Email Address</h2>
                            <p class="mb-30">Thanks for signing up! Before getting started, could you verify your
                                email address by clicking on the link we just emailed to you? If you didn't receive
                                the email, we will gladly send you another.
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
                                                name="login">Resend Verification Email</button>
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
