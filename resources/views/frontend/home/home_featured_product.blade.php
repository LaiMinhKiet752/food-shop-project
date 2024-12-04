<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
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
            <h3 class=""> Sản phẩm nổi bật </h3>
        </div>
        <div class="row">
            <div class="col-lg-3 d-none d-lg-flex wow animate__animated animate__fadeIn">
                <div class="banner-img style-2">
                    <div class="banner-text">
                        <h2 class="mb-100">Bring nature into your home</h2>
                        <a href="{{ route('shop.page') }}" class="btn btn-xs">Mua ngay <i
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
                                                <a aria-label="Thêm vào yêu thích" class="action-btn small hover-up"
                                                    id="{{ $product->id }}" onclick="addToWishlist(this.id)"><i
                                                        class="fi-rs-heart"></i></a>

                                                <a aria-label="Thêm vào so sánh" class="action-btn small hover-up"
                                                    id="{{ $product->id }}" onclick="addToCompare(this.id)"><i
                                                        class="fi-rs-shuffle"></i></a>

                                                <a aria-label="Xem nhanh" class="action-btn small hover-up"
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
                                                    <span class="new">Mới</span>
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
                                            min-height: 60px;
                                            height: 30px;
                                            box-sizing: border-box;">
                                                <a
                                                    href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">{{ $product->product_name }}</a>
                                            </h2>

                                            @php
                                                $average = \App\Models\Review::where('product_id', $product->id)
                                                    ->where('status', 1)
                                                    ->avg('rating');
                                                $count_review = \App\Models\Review::where('product_id', $product->id)
                                                    ->where('status', 1)
                                                    ->count('rating');
                                            @endphp

                                            @if ($average == 0)
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width: 0%"></div>
                                                </div>
                                                <span class="font-small ml-5 text-muted">
                                                    ({{ $count_review }} đánh giá)
                                                </span>
                                            @elseif($average == 1)
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width: 20%"></div>
                                                </div>
                                                <span class="font-small ml-5 text-muted">
                                                    ({{ $count_review }} đánh giá)
                                                </span>
                                            @elseif($average > 1 && $average < 2)
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width: 30%"></div>
                                                </div>
                                                <span class="font-small ml-5 text-muted">
                                                    ({{ $count_review }} đánh giá)
                                                </span>
                                            @elseif($average == 2)
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width: 40%"></div>
                                                </div>
                                                <span class="font-small ml-5 text-muted">
                                                    ({{ $count_review }}
                                                    đánh giá)
                                                </span>
                                            @elseif($average > 2 && $average < 3)
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width: 50%"></div>
                                                </div>
                                                <span class="font-small ml-5 text-muted">
                                                    ({{ $count_review }} đánh giá)
                                                </span>
                                            @elseif($average == 3)
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width: 60%"></div>
                                                </div>
                                                <span class="font-small ml-5 text-muted">
                                                    ({{ $count_review }} đánh giá)
                                                </span>
                                            @elseif($average > 3 && $average < 4)
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width: 70%"></div>
                                                </div>
                                                <span class="font-small ml-5 text-muted">
                                                    ({{ $count_review }} đánh giá)
                                                </span>
                                            @elseif($average == 4)
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width: 80%"></div>
                                                </div>
                                                <span class="font-small ml-5 text-muted">
                                                    ({{ $count_review }} đánh giá)
                                                </span>
                                            @elseif($average > 4 && $average < 5)
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width: 90%"></div>
                                                </div>
                                                <span class="font-small ml-5 text-muted">
                                                    ({{ $count_review }} đánh giá)
                                                </span>
                                            @elseif($average == 5)
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width: 100%"></div>
                                                </div>
                                                <span class="font-small ml-5 text-muted">
                                                    ({{ $count_review }} đánh giá)
                                                </span>
                                            @endif



                                            @if ($product->discount_price == null)
                                                <div class="product-price mt-10">
                                                    <span>{{ number_format($product->selling_price, 0, '.', ',') }}đ</span>
                                                </div>
                                            @else
                                                <div class="product-price mt-10">
                                                    <span>{{ number_format($product->discount_price, 0, '.', ',') }}đ</span>
                                                    <span class="old-price">{{ number_format($product->selling_price, 0, '.', ',') }}đ</span>
                                                </div>
                                            @endif
                                            <div class="sold mt-15 mb-15">

                                            </div>
                                            <input type="hidden" value="{{ $product->id }}"
                                                class="featured_prod_id">

                                            <input type="hidden" class="home_featured_category_pname"
                                                value="{{ $product->product_name }}">
                                            <input type="hidden" class="home_featured_category_brand_id"
                                                value="{{ $product->brand_id }}">
                                            <a class="btn w-100 hover-up featuredProductAddToCart" type="submit"><i
                                                    class="fi-rs-shopping-cart mr-5"></i>Mua </a>
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
                var brand_id = $(this).closest('.featured_product_data').find(
                    '.home_featured_category_brand_id').val();
                var quantity = 1;
                $.ajax({
                    type: "POST",
                    url: "/featured/product/cart/store/" + id,
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
        // Start Home New Product Page Add To Cart Product
    </script>

</section>
