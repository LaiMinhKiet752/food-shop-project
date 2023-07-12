@extends('frontend.master_dashboard')
@section('main')
@section('title')
    Create New Account
@endsection
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>HOME</a>
            <span></span> Create New Account
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
                                    <h1 class="mb-5">Create an Account</h1>
                                    <p class="mb-30">Already have an account? <a href="{{ route('login') }}">Log in</a>
                                    </p>
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
                                <form method="POST" action="{{ route('register') }}" id="myForm">
                                    @csrf
                                    <div class="form-group">
                                        <input class="form-control" type="text" id="username" name="username"
                                            placeholder="Username *" value="{{ old('username') }}" />
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" type="email" id="email" name="email"
                                            placeholder="Email *" value="{{ old('email') }}" />
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group" id="show_hide_password">
                                            <input type="password" name="password" class="form-control" id="password"
                                                placeholder="Password *">
                                            <a href="javascript:;" class="input-group-text bg-transparent"><i
                                                    class='fa-solid fa-eye-slash'></i></a>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group" id="show_hide_confirm_password">
                                            <input type="password" name="password_confirmation" class="form-control"
                                                id="password_confirmation" placeholder="Confirm password *">
                                            <a href="javascript:;" class="input-group-text bg-transparent"><i
                                                    class='fa-solid fa-eye-slash'></i></a>
                                        </div>
                                    </div>
                                    <div class="login_footer form-group">
                                        <div class="form-group chek-form">
                                            <input type="text" required="" name="captcha_code"
                                                placeholder="Captcha Code *" class="form-control" />
                                        </div>
                                        <div class="form-group captcha">
                                            {!! captcha_img('flat') !!}
                                        </div>
                                        <div class="form-group">
                                            <button type="button" class="btn reload" id="reload">&#x21bb;</button>
                                        </div>
                                    </div>
                                    <div class="login_footer form-group mb-50">
                                        <div class="chek-form">
                                            <div class="custome-checkbox">
                                                <input class="form-check-input" type="checkbox" name="checkbox"
                                                    id="exampleCheckbox12" />
                                                <label class="form-check-label" for="exampleCheckbox12"><span>I
                                                        agree to Terms &amp;
                                                        Policy.</span></label>
                                            </div>
                                        </div>
                                        <a href="{{ route('privacy_policy') }}"><i
                                                class="fi-rs-book-alt mr-5 text-muted"></i>Lean more</a>
                                    </div>
                                    <div class="form-group mb-30">
                                        <button type="submit"
                                            class="btn btn-fill-out btn-block hover-up font-weight-bold"
                                            name="login">Register</button>
                                    </div>
                                    <p class="font-xs text-muted"><strong>Note:</strong>Your personal data will
                                        be used to support your experience throughout this website, to manage
                                        access to your account, and for other purposes described in our privacy
                                        policy</p>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-8">
                        <div class="login_wrap widget-taber-content background-white">
                            <div class="padding_eight_all bg-white">
                                <div class="card-login mt-115">
                                    <h6 class="mb-15">Password must:</h6>
                                    <p>Be between 8 and 16 characters long.</p>
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
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#myForm').validate({
            rules: {
                username: {
                    required: true,
                    maxlength: 255,
                },
                email: {
                    required: true,
                    email: true,
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
                captcha_code: {
                    required: true,
                },
            },
            messages: {
                username: {
                    required: 'Please enter your username.',
                    maxlength: 'The user name must not be greater than 255 characters.',
                },
                email: {
                    required: 'Please enter your email.',
                    email: 'The email must be a valid email address.',
                },
                password: {
                    required: 'Please enter your password.',
                    minlength: ''
                },
                password_confirmation: {
                    required: 'Please enter your confirmation password.',
                    equalTo: 'The confirmation password must be the same as the password.',
                },
                captcha_code: {
                    required: 'Please enter captcha code.',
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
<script type="text/javascript">
    $('#reload').click(function() {
        $.ajax({
            type: "GET",
            url: "/reload-captcha",
            success: function(data) {
                $(".captcha").html(data.captcha);
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $("#show_hide_password a").on('click', function(event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("fa-eye-slash");
                $('#show_hide_password i').removeClass("fa-eye");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("fa-eye-slash");
                $('#show_hide_password i').addClass("fa-eye");
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
