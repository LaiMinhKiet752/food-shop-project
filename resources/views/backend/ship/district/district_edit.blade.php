@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">District</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit District</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('all.district') }}" class="btn btn-primary"><i class="lni lni-arrow-left"> Go Back</i></a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                @error('district_name')
                                    <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
                                        <div class="text-white">{{ $message }}</div>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @enderror
                                <form method="post" action="{{ route('update.district') }}" id="myForm">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $district->id }}">
                                    <div class="row mb-3 ">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Division Name <span class="text-danger">*</span></h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-dark">
                                            <select name="division_id" class="form-select mb-3 single-select"
                                                aria-label="Default select example">
                                                <option></option>
                                                @foreach ($division as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $item->id == $district->division_id ? 'selected' : '' }}>
                                                        {{ $item->division_name }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">District Name <span class="text-danger">*</span></h6>
                                        </div>
                                        <div class="form-group col-sm-9 text-secondary">
                                            <input type="text" name="district_name" class="form-control"
                                                value="{{ $district->district_name }}" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="btn btn-primary px-4 savedata"
                                                value="Save Changes" />
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
                    district_name: {
                        required: true,
                        maxlength: 255,
                    },
                    division_id: {
                        required: true,
                    },
                },
                messages: {
                    district_name: {
                        required: 'Please enter district name.',
                        maxlength: 'The district name must not be greater than 255 characters.',
                    },
                    division_id: {
                        required: 'Please select a division name.',
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
