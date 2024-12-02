@extends('frontend.master_dashboard')
@section('main')
@section('title')
    Chính sách bảo mật
@endsection
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang chủ</a>
            <span></span> Chính sách bảo mật
        </div>
    </div>
</div>
<div class="page-content pt-150 pb-150">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-8 col-md-12 m-auto">
                <div class="row">
                    <div class="heading_s1">
                        <img class="border-radius-15" src="{{ asset('frontend/assets/imgs/page/reset_password.svg') }}"
                            alt="" />
                        <h2 class="mb-15 mt-15">Chính sách bảo mật</h2>
                        <p class="mb-30" style="color: #037841; font-weight: 500;">Bảo Linh cam kết
bảo vệ quyền riêng tư của bạn. Vui lòng đọc
"Chính sách bảo mật thông tin khách hàng" bên dưới để hiểu rõ hơn về các cam kết mà chúng tôi
thực hiện, nhằm tôn trọng và bảo vệ quyền của khách truy cập.
                        </p>
                    </div>
                    <div class="col-lg-12 col-md-8">
                        <div class="login_wrap widget-taber-content background-white">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                    <h4 class="mb-12">1. Thu thập thông tin cá nhân</h4>
                                    <p class="mb-30">Để truy cập và sử dụng một số dịch vụ tại Bảo Linh, bạn có thể được yêu cầu đăng ký với chúng tôi thông tin cá nhân (Email, Họ và tên, Số điện thoại liên lạc...). Mọi thông tin khai báo phải chính xác và hợp pháp. Bảo Linh không chịu bất kỳ trách nhiệm nào liên quan đến luật pháp của thông tin khai báo.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-8">
                        <div class="login_wrap widget-taber-content background-white">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                    <h4 class="mb-12">2. Sử dụng thông tin cá nhân</h4>
                                    <p class="mb-30">Bảo Linh thu thập và sử dụng thông tin cá nhân của bạn cho các mục đích phù hợp và tuân thủ đầy đủ nội dung của “Chính sách bảo mật thông tin khách hàng” này. Khi cần thiết, chúng tôi có thể sử dụng thông tin này để liên hệ trực tiếp với bạn dưới các hình thức: Thư ngỏ, đơn đặt hàng, thư cảm ơn, thông tin kỹ thuật và bảo mật ...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-8">
                        <div class="login_wrap widget-taber-content background-white">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                    <h4 class="mb-12">3. Chia sẻ thông tin cá nhân</h4>
                                    <p class="mb-30">Ngoài việc sử dụng thông tin cá nhân như đã nêu trong chính sách này, chúng tôi cam kết không tiết lộ thông tin cá nhân của bạn.</p>
                                    <p class="mb-30">Trong một số trường hợp, chúng tôi có thể thuê một đơn vị độc lập để tiến hành các dự án nghiên cứu thị trường và sau đó thông tin của bạn sẽ được cung cấp cho đơn vị này để tiến hành dự án. Bên thứ ba này sẽ bị ràng buộc bởi một thỏa thuận bảo mật theo đó họ chỉ được phép sử dụng thông tin được cung cấp cho mục đích hoàn thành dự án.</p>
                                    <p class="mb-30">Chúng tôi có thể tiết lộ hoặc cung cấp thông tin cá nhân của bạn trong các trường hợp sau đây khi thực sự cần thiết:</p>
                                    <p class="mb-30">* Khi có yêu cầu của cơ quan thực thi pháp luật</p>
                                    <p class="mb-30">* Trong các trường hợp chúng tôi tin rằng điều đó sẽ giúp chúng tôi bảo vệ quyền lợi hợp pháp của mình trước pháp luật</p>
                                    <p class="mb-30">* Tình huống cấp bách và cần thiết để bảo vệ sự an toàn cá nhân của các thành viên Bảo Linh</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-8">
                        <div class="login_wrap widget-taber-content background-white">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                    <h4 class="mb-12">4. Truy xuất thông tin cá nhân</h4>
                                    <p class="mb-30">Bạn có thể truy cập và chỉnh sửa thông tin cá nhân của mình bất kỳ lúc nào theo các liên kết phù hợp mà chúng tôi cung cấp.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-8">
                        <div class="login_wrap widget-taber-content background-white">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                    <h4 class="mb-12">5. Bảo mật thông tin cá nhân</h4>
                                    <p class="mb-30">Bảo Linh cam kết bảo mật thông tin cá nhân của bạn theo mọi cách có thể. Chúng tôi sẽ sử dụng nhiều công nghệ bảo mật thông tin khác nhau để bảo vệ thông tin này khỏi việc truy xuất, sử dụng hoặc tiết lộ ngoài ý muốn.</p>
                                    <p class="mb-30">Bảo Linh khuyến cáo bạn nên giữ thông tin liên quan đến mật khẩu của mình ở chế độ riêng tư và không chia sẻ với bất kỳ ai khác. Nếu bạn sử dụng máy tính chung với nhiều người, bạn nên đăng xuất hoặc thoát khỏi tất cả các cửa sổ Website đang mở.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-8">
                        <div class="login_wrap widget-taber-content background-white">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                    <h4 class="mb-12">6. Sử dụng “Cookie”</h4>
                                    <p class="mb-30">Bảo Linh sử dụng “Cookie” để giúp cá nhân hóa và tối đa hóa việc sử dụng thời gian trực tuyến của bạn. Cookie là một tệp văn bản được máy chủ của trang web đặt trên ổ cứng của bạn. Cookie không được sử dụng để chạy chương trình hoặc đưa vi-rút vào máy tính của bạn. Cookie được gán cho máy tính của bạn và chỉ có thể được đọc bởi máy chủ của trang web trên tên miền đã cấp cookie cho bạn.</p>
                                    <p class="mb-30">Một trong những mục đích của Cookie là cung cấp sự tiện lợi để tiết kiệm thời gian của bạn khi truy cập trang web hoặc truy cập lại trang web mà không cần phải đăng ký lại thông tin hiện có. Bạn có thể chấp nhận hoặc từ chối sử dụng cookie. Hầu hết các trình duyệt đều tự động chấp nhận cookie, nhưng bạn có thể thay đổi cài đặt để từ chối tất cả cookie nếu bạn muốn.</p>
                                    <p class="mb-30">Tuy nhiên, nếu bạn chọn từ chối cookie, điều đó có thể gây trở ngại và ảnh hưởng xấu đến một số dịch vụ và tính năng phụ thuộc vào cookie tại trang web: baolinhchaykho.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-8">
                        <div class="login_wrap widget-taber-content background-white">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                    <h4 class="mb-12">7. Quy định về "Spam"</h4>
                                    <p class="mb-30">Bảo Linh thực sự quan tâm đến vấn nạn Spam (thư rác), các email giả mạo mà chúng tôi gửi đi. Do đó, Bảo Linh khẳng định chỉ gửi Email đến Quý khách khi và chỉ khi Quý khách đã đăng ký hoặc sử dụng dịch vụ từ hệ thống của chúng tôi.</p>
                                    <p class="mb-30">Bảo Linh cam kết không bán, cho thuê hoặc cho thuê lại Email của Quý khách từ bên thứ ba. Nếu Quý khách vô tình nhận được Email không mong muốn từ hệ thống của chúng tôi do nguyên nhân ngoài ý muốn, vui lòng nhấp vào liên kết từ chối nhận Email này kèm theo, hoặc thông báo trực tiếp cho quản trị viên Website.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-8">
                        <div class="login_wrap widget-taber-content background-white">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                    <h4 class="mb-12">8. Thay đổi chính sách</h4>
                                    <p class="mb-30">Nội dung của “Chính sách bảo mật” này có thể thay đổi để phù hợp với nhu cầu của Bảo Linh cũng như nhu cầu và phản hồi từ khách hàng, nếu có. Khi cập nhật nội dung của chính sách này, chúng tôi sẽ sửa đổi thời gian “Cập nhật lần cuối” ở trên.</p>
                                    <p class="mb-30">Nội dung “Chính sách bảo mật thông tin khách hàng” này chỉ áp dụng tại baolinhchaykho.com, không bao gồm hoặc liên quan đến các bên thứ ba đặt quảng cáo hoặc có liên kết tại baolinhchaykho.com. Do đó, chúng tôi khuyến cáo bạn nên đọc và tham khảo kỹ nội dung “Chính sách bảo mật thông tin khách hàng” của từng website mà bạn đang truy cập.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-8">
                        <div class="login_wrap widget-taber-content background-white">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                    <h4 class="mb-12">9. Thông tin liên hệ</h4>
                                    <p class="mb-30">Chúng tôi luôn hoan nghênh các ý kiến ​​đóng góp, liên hệ và phản hồi của bạn về “Chính sách bảo mật thông tin khách hàng” này. Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi qua Email: contact@baolinhchaykho.com</p>
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
