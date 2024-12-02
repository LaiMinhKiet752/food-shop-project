@extends('frontend.master_dashboard')
@section('main')
@section('title')
    Thông tin tài khoản
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang chủ</a>
            <span></span> Thông tin tài khoản
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
                                        <h3>Thông tin tài khoản của bạn</h3>
                                    </div>
                                    <div class="card-body">
                                        @error('email')
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong>{{ $message }}</strong>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @enderror
                                        @error('phone')
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong>{{ $message }}</strong>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @enderror

                                        <form method="post" action="{{ route('user.profile.store') }}"
                                            enctype="multipart/form-data" id="myFormDetails">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>Username <span class="text-danger">*</span></label>
                                                    <input required="" class="form-control" name="username"
                                                        value="{{ $userData->username }}" type="text" readonly />
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Họ và tên <span class="text-danger">*</span></label>
                                                    <input required="" class="form-control" name="name"
                                                        value="{{ $userData->name }}" />
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Email <span class="text-danger">*</span></label>
                                                    <input required="" class="form-control" name="email"
                                                        type="email" value="{{ $userData->email }}" />
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Số điện thoại <span class="text-danger">*</span></label>
                                                    <input required="" class="form-control" name="phone"
                                                        type="text" value="{{ $userData->phone }}" />
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Địa chỉ <span class="text-danger">*</span></label>
                                                    <input required="" class="form-control" name="address"
                                                        type="text" value="{{ $userData->address }}" />
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Ảnh</label>
                                                    <input class="form-control" name="photo" type="file"
                                                        id="image" />
                                                    @if ($errors->has('photo'))
                                                        <span class="text-danger">{{ $errors->first('photo') }}</span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label></label>
                                                    <img id="showImage"
                                                        src="{{ !empty($userData->photo) ? url('upload/user_images/' . $userData->photo) : url('upload/no_image.jpg') }}"
                                                        alt="User" class="rounded-circle p-1 bg-primary"
                                                        style="width: 150px; height: 150px;">
                                                </div>
                                                <div class="col-md-12">
                                                    <button type="submit"
                                                        class="btn btn-fill-out submit font-weight-bold" name="submit"
                                                        value="Submit">Lưu thay đổi</button>
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
        $('#myFormDetails').validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 255,
                },
                email: {
                    required: true,
                    maxlength: 255,
                    email: true,
                },
                phone: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                    digits: true,
                },
                address: {
                    required: true,
                    maxlength: 255,
                },
            },
            messages: {
                name: {
                    required: 'Please enter your full name.',
                    maxlength: 'The full name must not be greater than 255 characters.',
                },
                email: {
                    required: 'Vui lòng nhập email.',
                    maxlength: 'The email must not be greater than 255 characters.',
                    email: 'Vui lòng nhập email hợp lệ.',
                },
                phone: {
                    required: 'Please enter your phone number.',
                    minlength: 'Please enter 10 numeric characters correctly.',
                    maxlength: 'Please enter 10 numeric characters correctly.',
                    digits: 'Please enter 10 numeric characters correctly.',
                },
                address: {
                    required: 'Please enter your address.',
                    maxlength: 'The address must not be greater than 255 characters.',
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
