@extends('admin.admin_dashboard')
@section('admin')
@section('title')
    Employee Management
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Employee </div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Employee</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('all.employee') }}" class="btn btn-primary"><i class="lni lni-arrow-left"> Go
                        Back</i></a>
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
                            @error('employee_code')
                                <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
                                    <div class="text-white">{{ $message }}</div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @enderror
                            @error('employee_email')
                                <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
                                    <div class="text-white">{{ $message }}</div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @enderror
                            @error('employee_phone')
                                <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
                                    <div class="text-white">{{ $message }}</div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @enderror
                            <form id="myForm" method="post" action="{{ route('update.employee') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $employee->id }}">
                                <input type="hidden" name="old_image" value="{{ $employee->employee_photo }}">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Employee Code <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="employee_code" class="form-control"
                                            value="{{ $employee->employee_code }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Full Name <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="employee_name" class="form-control"
                                            value="{{ $employee->employee_name }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="employee_email" class="form-control"
                                            value="{{ $employee->employee_email }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Phone <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="employee_phone" class="form-control"
                                            value="{{ $employee->employee_phone }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Address <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="employee_address" class="form-control"
                                            value="{{ $employee->employee_address }}" />
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Position <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="position" class="form-control"
                                            value="{{ $employee->position }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Experience <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-dark">
                                        <select name="experience" class="form-control form-select single-select">
                                            <option value="0 Year"
                                                {{ $employee->experience == '0 Year' ? 'selected' : '' }}>0 Year
                                            </option>
                                            <option value="1 Year"
                                                {{ $employee->experience == '1 Year' ? 'selected' : '' }}>1 Year
                                            </option>
                                            <option value="2 Years"
                                                {{ $employee->experience == '2 Years' ? 'selected' : '' }}>2 Years
                                            </option>
                                            <option value="3 Years"
                                                {{ $employee->experience == '3 Years' ? 'selected' : '' }}>3 Years
                                            </option>
                                            <option value="4 Years"
                                                {{ $employee->experience == '4 Years' ? 'selected' : '' }}>4 Years
                                            </option>
                                            <option value="5 Years"
                                                {{ $employee->experience == '5 Years' ? 'selected' : '' }}>5 Years
                                            </option>
                                            <option value="6 Years"
                                                {{ $employee->experience == '6 Years' ? 'selected' : '' }}>6 Years
                                            </option>
                                            <option value="7 Years"
                                                {{ $employee->experience == '7 Years' ? 'selected' : '' }}>7 Years
                                            </option>
                                            <option value="8 Years"
                                                {{ $employee->experience == '8 Years' ? 'selected' : '' }}>8 Years
                                            </option>
                                            <option value="9 Years"
                                                {{ $employee->experience == '9 Years' ? 'selected' : '' }}>9 Years
                                            </option>
                                            <option value="10 Years"
                                                {{ $employee->experience == '10 Years' ? 'selected' : '' }}>10 Years
                                            </option>
                                            <option value="11 Years"
                                                {{ $employee->experience == '11 Years' ? 'selected' : '' }}>11 Years
                                            </option>
                                            <option value="12 Years"
                                                {{ $employee->experience == '12 Years' ? 'selected' : '' }}>12 Years
                                            </option>
                                            <option value="13 Years"
                                                {{ $employee->experience == '13 Years' ? 'selected' : '' }}>13 Years
                                            </option>
                                            <option value="14 Years"
                                                {{ $employee->experience == '14 Years' ? 'selected' : '' }}>14 Years
                                            </option>
                                            <option value="15 Years"
                                                {{ $employee->experience == '15 Years' ? 'selected' : '' }}>15 Years
                                            </option>
                                            <option value="16 Years"
                                                {{ $employee->experience == '16 Years' ? 'selected' : '' }}>16 Years
                                            </option>
                                            <option value="17 Years"
                                                {{ $employee->experience == '17 Years' ? 'selected' : '' }}>17 Years
                                            </option>
                                            <option value="18 Years"
                                                {{ $employee->experience == '18 Years' ? 'selected' : '' }}>18 Years
                                            </option>
                                            <option value="19 Years"
                                                {{ $employee->experience == '19 Years' ? 'selected' : '' }}>19 Years
                                            </option>
                                            <option value="20 Years"
                                                {{ $employee->experience == '20 Years' ? 'selected' : '' }}>20 Years
                                            </option>
                                            <option value="21 Years"
                                                {{ $employee->experience == '21 Years' ? 'selected' : '' }}>21 Years
                                            </option>
                                            <option value="22 Years"
                                                {{ $employee->experience == '22 Years' ? 'selected' : '' }}>22 Years
                                            </option>
                                            <option value="23 Years"
                                                {{ $employee->experience == '23 Years' ? 'selected' : '' }}>23 Years
                                            </option>
                                            <option value="24 Years"
                                                {{ $employee->experience == '24 Years' ? 'selected' : '' }}>24 Years
                                            </option>
                                            <option value="25 Years"
                                                {{ $employee->experience == '25 Years' ? 'selected' : '' }}>25 Years
                                            </option>
                                            <option value="26 Years"
                                                {{ $employee->experience == '26 Years' ? 'selected' : '' }}>26 Years
                                            </option>
                                            <option value="27 Years"
                                                {{ $employee->experience == '27 Years' ? 'selected' : '' }}>27 Years
                                            </option>
                                            <option value="28 Years"
                                                {{ $employee->experience == '28 Years' ? 'selected' : '' }}>28 Years
                                            </option>
                                            <option value="29 Years"
                                                {{ $employee->experience == '29 Years' ? 'selected' : '' }}>29 Years
                                            </option>
                                            <option value="30 Years"
                                                {{ $employee->experience == '30 Years' ? 'selected' : '' }}>30 Years
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Salary(USD) <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="salary" class="form-control"
                                            value="{{ $employee->salary }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Photo </h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="file" name="employee_photo" class="form-control"
                                            id="image" />
                                        @if ($errors->has('employee_photo'))
                                            <span class="text-danger">{{ $errors->first('employee_photo') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"> </h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <img id="showImage"
                                            src="{{ !empty($employee->employee_photo) ? asset($employee->employee_photo) : url('upload/no_image.jpg') }}"
                                            alt="Photo" style="width: 120px; height: 90px;">
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
        $('#myForm').validate({
            rules: {
                employee_code: {
                    required: true,
                    maxlength: 255,
                },
                employee_name: {
                    required: true,
                    maxlength: 255,
                },
                employee_email: {
                    required: true,
                    email: true,
                },
                employee_phone: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                    digits: true,
                },
                employee_address: {
                    required: true,
                    maxlength: 255,
                },
                position: {
                    required: true,
                    maxlength: 255,
                },
                experience: {
                    required: true,
                },
                salary: {
                    required: true,
                    number: true,
                },
            },
            messages: {
                employee_code: {
                    required: 'Please enter employee code.',
                    maxlength: 'The employee code must not be greater than 255 characters.',
                },
                employee_name: {
                    required: 'Please enter employee name.',
                    maxlength: 'The employee name must not be greater than 255 characters.',
                },
                employee_email: {
                    required: 'Please enter employee email.',
                    maxlength: 'The email must not be greater than 255 characters.',
                    email: 'The email must be a valid email address.',
                },
                employee_phone: {
                    required: 'Please enter your phone number.',
                    minlength: 'Please enter 10 numeric characters correctly.',
                    maxlength: 'Please enter 10 numeric characters correctly.',
                    digits: 'Please enter 10 numeric characters correctly.',
                },
                employee_address: {
                    required: 'Please enter your address.',
                    maxlength: 'The address must not be greater than 255 characters.',
                },
                position: {
                    required: 'Please enter the position for the employee.',
                    maxlength: 'The position must not be greater than 255 characters.',
                },
                experience: {
                    required: 'Please select the number of years of experience.',
                },
                salary: {
                    required: 'Please enter salary.',
                    number: 'Please enter only positive integers or decimals.',
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
@endsection
