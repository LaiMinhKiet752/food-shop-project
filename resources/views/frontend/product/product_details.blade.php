@extends('frontend.master_dashboard')
@section('main')
@section('title')
    {{ $product->product_name }}
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>HOME</a>
            <span></span> <a href="shop-grid-right.html">{{ $product['category']['category_name'] }}</a> <span></span>
            {{ $product['subcategory']['subcategory_name'] }}<span></span>{{ $product->product_name }}
        </div>
    </div>
</div>
<div class="container mb-30">
    <div class="row">
        <div class="col-xl-10 col-lg-12 m-auto">
            <div class="product-detail accordion-detail">
                <div class="row mb-50 mt-30">
                    <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                        <div class="detail-gallery">
                            <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                            <!-- MAIN SLIDES -->
                            <div class="product-image-slider">
                                @foreach ($multipleImage as $image)
                                    <figure class="border-radius-10">
                                        <img src="{{ asset($image->photo_name) }}" alt="product image" />
                                    </figure>
                                @endforeach
                            </div>
                            <!-- THUMBNAILS -->
                            <div class="slider-nav-thumbnails">
                                @foreach ($multipleImage as $image)
                                    <div><img src="{{ asset($image->photo_name) }}" alt="product image" /></div>
                                @endforeach
                            </div>
                        </div>
                        <!-- End Gallery -->
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="detail-info pr-30 pl-30">
                            @if ($product->product_quantity > 0)
                                <span class="stock-status in-stock"> In Stock </span>
                            @else
                                <span class="stock-status out-stock"> Out Of Stock </span>
                            @endif

                            <h2 class="title-detail" id="dpname">{{ $product->product_name }}</h2>
                            <div class="product-detail-rating">
                                <div class="product-rate-cover text-end">
                                    @php
                                        $average = \App\Models\Review::where('product_id', $product->id)
                                            ->where('status', 1)
                                            ->avg('rating');
                                        $review_count = \App\Models\Review::where('product_id', $product->id)
                                            ->where('status', 1)
                                            ->latest()
                                            ->get();
                                    @endphp
                                    <div class="product-rate d-inline-block">
                                        @if ($average == 0)
                                        @elseif($average == 1)
                                            <div class="product-rating" style="width: 20%"></div>
                                        @elseif($average > 1 && $average < 2)
                                            <div class="product-rating" style="width: 30%"></div>
                                        @elseif($average == 2)
                                            <div class="product-rating" style="width: 40%"></div>
                                        @elseif($average > 2 && $average < 3)
                                            <div class="product-rating" style="width: 50%"></div>
                                        @elseif($average == 3)
                                            <div class="product-rating" style="width: 60%"></div>
                                        @elseif($average > 3 && $average < 4)
                                            <div class="product-rating" style="width: 70%"></div>
                                        @elseif($average == 4)
                                            <div class="product-rating" style="width: 80%"></div>
                                        @elseif($average > 4 && $average < 5)
                                            <div class="product-rating" style="width: 90%"></div>
                                        @elseif($average == 5)
                                            <div class="product-rating" style="width: 100%"></div>
                                        @endif
                                    </div>
                                    <span class="font-small ml-5 text-muted"> ({{ count($review_count) }}
                                        reviews)</span>
                                </div>
                            </div>
                            <div class="clearfix product-price-cover">
                                @php
                                    $amount = $product->selling_price - $product->discount_price;
                                    $discount = ($amount / $product->selling_price) * 100;
                                @endphp
                                @if ($product->discount_price == null)
                                    <div class="product-price primary-color float-left">
                                        <span class="current-price text-brand">${{ $product->selling_price }}</span>
                                    </div>
                                @else
                                    <div class="product-price primary-color float-left">
                                        <span class="current-price text-brand">${{ $product->discount_price }}</span>
                                        <span>
                                            <span class="save-price font-md color3 ml-15"> - {{ round($discount) }}%
                                                Off</span>
                                            <span class="old-price font-md ml-15">${{ $product->selling_price }}</span>
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <div class="short-desc mb-30">
                                <p class="font-lg">{{ $product->short_description }}</p>
                            </div>

                            <div class="detail-extralink mb-50">
                                <div class="detail-qty border radius">
                                    <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                    <input type="text" id="dqty" name="quantity" class="qty-val" value="1"
                                        min="1">
                                    <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                </div>
                                <div class="product-extra-link2">

                                    <input type="hidden" id="dproduct_id" value="{{ $product->id }}">
                                    <input type="hidden" id="pbrand_id" value="{{ $product->brand_id }}">

                                    <button type="submit" class="button button-add-to-cart"
                                        onclick="addToCartDetails()"><i class="fi-rs-shopping-cart"></i>Add to
                                        cart</button>

                                    <a aria-label="Add To Wishlist" class="action-btn hover-up"
                                        id="{{ $product->id }}" onclick="addToWishlist(this.id)"><i
                                            class="fi-rs-heart"></i></a>

                                    <a aria-label="Compare" class="action-btn hover-up" id="{{ $product->id }}"
                                        onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>

                                </div>
                            </div>
                            <h6>Sold By <a href="javascript;"> <span class="text-danger">Nest</span></a></h6>
                            <hr>
                            <div class="font-xs">
                                <ul class="mr-50 float-start">
                                    <li class="mb-5">PRODUCT CODE: <a
                                            href="#">{{ $product->product_code }}</a>
                                    </li>
                                    <li class="mb-5">BRAND: <span
                                            class="text-brand">{{ $product['brand']['brand_name'] }}</span></li>
                                    <li class="mb-5">CATEGORY: <span
                                            class="text-brand">{{ $product['category']['category_name'] }}</span>
                                    </li>
                                    <li class="mb-5">SUBCATEGORY: <span
                                            class="text-brand">{{ $product['subcategory']['subcategory_name'] }}</span>
                                    </li>
                                </ul>
                                <ul class="float-start">
                                    <li class="mb-5">TAGS: <a href="#"
                                            rel="tag">{{ $product->product_tags }}</a></li>
                                    @if ($product->manufacturing_date == null)
                                    @else
                                        <li class="mb-5">MFG: <span
                                                class="text-brand">{{ date('d-m-Y', strtotime($product->manufacturing_date)) }}</span>
                                        </li>
                                    @endif
                                    @if ($product->expiry_date == null)
                                    @else
                                        <li>EXP: <span
                                                class="text-brand">{{ date('d-m-Y', strtotime($product->expiry_date)) }}</span>
                                        </li>
                                    @endif
                                    <li>IN STOCK:<span
                                            class="in-stock text-brand ml-5">({{ $product->product_quantity }})
                                            Items</span></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Detail Info -->
                    </div>
                </div>


                <div class="product-info">
                    <div class="tab-style3">


                        <ul class="nav nav-tabs text-uppercase">
                            <li class="nav-item">
                                <a class="nav-link active" id="Description-tab" data-bs-toggle="tab"
                                    href="#Description">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Reviews
                                    ({{ count($review_count) }})</a>
                            </li>
                        </ul>


                        <div class="tab-content shop_info_tab entry-main-content">
                            <div class="tab-pane fade show active" id="Description">
                                <div class="">
                                    <p>{!! $product->long_description !!}</p>
                                </div>
                            </div>


                            <div class="tab-pane fade" id="Reviews">
                                <!--Comments-->
                                <div class="comments-area">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <h4 class="mb-30">Customer questions & answers</h4>
                                            <div class="comment-list">

                                                @php
                                                    $reviews = \App\Models\Review::where('product_id', $product->id)
                                                        ->latest()
                                                        ->limit(5)
                                                        ->get();
                                                @endphp
                                                @foreach ($reviews as $item)
                                                    @if ($item->status == 0)
                                                    @else
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
                                                                    <div class="d-flex justify-content-between mb-10">
                                                                        <div class="d-flex align-items-center">
                                                                            <span
                                                                                class="font-xs text-muted">{{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                                                                        </div>
                                                                        <div class="product-rate d-inline-block">
                                                                            @if ($item->rating == null)
                                                                            @elseif($item->rating == 5)
                                                                                <div class="product-rating"
                                                                                    style="width: 100%">
                                                                                </div>
                                                                            @elseif($item->rating == 4)
                                                                                <div class="product-rating"
                                                                                    style="width: 80%">
                                                                                </div>
                                                                            @elseif($item->rating == 3)
                                                                                <div class="product-rating"
                                                                                    style="width: 60%">
                                                                                </div>
                                                                            @elseif($item->rating == 2)
                                                                                <div class="product-rating"
                                                                                    style="width: 40%">
                                                                                </div>
                                                                            @elseif($item->rating == 1)
                                                                                <div class="product-rating"
                                                                                    style="width: 20%">
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <p class="mb-10">{{ $item->comment }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach


                                            </div>
                                        </div>


                                        @php
                                            $average = \App\Models\Review::where('product_id', $product->id)
                                                ->where('status', 1)
                                                ->avg('rating');
                                        @endphp
                                        <div class="col-lg-4">
                                            <h4 class="mb-30">Customer reviews</h4>
                                            @if ($average == 0)
                                                <div class="product-rate d-inline-block mr-15">
                                                </div>
                                            @elseif($average == 1)
                                                <div class="d-flex mb-30">
                                                    <div class="product-rate d-inline-block mr-15">
                                                        <div class="product-rating" style="width: 20%"></div>
                                                    </div>
                                                    <h6>1 out of 5</h6>
                                                </div>
                                            @elseif($average > 1 && $average < 2)
                                                <div class="d-flex mb-30">
                                                    <div class="product-rate d-inline-block mr-15">
                                                        <div class="product-rating" style="width: 30%"></div>
                                                    </div>
                                                    <h6>{{ round($average, 1, PHP_ROUND_HALF_ODD) }} out of 5</h6>
                                                </div>
                                            @elseif($average == 2)
                                                <div class="d-flex mb-30">
                                                    <div class="product-rate d-inline-block mr-15">
                                                        <div class="product-rating" style="width: 40%"></div>
                                                    </div>
                                                    <h6>2 out of 5</h6>
                                                </div>
                                            @elseif($average > 2 && $average < 3)
                                                <div class="d-flex mb-30">
                                                    <div class="product-rate d-inline-block mr-15">
                                                        <div class="product-rating" style="width: 50%"></div>
                                                    </div>
                                                    <h6>{{ round($average, 1, PHP_ROUND_HALF_ODD) }} out of 5</h6>
                                                </div>
                                            @elseif($average == 3)
                                                <div class="d-flex mb-30">
                                                    <div class="product-rate d-inline-block mr-15">
                                                        <div class="product-rating" style="width: 60%"></div>
                                                    </div>
                                                    <h6>3 out of 5</h6>
                                                </div>
                                            @elseif($average > 3 && $average < 4)
                                                <div class="d-flex mb-30">
                                                    <div class="product-rate d-inline-block mr-15">
                                                        <div class="product-rating" style="width: 70%"></div>
                                                    </div>
                                                    <h6>{{ round($average, 1, PHP_ROUND_HALF_ODD) }} out of 5</h6>
                                                </div>
                                            @elseif($average == 4)
                                                <div class="d-flex mb-30">
                                                    <div class="product-rate d-inline-block mr-15">
                                                        <div class="product-rating" style="width: 80%"></div>
                                                    </div>
                                                    <h6>4 out of 5</h6>
                                                </div>
                                            @elseif($average > 4 && $average < 5)
                                                <div class="d-flex mb-30">
                                                    <div class="product-rate d-inline-block mr-15">
                                                        <div class="product-rating" style="width: 90%"></div>
                                                    </div>
                                                    <h6>{{ round($average, 1, PHP_ROUND_HALF_ODD) }} out of 5</h6>
                                                </div>
                                            @elseif($average == 5)
                                                <div class="d-flex mb-30">
                                                    <div class="product-rate d-inline-block mr-15">
                                                        <div class="product-rating" style="width: 100%"></div>
                                                    </div>
                                                    <h6>5 out of 5</h6>
                                                </div>
                                            @endif

                                            @php
                                                $check = \App\Models\Review::where('product_id', $product->id)
                                                    ->where('status', 1)
                                                    ->get();
                                                $all_stars = \App\Models\Review::where('product_id', $product->id)
                                                    ->where('status', 1)
                                                    ->count();
                                                $count_5_stars = \App\Models\Review::where('product_id', $product->id)
                                                    ->where('status', 1)
                                                    ->where('rating', 5)
                                                    ->count();
                                                $count_4_stars = \App\Models\Review::where('product_id', $product->id)
                                                    ->where('status', 1)
                                                    ->where('rating', 4)
                                                    ->count();
                                                $count_3_stars = \App\Models\Review::where('product_id', $product->id)
                                                    ->where('status', 1)
                                                    ->where('rating', 3)
                                                    ->count();
                                                $count_2_stars = \App\Models\Review::where('product_id', $product->id)
                                                    ->where('status', 1)
                                                    ->where('rating', 2)
                                                    ->count();
                                                $count_1_star = \App\Models\Review::where('product_id', $product->id)
                                                    ->where('status', 1)
                                                    ->where('rating', 1)
                                                    ->count();
                                                if (count($check) < 1) {
                                                    $percent_5_stars = 0;
                                                    $percent_4_stars = 0;
                                                    $percent_3_stars = 0;
                                                    $percent_2_stars = 0;
                                                    $percent_1_star = 0;
                                                } else {
                                                    $percent_4_stars = round(($count_4_stars / $all_stars) * 100, 1, PHP_ROUND_HALF_ODD);
                                                    $percent_5_stars = round(($count_5_stars / $all_stars) * 100, 1, PHP_ROUND_HALF_ODD);
                                                    $percent_3_stars = round(($count_3_stars / $all_stars) * 100, 1, PHP_ROUND_HALF_ODD);
                                                    $percent_2_stars = round(($count_2_stars / $all_stars) * 100, 1, PHP_ROUND_HALF_ODD);
                                                    $percent_1_star = round(($count_1_star / $all_stars) * 100, 1, PHP_ROUND_HALF_ODD);
                                                }

                                            @endphp
                                            <div class="progress">
                                                <span>5 star</span>
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: {{ $percent_5_stars }}%"
                                                    aria-valuenow="{{ $percent_5_stars }}" aria-valuemin="0"
                                                    aria-valuemax="100">{{ $percent_5_stars }}%
                                                </div>
                                            </div>
                                            <div class="progress">
                                                <span>4 star</span>
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: {{ $percent_4_stars }}%"
                                                    aria-valuenow="{{ $percent_4_stars }}" aria-valuemin="0"
                                                    aria-valuemax="100">{{ $percent_4_stars }}%
                                                </div>
                                            </div>
                                            <div class="progress">
                                                <span>3 star</span>
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: {{ $percent_3_stars }}%"
                                                    aria-valuenow="{{ $percent_3_stars }}" aria-valuemin="0"
                                                    aria-valuemax="100">{{ $percent_3_stars }}%
                                                </div>
                                            </div>
                                            <div class="progress">
                                                <span>2 star</span>
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: {{ $percent_2_stars }}%"
                                                    aria-valuenow="{{ $percent_2_stars }}" aria-valuemin="0"
                                                    aria-valuemax="100">{{ $percent_2_stars }}%
                                                </div>
                                            </div>
                                            <div class="progress mb-30">
                                                <span>1 star</span>
                                                <div class="progress-bar" role="progressbar"
                                                    style="width: {{ $percent_1_star }}%"
                                                    aria-valuenow="{{ $percent_1_star }}" aria-valuemin="0"
                                                    aria-valuemax="100">{{ $percent_1_star }}%
                                                </div>
                                            </div>
                                            <a href="#" class="font-xs text-muted">How are ratings
                                                calculated?</a>
                                        </div>



                                    </div>
                                </div>


                                <!--comment form-->
                                <div class="comment-form">
                                    <h4 class="mb-15">Add a review</h4>
                                    @guest
                                        <p><b>For Add Product Review. You Need To Login First! <a
                                                    href="{{ route('login') }}"> Log in here</a></b></p>
                                    @else
                                        <div class="row">
                                            <div class="col-lg-8 col-md-12">
                                                <form class="form-contact comment_form"
                                                    action="{{ route('store.review') }}" method="POST"
                                                    id="commentForm">
                                                    @csrf
                                                    <input type="hidden" name="review_product_id"
                                                        value="{{ $product->id }}">
                                                    <div class="row">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th class="cell-level">&nbsp;</th>
                                                                    <th class="text-center">1 star</th>
                                                                    <th class="text-center">2 stars</th>
                                                                    <th class="text-center">3 stars</th>
                                                                    <th class="text-center">4 stars</th>
                                                                    <th class="text-center">5 stars</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="cell-level text-center">Quality</td>
                                                                    <td><input type="radio" name="quality"
                                                                            class="radio-sm" value="1"></td>
                                                                    <td><input type="radio" name="quality"
                                                                            class="radio-sm" value="2"></td>
                                                                    <td><input type="radio" name="quality"
                                                                            class="radio-sm" value="3"></td>
                                                                    <td><input type="radio" name="quality"
                                                                            class="radio-sm" value="4"></td>
                                                                    <td><input type="radio" name="quality"
                                                                            class="radio-sm" value="5"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        @error('quality')
                                                            <div
                                                                class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
                                                                <div class="text-white">{{ $message }}</div>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="alert" aria-label="Close"></button>
                                                            </div>
                                                        @enderror
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <textarea class="form-control w-100" name="comment" id="comment" placeholder="Write Comment"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="button button-contactForm">Submit
                                                            Review</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endguest
                                </div>


                            </div>


                        </div>
                    </div>
                </div>


                <div class="row mt-60">
                    <div class="col-12">
                        <h2 class="section-title style-1 mb-30">Related products</h2>
                    </div>
                    <div class="col-12">
                        <div class="row related-products">
                            @foreach ($relatedProduct as $product)
                                <div class="col-lg-3 col-md-4 col-12 col-sm-6 related_product_data">
                                    <div class="product-cart-wrap hover-up">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}"
                                                    tabindex="0">
                                                    <img class="default-img"
                                                        src="{{ asset($product->product_thumbnail) }}"
                                                        alt="" />
                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                <a aria-label="Add To Wishlist" class="action-btn hover-up"
                                                    id="{{ $product->id }}" onclick="addToWishlist(this.id)"><i
                                                        class="fi-rs-heart"></i></a>

                                                <a aria-label="Compare" class="action-btn small hover-up"
                                                    id="{{ $product->id }}" onclick="addToCompare(this.id)"><i
                                                        class="fi-rs-shuffle"></i></a>

                                                <a aria-label="Quick view" class="action-btn small hover-up"
                                                    data-bs-toggle="modal" data-bs-target="#quickViewModal"
                                                    id="{{ $product->id }}" onclick="productView(this.id)"><i
                                                        class="fi-rs-eye"></i></a>
                                            </div>
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                @php
                                                    $amount = $product->selling_price - $product->discount_price;
                                                    $discount = ($amount / $product->selling_price) * 100;
                                                @endphp
                                                @if ($product->discount_price == null)
                                                    <span class="new">New</span>
                                                @else
                                                    <span class="hot"> - {{ round($discount) }} %</span>
                                                @endif
                                            </div>
                                        </div>
                                        @php
                                            $category = App\Models\Category::where('id', $product->category_id)->first();
                                        @endphp
                                        <div class="product-content-wrap">
                                            <div class="product-category">
                                                <a
                                                    href="{{ url('product/category/' . $category->id . '/' . $category->category_slug) }}">{{ $product['category']['category_name'] }}</a>
                                            </div>
                                            <h2
                                                style="overflow: hidden;
                                            line-height: 1.3em;
                                            padding: 16px 0 0;
                                            margin-bottom: 12px;
                                            text-overflow: ellipsis;
                                            white-space: initial;
                                            display: -webkit-box;
                                            -webkit-line-clamp: 2;
                                            -webkit-box-orient: vertical;
                                            min-height: 70px;
                                            height: 30px;
                                            box-sizing: border-box;">
                                                <a
                                                    href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">
                                                    {{ Str::limit($product->product_name, 48, '...') }} </a>
                                            </h2>



                                            @php
                                                $average = \App\Models\Review::where('product_id', $product->id)
                                                    ->where('status', 1)
                                                    ->avg('rating');
                                                $count_review = \App\Models\Review::where('product_id', $product->id)
                                                    ->where('status', 1)
                                                    ->count('rating');
                                            @endphp
                                            <div class="product-rate-cover">
                                                @if ($average == 0)
                                                    <div class="product-rate d-inline-block">
                                                        <div class="product-rating" style="width: 0%"></div>
                                                    </div>
                                                    <span class="font-small ml-5 text-muted">
                                                        ({{ $count_review }} reviews)
                                                    </span>
                                                @elseif($average == 1)
                                                    <div class="product-rate d-inline-block">
                                                        <div class="product-rating" style="width: 20%"></div>
                                                    </div>
                                                    <span class="font-small ml-5 text-muted">
                                                        ({{ $count_review }} reviews)
                                                    </span>
                                                @elseif($average > 1 && $average < 2)
                                                    <div class="product-rate d-inline-block">
                                                        <div class="product-rating" style="width: 30%"></div>
                                                    </div>
                                                    <span class="font-small ml-5 text-muted">
                                                        ({{ $count_review }} reviews)
                                                    </span>
                                                @elseif($average == 2)
                                                    <div class="product-rate d-inline-block">
                                                        <div class="product-rating" style="width: 40%"></div>
                                                    </div>
                                                    <span class="font-small ml-5 text-muted">
                                                        ({{ $count_review }}
                                                        reviews)
                                                    </span>
                                                @elseif($average > 2 && $average < 3)
                                                    <div class="product-rate d-inline-block">
                                                        <div class="product-rating" style="width: 50%"></div>
                                                    </div>
                                                    <span class="font-small ml-5 text-muted">
                                                        ({{ $count_review }} reviews)
                                                    </span>
                                                @elseif($average == 3)
                                                    <div class="product-rate d-inline-block">
                                                        <div class="product-rating" style="width: 60%"></div>
                                                    </div>
                                                    <span class="font-small ml-5 text-muted">
                                                        ({{ $count_review }} reviews)
                                                    </span>
                                                @elseif($average > 3 && $average < 4)
                                                    <div class="product-rate d-inline-block">
                                                        <div class="product-rating" style="width: 70%"></div>
                                                    </div>
                                                    <span class="font-small ml-5 text-muted">
                                                        ({{ $count_review }} reviews)
                                                    </span>
                                                @elseif($average == 4)
                                                    <div class="product-rate d-inline-block">
                                                        <div class="product-rating" style="width: 80%"></div>
                                                    </div>
                                                    <span class="font-small ml-5 text-muted">
                                                        ({{ $count_review }} reviews)
                                                    </span>
                                                @elseif($average > 4 && $average < 5)
                                                    <div class="product-rate d-inline-block">
                                                        <div class="product-rating" style="width: 90%"></div>
                                                    </div>
                                                    <span class="font-small ml-5 text-muted">
                                                        ({{ $count_review }} reviews)
                                                    </span>
                                                @elseif($average == 5)
                                                    <div class="product-rate d-inline-block">
                                                        <div class="product-rating" style="width: 100%"></div>
                                                    </div>
                                                    <span class="font-small ml-5 text-muted">
                                                        ({{ $count_review }} reviews)
                                                    </span>
                                                @endif
                                            </div>




                                            <div>
                                                <span class="font-small text-muted">By <a
                                                        href="#">Nest</a></span>
                                            </div>
                                            <div class="product-card-bottom">
                                                @if ($product->discount_price == null)
                                                    <div class="product-price">
                                                        <span>${{ $product->selling_price }}</span>

                                                    </div>
                                                @else
                                                    <div class="product-price">
                                                        <span>${{ $product->discount_price }}</span>
                                                        <span class="old-price">${{ $product->selling_price }}</span>
                                                    </div>
                                                @endif
                                                <div class="add-cart">
                                                    <input type="hidden" value="{{ $product->id }}"
                                                        class="related_prod_id">

                                                    <input type="hidden" class="related_pname"
                                                        value="{{ $product->product_name }}">
                                                    <input type="hidden" class="related_brand_id"
                                                        value="{{ $product->brand_id }}">
                                                    <a class="add RelatedProductAddToCart" type="submit"><i
                                                            class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Start Related Product Add To Cart --}}
