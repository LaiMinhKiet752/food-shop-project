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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success,
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
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
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success,
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
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
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {

                        Toast.fire({
                            type: 'success',
                            title: data.success,
                        })
                    } else {

                        Toast.fire({
                            type: 'error',
                            title: data.error,
                        })
                    }
                    // End Message
                }
            })
        }
        //End Mini Cart Remove

    </script>
</body>
</html>
