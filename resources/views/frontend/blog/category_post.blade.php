@extends('frontend.master_dashboard')
@section('main')
@section('title')
    Blog - {{ $breadcat->blog_category_name }}
@endsection
<div class="page-header mt-30 mb-75">
    <div class="container">
        <div class="archive-header">
            <div class="row align-items-center">
                <div class="col-xl-3">
                    <h3 class="mb-15">
                        {{ $breadcat->blog_category_name }}
                    </h3>
                    <div class="breadcrumb">
                        <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang chủ</a>
                        <span></span> Blog
                        <span></span>
                        {{ $breadcat->blog_category_name }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="page-content mb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="loop-grid loop-list pr-30 mb-50">
                    @forelse ($blogpost as $post)
                        <article class="wow fadeIn animated hover-up mb-30 animated">
                            <div class="post-thumb" style="background-image: url({{ asset($post->post_image) }})">
                                <div class="entry-meta">
                                    <a class="entry-meta meta-2" href="blog-category-grid.html"><i
                                            class="fi-rs-play-alt"></i></a>
                                </div>
                            </div>
                            <div class="entry-content-2 pl-50">
                                <h3 class="post-title mb-20">
                                    <a
                                        href="{{ url('post/details/' . $post->id . '/' . $post->post_slug) }}">{{ $post->post_title }}</a>
                                </h3>
                                <p class="post-exerpt mb-40">{{ $post->post_short_description }}</p>
                                <div class="entry-meta meta-1 font-xs color-grey mt-10 pb-10">
                                    <div>
                                        <span class="post-on">{{ $post->created_at->format('M d Y') }}</span>
                                        <span class="hit-count has-dot">{{ $post->views }} lượt xem</span>
                                    </div>
                                    <a href="{{ url('post/details/' . $post->id . '/' . $post->post_slug) }}"
                                        class="text-brand font-heading font-weight-bold">Xem thêm <i
                                            class="fi-rs-arrow-right"></i></a>
                                </div>
                            </div>
                        </article>
                    @empty
                        <h4 class="text-danger">Không tìm thấy blog nào!</h4>
                    @endforelse
                </div>

            </div>
            <div class="col-lg-3 primary-sidebar sticky-sidebar">
                <div class="widget-area">
                    <div class="sidebar-widget-2 widget_search mb-50">
                        <div class="search-form">
                            <form action="#">
                                <input type="text" placeholder="Tìm kiếm . . ." />
                                <button type="submit"><i class="fi-rs-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="sidebar-widget widget-category-2 mb-50">
                        <h5 class="section-title style-1 mb-30">Danh mục Blog</h5>
                        <ul>
                            @foreach ($blogcategories as $category)
                                @php
                                    $posts = App\Models\BlogPost::where('category_id', $category->id)->get();
                                @endphp

                                <li>
                                    <a
                                        href="{{ url('post/category/' . $category->id . '/' . $category->blog_category_slug) }}">{{ $category->blog_category_name }}</a><span
                                        class="text-brand" style="font-weight: bold;">{{ count($posts) }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Product sidebar Widget -->

                    <div class="sidebar-widget widget_instagram mb-50">
                        <h5 class="section-title style-1 mb-30">Kho ảnh</h5>
                        <div class="instagram-gellay">
                            <ul class="insta-feed">
                                <li>
                                    <a href="#"><img class="border-radius-5"
                                            src="{{ asset('frontend/assets/imgs/shop/thumbnail-1.jpg') }}"
                                            alt="" /></a>
                                </li>
                                <li>
                                    <a href="#"><img class="border-radius-5"
                                            src="{{ asset('frontend/assets/imgs/shop/thumbnail-2.jpg') }}"
                                            alt="" /></a>
                                </li>
                                <li>
                                    <a href="#"><img class="border-radius-5"
                                            src="{{ asset('frontend/assets/imgs/shop/thumbnail-3.jpg') }}"
                                            alt="" /></a>
                                </li>
                                <li>
                                    <a href="#"><img class="border-radius-5"
                                            src="{{ asset('frontend/assets/imgs/shop/thumbnail-4.jpg') }}"
                                            alt="" /></a>
                                </li>
                                <li>
                                    <a href="#"><img class="border-radius-5"
                                            src="{{ asset('frontend/assets/imgs/shop/thumbnail-5.jpg') }}"
                                            alt="" /></a>
                                </li>
                                <li>
                                    <a href="#"><img class="border-radius-5"
                                            src="{{ asset('frontend/assets/imgs/shop/thumbnail-6.jpg') }}"
                                            alt="" /></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
