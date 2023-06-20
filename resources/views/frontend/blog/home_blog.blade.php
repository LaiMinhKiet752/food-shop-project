@extends('frontend.master_dashboard')
@section('main')
    <div class="page-header mt-30 mb-75">
        <div class="container">
            <div class="archive-header">
                <div class="row align-items-center">
                    <div class="col-xl-3">
                        <h1 class="mb-15">Blog & News</h1>
                        <div class="breadcrumb">
                            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                            <span></span> Blog & News
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
                        @foreach ($blogpost as $post)
                            <article class="wow fadeIn animated hover-up mb-30 animated">
                                <div class="post-thumb" style="background-image: url({{ asset($post->post_image) }})">
                                    <div class="entry-meta">
                                        <a class="entry-meta meta-2" href="#"><i class="fi-rs-play-alt"></i></a>
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
                                            <span class="hit-count has-dot">{{ $post->visitors }} Views</span>
                                        </div>
                                        <a href="{{ url('post/details/' . $post->id . '/' . $post->post_slug) }}"
                                            class="text-brand font-heading font-weight-bold">Read more <i
                                                class="fi-rs-arrow-right"></i></a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                    <div class="pagination-area mt-15 mb-sm-5 mb-lg-0">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-start">
                                <li class="page-item">
                                    <a class="page-link" href="#"><i class="fi-rs-arrow-small-left"></i></a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                                <li class="page-item"><a class="page-link" href="#">6</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#"><i class="fi-rs-arrow-small-right"></i></a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-3 primary-sidebar sticky-sidebar">
                    <div class="widget-area">
                        <div class="sidebar-widget-2 widget_search mb-50">
                            <div class="search-form">
                                <form action="#">
                                    <input type="text" placeholder="Search…" />
                                    <button type="submit"><i class="fi-rs-search"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="sidebar-widget widget-category-2 mb-50">
                            <h5 class="section-title style-1 mb-30">Category</h5>
                            <ul>
                                @foreach ($blogcategories as $category)
                                    @php
                                        $posts = \App\Models\BlogPost::where('category_id', $category->id)->get();
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
                        <div class="sidebar-widget product-sidebar mb-50 p-30 bg-grey border-radius-10">
                            <h5 class="section-title style-1 mb-30">Trending Now</h5>
                            @foreach ($products as $product)
                                <div class="single-post clearfix">
                                    <div class="image">
                                        <img src="{{ asset($product->product_thumbnail) }}" alt="#" />
                                    </div>
                                    <div class="content pt-10">
                                        <h5><a
                                                href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">{{ $product->product_name }}</a>
                                        </h5>
                                        @if ($product->discount_price == null)
                                            <p class="price mb-0 mt-5">${{ $product->selling_price }}</p>
                                        @else
                                            <p class="price mb-0 mt-5">${{ $product->discount_price }}</p>
                                        @endif
                                        {{-- <div class="product-rate">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div> --}}
                                    </div>
                                </div>
                            @endforeach
                        </div>


                        <div class="sidebar-widget widget_instagram mb-50">
                            <h5 class="section-title style-1 mb-30">Gallery</h5>
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


                        <!--Tags-->
                        <div class="sidebar-widget widget-tags mb-50">
                            <h5 class="section-title style-1 mb-30">Popular Tags</h5>
                            <ul class="tags-list">
                                <li>
                                    <a class="hover-up" href="#"><i class="fi-rs-cross mr-10"></i>Fish</a>&nbsp;
                                    <a class="hover-up" href="#"><i class="fi-rs-cross mr-10"></i>Meat</a>
                                </li>
                                <li>
                                    <a class="hover-up" href="#"><i class="fi-rs-cross mr-10"></i>Milk</a>&nbsp;
                                    <a class="hover-up" href="#"><i class="fi-rs-cross mr-10"></i>Fruit</a>
                                </li>
                                <li>
                                    <a class="hover-up" href="#"><i class="fi-rs-cross mr-10"></i>Egg</a>&nbsp;
                                    <a class="hover-up" href="#"><i class="fi-rs-cross mr-10"></i>Salad</a>
                                </li>
                            </ul>
                        </div>

                        <div class="banner-img wow fadeIn mb-50 animated d-lg-block d-none">
                            <img src="{{ asset('frontend/assets/imgs/banner/banner-11.png') }}" alt="" />
                            <div class="banner-text">
                                <span>Oganic</span>
                                <h4>
                                    Save 17% <br />
                                    on <span class="text-brand">Oganic</span><br />
                                    Juice
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
