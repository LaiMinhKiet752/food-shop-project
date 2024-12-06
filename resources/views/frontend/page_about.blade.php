@extends('frontend.master_dashboard')
@section('main')
@section('title')
    Về chúng tôi
@endsection
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang chủ</a>
            <span></span> Về chúng tôi
        </div>
    </div>
</div>
<div class="page-content pt-10 pb-10">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-8 col-md-12 m-auto">
                <div class="row">
                    <div class="heading_s1">
                        <img style="padding: 0; margin-left: 25%; margin-right: 25%; width: 300px; height: 300px;"
                            class="border-radius-15" src="{{ asset('upload/logo.png') }}" alt="" />
                        <p class="mb-30" style="color: #037841; font-weight: 500;">Bảo Linh là công ty chuyên cung cấp
                            thực phẩm chay khô chất lượng cao, phục vụ nhu cầu của những người tìm kiếm một chế độ ăn
                            lành mạnh, thuần chay và đầy đủ dinh dưỡng. Chúng tôi tự hào mang đến các sản phẩm thực phẩm
                            chay được chế biến từ nguyên liệu tự nhiên, đảm bảo an toàn cho sức khỏe và thân thiện với
                            môi trường.
                        </p>
                        <img style="width: 100%; height: 300px;" class="border-radius-15 mb-30"
                                        src="{{ asset('upload/about/about_1.jpg') }}" alt="" />
                    </div>
                    <div class="col-lg-12 col-md-8">
                        <div class="login_wrap widget-taber-content background-white">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                    <h4 class="mb-12">1. Câu chuyện của Bảo Linh</h4>
                                    <p class="mb-30">Bảo Linh được thành lập với sứ mệnh mang đến cho người tiêu dùng
                                        Việt Nam một lựa chọn thực phẩm chay khô chất lượng, giúp cải thiện sức khỏe và
                                        hỗ trợ lối sống lành mạnh. Chúng tôi hiểu rằng chế độ ăn uống thuần chay ngày
                                        càng trở thành xu hướng sống khỏe và bền vững, không chỉ vì lợi ích sức khỏe mà
                                        còn vì tình yêu và sự tôn trọng đối với thiên nhiên và động vật. Chính vì vậy,
                                        Bảo Linh cam kết cung cấp các sản phẩm thực phẩm chay được chế biến từ nguyên
                                        liệu tự nhiên, dễ dàng sử dụng và thân thiện với môi trường, góp phần nâng cao
                                        chất lượng cuộc sống cho mọi người.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-8">
                        <div class="login_wrap widget-taber-content background-white">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                    <h4 class="mb-12">2. Sứ mệnh của chúng tôi</h4>
                                    <p class="mb-30">Sứ mệnh của Bảo Linh là mang lại cho cộng đồng một lựa chọn thực
                                        phẩm chay khô đa dạng, chất lượng, giúp mọi người dễ dàng duy trì chế độ ăn uống
                                        lành mạnh và thuần chay. Chúng tôi không chỉ cung cấp các sản phẩm chay khô mà
                                        còn cung cấp thông tin bổ ích về lợi ích của thực phẩm chay đối với sức khỏe.
                                        Bảo Linh luôn chú trọng đến việc phát triển các sản phẩm đạt tiêu chuẩn cao về
                                        chất lượng và an toàn thực phẩm, đồng thời xây dựng mối quan hệ lâu dài và bền
                                        vững với khách hàng, đối tác và cộng đồng.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-8">
                        <div class="login_wrap widget-taber-content background-white">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                    <h4 class="mb-12">3. Cung cấp thực phẩm chất lượng cao</h4>
                                    <p class="mb-30">Tại Bảo Linh, chúng tôi luôn lựa chọn những nguyên liệu tự nhiên
                                        và thực phẩm chay khô chất lượng cao từ những nguồn cung cấp uy tín trong và
                                        ngoài nước. Các sản phẩm của chúng tôi được chế biến theo quy trình nghiêm ngặt,
                                        không sử dụng phẩm màu, chất bảo quản hay bất kỳ hóa chất độc hại nào. Chúng tôi
                                        cam kết mang đến những sản phẩm tươi ngon, đầy đủ dinh dưỡng, đảm bảo sự an tâm
                                        tuyệt đối cho người tiêu dùng.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-8">
                        <div class="login_wrap widget-taber-content background-white">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                    <h4 class="mb-12">4. Dịch vụ khách hàng tuyệt vời</h4>
                                    <p class="mb-30">Chúng tôi luôn đặt khách hàng lên hàng đầu và cam kết mang đến
                                        dịch vụ tận tâm, chuyên nghiệp. Mỗi khách hàng là một phần quan trọng trong hành
                                        trình phát triển của Bảo Linh, vì vậy chúng tôi luôn lắng nghe ý kiến và phản
                                        hồi từ bạn để cải thiện dịch vụ và sản phẩm. Chúng tôi mong muốn không chỉ cung
                                        cấp thực phẩm chất lượng mà còn mang đến trải nghiệm mua sắm dễ dàng và thoải
                                        mái nhất.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-8">
                        <div class="login_wrap widget-taber-content background-white">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                    <h4 class="mb-12">5. Lối sống lành mạnh với thực phẩm chay</h4>
                                    <p class="mb-30">Tại Bảo Linh, chúng tôi tin rằng một chế độ ăn chay không chỉ mang
                                        lại lợi ích cho sức khỏe mà còn là lựa chọn bảo vệ môi trường và động vật. Những
                                        sản phẩm thực phẩm chay của chúng tôi giúp bạn duy trì một lối sống lành mạnh,
                                        giàu dinh dưỡng, dễ dàng chế biến và thưởng thức trong cuộc sống hàng ngày.
                                        Chúng tôi luôn khuyến khích bạn lựa chọn thực phẩm chay chất lượng để có một sức
                                        khỏe dẻo dai và bền vững.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-8">
                        <div class="login_wrap widget-taber-content background-white">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                    <h4 class="mb-12">6. Giá trị thực sự</h4>
                                    <p class="mb-30">Mỗi sản phẩm của Bảo Linh đều được chọn lọc và kiểm tra kỹ lưỡng,
                                        đảm bảo tiêu chuẩn chất lượng cao. Chúng tôi hợp tác với những nhà cung cấp uy
                                        tín và có chứng nhận chất lượng từ các tổ chức nổi tiếng trên thế giới, mang đến
                                        cho khách hàng những sản phẩm thực phẩm chay an toàn, bổ dưỡng và đáng tin cậy.
                                        Tất cả quy trình chế biến đều tuân thủ nghiêm ngặt, từ khâu lựa chọn nguyên liệu
                                        cho đến đóng gói và vận chuyển sản phẩm.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-8">
                        <div class="login_wrap widget-taber-content background-white">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                    <h4 class="mb-12">7. Phát triển bền vững</h4>
                                    <p class="mb-30">Chúng tôi cam kết không chỉ đem lại lợi ích cho người tiêu dùng mà còn đóng góp vào việc bảo vệ môi trường và phát triển cộng đồng. Bảo Linh ưu tiên sử dụng bao bì tái chế và có thể phân hủy sinh học, đồng thời thực hiện các chương trình hỗ trợ phát triển nông nghiệp bền vững, bảo vệ nguồn tài nguyên thiên nhiên. Chúng tôi tin rằng thực phẩm chay là một phần quan trọng trong chiến lược phát triển bền vững, giúp giảm thiểu tác động tiêu cực đến hành tinh và thúc đẩy một tương lai khỏe mạnh hơn.</p>
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
