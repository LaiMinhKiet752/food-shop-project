@extends('frontend.master_dashboard')
@section('main')
@section('title')
    Trang so sánh sản phẩm
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang chủ</a>
                <span></span> So sánh
            </div>
        </div>
    </div>
    <div class="container mb-80 mt-50">
        <div class="row">
            <div class="col-xl-10 col-lg-12 m-auto">
                <h1 class="heading-2 mb-10">So sánh sản phẩm</h1>
                <h6 class="text-body mb-40">Có <span class="text-brand" id="countproductcompare"></span> sản phẩm đang được so sánh</h6>
                <div class="table-responsive">
                    <table class="table text-center table-compare">
                        <tbody>
                            <tr class="pr_image" id="images">

                            </tr>

                            <tr class="pr_title" id="title">

                            </tr>

                            <tr class="pr_price" id="price">

                            </tr>

                            
                            <tr class="description" id="product_description">

                            </tr>

                            <tr class="pr_stock" id="stock">

                            </tr>

                            <tr class="pr_weight" id="weight">

                            </tr>

                            <tr class="pr_dimensions" id="dimensions">

                            </tr>

                            <tr class="pr_add_to_cart" id="details">

                            </tr>

                            <tr class="pr_remove text-muted" id="remove">

                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
