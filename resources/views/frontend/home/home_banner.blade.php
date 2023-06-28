@php
    $banners = \App\Models\Banner::where('status', 'show')
        ->orderBy('id', 'DESC')
        ->limit(3)
        ->get();
@endphp
<section class="banners mb-25">
    <div class="container">
        <div class="row">
            @foreach ($banners as $item)
                <div class="col-lg-4 col-md-6">
                    <div class="banner-img wow animate__animated animate__fadeInUp" data-wow-delay="0">
                        <img src="{{ asset($item->banner_image) }}" alt="" />
                        <div class="banner-text">
                            <h4 style="font-size: 20px;">
                                {{ $item->banner_title }}
                            </h4>
                            <a href="{{ route('shop.page') }}" class="btn btn-xs">Shop Now <i
                                    class="fi-rs-arrow-small-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
