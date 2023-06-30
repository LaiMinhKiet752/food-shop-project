@extends('admin.admin_dashboard')
@section('admin')
@section('title')
    Employee
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
                    <li class="breadcrumb-item active" aria-current="page">Edit Advance Salary</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('all.advance.salary') }}" class="btn btn-primary"><i class="lni lni-arrow-left"> Go
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
                            <form id="myForm" method="post" action="{{ route('update.advance.salary') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $salary->id }}">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Employee Name <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-dark">
                                        <label
                                            style="font-size: 20px; font-weight: bold;">{{ $employee->employee_name }}</label>
                                        <input type="hidden" name="employee_id" class="form-control"
                                            value="{{ $employee->id }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Month <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-dark">
                                        <select name="month" class="form-control form-select single-select">
                                            <option value="" disabled selected>Select Month</option>
                                            <option value="January" {{ $salary->month == 'January' ? 'selected' : '' }}>
                                                January</option>
                                            <option value="February"
                                                {{ $salary->month == 'February' ? 'selected' : '' }}>February</option>
                                            <option value="March" {{ $salary->month == 'March' ? 'selected' : '' }}>
                                                March</option>
                                            <option value="April" {{ $salary->month == 'April' ? 'selected' : '' }}>
                                                April</option>
                                            <option value="May" {{ $salary->month == 'May' ? 'selected' : '' }}>
                                                May</option>
                                            <option value="June" {{ $salary->month == 'June' ? 'selected' : '' }}>
                                                June</option>
                                            <option value="July" {{ $salary->month == 'July' ? 'selected' : '' }}>
                                                July</option>
                                            <option value="August" {{ $salary->month == 'August' ? 'selected' : '' }}>
                                                August</option>
                                            <option value="September"
                                                {{ $salary->month == 'September' ? 'selected' : '' }}>September
                                            </option>
                                            <option value="October"
                                                {{ $salary->month == 'October' ? 'selected' : '' }}>October</option>
                                            <option value="November"
                                                {{ $salary->month == 'November' ? 'selected' : '' }}>November</option>
                                            <option value="December"
                                                {{ $salary->month == 'December' ? 'selected' : '' }}>December</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Year <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-dark">
                                        <select name="year" class="form-control form-select single-select">
                                            <option value="" disabled selected>Select Year</option>
                                            <option value="2020" {{ $salary->year == '2020' ? 'selected' : '' }}>2020
                                            </option>
                                            <option value="2021" {{ $salary->year == '2021' ? 'selected' : '' }}>2021
                                            </option>
                                            <option value="2022" {{ $salary->year == '2022' ? 'selected' : '' }}>2022
                                            </option>
                                            <option value="2023" {{ $salary->year == '2023' ? 'selected' : '' }}>2023
                                            </option>
                                            <option value="2024" {{ $salary->year == '2024' ? 'selected' : '' }}>2024
                                            </option>
                                            <option value="2025" {{ $salary->year == '2025' ? 'selected' : '' }}>2025
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Advance Salary(USD) <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="advance_salary" class="form-control"
                                            value="{{ $salary->advance_salary }}" />
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
                month: {
                    required: true,
                },
                year: {
                    required: true,
                },
                advance_salary: {
                    required: true,
                    number: true,
                },
            },
            messages: {
                month: {
                    required: 'Please select a month.',
                },
                year: {
                    required: 'Please select a year.',
                },
                advance_salary: {
                    required: 'Please enter advance salary amount.',
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
@endsection
