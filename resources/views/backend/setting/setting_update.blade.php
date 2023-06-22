@extends('admin.admin_dashboard')
@section('admin')
@section('title')
    Setting
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
                    <li class="breadcrumb-item active" aria-current="page">Site Setting</li>
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
                            <form method="post" action="{{ route('admin.site.setting.update') }}"
                                enctype="multipart/form-data" id="myForm">
                                @csrf
                                <input type="hidden" name="id" value="{{ $setting->id }}">
                                <input type="hidden" name="old_image" value="{{ $setting->logo }}">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Support Phone </h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="support_phone" class="form-control"
                                            value="{{ $setting->support_phone }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Contact Phone </h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="call_us_phone" class="form-control"
                                            value="{{ $setting->call_us_phone }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email </h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="email" name="email" class="form-control"
                                            value="{{ $setting->email }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Company Address </h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="company_address" class="form-control"
                                            value="{{ $setting->company_address }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Facebook Link</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="facebook" class="form-control"
                                            value="{{ $setting->facebook }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Twitter Link</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="twitter" class="form-control"
                                            value="{{ $setting->twitter }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Youtube Link</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="youtube" class="form-control"
                                            value="{{ $setting->youtube }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Instagram Link</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="instagram" class="form-control"
                                            value="{{ $setting->instagram }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Pinterest Link</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="pinterest" class="form-control"
                                            value="{{ $setting->pinterest }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Copyright </h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="copyright" class="form-control"
                                            value="{{ $setting->copyright }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Logo </h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="file" name="logo" class="form-control" id="image" />
                                        @if ($errors->has('logo'))
                                            <span class="text-danger">{{ $errors->first('logo') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"> </h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <img id="showImage" src="{{ asset($setting->logo) }}" alt="Logo"
                                            style="width:200px; height: 100px;">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
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
        $('#image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#myForm').validate({
            rules: {
                support_phone: {
                    maxlength: 255,
                },
                call_us_phone: {
                    maxlength: 255,
                },
                email: {
                    maxlength: 255,
                    email: true,
                },
                company_address: {
                    maxlength: 255,
                },
                facebook: {
                    maxlength: 255,
                },
                twitter: {
                    maxlength: 255,
                },
                youtube: {
                    maxlength: 255,
                },
                instagram: {
                    maxlength: 255,
                },
                pinterest: {
                    maxlength: 255,
                },
                copyright: {
                    maxlength: 255,
                },
            },
            messages: {
                support_phone: {
                    maxlength: 'The support phone must not be greater than 255 characters.',
                },
                call_us_phone: {
                    maxlength: 'The call us phone must not be greater than 255 characters.',
                },
                email: {
                    maxlength: 'The email must not be greater than 255 characters.',
                    email: 'The email must be a valid email address.',
                },
                company_address: {
                    maxlength: 'The address must not be greater than 255 characters.',
                },
                facebook: {
                    maxlength: 'The facebook link must not be greater than 255 characters.',
                },
                twitter: {
                    maxlength: 'The twitter link must not be greater than 255 characters.',
                },
                youtube: {
                    maxlength: 'The youtube link must not be greater than 255 characters.',
                },
                instagram: {
                    maxlength: 'The instagram link must not be greater than 255 characters.',
                },
                pinterest: {
                    maxlength: 'The pinterest link must not be greater than 255 characters.',
                },
                copyright: {
                    maxlength: 'The copyright must not be greater than 255 characters.',
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
