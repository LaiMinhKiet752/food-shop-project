@extends('admin.admin_dashboard')
@section('admin')
@section('title')
    SMTP Setting
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Setting</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">SMTP Setting</li>
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
                            <form method="post" action="{{ route('admin.update.smpt.setting') }}" id="myForm">
                                @csrf
                                <input type="hidden" name="id" value="{{ $setting->id }}">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Mailer </h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="mailer" class="form-control"
                                            value="{{ $setting->mailer }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Host </h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="host" class="form-control"
                                            value="{{ $setting->host }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Port </h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="port" class="form-control"
                                            value="{{ $setting->port }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Username </h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="username" class="form-control"
                                            value="{{ $setting->username }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Password </h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="password" class="form-control"
                                            value="{{ $setting->password }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Encryption </h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="encryption" class="form-control"
                                            value="{{ $setting->encryption }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">From Address </h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="from_address" class="form-control"
                                            value="{{ $setting->from_address }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">From Name </h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="from_name" class="form-control"
                                            value="{{ $setting->from_name }}" />
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
                mailer: {
                    maxlength: 255,
                },
                host: {
                    maxlength: 255,
                },
                port: {
                    maxlength: 255,
                    digits: true,
                },
                username: {
                    maxlength: 255,
                },
                password: {
                    maxlength: 255,
                },
                encryption: {
                    maxlength: 255,
                },
                from_address: {
                    maxlength: 255,
                },
                from_name: {
                    maxlength: 255,
                },
            },
            messages: {
                mailer: {
                    maxlength: 'The mailer must not be greater than 255 characters.',
                },
                host: {
                    maxlength: 'The host must not be greater than 255 characters.',
                },
                port: {
                    maxlength: 'The port must not be greater than 255 characters.',
                    digits: 'Please enter only positive integers.',
                },
                username: {
                    maxlength: 'The username must not be greater than 255 characters.',
                },
                password: {
                    maxlength: 'The password must not be greater than 255 characters.',
                },
                encryption: {
                    maxlength: 'The encryption must not be greater than 255 characters.',
                },
                from_address: {
                    maxlength: 'The from address must not be greater than 255 characters.',
                },
                from_name: {
                    maxlength: 'The from name must not be greater than 255 characters.',
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
