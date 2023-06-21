@extends('frontend.master_dashboard')
@section('main')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <div class="page-header mt-30 mb-50">
        <div class="container">
            <div class="archive-header">
                <div class="row align-items-center">
                    <div class="col-xl-3">
                        <h1 class="mb-15">{{ $breadsubcategory->subcategory_name }}</h1>
                        <div class="breadcrumb">
                            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                            <span></span>{{ $breadsubcategory->category->category_name }} <span></span>
                            {{ $breadsubcategory->subcategory_name }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="container mb-30">
        <div class="row flex-row-reverse">
            <div class="col-lg-4-5">
                <div class="shop-product-fillter">
                    <div class="totall-product">
                        <p>We found <strong class="text-brand" style="font-weight: bold;">{{ count($products) }}</strong>
                            items for you!</p>
                    </div>
                    <div class="sort-by-product-area">
                        <div class="sort-by-cover mr-10">
                            <div class="sort-by-product-wrap">
                                <div class="sort-by">
                                    <span><i class="fi-rs-apps"></i>Show:</span>
                                </div>
                                <div class="sort-by-dropdown-wrap">
                                    <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                                </div>
                            </div>
                            <div class="sort-by-dropdown">
                                <ul>
                                    <li><a class="active" href="#">50</a></li>
                                    <li><a href="#">100</a></li>
                                    <li><a href="#">150</a></li>
                                    <li><a href="#">200</a></li>
                                    <li><a href="#">All</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="sort-by-cover">
                            <div class="sort-by-product-wrap">
                                <div class="sort-by">
                                    <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                </div>
                                <div class="sort-by-dropdown-wrap">
                                    <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                                </div>
                            </div>
                            <div class="sort-by-dropdown">
                                <ul>
                                    <li><a class="active" href="#">Featured</a></li>
                                    <li><a href="#">Price: Low to High</a></li>
                                    <li><a href="#">Price: High to Low</a></li>
                                    <li><a href="#">Release Date</a></li>
                                    <li><a href="#">Avg. Rating</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row product-grid">
                    @foreach ($products as $product)
                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn subcat_product_data"
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
                                    $subcategory = App\Models\SubCategory::where('category_id', $category->id)->first();
                                @endphp
                                <div class="product-content-wrap">
                                    <div class="product-category">
                                        <a
                                            href="{{ url('product/subcategory/' . $subcategory->id . '/' . $subcategory->subcategory_slug) }}">{{ $product['subcategory']['subcategory_name'] }}</a>
                                    </div>
                                    <h2><a
                                            href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">
                                            {{ $product->product_name }} </a></h2>



                                    @php
                                        $avarage = \App\Models\Review::where('product_id', $product->id)
                                            ->where('status', 1)
                                            ->avg('rating');
                                    @endphp

                                    <div class="product-rate-cover">
                                        @if ($avarage == 0)
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 0%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (0.0)</span>
                                        @elseif($avarage == 1)
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 20%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (1.0)</span>
                                        @elseif($avarage > 1 && $avarage < 2)
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 30%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> ({{ $avarage }})</span>
                                        @elseif($avarage == 2)
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 40%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (2.0)</span>
                                        @elseif($avarage > 2 && $avarage < 3)
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 50%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> ({{ $avarage }})</span>
                                        @elseif($avarage == 3)
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 60%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (3.0)</span>
                                        @elseif($avarage > 3 && $avarage < 4)
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 70%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> ({{ $avarage }})</span>
                                        @elseif($avarage == 4)
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 80%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        @elseif($avarage > 4 && $avarage < 5)
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> ({{ $avarage }})</span>
                                        @elseif($avarage == 5)
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 100%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (5.0)</span>
                                        @endif
                                    </div>



                                    <div>
                                        @if ($product->vendor_id == null)
                                            <span class="font-small text-muted">By <a
                                                    href="vendor-details-1.html">Owner</a></span>
                                        @else
                                            <span class="font-small text-muted">By <a
                                                    href="vendor-details-1.html">{{ $product['vendor']['shop_name'] }}</a></span>
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
                                            <input type="hidden" value="{{ $product->id }}" class="subcat_prod_id">

                                            <input type="hidden" class="subcategory_view_pname"
                                                value="{{ $product->product_name }}">
                                            <input type="hidden" class="subcategory_view_vendor_id"
                                                value="{{ $product->vendor_id }}">
                                            <input type="hidden" class="subcategory_view_brand_id"
                                                value="{{ $product->brand_id }}">
                                            <a class="add SubCategoryProductAddToCart" type="submit"><i
                                                    class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end product card-->
                    @endforeach



                </div>
                <!--product grid-->
                <div class="pagination-area mt-20 mb-20">
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
                <!--End Deals-->
            </div>
            <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
                <div class="sidebar-widget widget-category-2 mb-30">
                    <h5 class="section-title style-1 mb-30">Category</h5>
                    <ul>

                        @foreach ($categories as $category)
                            @php

                                $products = App\Models\Product::where('category_id', $category->id)->get();

                            @endphp

                            <li>
                                <a href="{{ url('product/category/' . $category->id . '/' . $category->category_slug) }}">
                                    <img src=" {{ asset($category->category_image) }} "
                                        alt="" />{{ $category->category_name }}</a><span class="text-brand"
                                    style="font-weight: bold;">{{ count($products) }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- Fillter By Price -->

                <!-- Product sidebar Widget -->
                <div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
                    <h5 class="section-title style-1 mb-30">New products</h5>

                    @foreach ($newProduct as $product)
                        <div class="single-post clearfix">
                            <div class="image">
                                <img src="{{ asset($product->product_thumbnail) }}" alt="#" />
                            </div>
                            <div class="content pt-10">
                                <p><a
                                        href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">{{ $product->product_name }}</a>
                                </p>

                                @if ($product->discount_price == null)
                                    <p class="price mb-0 mt-5">${{ $product->selling_price }}</p>
                                @else
                                    <p class="price mb-0 mt-5">${{ $product->discount_price }}</p>
                                @endif

                                @php
                                    $avarage = \App\Models\Review::where('product_id', $product->id)
                                        ->where('status', 1)
                                        ->avg('rating');
                                @endphp
                                @if ($avarage == 0)
                                    <div class="product-rate">
                                        <div class="product-rating" style="width: 0%"></div>
                                    </div>
                                @elseif($avarage == 1)
                                    <div class="product-rate">
                                        <div class="product-rating" style="width: 20%"></div>
                                    </div>
                                @elseif($avarage > 1 && $avarage < 2)
                                    <div class="product-rate">
                                        <div class="product-rating" style="width: 30%"></div>
                                    </div>
                                @elseif($avarage == 2)
                                    <div class="product-rate">
                                        <div class="product-rating" style="width: 40%"></div>
                                    </div>
                                @elseif($avarage > 2 && $avarage < 3)
                                    <div class="product-rate">
                                        <div class="product-rating" style="width: 50%"></div>
                                    </div>
                                @elseif($avarage == 3)
                                    <div class="product-rate">
                                        <div class="product-rating" style="width: 60%"></div>
                                    </div>
                                @elseif($avarage > 3 && $avarage < 4)
                                    <div class="product-rate">
                                        <div class="product-rating" style="width: 70%"></div>
                                    </div>
                                @elseif($avarage == 4)
                                    <div class="product-rate">
                                        <div class="product-rating" style="width: 80%"></div>
                                    </div>
                                @elseif($avarage > 4 && $avarage < 5)
                                    <div class="product-rate">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                @elseif($avarage == 5)
                                    <div class="product-rate">
                                        <div class="product-rating" style="width: 100%"></div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

    {{-- Start SubCategory Product Add To Card --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $('.SubCategoryProductAddToCart').click(function(e) {
                e.preventDefault();
                var id = $(this).closest('.subcat_product_data').find('.subcat_prod_id').val();
                var product_name = $(this).closest('.subcat_product_data').find(
                    '.subcategory_view_pname').val();
                var vendor_id = $(this).closest('.subcat_product_data').find(
                    '.subcategory_view_vendor_id').val();
                var brand_id = $(this).closest('.subcat_product_data').find(
                    '.subcategory_view_brand_id').val();
                var quantity = 1;
                $.ajax({
                    type: "POST",
                    url: "/subcategory/product/cart/store/" + id,
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
    {{-- End SubCategory Product Add To Card --}}
@endsection
