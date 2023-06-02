@extends('frontend.master_dashboard')
@section('main')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
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
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (32 reviews)</span>
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
                                @if ($product->vendor_id == null)
                                    <h6>Sold By <a href=""> <span class="text-danger">Owner</span></a></h6>
                                @else
                                    <h6>Sold By <a href="#"> <span
                                                class="text-danger">{{ $product['vendor']['shop_name'] }}</span></a></h6>
                                @endif
                                <hr>
                                <div class="font-xs">
                                    <ul class="mr-50 float-start">
                                        <li class="mb-5">Product Code: <a href="#">{{ $product->product_code }}</a>
                                        </li>
                                        <li class="mb-5">Brand: <span
                                                class="text-brand">{{ $product['brand']['brand_name'] }}</span></li>
                                        <li class="mb-5">Category: <span
                                                class="text-brand">{{ $product['category']['category_name'] }}</span>
                                        </li>
                                        <li class="mb-5">SubCategory: <span
                                                class="text-brand">{{ $product['subcategory']['subcategory_name'] }}</span>
                                        </li>
                                    </ul>
                                    <ul class="float-start">
                                        <li class="mb-5">Tags: <a href="#"
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
                                        <li>Stock:<span class="in-stock text-brand ml-5">({{ $product->product_quantity }})
                                                Items
                                                In Stock</span></li>
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
                                    <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab"
                                        href="#Additional-info">Additional info</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Vendor-info-tab" data-bs-toggle="tab"
                                        href="#Vendor-info">Vendor</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Reviews
                                        (3)</a>
                                </li>
                            </ul>
                            <div class="tab-content shop_info_tab entry-main-content">
                                <div class="tab-pane fade show active" id="Description">
                                    <div class="">
                                        <p>{!! $product->long_description !!}</p>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="Additional-info">
                                    <table class="font-md">
                                        <tbody>
                                            <tr class="stand-up">
                                                <th>Stand Up</th>
                                                <td>
                                                    <p>35″L x 24″W x 37-45″H(front to back wheel)</p>
                                                </td>
                                            </tr>
                                            <tr class="folded-wo-wheels">
                                                <th>Folded (w/o wheels)</th>
                                                <td>
                                                    <p>32.5″L x 18.5″W x 16.5″H</p>
                                                </td>
                                            </tr>
                                            <tr class="folded-w-wheels">
                                                <th>Folded (w/ wheels)</th>
                                                <td>
                                                    <p>32.5″L x 24″W x 18.5″H</p>
                                                </td>
                                            </tr>
                                            <tr class="door-pass-through">
                                                <th>Door Pass Through</th>
                                                <td>
                                                    <p>24</p>
                                                </td>
                                            </tr>
                                            <tr class="frame">
                                                <th>Frame</th>
                                                <td>
                                                    <p>Aluminum</p>
                                                </td>
                                            </tr>
                                            <tr class="weight-wo-wheels">
                                                <th>Weight (w/o wheels)</th>
                                                <td>
                                                    <p>20 LBS</p>
                                                </td>
                                            </tr>
                                            <tr class="weight-capacity">
                                                <th>Weight Capacity</th>
                                                <td>
                                                    <p>60 LBS</p>
                                                </td>
                                            </tr>
                                            <tr class="width">
                                                <th>Width</th>
                                                <td>
                                                    <p>24″</p>
                                                </td>
                                            </tr>
                                            <tr class="handle-height-ground-to-handle">
                                                <th>Handle height (ground to handle)</th>
                                                <td>
                                                    <p>37-45″</p>
                                                </td>
                                            </tr>
                                            <tr class="wheels">
                                                <th>Wheels</th>
                                                <td>
                                                    <p>12″ air / wide track slick tread</p>
                                                </td>
                                            </tr>
                                            <tr class="seat-back-height">
                                                <th>Seat back height</th>
                                                <td>
                                                    <p>21.5″</p>
                                                </td>
                                            </tr>
                                            <tr class="head-room-inside-canopy">
                                                <th>Head room (inside canopy)</th>
                                                <td>
                                                    <p>25″</p>
                                                </td>
                                            </tr>
                                            <tr class="pa_color">
                                                <th>Color</th>
                                                <td>
                                                    <p>Black, Blue, Red, White</p>
                                                </td>
                                            </tr>
                                            <tr class="pa_size">
                                                <th>Size</th>
                                                <td>
                                                    <p>M, S</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>


                                <div class="tab-pane fade" id="Vendor-info">
                                    <div class="vendor-logo d-flex mb-30">
                                        <img src="{{ !empty($product->vendor->photo) ? url('upload/vendor_images/' . $product->vendor->photo) : url('upload/no_image.jpg') }}"
                                            alt="" />
                                        <div class="vendor-name ml-15">
                                            @if ($product->vendor_id == null)
                                                <h6>
                                                    <a href="vendor-details-2.html">Owner</a>
                                                </h6>
                                            @else
                                                <h6>
                                                    <a
                                                        href="vendor-details-2.html">{{ $product['vendor']['shop_name'] }}</a>
                                                </h6>
                                            @endif

                                            <div class="product-rate-cover text-end">
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width: 90%"></div>
                                                </div>
                                                <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($product->vendor_id == null)
                                        <ul class="contact-infor mb-50">
                                            <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-location.svg') }}"
                                                    alt="" /><strong>Address: </strong>
                                                <span>Owner</span>
                                            </li>
                                            <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-contact.svg') }}"
                                                    alt="" /><strong>Contact
                                                    Seller: </strong><span>Owner</span></li>
                                        </ul>
                                    @else
                                        <ul class="contact-infor mb-50">
                                            <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-location.svg') }}"
                                                    alt="" /><strong>Address: </strong>
                                                <span>{{ $product['vendor']['address'] }}</span>
                                            </li>
                                            <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-contact.svg') }}"
                                                    alt="" /><strong>Contact
                                                    Seller: </strong><span>{{ $product['vendor']['phone'] }}</span></li>
                                        </ul>
                                    @endif
                                    @if ($product->vendor_id == null)
                                        <p>Owner Information</p>
                                    @else
                                        <p>{{ $product['vendor']['vendor_short_info'] }}</p>
                                    @endif
                                </div>


                                <div class="tab-pane fade" id="Reviews">
                                    <!--Comments-->
                                    <div class="comments-area">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <h4 class="mb-30">Customer questions & answers</h4>
                                                <div class="comment-list">
                                                    <div class="single-comment justify-content-between d-flex mb-30">
                                                        <div class="user justify-content-between d-flex">
                                                            <div class="thumb text-center">
                                                                <img src="{{ asset('frontend/assets/imgs/blog/author-2.png') }}"
                                                                    alt="" />
                                                                <a href="#"
                                                                    class="font-heading text-brand">Sienna</a>
                                                            </div>
                                                            <div class="desc">
                                                                <div class="d-flex justify-content-between mb-10">
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="font-xs text-muted">December 4,
                                                                            2022
                                                                            at 3:12 pm </span>
                                                                    </div>
                                                                    <div class="product-rate d-inline-block">
                                                                        <div class="product-rating" style="width: 100%">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p class="mb-10">Lorem ipsum dolor sit amet,
                                                                    consectetur
                                                                    adipisicing elit. Delectus, suscipit exercitationem
                                                                    accusantium obcaecati quos voluptate nesciunt
                                                                    facilis
                                                                    itaque modi commodi dignissimos sequi repudiandae
                                                                    minus
                                                                    ab deleniti totam officia id incidunt? <a
                                                                        href="#" class="reply">Reply</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="single-comment justify-content-between d-flex mb-30 ml-30">
                                                        <div class="user justify-content-between d-flex">
                                                            <div class="thumb text-center">
                                                                <img src="{{ asset('frontend/assets/imgs/blog/author-3.png') }}"
                                                                    alt="" />
                                                                <a href="#"
                                                                    class="font-heading text-brand">Brenna</a>
                                                            </div>
                                                            <div class="desc">
                                                                <div class="d-flex justify-content-between mb-10">
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="font-xs text-muted">December 4,
                                                                            2022
                                                                            at 3:12 pm </span>
                                                                    </div>
                                                                    <div class="product-rate d-inline-block">
                                                                        <div class="product-rating" style="width: 80%">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p class="mb-10">Lorem ipsum dolor sit amet,
                                                                    consectetur
                                                                    adipisicing elit. Delectus, suscipit exercitationem
                                                                    accusantium obcaecati quos voluptate nesciunt
                                                                    facilis
                                                                    itaque modi commodi dignissimos sequi repudiandae
                                                                    minus
                                                                    ab deleniti totam officia id incidunt? <a
                                                                        href="#" class="reply">Reply</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="single-comment justify-content-between d-flex">
                                                        <div class="user justify-content-between d-flex">
                                                            <div class="thumb text-center">
                                                                <img src="{{ asset('frontend/assets/imgs/blog/author-4.png') }}"
                                                                    alt="" />
                                                                <a href="#"
                                                                    class="font-heading text-brand">Gemma</a>
                                                            </div>
                                                            <div class="desc">
                                                                <div class="d-flex justify-content-between mb-10">
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="font-xs text-muted">December 4,
                                                                            2022
                                                                            at 3:12 pm </span>
                                                                    </div>
                                                                    <div class="product-rate d-inline-block">
                                                                        <div class="product-rating" style="width: 80%">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <p class="mb-10">Lorem ipsum dolor sit amet,
                                                                    consectetur
                                                                    adipisicing elit. Delectus, suscipit exercitationem
                                                                    accusantium obcaecati quos voluptate nesciunt
                                                                    facilis
                                                                    itaque modi commodi dignissimos sequi repudiandae
                                                                    minus
                                                                    ab deleniti totam officia id incidunt? <a
                                                                        href="#" class="reply">Reply</a></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <h4 class="mb-30">Customer reviews</h4>
                                                <div class="d-flex mb-30">
                                                    <div class="product-rate d-inline-block mr-15">
                                                        <div class="product-rating" style="width: 90%"></div>
                                                    </div>
                                                    <h6>4.8 out of 5</h6>
                                                </div>
                                                <div class="progress">
                                                    <span>5 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 50%"
                                                        aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <span>4 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 25%"
                                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <span>3 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 45%"
                                                        aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">45%
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <span>2 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 65%"
                                                        aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">65%
                                                    </div>
                                                </div>
                                                <div class="progress mb-30">
                                                    <span>1 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 85%"
                                                        aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%
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
                                        <div class="product-rate d-inline-block mb-30"></div>
                                        <div class="row">
                                            <div class="col-lg-8 col-md-12">
                                                <form class="form-contact comment_form" action="#" id="commentForm">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9"
                                                                    placeholder="Write Comment"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <input class="form-control" name="name" id="name"
                                                                    type="text" placeholder="Name" />
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <input class="form-control" name="email" id="email"
                                                                    type="email" placeholder="Email" />
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <input class="form-control" name="website" id="website"
                                                                    type="text" placeholder="Website" />
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

                                                    <a aria-label="Compare" class="action-btn small hover-up" id="{{ $product->id }}"
                                                        onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>

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
                                                <h2><a
                                                        href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">
                                                        {{ $product->product_name }} </a></h2>
                                                <div class="product-rate-cover">
                                                    <div class="product-rate d-inline-block">
                                                        <div class="product-rating" style="width: 90%"></div>
                                                    </div>
                                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
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
                                                        <input type="hidden" value="{{ $product->id }}"
                                                            class="related_prod_id">
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
                var quantity = 1;
                $.ajax({
                    type: "POST",
                    url: "/related/product/cart/store/" + id,
                    data: {
                        quantity: quantity
                    },
                    dataType: "json",
                    success: function(data) {
                        miniCart();
                        //Start Message
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000
                        })
                        if ($.isEmptyObject(data.error)) {
                            Toast.fire({
                                type: 'success',
                                icon: 'success',
                                title: data.success,
                            })
                        } else {
                            Toast.fire({
                                type: 'error',
                                icon: 'error',
                                title: data.error,
                            })
                        }
                        //End Message
                    }
                });
            });
        });
    </script>
    {{-- End Related Product Add To Cart --}}
@endsection
