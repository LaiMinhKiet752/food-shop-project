@extends('frontend.master_dashboard')
@section('main')
@section('title')
    Đặt lại mật khẩu
@endsection
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> Đặt lại mật khẩu
        </div>
    </div>
</div>
<div class="page-content pt-150 pb-150">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                <div class="row">
                    <div class="col-lg-6 pr-30 d-none d-lg-block">
                        <img class="border-radius-15" src="{{ asset('frontend/assets/imgs/page/login-1.png') }}"
                            alt="" />
                    </div>
                    <div class="col-lg-6 col-md-8">
                        <div class="login_wrap widget-taber-content background-white">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                    <h1 class="mb-5">Đặt lại mật khẩu</h1>
                                </div>
                                <br>
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>{{ $error }}</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endforeach
                                @endif
                                <form method="POST" action="{{ route('password.store') }}" id="myForm">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                    <div class="form-group">
                                        <input class="form-control" type="email" id="email" required=""
                                            name="email" placeholder="Your email *"
                                            value="{{ old('email', $request->email) }}" readonly />
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group" id="show_hide_new_password">
                                            <input type="password" name="password" required="" class="form-control"
                                                id="password" placeholder="Nhập vào mật khẩu mới *">
                                            <a href="javascript:;" class="input-group-text bg-transparent"><i
                                                    class='fa-solid fa-eye-slash'></i></a>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group" id="show_hide_confirm_password">
                                            <input type="password" name="password_confirmation" required=""
                                                class="form-control" id="password_confirmation"
                                                placeholder="Xác nhận mật khẩu mới *">
                                            <a href="javascript:;" class="input-group-text bg-transparent"><i
                                                    class='fa-solid fa-eye-slash'></i></a>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-heading btn-block hover-up"
                                            name="login">Xác nhận</button>
                                    </div>
                                </form>
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
                password: {
                    required: 'Please enter your password.',
                    minlength: ''
                },
                password_confirmation: {
                    required: 'Please enter your confirmation password.',
                    equalTo: 'Confirm password must be same as new password.',
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
                return this.optional(element) || /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,16}$/
                    .test(
                        value);
            },
            "Your password must be between 8 and 16 characters long, must contain at least 1 Uppercase Letter, 1 Lowercase Letter, 1 Number and 1 Special Character."
        );
    });
</script>
<script>
    $(document).ready(function() {
        $("#show_hide_new_password a").on('click', function(event) {
            event.preventDefault();
            if ($('#show_hide_new_password input').attr("type") == "text") {
                $('#show_hide_new_password input').attr('type', 'password');
                $('#show_hide_new_password i').addClass("fa-eye-slash");
                $('#show_hide_new_password i').removeClass("fa-eye");
            } else if ($('#show_hide_new_password input').attr("type") == "password") {
                $('#show_hide_new_password input').attr('type', 'text');
                $('#show_hide_new_password i').removeClass("fa-eye-slash");
                $('#show_hide_new_password i').addClass("fa-eye");
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $("#show_hide_confirm_password a").on('click', function(event) {
            event.preventDefault();
            if ($('#show_hide_confirm_password input').attr("type") == "text") {
                $('#show_hide_confirm_password input').attr('type', 'password');
                $('#show_hide_confirm_password i').addClass("fa-eye-slash");
                $('#show_hide_confirm_password i').removeClass("fa-eye");
            } else if ($('#show_hide_confirm_password input').attr("type") == "password") {
                $('#show_hide_confirm_password input').attr('type', 'text');
                $('#show_hide_confirm_password i').removeClass("fa-eye-slash");
                $('#show_hide_confirm_password i').addClass("fa-eye");
            }
        });
    });
</script>
@endsection
