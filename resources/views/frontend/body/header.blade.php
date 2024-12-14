@php
    $setting = \App\Models\SiteSetting::find(1);
@endphp
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    #searchProducts {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background: #ffffff;
        z-index: 999;
        border-radius: 8px;
        margin-top: 5px;
    }
</style>

<script>
    function search_result_show() {
        $("#searchProducts").slideDown();
    }

    function search_result_hide() {
        $("#searchProducts").slideUp();
    }
</script>
<!-- Header  -->
<header class="header-area header-style-1 header-height-2">

    <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="header-wrap">
                <div class="logo logo-width-1">
                    <a href="{{ url('/') }}"><img src="{{ asset($setting->logo) }}" alt="logo" /></a>
                </div>
                @php
                    $all_categories = \App\Models\Category::orderBy('id', 'DESC')->get();
                @endphp
                <div class="header-right">


                    <div class="search-style-2">
                        <form action="{{ route('product.search') }}" method="post">
                            @csrf

                            <input onfocus="search_result_show()" onblur="search_result_hide()" name="search"
                                id="search" placeholder="Bạn muốn tìm gì..." />
                            <div id="searchProducts"></div>
                        </form>
                    </div>


                    <div class="header-action-right">
                        <div class="header-action-2">
                            <div class="header-action-icon-2">
                                <a href="{{ route('compare') }}">
                                    <img class="svgInject" alt="Bảo Linh"
                                        src="{{ asset('frontend/assets/imgs/theme/icons/icon-compare.svg') }}" />
                                    <span class="pro-count blue" id="compareQty">0</span>
                                </a>
                                <a href="{{ route('compare') }}"><span class="lable">So sánh</span></a>
                            </div>

                            <div class="header-action-icon-2">
                                <a href="{{ route('wishlist') }}">
                                    <img class="svgInject" alt="Bảo Linh"
                                        src="{{ asset('frontend/assets/imgs/theme/icons/icon-heart.svg') }}" />
                                    <span class="pro-count blue" id="wishlistQty">0</span>
                                </a>
                                <a href="{{ route('wishlist') }}"><span class="lable">Yêu thích</span></a>
                            </div>

                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="{{ route('mycart') }}">
                                    <img alt="Bảo Linh"
                                        src="{{ asset('frontend/assets/imgs/theme/icons/icon-cart.svg') }}" />
                                    <span class="pro-count blue" id="cartQty">0</span>
                                </a>
                                <a href="{{ route('mycart') }}"><span class="lable">Giỏ hàng</span></a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2">

                                    {{-- Mini Cart Start With Ajax --}}
                                    <div id="miniCart">

                                    </div>
                                    {{-- End Mini Cart Start With Ajax --}}

                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">
                                            <h4>Tổng cộng <span id="cartSubTotal"></span></h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="{{ route('mycart') }}" class="outline">Xem giỏ hàng</a>
                                            <a href="{{ route('checkout') }}">Thanh toán</a>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            @auth
                                <div class="header-action-icon-2">
                                    <a href="{{ route('dashboard') }}">
                                        <img class="svgInject" alt="Bảo Linh"
                                            src="{{ asset('frontend/assets/imgs/theme/icons/icon-user.svg') }}" />
                                    </a>
                                    <a href="{{ route('dashboard') }}"><span class="lable ml-0">Tài khoản</span></a>
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                        <ul>
                                            <li>
                                                <a href="{{ route('user.account.page') }}"><i
                                                        class="fi fi-rs-user mr-10"></i>Quản lý tài khoản</a>
                                            </li>

                                            <li>
                                                <a href="{{ route('user.change.password') }}"><i
                                                        class="fa-solid fa-code-compare mr-10"></i>Đổi mật khẩu</a>
                                            </li>

                                            <li>
                                                <a href="{{ route('user.order.page') }}"><i
                                                        class="fa-solid fa-cart-shopping mr-10"></i>Đơn đặt hàng</a>
                                            </li>

                                            <li>
                                                <a href="{{ route('user.logout') }}"><i
                                                        class="fi fi-rs-sign-out mr-10"></i>Đăng xuất</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @else
                                <div class="header-action-icon-2">
                                    <a href="{{ route('login') }}">
                                        <img class="svgInject" alt="Bảo Linh"
                                            src="{{ asset('frontend/assets/imgs/theme/icons/icon-user.svg') }}" />
                                    </a>
                                    <a href="{{ route('login') }}"><span class="lable ml-0">Đăng nhập</span></a>

                                    <span class="lable" style="margin-left: 2px; margin-right: 2px;"> | </span>

                                    <a href="{{ route('register') }}"><span class="lable ml-0">Đăng ký</span></a>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="header-bottom header-bottom-bg-color sticky-bar">
        <div class="container">
            <div class="header-wrap header-space-between position-relative">
                <div class="logo logo-width-1 d-block d-lg-none">
                    <a href="{{ url('/') }}"><img src="{{ asset('frontend/assets/imgs/theme/logo.png') }}"
                            alt="logo" /></a>
                </div>
                <div class="header-nav d-none d-lg-flex">

                    <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                        <nav>
                            <ul>

                                <li>
                                    <a class="active" href="{{ url('/') }}">TRANG CHỦ </a>
                                </li>

                                @php
                                    $categories = App\Models\Category::orderBy('category_name', 'ASC')->limit(8)->get();
                                @endphp

                                @foreach ($categories as $category)
                                    <li>
                                        <a
                                            href="{{ url('product/category/' . $category->id . '/' . $category->category_slug) }}">{{ $category->category_name }}</a>
                                    </li>
                                @endforeach

                                <li>
                                    <a href="{{ route('home.blog') }}">BLOG & TIN TỨC</a>
                                </li>
                                <li>
                                    <a href="{{ route('contact') }}">LIÊN HỆ</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- End Header  -->
