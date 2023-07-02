@extends('frontend.master_dashboard')
@section('main')
@section('title')
    About
@endsection
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>HOME</a>
            <span></span> About
        </div>
    </div>
</div>
<div class="page-content pt-10 pb-10">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-8 col-md-12 m-auto">
                <div class="row">
                    <div class="heading_s1">
                        <img style="padding: 0; margin-left: 25%; margin-right: 25%; width: 300px; height: 150px;"
                            class="border-radius-15" src="{{ asset('upload/logo.svg') }}" alt="" />
                        <p class="mb-30" style="color: #037841; font-weight: 500;">NEST is an online platform where
                            consumers can purchase food products that are produced and processed using organic and
                            sustainable methods. The products on this website are generally grown or raised according to
                            strict environmental and food safety standards. By purchasing products from this website,
                            consumers can support local farmers and reduce their negative impact on the environment.
                        </p>
                    </div>
                    <div class="col-lg-12 col-md-8">
                        <div class="login_wrap widget-taber-content background-white">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                    <h4 class="mb-12">1. Our story</h4>
                                    <p class="mb-30">Nest is a website specializing in providing organic and clean food
                                        with the goal
                                        of helping Vietnamese consumers lead a healthier life through certified organic
                                        foods, natural and non-sourced foods. genetically modified (GMO) origin. We
                                        select organic foods, natural foods from domestic and foreign manufacturers and
                                        companies through a careful selection process for sourcing capabilities,
                                        standard certificates issued by world-renowned organization. We love what we do
                                        and we are passionate about the benefits of a healthy lifestyle, sourcing the
                                        highest quality organic produce to our customers and providing the best home
                                        delivery service. . We fully believe that products made from organic and natural
                                        farming and production are good for everyone's body, better for the community
                                        and better for the planet we live in.</p>
                                    <img style="width: 100%; height: 300px;" class="border-radius-15 mb-30"
                                        src="{{ asset('upload/about/about_1.jpg') }}" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-8">
                        <div class="login_wrap widget-taber-content background-white">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                    <h4 class="mb-12">2. Business mission</h4>
                                    <p class="mb-30">NEST's mission is to make it easier for people to access organic
                                        and natural foods. Not only providing organic products, we also bring useful
                                        information about the health that organic food brings to people and the
                                        community. Everyone has a different need and approach to organic and natural
                                        food, so we are here to support you by: Providing only organic foods , natural
                                        foods achieved prestigious certifications in general and verified by NEST in
                                        particular. Create positive, long-term and trusting relationships between NEST
                                        and customers, employees, suppliers and the community. Support the development
                                        of farms, small communities in remote areas, ethnic minority areas and
                                        vulnerable groups in the farming society according to organic and natural
                                        methods to have a good life.</p>
                                    <img style="width: 100%; height: 300px;" class="border-radius-15 mb-30"
                                        src="{{ asset('upload/about/about_4.png') }}" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-8">
                        <div class="login_wrap widget-taber-content background-white">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                    <h4 class="mb-12">3. Spread the good and much more</h4>
                                    <p class="mb-30">As a NEST customer you don't have to spend hours going to the
                                        market or supermarket looking for the freshest organic produce because we do it
                                        for you and then deliver it to your door. We choose fresh and certified organic
                                        products. During our packing process we also ensure that the quality of all
                                        products is further checked so that the product delivered is of the best
                                        standard.</p>
                                    <img style="width: 100%; height: 300px;" class="border-radius-15 mb-30"
                                        src="{{ asset('upload/about/about_2.jpg') }}" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-8">
                        <div class="login_wrap widget-taber-content background-white">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                    <h4 class="mb-12">4. Great customer service</h4>
                                    <p class="mb-30">Our mission is to provide the best service to our customers, to
                                        help you enjoy the best shopping experience. We love interacting with our
                                        customers and we always welcome feedback on your services. That's how we
                                        understand you better, as well as do our service better, improve ourselves more
                                        and more every day.</p>
                                    <img style="width: 100%; height: 300px;" class="border-radius-15 mb-30"
                                        src="{{ asset('upload/about/about_3.jpg') }}" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-8">
                        <div class="login_wrap widget-taber-content background-white">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                    <h4 class="mb-12">5. Above all wishes</h4>
                                    <p class="mb-30">We like to promote nutritious organic foods and minimize processed
                                        foods as much as possible. Whatever food you choose for you and your family, we
                                        insist that organic food is the healthiest lifestyle support. Organic food is
                                        not yet known by many people, but it is more and more trusted by many people
                                        because it is really good for the health of you and your family.</p>
                                    <img style="width: 100%; height: 300px;" class="border-radius-15 mb-30"
                                        src="{{ asset('upload/about/about_5.jpg') }}" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-8">
                        <div class="login_wrap widget-taber-content background-white">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                    <h4 class="mb-12">6. True Value</h4>
                                    <p class="mb-30">Most of the products we offer are certified organic in addition to
                                        some organic, all-natural farming where we also have some local growers so you
                                        can rest assured that all Our processes and systems are all rigorously tested.
                                    </p>
                                    <img style="width: 100%; height: 300px;" class="border-radius-15 mb-30"
                                        src="{{ asset('upload/about/about_6.jpg') }}" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-8">
                        <div class="login_wrap widget-taber-content background-white">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                    <h4 class="mb-12">7. Sustainable Development</h4>
                                    <p class="mb-30">Organic farming, clean food is getting better and better for our
                                        planet. We look to the places where there are non-polluted land, water and air
                                        resources to build a good ecosystem, we have mapped out the best way to save
                                        emissions. We keep waste to a minimum with food scraps donated to local
                                        residents for composting and pet food. Our packaging is reusable and can be
                                        recycled. We use certified compostable and biodegradable bags. Our boxes can be
                                        reused and we ask customers to return the paper box on their next purchase.</p>
                                    <img style="width: 100%; height: 300px;" class="border-radius-15 mb-30"
                                        src="{{ asset('upload/about/about_7.jpg') }}" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
