@extends('frontend.master_dashboard')
@section('main')
@section('title')
    Vendor - {{ $vendor->shop_name }}
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> Vendor Details Page
        </div>
    </div>
</div>
<div class="container mb-30">
    <div class="archive-header-2 text-center pt-80 pb-50">
        <h1 class="display-2 mb-50"> {{ $vendor->shop_name }} </h1>
    </div>
    <div class="row flex-row-reverse">
        <div class="col-lg-4-5">
            <div class="shop-product-fillter">
                <div class="totall-product">
                    <p>We found <strong class="text-brand" style="font-weight: bold;">{{ count($vproduct) }}</strong>
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
                @foreach ($vproduct as $product)
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn vendor_product_data"
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
                                    $avarage = \App\Models\Review::where('product_id', $product->id)
                                        ->where('status', 1)
                                        ->avg('rating');
                                    $count_review = \App\Models\Review::where('product_id', $product->id)
                                        ->where('status', 1)
                                        ->count('rating');
                                @endphp
                                <div class="product-rate-cover">
                                    @if ($avarage == 0)
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 0%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted">
                                            ({{ $count_review }} reviews)
                                        </span>
                                    @elseif($avarage == 1)
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 20%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted">
                                            ({{ $count_review }} reviews)
                                        </span>
                                    @elseif($avarage > 1 && $avarage < 2)
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 30%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted">
                                            ({{ $count_review }} reviews)
                                        </span>
                                    @elseif($avarage == 2)
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 40%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted">
                                            ({{ $count_review }}
                                            reviews)
                                        </span>
                                    @elseif($avarage > 2 && $avarage < 3)
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 50%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted">
                                            ({{ $count_review }} reviews)
                                        </span>
                                    @elseif($avarage == 3)
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 60%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted">
                                            ({{ $count_review }} reviews)
                                        </span>
                                    @elseif($avarage > 3 && $avarage < 4)
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 70%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted">
                                            ({{ $count_review }} reviews)
                                        </span>
                                    @elseif($avarage == 4)
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 80%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted">
                                            ({{ $count_review }} reviews)
                                        </span>
                                    @elseif($avarage > 4 && $avarage < 5)
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted">
                                            ({{ $count_review }} reviews)
                                        </span>
                                    @elseif($avarage == 5)
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
                                        <input type="hidden" value="{{ $product->id }}" class="vendor_prod_id">

                                        <input type="hidden" class="vendor_details_pname"
                                            value="{{ $product->product_name }}">
                                        <input type="hidden" class="vendor_details_vendor_id"
                                            value="{{ $product->vendor_id }}">
                                        <input type="hidden" class="vendor_details_brand_id"
                                            value="{{ $product->brand_id }}">
                                        <a class="add VendorDetailsProductAddToCart" type="submit"><i
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
            <div class="sidebar-widget widget-store-info mb-30 bg-3 border-0">
                <div class="vendor-logo mb-30">
                    <img src="{{ !empty($vendor->photo) ? url('upload/vendor_images/' . $vendor->photo) : url('upload/no_image.jpg') }}"
                        alt="" />
                </div>
                <div class="vendor-info">
                    <div class="product-category">
                        <span class="text-muted">Since {{ $vendor->vendor_join }}</span>
                    </div>
                    <h4 class="mb-5"><a href="vendor-details-1.html"
                            class="text-heading">{{ $vendor->shop_name }}</a>
                    </h4>


                    @php
                        $avarage = \App\Models\Review::where('vendor_id', $product->vendor_id)
                            ->where('status', 1)
                            ->avg('rating');
                        $count_review_vendor = \App\Models\Review::where('vendor_id', $product->vendor_id)
                            ->where('status', 1)
                            ->count('rating');
                    @endphp
                    @if ($avarage == 0)
                        <div class="product-rate-cover mb-15">
                            <div class="product-rate d-inline-block">
                                <div class="product-rating" style="width: 0%"></div>
                            </div>
                            <span class="font-small ml-5 text-muted"> ({{ $count_review_vendor }} reviews)</span>
                        </div>
                    @elseif($avarage == 1)
                        <div class="product-rate-cover mb-15">
                            <div class="product-rate d-inline-block">
                                <div class="product-rating" style="width: 20%"></div>
                            </div>
                            <span class="font-small ml-5 text-muted"> ({{ $count_review_vendor }} reviews)</span>
                        </div>
                    @elseif($avarage > 1 && $avarage < 2)
                        <div class="product-rate-cover mb-15">
                            <div class="product-rate d-inline-block">
                                <div class="product-rating" style="width: 30%"></div>
                            </div>
                            <span class="font-small ml-5 text-muted"> ({{ $count_review_vendor }} reviews)</span>
                        </div>
                    @elseif($avarage == 2)
                        <div class="product-rate-cover mb-15">
                            <div class="product-rate d-inline-block">
                                <div class="product-rating" style="width: 40%"></div>
                            </div>
                            <span class="font-small ml-5 text-muted"> ({{ $count_review_vendor }} reviews)</span>
                        </div>
                    @elseif($avarage > 2 && $avarage < 3)
                        <div class="product-rate-cover mb-15">
                            <div class="product-rate d-inline-block">
                                <div class="product-rating" style="width: 50%"></div>
                            </div>
                            <span class="font-small ml-5 text-muted"> ({{ $count_review_vendor }} reviews)</span>
                        </div>
                    @elseif($avarage == 3)
                        <div class="product-rate-cover mb-15">
                            <div class="product-rate d-inline-block">
                                <div class="product-rating" style="width: 60%"></div>
                            </div>
                            <span class="font-small ml-5 text-muted"> ({{ $count_review_vendor }} reviews)</span>
                        </div>
                    @elseif($avarage > 3 && $avarage < 4)
                        <div class="product-rate-cover mb-15">
                            <div class="product-rate d-inline-block">
                                <div class="product-rating" style="width: 70%"></div>
                            </div>
                            <span class="font-small ml-5 text-muted"> ({{ $count_review_vendor }} reviews)</span>
                        </div>
                    @elseif($avarage == 4)
                        <div class="product-rate-cover mb-15">
                            <div class="product-rate d-inline-block">
                                <div class="product-rating" style="width: 80%"></div>
                            </div>
                            <span class="font-small ml-5 text-muted"> ({{ $count_review_vendor }} reviews)</span>
                        </div>
                    @elseif($avarage > 4 && $avarage < 5)
                        <div class="product-rate-cover mb-15">
                            <div class="product-rate d-inline-block">
                                <div class="product-rating" style="width: 90%"></div>
                            </div>
                            <span class="font-small ml-5 text-muted"> ({{ $count_review_vendor }} reviews)</span>
                        </div>
                    @elseif($avarage == 5)
                        <div class="product-rate-cover mb-15">
                            <div class="product-rate d-inline-block">
                                <div class="product-rating" style="width: 100%"></div>
                            </div>
                            <span class="font-small ml-5 text-muted"> ({{ $count_review_vendor }} reviews)</span>
                        </div>
                    @endif





                    <div class="vendor-des mb-30">
                        <p class="font-sm text-heading">{{ $vendor->vendor_short_info }}</p>
                    </div>
                    <div class="follow-social mb-20">
                        <h6 class="mb-15">Follow Us</h6>
                        <ul class="social-network">
                            <li class="hover-up">
                                <a href="#">
                                    <img src="{{ asset('frontend/assets/imgs/theme/icons/social-tw.svg') }}"
                                        alt="" />
                                </a>
                            </li>
                            <li class="hover-up">
                                <a href="#">
                                    <img src="{{ asset('frontend/assets/imgs/theme/icons/social-fb.svg') }}"
                                        alt="" />
                                </a>
                            </li>
                            <li class="hover-up">
                                <a href="#">
                                    <img src="{{ asset('frontend/assets/imgs/theme/icons/social-insta.svg') }}"
                                        alt="" />
                                </a>
                            </li>
                            <li class="hover-up">
                                <a href="#">
                                    <img src="{{ asset('frontend/assets/imgs/theme/icons/social-pin.svg') }}"
                                        alt="" />
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="vendor-info">
                        <ul class="font-sm mb-20">
                            <li><img class="mr-5"
                                    src="{{ asset('frontend/assets/imgs/theme/icons/icon-location.svg') }}"
                                    alt="" /><strong>Address: </strong> <span>{{ $vendor->address }}</span>
                            </li>
                            <li><img class="mr-5"
                                    src="{{ asset('frontend/assets/imgs/theme/icons/icon-contact.svg') }}"
                                    alt="" /><strong>Call Us: </strong><span>{{ $vendor->phone }}</span></li>
                        </ul>
                        <a href="vendor-details-1.html" class="btn btn-xs">Contact Seller <i
                                class="fi-rs-arrow-small-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Fillter By Price -->

        </div>
    </div>
</div>

{{-- Start Vendor Details Page Add To Cart --}}
<script type="text/javascript">
    $(document).ready(function() {
        $('.VendorDetailsProductAddToCart').click(function(e) {
            e.preventDefault();
            var id = $(this).closest('.vendor_product_data').find('.vendor_prod_id').val();
            var product_name = $(this).closest('.vendor_product_data').find(
                '.vendor_details_pname').val();
            var vendor_id = $(this).closest('.vendor_product_data').find(
                '.vendor_details_vendor_id').val();
            var brand_id = $(this).closest('.vendor_product_data').find(
                '.vendor_details_brand_id').val();
            var quantity = 1;
            $.ajax({
                type: "POST",
                url: "/vendor/details/product/cart/store/" + id,
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
{{-- End Vendor Details Page Add To Cart --}}
@endsection
