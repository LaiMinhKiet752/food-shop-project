@extends('frontend.master_dashboard')
@section('main')
@section('title')
    Nest - Food Shop
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
@include('frontend.home.home_slider')
<!--End hero slider-->
@include('frontend.home.home_featured_category')
<!--End category slider-->
@include('frontend.home.home_banner')
<!--End banners-->
@include('frontend.home.home_new_product')
<!--Products Tabs-->
@include('frontend.home.home_featured_product')
<!--End Best Sales-->


<!-- Category 1 -->
<section class="product-tabs section-padding position-relative">
    <div class="container">
        <div class="section-title style-2 wow animate__animated animate__fadeIn">
            <h3>{{ $skip_category_0->category_name }} Category</h3>
        </div>
        <!--End nav-tabs-->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                <div class="row product-grid-4">
                    @foreach ($skip_product_0 as $product)
                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn cat1_product_data"
                                data-wow-delay=".1s">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a
                                            href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">
                                            <img class="default-img" src="{{ asset($product->product_thumbnail) }}"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}"
                                            onclick="addToWishlist(this.id)"><i class="fi-rs-heart"></i></a>

                                        <a aria-label="Compare" class="action-btn" id="{{ $product->id }}"
                                            onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>

                                        <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal"
                                            data-bs-target="#quickViewModal" id="{{ $product->id }}"
                                            onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
                                    </div>

                                    @php
                                        $amount = $product->selling_price - $product->discount_price;
                                        $discount = ($amount / $product->selling_price) * 100;

                                    @endphp
                                    <div class="product-badges product-badges-position product-badges-mrg">
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
                                    <h2><a
                                            href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">
                                            {{ $product->product_name }} </a></h2>



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
                                        @if ($product->vendor_id == null)
                                            <span class="font-small text-muted">By <a href="#">Owner</a></span>
                                        @else
                                            <span class="font-small text-muted">By <a
                                                    href="{{ route('vendor.details', $product['vendor']['id']) }}">{{ $product['vendor']['shop_name'] }}</a></span>
                                        @endif
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
                                            <input type="hidden" value="{{ $product->id }}" class="cat1_prod_id">

                                            <input type="hidden" class="cat1_pname"
                                                value="{{ $product->product_name }}">
                                            <input type="hidden" class="cat1_vendor_id"
                                                value="{{ $product->vendor_id }}">
                                            <input type="hidden" class="cat1_brand_id"
                                                value="{{ $product->brand_id }}">
                                            <a class="add CategoryOneProductAddToCart" type="submit"><i
                                                    class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end product card-->
                    @endforeach
                </div>
                <!--End product-grid-4-->
            </div>
        </div>
        <!--End tab-content-->
    </div>
</section>
<!-- End Category 1 -->


<!-- Category 2 -->
<section class="product-tabs section-padding position-relative">
    <div class="container">
        <div class="section-title style-2 wow animate__animated animate__fadeIn">
            <h3>{{ $skip_category_1->category_name }} Category</h3>
        </div>
        <!--End nav-tabs-->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                <div class="row product-grid-4">
                    @foreach ($skip_product_1 as $product)
                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn cat2_product_data"
                                data-wow-delay=".1s">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a
                                            href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">
                                            <img class="default-img" src="{{ asset($product->product_thumbnail) }}"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}"
                                            onclick="addToWishlist(this.id)"><i class="fi-rs-heart"></i></a>

                                        <a aria-label="Compare" class="action-btn" id="{{ $product->id }}"
                                            onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>

                                        <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal"
                                            data-bs-target="#quickViewModal" id="{{ $product->id }}"
                                            onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
                                    </div>

                                    @php
                                        $amount = $product->selling_price - $product->discount_price;
                                        $discount = ($amount / $product->selling_price) * 100;

                                    @endphp
                                    <div class="product-badges product-badges-position product-badges-mrg">
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
                                    <h2><a
                                            href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">
                                            {{ $product->product_name }} </a></h2>



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
                                        @if ($product->vendor_id == null)
                                            <span class="font-small text-muted">By <a href="#">Owner</a></span>
                                        @else
                                            <span class="font-small text-muted">By <a
                                                    href="{{ route('vendor.details', $product['vendor']['id']) }}">{{ $product['vendor']['shop_name'] }}</a></span>
                                        @endif
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
                                            <input type="hidden" value="{{ $product->id }}" class="cat2_prod_id">

                                            <input type="hidden" class="cat2_pname"
                                                value="{{ $product->product_name }}">
                                            <input type="hidden" class="cat2_vendor_id"
                                                value="{{ $product->vendor_id }}">
                                            <input type="hidden" class="cat2_brand_id"
                                                value="{{ $product->brand_id }}">
                                            <a class="add CategoryTwoProductAddToCart" type="submit"><i
                                                    class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end product card-->
                    @endforeach
                </div>
                <!--End product-grid-4-->
            </div>
        </div>
        <!--End tab-content-->
    </div>
