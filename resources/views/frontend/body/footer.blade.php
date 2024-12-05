@php
    $setting = \App\Models\SiteSetting::find(1);
@endphp
<footer class="main">
    <section class="newsletter mb-15 wow animate__animated animate__fadeIn">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="position-relative newsletter-inner">
                        <div class="newsletter-content">
                            <h2 class="mb-20">
                                Ở nhà và mua sắm nhu yếu phẩm hàng ngày <br />
                                ngay tại cửa hàng của chúng tôi.
                            </h2>
                            <p class="mb-45">Bắt đầu mua sắm hàng ngày cùng <span class="text-brand">Bảo Linh.</span></p>
                            <form class="form-subcriber d-flex" method="post"
                                action="{{ route('subscriber.send.mail') }}" id="formSubscriberSubmit">
                                @csrf
                                <input type="email" name="email" placeholder="Nhập email của bạn..." />
                                <button class="btn" type="submit" style="min-width: 150px;">Đăng ký</button>
                            </form>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <img src="{{ asset('frontend/assets/imgs/banner/banner-9.png') }}" alt="newsletter" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="featured section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 mb-md-4 mb-xl-0">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp"
                        data-wow-delay="0">
                        <div class="banner-icon">
                            <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-1.svg') }}" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Giá tốt nhất</h3>
                            <p>Giá chỉ từ 1.000 VND đến dưới 500.000 VND</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp"
                        data-wow-delay=".1s">
                        <div class="banner-icon">
                            <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-2.svg') }}" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Free Ship</h3>
                            <p>Đơn hàng có giá trị từ 200.000 VND trở lên</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp"
                        data-wow-delay=".2s">
                        <div class="banner-icon">
                            <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-3.svg') }}" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Ưu đãi mỗi ngày</h3>
                            <p>Hàng tháng bạn sẽ nhận được 1 mã khuyến mãi</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp"
                        data-wow-delay=".3s">
                        <div class="banner-icon">
                            <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-4.svg') }}" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Sản phẩm sạch</h3>
                            <p>Nguồn gốc và xuất xứ rõ ràng</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp"
                        data-wow-delay=".4s">
                        <div class="banner-icon">
                            <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-5.svg') }}" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Dễ hoàn trả</h3>
                            <p>Trong vòng 7 ngày bạn có thể hoàn trả lại sản phẩm</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 d-xl-none">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp"
                        data-wow-delay=".5s">
                        <div class="banner-icon">
                            <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-6.svg') }}" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Safe delivery</h3>
                            <p>Within 30 days</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-padding footer-mid">
        <div class="container pt-15 pb-20">
            <div class="row">
                <div class="col">
                    <div class="widget-about font-md mb-md-3 mb-lg-3 mb-xl-0 wow animate__animated animate__fadeInUp"
                        data-wow-delay="0">
                        <div class="logo mb-30">
                            <a style="max-width: 50%;" href="{{ url('/') }}" class="mb-15"><img
                                    src="{{ asset($setting->logo) }}" alt="logo" /></a>
                            <p class="font-lg text-heading">Chuyên cung cấp thực phẩm khô chay số 1 tại Việt Nam.</p>
                        </div>
                        <ul class="contact-infor">
                            <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-location.svg') }}"
                                    alt="" /><strong>Địa chỉ: </strong>
                                <span>{{ $setting->company_address }}</span>
                            </li>
                            <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-contact.svg') }}"
                                    alt="" /><strong>Hotline:
                                </strong><span>{{ $setting->call_us_phone }}</span>
                            </li>
                            <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-email-2.svg') }}"
                                    alt="" /><strong>Email: </strong><span>{{ $setting->email }}</span></li>
                        </ul>
                    </div>
                </div>
                <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                    <h4 class=" widget-title">Company</h4>
                    <ul class="footer-list mb-sm-5 mb-md-0">
                        <li><a href="{{ route('about') }}">Về chúng tôi</a></li>
                        <li><a href="{{ route('contact') }}">Liên hệ</a></li>
                        <li><a href="{{ route('home.blog') }}">Blog & Tin tức</a></li>
                        <li><a href="{{ route('privacy_policy') }}">Chính sách bảo mật</a></li>
                    </ul>
                </div>
                <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                    <h4 class="widget-title">Account</h4>
                    <ul class="footer-list mb-sm-5 mb-md-0">
                        <li><a href="{{ route('login') }}">Đăng nhập</a></li>
                        <li><a href="{{ route('register') }}">Đăng ký</a></li>
                        <li><a href="{{ route('wishlist') }}">Yêu thích</a></li>
                        <li><a href="{{ route('compare') }}">So sánh</a></li>
                    </ul>
                </div>

            </div>
    </section>
    <div class="container pb-30 wow animate__animated animate__fadeInUp" data-wow-delay="0">
        <div class="row align-items-center">
            <div class="col-12 mb-30">
                <div class="footer-bottom"></div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6">
                <p class="font-sm mb-0">&copy; {{ $setting->copyright }}</p>
            </div>
            <div class="col-xl-4 col-lg-6 text-center d-none d-xl-block">

                <div class="hotline d-lg-inline-flex">
                    <img src="{{ asset('frontend/assets/imgs/theme/icons/phone-call.svg') }}" alt="hotline" />
                    <p>{{ $setting->support_phone }}<span>Hỗ trợ 24/7</span></p>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 text-end d-none d-md-block">
                <div class="mobile-social-icon">
                    <h6>Theo dõi chúng tôi</h6>
                    <a href="{{ $setting->facebook }}"><img
                            src="{{ asset('frontend/assets/imgs/theme/icons/icon-facebook-white.svg') }}"
                            alt="" /></a>
                    <a href="{{ $setting->twitter }}"><img
                            src="{{ asset('frontend/assets/imgs/theme/icons/icon-twitter-white.svg') }}"
                            alt="" /></a>
                    <a href="{{ $setting->instagram }}"><img
                            src="{{ asset('frontend/assets/imgs/theme/icons/icon-instagram-white.svg') }}"
                            alt="" /></a>
                    <a href="{{ $setting->pinterest }}"><img
                            src="{{ asset('frontend/assets/imgs/theme/icons/icon-pinterest-white.svg') }}"
                            alt="" /></a>
                    <a href="{{ $setting->youtube }}"><img
                            src="{{ asset('frontend/assets/imgs/theme/icons/icon-youtube-white.svg') }}"
                            alt="" /></a>
                </div>
                <p class="font-sm">Giảm giá lên đến 50% cho lần đăng ký đầu tiên của bạn</p>
            </div>
        </div>
    </div>
</footer>