<script type="text/javascript">
    $(document).ready(function() {
        $('.RelatedProductAddToCart').click(function(e) {
            e.preventDefault();
            var id = $(this).closest('.related_product_data').find('.related_prod_id').val();
            var product_name = $(this).closest('.related_product_data').find(
                '.related_pname').val();
            var brand_id = $(this).closest('.related_product_data').find(
                '.related_brand_id').val();
            var quantity = 1;
            $.ajax({
                type: "POST",
                url: "/related/product/cart/store/" + id,
                data: {
                    quantity: quantity,
                    product_name: product_name,
                    brand_id: brand_id,
                },
                dataType: "json",
                success: function(data) {
                    if (data.error_quantity) {
                        // Start Message
                        const Toast = Swal.mixin({
                            position: 'center',
                            title: 'Sorry!',
                            timerProgressBar: true,
                            showConfirmButton: true,
                            timer: 3000,
                            confirmButtonText: "OK",
                            confirmButtonColor: '#3BB77E',
                        })
                        Toast.fire({
                            icon: 'error',
                            text: data.error_quantity,
                        })
                        // End Message
                    } else {
                        miniCart();
                        // Start Message
                        const Toast = Swal.mixin({
                            position: 'top-end',
                            toast: true,
                            showConfirmButton: false,
                            timer: 3000,
                        })
                        if ($.isEmptyObject(data.error)) {
                            Toast.fire({
                                icon: 'success',
                                title: data.success,
                            })
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: data.error,
                            })
                        }
                        // End Message
                    }
                }
            });
        });
    });
</script>
{{-- End Related Product Add To Cart --}}

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
                    required: 'Please enter your review of the product.',
                    maxlength: 'Your product review cannot be longer than 500 characters.',
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