</section>
<!-- End Category 2 -->


<!-- Category 3 -->
<section class="product-tabs section-padding position-relative">
    <div class="container">
        <div class="section-title style-2 wow animate__animated animate__fadeIn">
            <h3>{{ $skip_category_2->category_name }} Category</h3>
        </div>
        <!--End nav-tabs-->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                <div class="row product-grid-4">
                    @foreach ($skip_product_2 as $product)
                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn cat3_product_data"
                                data-wow-delay=".1s">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a
                                            href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">
                                            <img class="default-img" src="{{ asset($product->product_thumbnail) }}"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}"
                                            onclick="addToWishlist(this.id)"><i class="fi-rs-heart"></i></a>

                                        <a aria-label="Compare" class="action-btn" id="{{ $product->id }}"
                                            onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>

                                        <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal"
                                            data-bs-target="#quickViewModal" id="{{ $product->id }}"
                                            onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
                                    </div>

                                    @php
                                        $amount = $product->selling_price - $product->discount_price;
                                        $discount = ($amount / $product->selling_price) * 100;

                                    @endphp
                                    <div class="product-badges product-badges-position product-badges-mrg">
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
                                    <h2><a
                                            href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">
                                            {{ $product->product_name }} </a></h2>



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
                                        @if ($product->vendor_id == null)
                                            <span class="font-small text-muted">By <a href="#">Owner</a></span>
                                        @else
                                            <span class="font-small text-muted">By <a
                                                    href="{{ route('vendor.details', $product['vendor']['id']) }}">{{ $product['vendor']['shop_name'] }}</a></span>
                                        @endif
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
                                            <input type="hidden" value="{{ $product->id }}" class="cat3_prod_id">

                                            <input type="hidden" class="cat3_pname"
                                                value="{{ $product->product_name }}">
                                            <input type="hidden" class="cat3_vendor_id"
                                                value="{{ $product->vendor_id }}">
                                            <input type="hidden" class="cat3_brand_id"
                                                value="{{ $product->brand_id }}">
                                            <a class="add CategoryThreeProductAddToCart" type="submit"><i
                                                    class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end product card-->
                    @endforeach
                </div>
                <!--End product-grid-4-->
            </div>
        </div>
        <!--End tab-content-->
    </div>
</section>
<!-- End Category 3 -->


<!-- Category 4 -->
<section class="product-tabs section-padding position-relative">
    <div class="container">
        <div class="section-title style-2 wow animate__animated animate__fadeIn">
            <h3>{{ $skip_category_3->category_name }} Category</h3>
        </div>
        <!--End nav-tabs-->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                <div class="row product-grid-4">
                    @foreach ($skip_product_3 as $product)
                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn cat4_product_data"
                                data-wow-delay=".1s">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a
                                            href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">
                                            <img class="default-img" src="{{ asset($product->product_thumbnail) }}"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}"
                                            onclick="addToWishlist(this.id)"><i class="fi-rs-heart"></i></a>

                                        <a aria-label="Compare" class="action-btn" id="{{ $product->id }}"
                                            onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>

                                        <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal"
                                            data-bs-target="#quickViewModal" id="{{ $product->id }}"
                                            onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
                                    </div>

                                    @php
                                        $amount = $product->selling_price - $product->discount_price;
                                        $discount = ($amount / $product->selling_price) * 100;

                                    @endphp
                                    <div class="product-badges product-badges-position product-badges-mrg">
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
                                    <h2><a
                                            href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">
                                            {{ $product->product_name }} </a></h2>



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
                                        @if ($product->vendor_id == null)
                                            <span class="font-small text-muted">By <a href="#">Owner</a></span>
                                        @else
                                            <span class="font-small text-muted">By <a
                                                    href="{{ route('vendor.details', $product['vendor']['id']) }}">{{ $product['vendor']['shop_name'] }}</a></span>
                                        @endif
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
                                            <input type="hidden" value="{{ $product->id }}" class="cat4_prod_id">

                                            <input type="hidden" class="cat4_pname"
                                                value="{{ $product->product_name }}">
                                            <input type="hidden" class="cat4_vendor_id"
                                                value="{{ $product->vendor_id }}">
                                            <input type="hidden" class="cat4_brand_id"
                                                value="{{ $product->brand_id }}">
                                            <a class="add CategoryFourProductAddToCart" type="submit"><i
                                                    class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end product card-->
                    @endforeach
                </div>
                <!--End product-grid-4-->
            </div>
        </div>
        <!--End tab-content-->
    </div>
