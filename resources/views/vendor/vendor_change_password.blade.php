@extends('vendor.vendor_dashboard')
@section('vendor')
@section('title')
    Change Password
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Vendor</div>
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
                            <form method="post" action="{{ route('vendor.update.password') }}" id="myForm">
                                @csrf

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Old Password <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="password" name="old_password" class="form-control"
                                            id="current_password" placeholder="Old Password" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">New Password <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="password" id="new_password" name="new_password"
                                            class="form-control" id="new_password" placeholder="New Password" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Confirm New Password <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="password" name="new_password_confirmation" class="form-control"
                                            id="new_password_confirmation" placeholder=" Confirm New Password" />
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
@endsection
