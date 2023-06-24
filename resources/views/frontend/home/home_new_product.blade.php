@php
    $products = \App\Models\Product::where('status', 1)
        ->where('product_quantity', '>', '0')
        ->orderBy('id', 'DESC')
        ->limit(10)
        ->get();
    $categories = \App\Models\Category::orderBy('category_name', 'ASC')
        ->limit(10)
        ->get();
@endphp

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<section class="product-tabs section-padding position-relative">
    <div class="container">
        <div class="section-title style-2 wow animate__animated animate__fadeIn">
            <h3> New Products </h3>
            <ul class="nav nav-tabs links" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-one"
                        type="button" role="tab" aria-controls="tab-one" aria-selected="true">All</button>
                </li>
                @foreach ($categories as $category)
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="nav-tab-two" data-bs-toggle="tab" href="#category{{ $category->id }}"
                            type="button" role="tab" aria-controls="tab-two"
                            aria-selected="false">{{ $category->category_name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <!--End nav-tabs-->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                <div class="row product-grid-4">
                    @foreach ($products as $product)
                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn product_data"
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
                                    $category = \App\Models\Category::where('id', $product->category_id)->first();
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
                                            <input type="hidden" value="{{ $product->id }}" class="prod_id">

                                            <input type="hidden" class="homnew_pname"
                                                value="{{ $product->product_name }}">
                                            <input type="hidden" class="homnew_vendor_id"
                                                value="{{ $product->vendor_id }}">
                                            <input type="hidden" class="homnew_brand_id"
                                                value="{{ $product->brand_id }}">

                                            <a class="add homeNewProductAddToCart" type="submit"><i
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
            <!--En tab one-->

            @foreach ($categories as $category)
                <div class="tab-pane fade" id="category{{ $category->id }}" role="tabpanel"
                    aria-labelledby="tab-two">
                    <div class="row product-grid-4">
                        @php
                            $catwiseProduct = \App\Models\Product::where('category_id', $category->id)
                                ->where('status', 1)
                                ->orderBy('id', 'DESC')
                                ->get();
                        @endphp
                        @forelse($catwiseProduct as $product)
                            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn cat_product_data"
                                    data-wow-delay=".1s">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a
                                                href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">
                                                <img class="default-img"
                                                    src="{{ asset($product->product_thumbnail) }}" alt="" />

                                            </a>
                                        </div>
                                        <div class="product-action-1">

                                            <a aria-label="Add To Wishlist" class="action-btn"
                                                id="{{ $product->id }}" onclick="addToWishlist(this.id)"><i
                                                    class="fi-rs-heart"></i></a>

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
                                                <span class="font-small text-muted">By <a
                                                        href="#">Owner</a></span>
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
                                                <input type="hidden" value="{{ $product->id }}"
                                                    class="cat_prod_id">

                                                <input type="hidden" class="home_new_category_pname"
                                                    value="{{ $product->product_name }}">
                                                <input type="hidden" class="home_new_category_vendor_id"
                                                    value="{{ $product->vendor_id }}">
                                                <input type="hidden" class="home_new_category_brand_id"
                                                    value="{{ $product->brand_id }}">
                                                <a class="add homeNewProductCategoryAddToCart" type="submit"><i
                                                        class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end product card-->

                        @empty
                            <h5 class="text-danger"> No Product Found </h5>
                        @endforelse
                    </div>
                    <!--End product-grid-4-->
                </div>
                <!--En tab two-->
            @endforeach
        </div>
        <!--End tab-content-->
    </div>


    <script type="text/javascript">
        // Start Home New Product Page Add To Cart
        $(document).ready(function() {
            $('.homeNewProductAddToCart').click(function(e) {
                e.preventDefault();
                var id = $(this).closest('.product_data').find('.prod_id').val();
                var product_name = $(this).closest('.product_data').find('.homnew_pname').val();
                var vendor_id = $(this).closest('.product_data').find('.homnew_vendor_id').val();
                var brand_id = $(this).closest('.product_data').find('.homnew_brand_id').val();
                var quantity = 1;
                $.ajax({
                    type: "POST",
                    url: "/home/new/product/cart/store/" + id,
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
        // End Home New Product Page Add To Cart
    </script>

    <script type="text/javascript">
        // Start Home New Product Category Page Add To Cart
        $(document).ready(function() {
            $('.homeNewProductCategoryAddToCart').click(function(e) {
                e.preventDefault();
                var id = $(this).closest('.cat_product_data').find('.cat_prod_id').val();
                var product_name = $(this).closest('.cat_product_data').find('.home_new_category_pname')
                    .val();
                var vendor_id = $(this).closest('.cat_product_data').find('.home_new_category_vendor_id')
                    .val();
                var brand_id = $(this).closest('.cat_product_data').find('.home_new_category_brand_id')
                    .val();
                var quantity = 1;
                $.ajax({
                    type: "POST",
                    url: "/home/new/product/category/cart/store/" + id,
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
        // End Home New Product Category Page Add To Cart
    </script>


</section>