</section>
<!-- End Category 4 -->


<!-- Category 5 -->
<section class="product-tabs section-padding position-relative">
    <div class="container">
        <div class="section-title style-2 wow animate__animated animate__fadeIn">
            <h3>{{ $skip_category_4->category_name }} Category</h3>
        </div>
        <!--End nav-tabs-->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                <div class="row product-grid-4">
                    @foreach ($skip_product_4 as $product)
                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn cat5_product_data"
                                data-wow-delay=".1s">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a
                                            href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">
                                            <img class="default-img" src="{{ asset($product->product_thumbnail) }}"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}"
                                            onclick="addToWishlist(this.id)"><i class="fi-rs-heart"></i></a>

                                        <a aria-label="Compare" class="action-btn" id="{{ $product->id }}"
                                            onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>

                                        <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal"
                                            data-bs-target="#quickViewModal" id="{{ $product->id }}"
                                            onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
                                    </div>

                                    @php
                                        $amount = $product->selling_price - $product->discount_price;
                                        $discount = ($amount / $product->selling_price) * 100;

                                    @endphp
                                    <div class="product-badges product-badges-position product-badges-mrg">
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
                                    <h2><a
                                            href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">
                                            {{ $product->product_name }} </a></h2>



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
                                        @if ($product->vendor_id == null)
                                            <span class="font-small text-muted">By <a href="#">Owner</a></span>
                                        @else
                                            <span class="font-small text-muted">By <a
                                                    href="{{ route('vendor.details', $product['vendor']['id']) }}">{{ $product['vendor']['shop_name'] }}</a></span>
                                        @endif
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
                                            <input type="hidden" value="{{ $product->id }}" class="cat5_prod_id">

                                            <input type="hidden" class="cat5_pname"
                                                value="{{ $product->product_name }}">
                                            <input type="hidden" class="cat5_vendor_id"
                                                value="{{ $product->vendor_id }}">
                                            <input type="hidden" class="cat5_brand_id"
                                                value="{{ $product->brand_id }}">
                                            <a class="add CategoryFiveProductAddToCart" type="submit"><i
                                                    class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end product card-->
                    @endforeach
                </div>
                <!--End product-grid-4-->
            </div>
        </div>
        <!--End tab-content-->
    </div>
</section>
<!-- End Category 5 -->


