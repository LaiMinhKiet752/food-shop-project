@extends('frontend.master_dashboard')
@section('main')
@section('title')
    Bảng điều khiển
@endsection
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang chủ</a>
                <span></span> Bảng điều khiển
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
                            <div class="tab-content account dashboard-content pl-50">
                                <div class="tab-pane fade active show" id="dashboard" role="tabpanel"
                                    aria-labelledby="dashboard-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="mb-0">Xin chào {{ Auth::user()->name }}!</h3><br>
                                            <img src="{{ !empty($userData->photo) ? url('upload/user_images/' . $userData->photo) : url('upload/no_image.jpg') }}"
                                                alt="User" class="rounded-circle p-1 bg-primary"
                                                style="width: 150px; height: 150px;">
                                        </div>
                                        <div class="card-body">
                                            <p>
                                                Từ bảng điều khiển tài khoản của bạn, bạn có thể dễ dàng kiểm tra và xem các đơn hàng gần đây, quản lý địa chỉ giao hàng và thanh toán, cũng như chỉnh sửa mật khẩu và thông tin tài khoản của mình.
                                            </p>
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
@endsection
