@extends('frontend.master_dashboard')
@section('main')
@section('title')
    Liên hệ
@endsection
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang chủ</a>
            <span></span> Liên hệ
        </div>
    </div>
</div>
<div class="page-content pt-150 pb-150">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                <div class="row">
                    <div class="col-lg-6 col-md-8">
                        <div class="login_wrap widget-taber-content background-white">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                    <h1 class="mb-5">Gửi liên hệ</h1>
                                </div>
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>{{ $error }}</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endforeach
                                @endif
                                <form method="post" action="{{ route('contact.submit') }}" id="myForm">
                                    @csrf
                                    <div class="form-group">
                                        <input class="form-control" type="email" name="email"
                                            placeholder="Nhập email của bạn *" value="{{ old('email') }}" />
                                    </div>

                                    <div class="form-group">
                                        <input class="form-control" type="text" name="subject"
                                            placeholder="Tiêu đề *" value="{{ old('subject') }}" />
                                    </div>

                                    <div class="form-group">
                                        <textarea class="form-control" name="message" placeholder="Nội dung *" style="height: 200px;">{{ old('message') }}</textarea>
                                    </div>

                                    <div class="form-group mb-30">
                                        <button type="submit"
                                            class="btn btn-fill-out btn-block hover-up font-weight-bold">Gửi</button>
                                    </div>
                                    <p class="font-xs text-muted"><strong>Lưu ý:</strong> Dữ liệu cá nhân của bạn sẽ được sử dụng để hỗ trợ trải nghiệm của bạn trên toàn bộ trang web này, để quản lý quyền truy cập vào tài khoản của bạn và cho các mục đích khác được mô tả trong chính sách bảo mật của chúng tôi</p>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-8">
                        <div class="login_wrap widget-taber-content background-white">
                            <div class="padding_eight_all bg-white">
                                <div class="card-login" style="margin-top: 62px;">
                                    <h6 class="mb-15">Vị trí:</h6>
                                    <p><i class="fa-solid fa-location-dot"></i>&nbsp;&nbsp; 10 Lê Lai, Quận 1, Thành phố Hồ Chí Minh.</p>
                                    <p><i class="fa-solid fa-phone"></i>&nbsp;&nbsp; 19007799</p>
                                    <p><i class="fa-solid fa-envelope"></i>&nbsp;&nbsp; baolinh.amthucchay@gmail.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#myForm').validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                },
                subject: {
                    required: true,
                    maxlength: 255,
                },
                message: {
                    required: true,
                },
            },
            messages: {
                email: {
                    required: 'Vui lòng nhập email.',
                    email: 'Vui lòng nhập email hợp lệ.',
                },
                subject: {
                    required: 'Vui lòng nhập tiêu đề cho email.',
                    maxlength: 'Tiêu đề không được vượt quá 255 ký tự.',
                },
                message: {
                    required: 'Vui lòng nhập nội dung.',
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
    });
</script>

@endsection