<section class="section-padding mb-30">
    <div class="container">
        <div class="row">

            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 wow animate__animated animate__fadeInUp"
                data-wow-delay="0">
                <h4 class="section-title style-1 mb-30 animated animated"> Hot Deals </h4>
                <div class="product-list-small animated animated">
                    @foreach ($hot_deals as $item)
                        <article class="row align-items-center hover-up">
                            <figure class="col-md-4 mb-0">
                                <a href="{{ url('product/details/' . $item->id . '/' . $item->product_slug) }}"><img
                                        src="{{ asset($item->product_thumbnail) }}" alt="" /></a>
                            </figure>
                            <div class="col-md-8 mb-0">
                                <h6>
                                    <a
                                        href="{{ url('product/details/' . $item->id . '/' . $item->product_slug) }}">{{ $item->product_name }}</a>
                                </h6>



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



                                <div class="product-price">
                                    @if ($item->discount_price == null)
                                        <div class="product-price">
                                            <span>${{ $item->selling_price }}</span>
                                        </div>
                                    @else
                                        <div class="product-price">
                                            <span>${{ $item->discount_price }}</span>
                                            <span class="old-price">${{ $item->selling_price }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 mb-md-0 wow animate__animated animate__fadeInUp"
                data-wow-delay=".1s">
                <h4 class="section-title style-1 mb-30 animated animated"> Special Offer </h4>
                <div class="product-list-small animated animated">
                    @foreach ($special_offer as $item)
                        <article class="row align-items-center hover-up">
                            <figure class="col-md-4 mb-0">
                                <a href="{{ url('product/details/' . $item->id . '/' . $item->product_slug) }}"><img
                                        src="{{ asset($item->product_thumbnail) }}" alt="" /></a>
                            </figure>
                            <div class="col-md-8 mb-0">
                                <h6>
                                    <a
                                        href="{{ url('product/details/' . $item->id . '/' . $item->product_slug) }}">{{ $item->product_name }}</a>
                                </h6>



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



                                <div class="product-price">
                                    @if ($item->discount_price == null)
                                        <div class="product-price">
                                            <span>${{ $item->selling_price }}</span>
                                        </div>
                                    @else
                                        <div class="product-price">
                                            <span>${{ $item->discount_price }}</span>
                                            <span class="old-price">${{ $item->selling_price }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-lg-block wow animate__animated animate__fadeInUp"
                data-wow-delay=".2s">
                <h4 class="section-title style-1 mb-30 animated animated">Recently added</h4>
                <div class="product-list-small animated animated">
                    @foreach ($new as $item)
                        <article class="row align-items-center hover-up">
                            <figure class="col-md-4 mb-0">
                                <a href="{{ url('product/details/' . $item->id . '/' . $item->product_slug) }}"><img
                                        src="{{ asset($item->product_thumbnail) }}" alt="" /></a>
                            </figure>
                            <div class="col-md-8 mb-0">
                                <h6>
                                    <a
                                        href="{{ url('product/details/' . $item->id . '/' . $item->product_slug) }}">{{ $item->product_name }}</a>
                                </h6>



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



                                <div class="product-price">
                                    @if ($item->discount_price == null)
                                        <div class="product-price">
                                            <span>${{ $item->selling_price }}</span>
                                        </div>
                                    @else
                                        <div class="product-price">
                                            <span>${{ $item->discount_price }}</span>
                                            <span class="old-price">${{ $item->selling_price }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>


            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-xl-block wow animate__animated animate__fadeInUp"
                data-wow-delay=".3s">
                <h4 class="section-title style-1 mb-30 animated animated"> Special Deals </h4>
                <div class="product-list-small animated animated">
                    @foreach ($special_deals as $item)
                        <article class="row align-items-center hover-up">
                            <figure class="col-md-4 mb-0">
                                <a href="{{ url('product/details/' . $item->id . '/' . $item->product_slug) }}"><img
                                        src="{{ asset($item->product_thumbnail) }}" alt="" /></a>
                            </figure>
                            <div class="col-md-8 mb-0">
                                <h6>
                                    <a
                                        href="{{ url('product/details/' . $item->id . '/' . $item->product_slug) }}">{{ $item->product_name }}</a>
                                </h6>



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



                                <div class="product-price">
                                    @if ($item->discount_price == null)
                                        <div class="product-price">
                                            <span>${{ $item->selling_price }}</span>
                                        </div>
                                    @else
                                        <div class="product-price">
                                            <span>${{ $item->discount_price }}</span>
                                            <span class="old-price">${{ $item->selling_price }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>


<!--Vendor List -->
@include('frontend.home.home_vendor_list')
<!--End Vendor List -->


{{-- Start Category One Add To Cart --}}
<script type="text/javascript">
    $(document).ready(function() {
        $('.CategoryOneProductAddToCart').click(function(e) {
            e.preventDefault();
            var id = $(this).closest('.cat1_product_data').find('.cat1_prod_id').val();
            var product_name = $(this).closest('.cat1_product_data').find(
                '.cat1_pname').val();
            var vendor_id = $(this).closest('.cat1_product_data').find(
                '.cat1_vendor_id').val();
            var brand_id = $(this).closest('.cat1_product_data').find(
                '.cat1_brand_id').val();
            var quantity = 1;
            $.ajax({
                type: "POST",
                url: "/categoryone/product/cart/store/" + id,
                data: {
                    quantity: quantity,
                    product_name: product_name,
                    vendor_id: vendor_id,
                    brand_id: brand_id,
                },
                dataType: "json",
                success: function(data) {
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
            });
        });
    });
</script>
{{-- End Category One Add To Cart --}}

{{-- Start Category Two Add To Cart --}}
<script type="text/javascript">
    $(document).ready(function() {
        $('.CategoryTwoProductAddToCart').click(function(e) {
            e.preventDefault();
            var id = $(this).closest('.cat2_product_data').find('.cat2_prod_id').val();
            var id = $(this).closest('.cat2_product_data').find('.cat2_prod_id').val();
            var product_name = $(this).closest('.cat2_product_data').find(
                '.cat2_pname').val();
            var vendor_id = $(this).closest('.cat2_product_data').find(
                '.cat2_vendor_id').val();
            var brand_id = $(this).closest('.cat2_product_data').find(
                '.cat2_brand_id').val();
            var quantity = 1;
            $.ajax({
                type: "POST",
                url: "/categorytwo/product/cart/store/" + id,
                data: {
                    quantity: quantity,
                    product_name: product_name,
                    vendor_id: vendor_id,
                    brand_id: brand_id,
                },
                dataType: "json",
                success: function(data) {
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
            });
        });
    });
</script>
{{-- End Category Two Add To Cart --}}

{{-- Start Category Three Add To Cart --}}
<script type="text/javascript">
    $(document).ready(function() {
        $('.CategoryThreeProductAddToCart').click(function(e) {
            e.preventDefault();
            var id = $(this).closest('.cat3_product_data').find('.cat3_prod_id').val();
            var id = $(this).closest('.cat3_product_data').find('.cat3_prod_id').val();
            var product_name = $(this).closest('.cat3_product_data').find(
                '.cat3_pname').val();
            var vendor_id = $(this).closest('.cat3_product_data').find(
                '.cat3_vendor_id').val();
            var brand_id = $(this).closest('.cat3_product_data').find(
                '.cat3_brand_id').val();
            var quantity = 1;
            $.ajax({
                type: "POST",
                url: "/categorythree/product/cart/store/" + id,
                data: {
                    quantity: quantity,
                    product_name: product_name,
                    vendor_id: vendor_id,
                    brand_id: brand_id,
                },
                dataType: "json",
                success: function(data) {
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
            });
        });
    });
</script>
{{-- End Category Three Add To Cart --}}

{{-- Start Category Four Add To Cart --}}
<script type="text/javascript">
    $(document).ready(function() {
        $('.CategoryFourProductAddToCart').click(function(e) {
            e.preventDefault();
            var id = $(this).closest('.cat4_product_data').find('.cat4_prod_id').val();
            var id = $(this).closest('.cat4_product_data').find('.cat4_prod_id').val();
            var product_name = $(this).closest('.cat4_product_data').find(
                '.cat4_pname').val();
            var vendor_id = $(this).closest('.cat4_product_data').find(
                '.cat4_vendor_id').val();
            var brand_id = $(this).closest('.cat4_product_data').find(
                '.cat4_brand_id').val();
            var quantity = 1;
            $.ajax({
                type: "POST",
                url: "/categoryfour/product/cart/store/" + id,
                data: {
                    quantity: quantity,
                    product_name: product_name,
                    vendor_id: vendor_id,
                    brand_id: brand_id,
                },
                dataType: "json",
                success: function(data) {
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
            });
        });
    });
</script>
{{-- End Category Four Add To Cart --}}

{{-- Start Category Five Add To Cart --}}
<script type="text/javascript">
    $(document).ready(function() {
        $('.CategoryFiveProductAddToCart').click(function(e) {
            e.preventDefault();
            var id = $(this).closest('.cat5_product_data').find('.cat5_prod_id').val();
            var id = $(this).closest('.cat5_product_data').find('.cat5_prod_id').val();
            var product_name = $(this).closest('.cat5_product_data').find(
                '.cat5_pname').val();
            var vendor_id = $(this).closest('.cat5_product_data').find(
                '.cat5_vendor_id').val();
            var brand_id = $(this).closest('.cat5_product_data').find(
                '.cat5_brand_id').val();
            var quantity = 1;
            $.ajax({
                type: "POST",
                url: "/categoryfive/product/cart/store/" + id,
                data: {
                    quantity: quantity,
                    product_name: product_name,
                    vendor_id: vendor_id,
                    brand_id: brand_id,
                },
                dataType: "json",
                success: function(data) {
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
            });
        });
    });
</script>
{{-- End Category Five Add To Cart --}}
@endsection
