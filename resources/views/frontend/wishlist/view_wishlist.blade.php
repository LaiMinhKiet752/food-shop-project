@extends('frontend.master_dashboard')
@section('main')
@section('title')
    Trang danh sách yêu thích sản phẩm
@endsection
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang chủ</a>
                <span></span> Yêu thích
            </div>
        </div>
    </div>
    <div class="container mb-30 mt-50">
        <div class="row">
            <div class="col-xl-10 col-lg-12 m-auto">
                <div class="mb-50">
                    <h1 class="heading-2 mb-10">Danh sách yêu thích</h1>
                    <h6 class="text-body">Có <span class="text-brand" id="countproductwishlist"></span> sản phẩm trong mục yêu thích</h6>
                </div>
                <div class="table-responsive shopping-summery">
                    <table class="table table-wishlist">
                        <thead>
                            <tr class="main-heading">
                                <th class="custome-checkbox start pl-30">
                                </th>
                                <th scope="col" colspan="2">Sản phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col" class="end">Xóa</th>
                            </tr>
                        </thead>
                        <tbody id="wishlist">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
