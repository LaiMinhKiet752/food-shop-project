@php
    $products = \App\Models\Product::where('status', 1)
        ->where('product_quantity', '>', '0')
        ->orderBy('id', 'DESC')
        ->limit(5)
        ->get();
    $categories = \App\Models\Category::orderBy('category_name', 'ASC')->limit(5)->get();
@endphp

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<section class="product-tabs section-padding position-relative">
    <div class="container">
        <div class="section-title style-2 wow animate__animated animate__fadeIn">
            <h3> Sản phẩm mới </h3>
            <ul class="nav nav-tabs links" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-one"
                        type="button" role="tab" aria-controls="tab-one" aria-selected="true">TẤT CẢ</button>
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

                                        <a aria-label="Thêm vào yêu thích" class="action-btn" id="{{ $product->id }}"
                                            onclick="addToWishlist(this.id)"><i class="fi-rs-heart"></i></a>

                                        <a aria-label="Thêm vào so sánh" class="action-btn" id="{{ $product->id }}"
                                            onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>

                                        <a aria-label="Xem nhanh" class="action-btn" data-bs-toggle="modal"
                                            data-bs-target="#quickViewModal" id="{{ $product->id }}"
                                            onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>

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
                                    $category = \App\Models\Category::where('id', $product->category_id)->first();
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
                                    height: 25px;
                                    box-sizing: border-box;">
                                        <a
                                            href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">
                                            {{ Str::limit($product->product_name, 50, '...') }}</a>
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
                                    </div>




                                    <div>

                                    </div>
                                    <div class="product-card-bottom">
                                        @if ($product->discount_price == null)
                                            <div class="product-price">
                                                <span>{{ number_format($product->selling_price, 0, ',', '.') }}đ</span>

                                            </div>
                                        @else
                                            <div class="product-price">
                                                <span>{{ number_format($product->discount_price, 0, ',', '.') }}đ</span>
                                                <span class="old-price"
                                                    style="margin: 0 0 0 5px;">{{ number_format($product->selling_price, 0, ',', '.') }}đ</span>
                                            </div>
                                        @endif
                                        <div class="add-cart">
                                            <input type="hidden" value="{{ $product->id }}" class="prod_id">

                                            <input type="hidden" class="homnew_pname"
                                                value="{{ $product->product_name }}">
                                            <input type="hidden" class="homnew_brand_id"
                                                value="{{ $product->brand_id }}">

                                            <a class="add homeNewProductAddToCart" type="submit"
                                                style="padding: 4px 15px 4px 15px;"><i
                                                    class="fi-rs-shopping-cart mr-5"></i>Mua</a>
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
                                ->limit(10)
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

                                            <a aria-label="Thêm vào yêu thích" class="action-btn"
                                                id="{{ $product->id }}" onclick="addToWishlist(this.id)"><i
                                                    class="fi-rs-heart"></i></a>

                                            <a aria-label="Thêm vào so sánh" class="action-btn"
                                                id="{{ $product->id }}" onclick="addToCompare(this.id)"><i
                                                    class="fi-rs-shuffle"></i></a>

                                            <a aria-label="Xem nhanh" class="action-btn" data-bs-toggle="modal"
                                                data-bs-target="#quickViewModal" id="{{ $product->id }}"
                                                onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
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
                                        </div>


                                        <div>

                                        </div>
                                        <div class="product-card-bottom">
                                            @if ($product->discount_price == null)
                                                <div class="product-price">
                                                    <span>{{ number_format($product->selling_price, 0, ',', '.') }}đ</span>

                                                </div>
                                            @else
                                                <div class="product-price">
                                                    <span>{{ number_format($product->discount_price, 0, ',', '.') }}đ</span>
                                                    <span
                                                        class="old-price">{{ number_format($product->selling_price, 0, ',', '.') }}đ</span>
                                                </div>
                                            @endif
                                            <div class="add-cart">
                                                <input type="hidden" value="{{ $product->id }}"
                                                    class="cat_prod_id">

                                                <input type="hidden" class="home_new_category_pname"
                                                    value="{{ $product->product_name }}">
                                                <input type="hidden" class="home_new_category_brand_id"
                                                    value="{{ $product->brand_id }}">
                                                <a class="add homeNewProductCategoryAddToCart" type="submit"><i
                                                        class="fi-rs-shopping-cart mr-5"></i>Mua </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end product card-->

                        @empty
                            <h5 class="text-danger"> Không tìm thấy sản phẩm nào. </h5>
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
                var brand_id = $(this).closest('.product_data').find('.homnew_brand_id').val();
                var quantity = 1;
                $.ajax({
                    type: "POST",
                    url: "/home/new/product/cart/store/" + id,
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
                                timer: 2000,
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
                                timer: 2000,
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
                var brand_id = $(this).closest('.cat_product_data').find('.home_new_category_brand_id')
                    .val();
                var quantity = 1;
                $.ajax({
                    type: "POST",
                    url: "/home/new/product/category/cart/store/" + id,
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
                                timer: 2000,
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
                                timer: 2000,
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
        // End Home New Product Category Page Add To Cart
    </script>


</section>
