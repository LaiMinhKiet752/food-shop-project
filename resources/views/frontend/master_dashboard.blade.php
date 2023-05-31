<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>Nest - Food Shop </title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/assets/imgs/theme/favicon.svg') }}" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css?v=5.3') }}" />

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
</head>

<body>
    <!-- Modal -->

    <!-- Quick view -->
    @include('frontend.body.quickview')
    <!-- Header  -->
    @include('frontend.body.header')
    <!-- End Header  -->

    <main class="main">
        @yield('main')
    </main>


    <!-- Footer -->
    @include('frontend.body.footer')
    <!-- End Footer -->
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="text-center">
                    <img src="{{ asset('frontend/assets/imgs/theme/loading.gif') }}" alt="" />
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Vendor JS-->
    <script src="{{ asset('frontend/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/slick.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.syotimer.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/waypoints.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/wow.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/magnific-popup.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/counterup.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/images-loaded.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/isotope.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/scrollup.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.vticker-min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.theia.sticky.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.elevatezoom.js') }}"></script>
    <!-- Template  JS -->
    <script src="{{ asset('frontend/assets/js/main.js?v=5.3') }}"></script>
    <script src="{{ asset('frontend/assets/js/shop.js?v=5.3') }}"></script>


    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        // Start Product View With Modal
        function productView(id) {
            // alert(id)
            $.ajax({
                type: 'GET',
                url: '/product/view/modal/' + id,
                dataType: 'json',
                success: function(data) {
                    // console.log(data)
                    $('#pname').text(data.product.product_name);
                    $('#pprice').text(data.product.selling_price);
                    $('#pcode').text(data.product.product_code);
                    $('#pcategory').text(data.product.category.category_name);
                    $('#pbrand').text(data.product.brand.brand_name);
                    $('#pimage').attr('src', '/' + data.product.product_thumbnail);

                    $('#product_id').val(id);
                    $('#qty').val(1);

                    // Product Price
                    if (data.product.discount_price == null) {
                        $('#pprice').text('');
                        $('#oldprice').text('');
                        $('#pprice').text('$' + data.product.selling_price);

                    } else {
                        $('#pprice').text('$' + data.product.discount_price);
                        $('#oldprice').text('$' + data.product.selling_price);
                    }

                    //Start Stock Option
                    if (data.product.product_quantity > 0) {
                        $('#instock').text('');
                        $('#outofstock').text('');
                        $('#instock').text('In Stock');
                    } else {
                        $('#instock').text('');
                        $('#outofstock').text('');
                        $('#outofstock').text('Out Of Stock');
                    }
                    //End Stock Option
                }
            })
        }
        // End Product View With Modal

        // Start Add To Cart Product
        function addToCart() {
            var product_name = $('#pname').text();
            var id = $('#product_id').val();
            var quantity = $('#qty').val();

            $.ajax({
                type: "POST",
                dataType: 'json',
                data: {
                    quantity: quantity,
                    product_name: product_name
                },
                url: "/cart/data/store/" + id,
                success: function(data) {
                    miniCart();
                    $('#closeModal').click();
                    // console.log(data)

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
            })
        }
        // End Add To Cart Product

        // Start Details Page Add To Cart Product
        function addToCartDetails() {
            var product_name = $('#dpname').text();
            var id = $('#dproduct_id').val();
            var quantity = $('#dqty').val();
            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: {
                    quantity: quantity,
                    product_name: product_name
                },
                url: "/dcart/data/store/" + id,
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
            })
        }
        // End Details Page Add To Cart Product
    </script>

    <script type="text/javascript">
        //Start Mini Cart
        function miniCart() {
            $.ajax({
                type: 'GET',
                url: '/product/mini/cart',
                dataType: 'json',
                success: function(response) {
                    // console.log(response)
                    $('#cartQty').text(response.cartQty);
                    $('span[id="cartSubTotal"]').text('$' + response.cartTotal);

                    var miniCart = "";
                    $.each(response.carts, function(key, value) {
                        miniCart += ` <ul>
                                    <li>
                                        <div class="shopping-cart-img">
                                            <a href="shop-product-right.html"><img alt="Nest" src="/${value.options.image} " style="width: 60px;height: 60px;" /></a>
                                        </div>
                                        <div class="shopping-cart-title" style="margin: -73px 74px 14px; width" 146px;>
                                            <h4><a href="shop-product-right.html"> ${value.name} </a></h4>
                                            <h4><span>${value.qty} × </span>$${value.price}</h4>
                                        </div>
                                        <div class="shopping-cart-delete" style="margin: -85px 1px 0px;">
                                            <a type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)"><i class="fi-rs-cross-small"></i></a>
                                        </div>
                                    </li>
                                    </ul>
                                    <hr><br>
                                        `
                    });

                    $('#miniCart').html(miniCart);
                }
            })
        }
        miniCart();
        //End Mini Cart

        //Start Mini Cart Remove
        function miniCartRemove(rowId) {
            $.ajax({
                type: 'GET',
                url: '/minicart/product/remove/' + rowId,
                dataType: 'json',
                success: function(data) {
                    miniCart();
                    // Start Message
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
                    // End Message
                }
            })
        }
        //End Mini Cart Remove
    </script>

    <!--  /// Start Load Wishlist Data -->
    <script type="text/javascript">
        function wishlist() {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "/get-wishlist-product",
                success: function(response) {
                    $('#wishlistQty').text(response.wishlistQuantity);
                    $('#countproductwishlist').text(response.wishlistQuantity);
                    var rows = "";
                    $.each(response.wishlist, function(key, value) {
                        rows += `<tr class="pt-30">
                        <td class="custome-checkbox pl-30">
                        </td>
                        <td class="image product-thumbnail pt-40"><img src="/${value.product.product_thumbnail}" alt="#" /></td>
                        <td class="product-des product-name">
                            <h6><a class="product-name mb-10" href="${`product/details/${value.product.id}/${value.product.product_slug}`}">${value.product.product_name}</a></h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>
                        </td>
                        <td class="price" data-title="Price">
                        ${(value.product.discount_price == null || value.product.discount_price == 0)
                        ? `<h3 class="text-brand">$${value.product.selling_price}</h3>`
                        :`<h3 class="text-brand">$${value.product.discount_price}</h3>`
                        }
                        </td>
                        <td class="text-center detail-info" data-title="Stock">
                            ${value.product.product_quantity > 0
                                ? `<span class="stock-status in-stock mb-0"> In Stock </span>`
                                :`<span class="stock-status out-stock mb-0"> Out Of Stock </span>`
                            }

                        </td>
                        <td class="action text-center" data-title="Remove">
                            <a type="submit" class="text-body" id="${value.id}" onclick="wishlistRemove(this.id)"><i class="fi-rs-trash"></i></a>
                        </td>
                    </tr> `
                    });
                    $('#wishlist').html(rows);
                }
            })
        }

        wishlist();


        function wishlistRemove(id) {
            $.ajax({
                type: "GET",
                url: "/wishlist-remove/" + id,
                dataType: "json",
                success: function(data) {
                    wishlist();
                    // Start Message
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
                    // End Message
                }
            });
        }
    </script>
    <!--  /// End Load Wishlist Data -->

    <!--  /// Start Add To Wishlist -->
    <script type="text/javascript">
        function addToWishlist(product_id) {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: "/add-to-wishlist/" + product_id,
                success: function(data) {
                    wishlist();
                    // Start Message
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
                    // End Message
                }
            })
        }
    </script>
    <!--  /// End Add To Wishlist -->



    <!--  /// Start Load Data To Compare -->
    <script type="text/javascript">
        function compare() {
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: "/get-compare-product",
                success: function(response) {
                    $('#compareQty').text(response.compareQuantity);
                    $('#countproductcompare').text(response.compareQuantity);
                    var images = `<td class="text-muted font-sm fw-600 font-heading mw-200">Preview</td>`;
                    var title = `<td class="text-muted font-sm fw-600 font-heading">Name</td>`;
                    var price = `<td class="text-muted font-sm fw-600 font-heading">Price</td>`;
                    var rating = ``;
                    var description = `<td class="text-muted font-sm fw-600 font-heading">Description</td>`;
                    var stock = `<td class="text-muted font-sm fw-600 font-heading">Stock status</td>`;
                    var weight = `<td class="text-muted font-sm fw-600 font-heading">Weight</td>`;
                    var dimensions = `<td class="text-muted font-sm fw-600 font-heading">Dimensions</td>`;
                    var details = `<td class="text-muted font-sm fw-600 font-heading">Watch now</td>`;
                    var remove = `<td class="text-muted font-md fw-600"></td>`;

                    $.each(response.compare, function(key, value) {
                        images +=
                            `<td class="row_img"><img src="/${value.product.product_thumbnail}"alt="compare-img" /></td>`;
                        title += `<td class="product_name">
                                    <h6 class="text-heading">${value.product.product_name}</h6>
                                </td>`;
                        price += `<td class="product_price">
                                    <h4 class="price text-brand">${(value.product.discount_price == null || value.product.discount_price == 0)
                        ? `$${value.product.selling_price}`
                        :`$${value.product.discount_price}`
                        }</h4>
                                    </td>`;

                        description += `<td class="row_text font-xs">
                                    <p class="font-sm text-muted">${value.product.short_description}</p>
                                        </td>`;

                        stock += `<td class="row_stock">${value.product.product_quantity > 0 ? `<span class="stock-status in-stock mb-0">In Stock</span>` :`<span class="stock-status out-stock mb-0">Out Of Stock</span>`}
                            </td>`;

                        weight += `<td class="row_weight">${value.product.product_weight}</td>`;

                        dimensions += `<td class="row_dimensions">${(value.product.product_dimensions == null)?`N/A`:`${value.product.product_dimensions}`}</td>`;

                        details += `<td class="row_btn">
                                        ${value.product.product_quantity > 0 ?
                                            `<a href="${`product/details/${value.product.id}/${value.product.product_slug}`}" class="btn btn-sm" type="submit"><i class="fi-rs-shopping-cart mr-5"></i>Details</a>`:`<button class="btn btn-sm btn-secondary"><i class="fi-rs-headset mr-5"></i>Contact Us</button>`}
                                    </td>`;
                        remove += `<td class="row_remove">
                                    <a type="submit" class="text-muted" id="${value.id}" onclick="compareRemove(this.id)"><i class="fi-rs-trash mr-5"></i><span>Remove</span>
                                    </a>
                                    </td>`;
                    });
                    $('#images').html(images);
                    $('#title').html(title);
                    $('#price').html(price);
                    $('#rating').html(rating);
                    $('#product_description').html(description);
                    $('#stock').html(stock);
                    $('#weight').html(weight);
                    $('#dimensions').html(dimensions);
                    $('#details').html(details);
                    $('#remove').html(remove);
                }
            });
        }
        compare();

        function compareRemove(id) {
            $.ajax({
                type: "GET",
                url: "/compare-remove/" + id,
                dataType: "json",
                success: function(data) {
                    compare();
                    // Start Message
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
                    // End Message
                }
            });
        }
    </script>
    <!--  /// End Load Data To Compare -->

    <!--  /// Start Add To Compare -->
    <script type="text/javascript">
        function addToCompare(product_id) {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: "/add-to-compare/" + product_id,
                success: function(data) {
                    compare();
                    // Start Message
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
                    // End Message
                }
            })
        }
    </script>
    <!--  /// End Add To Compare -->


</body>

</html>
