<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>Become Vendor Page </title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/assets/imgs/theme/favicon.svg') }}" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css?v=5.3') }}" />
</head>

<body>

    @include('frontend.body.header')
    <!--End header-->

    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Become Vendor
                </div>
            </div>
        </div>
        <div class="page-content pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 col-lg-10 col-md-12 m-auto">
                        <div class="row">
                            <div class="col-lg-6 col-md-8">
                                <div class="login_wrap widget-taber-content background-white">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h1 class="mb-5">Become Vendor</h1>
                                            <p class="mb-30">Already have an Vendor account? <a
                                                    href="{{ route('vendor.login') }}">Vendor Login</a></p>
                                        </div>
                                        @if ($errors->any())
                                            @foreach ($errors->all() as $error)
                                                <div class="alert alert-danger alert-dismissible fade show"
                                                    role="alert">
                                                    <strong>{{ $error }}</strong>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="Close"></button>
                                                </div>
                                            @endforeach
                                        @endif
                                        <form method="POST" action="{{ route('vendor.register') }}" id="myForm">
                                            @csrf
                                            <div class="form-group">
                                                <input class="form-control" type="text" id="name" required=""
                                                    name="name" placeholder="Full Name *"
                                                    value="{{ old('name') }}" />
                                            </div>

                                            <div class="form-group">
                                                <input class="form-control" type="text" id="shop_name" required=""
                                                    name="shop_name" placeholder="Shop Name *"
                                                    value="{{ old('shop_name') }}" />
                                            </div>

                                            <div class="form-group">
                                                <input class="form-control" type="text" id="username" required=""
                                                    name="username" placeholder="Username *"
                                                    value="{{ old('username') }}" />
                                            </div>

                                            <div class="form-group">
                                                <input class="form-control" type="text" id="vendor_join"
                                                    required="" name="vendor_join" placeholder="Founded Year *"
                                                    value="{{ old('vendor_join') }}" />
                                            </div>

                                            <div class="form-group">
                                                <input class="form-control" type="email" id="email" required=""
                                                    name="email" placeholder="Email *" value="{{ old('email') }}" />
                                            </div>

                                            <div class="form-group">
                                                <input class="form-control" type="text" id="phone" required=""
                                                    name="phone" placeholder="Phone *" value="{{ old('phone') }}" />
                                            </div>

                                            <div class="form-group">
                                                <input class="form-control" required="" id="password"
                                                    type="password" name="password" placeholder="Password *" />
                                            </div>

                                            <div class="form-group">
                                                <input class="form-control" required="" id="password_confirmation"
                                                    type="password" name="password_confirmation"
                                                    placeholder="Confirm password *" />
                                            </div>


                                            <div class="login_footer form-group mb-50">
                                                <div class="chek-form">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="checkbox" id="exampleCheckbox12" value="" />
                                                        <label class="form-check-label"
                                                            for="exampleCheckbox12"><span>I
                                                                agree to terms &amp; Policy.</span></label>
                                                    </div>
                                                </div>
                                                <a href="page-privacy-policy.html"><i
                                                        class="fi-rs-book-alt mr-5 text-muted"></i>Lean more</a>
                                            </div>
                                            <div class="form-group mb-30">
                                                <button type="submit"
                                                    class="btn btn-fill-out btn-block hover-up font-weight-bold"
                                                    name="login">Submit &amp; Register</button>
                                            </div>
                                            <p class="font-xs text-muted"><strong>Note:</strong>Your personal data will
                                                be used to support your experience throughout this website, to manage
                                                access to your account, and for other purposes described in our privacy
                                                policy</p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 pr-30 d-none d-lg-block">
                                <div class="card-login mt-115">
                                    <a href="#" class="social-login facebook-login">
                                        <img src="{{ asset('frontend/assets/imgs/theme/icons/logo-facebook.svg') }}"
                                            alt="" />
                                        <span>Continue with Facebook</span>
                                    </a>
                                    <a href="#" class="social-login google-login">
                                        <img src="{{ asset('frontend/assets/imgs/theme/icons/logo-google.svg') }}"
                                            alt="" />
                                        <span>Continue with Google</span>
                                    </a>
                                    <a href="#" class="social-login apple-login">
                                        <img src="{{ asset('frontend/assets/imgs/theme/icons/logo-apple.svg') }}"
                                            alt="" />
                                        <span>Continue with Apple</span>
                                    </a>
                                </div>
                                <div class="card-login mt-1">
                                    <h6 class="mb-15">Password must:</h6>
                                    <p>Be more than 8 characters long.</p>
                                    <p>Include at least tow of the following:</p>
                                    <ol class="list-insider">
                                        <li>An uppercase character</li>
                                        <li>A lowercase character</li>
                                        <li>A number</li>
                                        <li>A special character</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    @include('frontend.body.footer')


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

    <!-- Bootstrap JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
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

    <script src="{{ asset('frontend/assets/js/validate.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 255,
                    },
                    username: {
                        required: true,
                        maxlength: 255,
                    },
                    shop_name: {
                        required: true,
                        maxlength: 255,
                    },
                    vendor_join: {
                        required: true,
                        checkYear: true,
                    },
                    email: {
                        required: true,
                        maxlength: 255,
                        email: true,
                    },
                    phone: {
                        required: true,
                        minlength: 10,
                        maxlength: 10,
                        digits: true,
                    },
                    password: {
                        required: true,
                        validatePassword: true,
                        minlength: 8
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: "#password",
                    },
                },
                messages: {
                    name: {
                        required: 'Please enter your full name.',
                        maxlength: 'The full name must not be greater than 255 characters.',
                    },
                    username: {
                        required: 'Please enter your username.',
                        maxlength: 'The user name must not be greater than 255 characters.',
                    },
                    shop_name: {
                        required: 'Please enter your shop name.',
                        maxlength: 'The shop name must not be greater than 255 characters.',
                    },
                    vendor_join: {
                        required: 'Please enter the year your store was established.',
                    },
                    email: {
                        required: 'Please enter your email.',
                        maxlength: 'The email must not be greater than 255 characters.',
                        email: 'The email must be a valid email address.',
                    },
                    phone: {
                        required: 'Please enter your phone number.',
                        minlength: 'Please enter 10 numeric characters correctly.',
                        maxlength: 'Please enter 10 numeric characters correctly.',
                        digits: 'Please enter 10 numeric characters correctly.',
                    },
                    password: {
                        required: 'Please enter your password.',
                        minlength: ''
                    },
                    password_confirmation: {
                        required: 'Please enter your confirmation password.',
                        equalTo: "The two passwords must be the same.",
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
            $.validator.addMethod("validatePassword", function(value, element) {
                    return this.optional(element) || /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,16}$/i
                        .test(
                            value);
                },
                "Your password must be more than 8 characters long, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character."
            );
            $.validator.addMethod("checkYear", function(value, element) {
                var year = $(element).val();
                return (year >= 1800) && (year <= (new Date()).getFullYear());
            }, "The year you entered is not valid (The year must be from 1800 to 2023).");
        });
    </script>
</body>

</html>
