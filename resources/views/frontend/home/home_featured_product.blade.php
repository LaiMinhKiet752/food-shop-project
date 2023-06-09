<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@php
    $featured = \App\Models\Product::where('featured', 1)
        ->where('status', 1)
        ->orderBy('id', 'DESC')
        ->limit(6)
        ->get();
@endphp
<section class="section-padding pb-5">
    <div class="container">
        <div class="section-title wow animate__animated animate__fadeIn">
            <h3 class=""> Featured Products </h3>
        </div>
        <div class="row">
            <div class="col-lg-3 d-none d-lg-flex wow animate__animated animate__fadeIn">
                <div class="banner-img style-2">
                    <div class="banner-text">
                        <h2 class="mb-100">Bring nature into your home</h2>
                        <a href="shop-grid-right.html" class="btn btn-xs">Shop Now <i
                                class="fi-rs-arrow-small-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-12 wow animate__animated animate__fadeIn" data-wow-delay=".4s">
                <div class="tab-content" id="myTabContent-1">
                    <div class="tab-pane fade show active" id="tab-one-1" role="tabpanel" aria-labelledby="tab-one-1">
                        <div class="carausel-4-columns-cover arrow-center position-relative">
                            <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow"
                                id="carausel-4-columns-arrows"></div>
                            <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns">
                                @foreach ($featured as $product)
                                    <div class="product-cart-wrap featured_product_data">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a
                                                    href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">
                                                    <img class="default-img"
                                                        src="{{ asset($product->product_thumbnail) }}" alt="" />
                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                <a aria-label="Add To Wishlist" class="action-btn small hover-up"
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
                                                    href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">{{ $product->product_name }}</a>
                                            </h2>
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 80%"></div>
                                            </div>
                                            @if ($product->discount_price == null)
                                                <div class="product-price mt-10">
                                                    <span>${{ $product->selling_price }}</span>
                                                </div>
                                            @else
                                                <div class="product-price mt-10">
                                                    <span>${{ $product->discount_price }}</span>
                                                    <span class="old-price">${{ $product->selling_price }}</span>
                                                </div>
                                            @endif
                                            <div class="sold mt-15 mb-15">
                                                <div class="progress mb-5">
                                                    <div class="progress-bar" role="progressbar" style="width: 50%"
                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <input type="hidden" value="{{ $product->id }}" class="featured_prod_id">

                                            <input type="hidden" class="home_featured_category_pname"
                                                value="{{ $product->product_name }}">
                                            <input type="hidden" class="home_featured_category_vendor_id"
                                                value="{{ $product->vendor_id }}">
                                            <input type="hidden" class="home_featured_category_brand_id"
                                                value="{{ $product->brand_id }}">
                                            <a class="btn w-100 hover-up featuredProductAddToCart" type="submit"><i
                                                    class="fi-rs-shopping-cart mr-5"></i>Add To Cart </a>
                                        </div>
                                    </div>
                                    <!--End product Wrap-->
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!--End tab-pane-->
                </div>
                <!--End tab-content-->
            </div>
            <!--End Col-lg-9-->
        </div>
    </div>

    <script type="text/javascript">
        // Start Home New Product Page Add To Cart Product
        $(document).ready(function() {
            $('.featuredProductAddToCart').click(function(e) {
                e.preventDefault();
                var id = $(this).closest('.featured_product_data').find('.featured_prod_id').val();
                var product_name = $(this).closest('.featured_product_data').find(
                        '.home_featured_category_pname')
                    .val();
                var vendor_id = $(this).closest('.featured_product_data').find(
                    '.home_featured_category_vendor_id').val();
                var brand_id = $(this).closest('.featured_product_data').find(
                    '.home_featured_category_brand_id').val();
                var quantity = 1;
                $.ajax({
                    type: "POST",
                    url: "/featured/product/cart/store/" + id,
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
                            timer: 1500
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
        // Start Home New Product Page Add To Cart Product
    </script>

</section>
