@extends('admin.admin_dashboard')
@section('admin')
@section('title')
    Change Password
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Admin</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">

        </div>
    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="{{ route('admin.update.password') }}" id="myForm">
                                @csrf

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Old Password <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <div class="input-group" id="show_hide_old_password">
                                            <input type="password" name="old_password" class="form-control"
                                                id="current_password" placeholder="Old Password"> <a href="javascript:;"
                                                class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">New Password <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <div class="input-group" id="show_hide_password">
                                            <input type="password" name="new_password" class="form-control"
                                                id="new_password" placeholder="New Password"> <a href="javascript:;"
                                                class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Confirm New Password <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <div class="input-group" id="show_hide_confirm_password">
                                            <input type="password" name="new_password_confirmation" class="form-control"
                                                id="new_password_confirmation" placeholder="Confirm New Password"> <a
                                                href="javascript:;" class="input-group-text bg-transparent"><i
                                                    class='bx bx-hide'></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-success px-4" value="Save Changes" />
                                    </div>
                                </div>
                            </form>
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
                old_password: {
                    required: true,
                },
                new_password: {
                    required: true,
                    validatePassword: true,
                    minlength: 8
                },
                new_password_confirmation: {
                    required: true,
                    equalTo: "#new_password",
                },
            },
            messages: {
                old_password: {
                    required: 'Vui lòng nhập mật khẩu cũ.',
                },
                new_password: {
                    required: 'Vui lòng nhập mật khẩu mới.',
                    minlength: ''
                },
                new_password_confirmation: {
                    required: 'Vui lòng nhập lại mật khẩu mới.',
                    equalTo: 'Mật khẩu xác nhận phải giống với mật khẩu mới.',
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
            "Mật khẩu của bạn phải dài từ 8 đến 16 ký tự, phải chứa ít nhất 1 chữ cái viết hoa, 1 chữ cái viết thường, 1 chữ số và 1 ký tự đặc biệt."
        );
    });
</script>
<script>
    $(document).ready(function() {
        $("#show_hide_old_password a").on('click', function(event) {
            event.preventDefault();
            if ($('#show_hide_old_password input').attr("type") == "text") {
                $('#show_hide_old_password input').attr('type', 'password');
                $('#show_hide_old_password i').addClass("bx-hide");
                $('#show_hide_old_password i').removeClass("bx-show");
            } else if ($('#show_hide_old_password input').attr("type") == "password") {
                $('#show_hide_old_password input').attr('type', 'text');
                $('#show_hide_old_password i').removeClass("bx-hide");
                $('#show_hide_old_password i').addClass("bx-show");
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
                $('#show_hide_password i').addClass("bx-hide");
                $('#show_hide_password i').removeClass("bx-show");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("bx-hide");
                $('#show_hide_password i').addClass("bx-show");
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
                $('#show_hide_confirm_password i').addClass("bx-hide");
                $('#show_hide_confirm_password i').removeClass("bx-show");
            } else if ($('#show_hide_confirm_password input').attr("type") == "password") {
                $('#show_hide_confirm_password input').attr('type', 'text');
                $('#show_hide_confirm_password i').removeClass("bx-hide");
                $('#show_hide_confirm_password i').addClass("bx-show");
            }
        });
    });
</script>
@endsection
