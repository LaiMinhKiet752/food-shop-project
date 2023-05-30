@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Add Brand</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add New Brand</li>
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
                    <div class="col-lg-10">
                        <div class="card">
                            <div class="card-body">

                                <form method="post" action="{{ route('store.brand') }}" enctype="multipart/form-data"
                                    id="myForm">
                                    @csrf

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Brand Name <span class="text-danger">*</span></h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="text" name="brand_name" class="form-control" value="{{ old('brand_name') }}"/>
                                            @if ($errors->has('brand_name'))
                                                <span class="text-danger">{{ $errors->first('brand_name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Brand Email <span class="text-danger">*</span></h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="text" name="brand_email" class="form-control" value="{{ old('brand_email') }}"/>
                                            @if ($errors->has('brand_email'))
                                                <span class="text-danger">{{ $errors->first('brand_email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Brand Phone <span class="text-danger">*</span></h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="text" name="brand_phone" class="form-control" value="{{ old('brand_phone') }}"/>
                                            @if ($errors->has('brand_phone'))
                                                <span class="text-danger">{{ $errors->first('brand_phone') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Brand Address <span class="text-danger">*</span></h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="text" name="brand_address" class="form-control" value="{{ old('brand_address') }}"/>
                                            @if ($errors->has('brand_address'))
                                                <span class="text-danger">{{ $errors->first('brand_address') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Brand Image <span class="text-danger">*</span></h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="file" name="brand_image" class="form-control" id="image" />
                                            @if ($errors->has('brand_image'))
                                                <span class="text-danger">{{ $errors->first('brand_image') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0"> </h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <img id="showImage" src="{{ url('upload/no_image.jpg') }}" alt="Brand"
                                                style="width:100px; height: 100px;">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
                                        </div>
                                    </div>
                            </div>
                            </form>
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
                    brand_name: {
                        required: true,
                        maxlength: 255,
                    },
                    brand_email: {
                        required: true,
                        maxlength: 255,
                        email: true,
                    },
                    brand_phone: {
                        required: true,
                    },
                    brand_address: {
                        required: true,
                        maxlength: 255,
                    },
                    brand_image: {
                        required: true,
                    },
                },
                messages: {
                    brand_name: {
                        required: 'Please enter brand name.',
                        maxlength: 'The brand name must not be greater than 255 characters.',
                    },
                    brand_email: {
                        required: 'Please enter brand email.',
                        maxlength: 'The brand email must not be greater than 255 characters.',
                        email: 'The brand email must be a valid email address.',
                    },
                    brand_phone: {
                        required: 'Please enter brand phone.',
                    },
                    brand_address: {
                        required: 'Please enter brand address.',
                        maxlength: 'The brand address must not be greater than 255 characters.',
                    },
                    brand_image: {
                        required: 'Please select a brand image.',
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
