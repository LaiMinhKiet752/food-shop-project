@extends('frontend.master_dashboard')
@section('main')
@section('title')
    Blog - {{ $blogdetails->post_title }}
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>HOME</a>
            <span></span> <a href="#">
                @foreach ($breadcat as $cat)
                    {{ $cat->blog_category_name }}
                @endforeach
            </a>
            <span></span> {{ $blogdetails->post_title }}
        </div>
    </div>
</div>
<div class="page-content mb-50">
    <div class="container">
        <div class="row">
            <div class="col-xl-11 col-lg-12 m-auto">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="single-page pt-50 pr-30">
                            <div class="single-header style-2">
                                <div class="row">
                                    <div class="col-xl-10 col-lg-12 m-auto">

                                        <h2 class="mb-10">{{ $blogdetails->post_title }}</h2>
                                        <div class="single-header-meta">
                                            <div class="entry-meta meta-1 font-xs mt-15 mb-15">
                                                    <img class="rounded-circle p-1"
                                                        src="{{ asset('upload/admin.jpg') }}" alt=""
                                                        style="width: 50px; height: 50px; margin-right: 10px;" />
                                                <span class="post-by">By <a href="#">Admin</a></span>
                                                <span
                                                    class="post-on has-dot">{{ Carbon\Carbon::parse($blogdetails->created_at)->diffForHumans() }}</span>
                                            </div>
                                            <div class="social-icons single-share">
                                                <ul class="text-grey-5 d-inline-block">
                                                    <li class="mr-5">
                                                        <a href="#"><img
                                                                src="{{ asset('frontend/assets/imgs/theme/icons/icon-bookmark.svg') }}"
                                                                alt="" /></a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <figure class="single-thumbnail">
                                <img src="{{ asset($blogdetails->post_image) }}" alt=""
                                    style="width: 100%; height: 500px;" />
                            </figure>
                            <div class="single-content">
                                <div class="row">
                                    <div class="col-xl-10 col-lg-12 m-auto">
                                        <p class="single-excerpt"> {!! $blogdetails->post_long_description !!} </p>


                                        <!--Entry bottom-->
                                        <div class="entry-bottom mt-10 mb-10">
                                            <div class="social-icons single-share">
                                                <ul class="text-grey-5 d-inline-block">
                                                    <li><strong class="mr-10">Share this:</strong></li>
                                                    <li class="social-facebook">
                                                        <a href="#"><img
                                                                src="{{ asset('frontend/assets/imgs/theme/icons/icon-facebook.svg') }}"
                                                                alt="" /></a>
                                                    </li>
                                                    <li class="social-twitter">
                                                        <a href="#"><img
                                                                src="{{ asset('frontend/assets/imgs/theme/icons/icon-twitter.svg') }}"
                                                                alt="" /></a>
                                                    </li>
                                                    <li class="social-instagram">
                                                        <a href="#"><img
                                                                src="{{ asset('frontend/assets/imgs/theme/icons/icon-instagram.svg') }}"
                                                                alt="" /></a>
                                                    </li>
                                                    <li class="social-linkedin">
                                                        <a href="#"><img
                                                                src="{{ asset('frontend/assets/imgs/theme/icons/icon-pinterest.svg') }}"
                                                                alt="" /></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <!--Comment form-->
                                        <div class="comment-form">
                                            <h3 class="mb-15">Leave a Comment</h3>
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                    @guest
                                                        <p><b>To Comment You Need To Login First! <a
                                                                    href="{{ route('login') }}"> Log in here</a></b></p>
                                                    @else
                                                        <form class="form-contact comment_form mb-50" method="POST"
                                                            action="{{ route('comments.blog') }}" id="commentForm">
                                                            @csrf
                                                            <input type="hidden" name="blog_post_id"
                                                                value="{{ $blogdetails->id }}">
                                                            <div class="row">
                                                                <div class="form-group col-12">
                                                                    <div class="form-group">
                                                                        <textarea class="form-control w-100" name="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <button type="submit"
                                                                    class="button button-contactForm">Post Comment</button>
                                                            </div>
                                                        </form>
                                                    @endguest
                                                    @php
                                                        $comment = \App\Models\BlogComment::where('blog_post_id', $blogdetails->id)
                                                            ->where('parent_id', null)
                                                            ->limit(5)
                                                            ->latest()
                                                            ->get();
                                                    @endphp
                                                    <div class="comments-area">
                                                        <h3 class="mb-30">Comments</h3>
                                                        <div class="comment-list">
                                                            @foreach ($comment as $item)
                                                                <div
                                                                    class="single-comment justify-content-between d-flex mb-30">
                                                                    <div class="user justify-content-between d-flex">
                                                                        <div class="thumb text-center">
                                                                            <img src="{{ !empty($item['user']['photo']) ? url('upload/user_images/' . $item['user']['photo']) : url('upload/no_image.jpg') }}"
                                                                                alt=""
                                                                                style="width: 70px; height: 80px;" />
                                                                            <a href="#"
                                                                                class="font-heading text-brand">{{ $item['user']['name'] }}</a>
                                                                        </div>
                                                                        <div class="desc">
                                                                            <div
                                                                                class="d-flex justify-content-between mb-10">
                                                                                <div class="d-flex align-items-center">
                                                                                    <span
                                                                                        class="font-xs text-muted">{{ $item->created_at->format('d F Y H:i:s') }}</span>
                                                                                </div>
                                                                            </div>
                                                                            <p class="mb-10">
                                                                                {{ $item->comment }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                @php
                                                                    $reply = \App\Models\BlogComment::where('parent_id', $item->id)->get();
                                                                @endphp

                                                                @foreach ($reply as $item)
                                                                    <div
                                                                        class="single-comment justify-content-between d-flex mb-30 ml-30">
                                                                        <div
                                                                            class="user justify-content-between d-flex">
                                                                            <div class="thumb text-center">
                                                                                <img src="{{ url('upload/admin.jpg') }}"
                                                                                    alt=""
                                                                                    style="width: 70px; height: 80px;" />
                                                                                <a href="#"
                                                                                    class="font-heading text-brand">{{ $item['user']['name'] }}</a>
                                                                            </div>
                                                                            <div class="desc">
                                                                                <div
                                                                                    class="d-flex justify-content-between mb-10">
                                                                                    <div
                                                                                        class="d-flex align-items-cer">
                                                                                        <span
                                                                                            class="font-xs text-muted">{{ $item->created_at->format('d F Y H:i:s') }}</span>
                                                                                    </div>
                                                                                </div>
                                                                                <p class="mb-10">{{ $item->comment }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endforeach
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


                    <div class="col-lg-3 primary-sidebar sticky-sidebar pt-50">
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
                                            $posts = App\Models\BlogPost::where('category_id', $category->id)->get();
                                        @endphp

                                        <li>
                                            <a
                                                href="{{ url('post/category/' . $category->id . '/' . $category->blog_category_slug) }}">{{ $category->blog_category_name }}</a><span
                                                class="text-brand"
                                                style="font-weight: bold;">{{ count($posts) }}</span>
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
                                        <a class="hover-up" href="#"><i
                                                class="fi-rs-cross mr-10"></i>Fish</a>&nbsp;
                                        <a class="hover-up" href="#"><i class="fi-rs-cross mr-10"></i>Meat</a>
                                    </li>
                                    <li>
                                        <a class="hover-up" href="#"><i
                                                class="fi-rs-cross mr-10"></i>Milk</a>&nbsp;
                                        <a class="hover-up" href="#"><i class="fi-rs-cross mr-10"></i>Fruit</a>
                                    </li>
                                    <li>
                                        <a class="hover-up" href="#"><i
                                                class="fi-rs-cross mr-10"></i>Egg</a>&nbsp;
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
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#commentForm').validate({
            rules: {
                comment: {
                    required: true,
                    maxlength: 500,
                },
            },
            messages: {
                comment: {
                    required: 'Please enter your comment.',
                    maxlength: 'Comments cannot be longer than 500 characters.',
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
