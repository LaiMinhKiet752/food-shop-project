@extends('frontend.master_dashboard')
@section('main')
@section('title')
    Bảo Linh
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

@include('frontend.home.home_slider')
<!--End hero slider-->

@include('frontend.home.home_new_product')
<!--Products Tabs-->

@include('frontend.home.home_banner')
<!--End banners-->

@endsection
