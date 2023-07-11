@extends('frontend.master_dashboard')
@section('main')
@section('title')
    Change Password
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>HOME</a>
            <span></span>Change Password
        </div>
    </div>
</div>
<div class="page-content pt-50 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 m-auto">
                <div class="row">
                    {{-- Start col-md-2 --}}
                    @include('frontend.body.dashboard_sidebar_menu')
                    {{-- End col-md-2 --}}
                    <div class="col-md-10">
                        <div class="tab-content account dashboard-content pl-50">
                            <div class="tab-pane fade active show" id="dashboard" role="tabpanel"
                                aria-labelledby="dashboard-tab">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>Change Password</h3>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" action="{{ route('user.update.password') }}"
                                            id="myForm">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label>Old Password <span class="text-danger">*</span></label>
                                                    <div class="input-group" id="show_hide_old_password">
                                                        <input type="password" name="old_password" class="form-control"
                                                            id="current_password">
                                                        <a href="javascript:;"
                                                            class="input-group-text bg-transparent"><i
                                                                class='fa-solid fa-eye-slash'></i></a>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>New Password <span class="text-danger">*</span></label>
                                                    <div class="input-group" id="show_hide_password">
                                                        <input type="password" name="new_password" class="form-control"
                                                            id="new_password">
                                                        <a href="javascript:;"
                                                            class="input-group-text bg-transparent"><i
                                                                class='fa-solid fa-eye-slash'></i></a>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Confirm New Password <span
                                                            class="text-danger">*</span></label>
                                                    <div class="input-group" id="show_hide_confirm_password">
                                                        <input type="password" name="new_password_confirmation"
                                                            class="form-control" id="new_password_confirmation">
                                                        <a href="javascript:;"
                                                            class="input-group-text bg-transparent"><i
                                                                class='fa-solid fa-eye-slash'></i></a>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <button type="submit"
                                                        class="btn btn-fill-out submit font-weight-bold" name="submit"
                                                        value="Submit">Save Changes</button>
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
                    required: 'Please enter your old password.',
                },
                new_password: {
                    required: 'Please enter your new password.',
                    minlength: ''
                },
                new_password_confirmation: {
                    required: 'Please enter your confirmation password.',
                    equalTo: 'The confirmation password must be the same as the new password.',
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
                return this.optional(element) || /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,16}$/i
                    .test(
                        value);
            },
            "Your password must be at least 8 characters long, must contain at least 1 Uppercase, 1 Lowercase, 1 Number and 1 special character."
        );
    });
</script>
<script>
    $(document).ready(function() {
        $("#show_hide_old_password a").on('click', function(event) {
            event.preventDefault();
            if ($('#show_hide_old_password input').attr("type") == "text") {
                $('#show_hide_old_password input').attr('type', 'password');
                $('#show_hide_old_password i').addClass("fa-eye-slash");
                $('#show_hide_old_password i').removeClass("fa-eye");
            } else if ($('#show_hide_old_password input').attr("type") == "password") {
                $('#show_hide_old_password input').attr('type', 'text');
                $('#show_hide_old_password i').removeClass("fa-eye-slash");
                $('#show_hide_old_password i').addClass("fa-eye");
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
