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
                    <li class="breadcrumb-item active" aria-current="page">Paid Salary History</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('month.salary') }}" class="btn btn-primary"><i class="lni lni-arrow-left"> Go
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
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Employee Code :</h6>
                                </div>
                                <div class="form-group col-sm-9 text-dark">
                                    <label
                                        style="font-size: 20px; font-weight: bold;">{{ $paysalary->employee_code }}</label>
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Employee Name :</h6>
                                </div>
                                <div class="form-group col-sm-9 text-dark">
                                    <label
                                        style="font-size: 20px; font-weight: bold;">{{ $paysalary->employee_name }}</label>
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Month :</h6>
                                </div>
                                <div class="form-group col-sm-9 text-dark">
                                    <label
                                        style="font-size: 20px; font-weight: bold;">{{ date('F', strtotime('-1 month')) }}</label>
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Year :</h6>
                                </div>
                                <div class="form-group col-sm-9 text-dark">
                                    <label style="font-size: 20px; font-weight: bold;">{{ date('Y') }}</label>
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Employee Salary(USD) :</h6>
                                </div>
                                <div class="form-group col-sm-9 text-dark">
                                    <label style="font-size: 20px; font-weight: bold;">{{ $paysalary->salary }}</label>
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Advance Salary(USD) :</h6>
                                </div>
                                <div class="form-group col-sm-9 text-dark">
                                    <label
                                        style="font-size: 20px; font-weight: bold;">{{ $paysalary->advance->advance_salary }}</label>
                                </div>
                            </div>
                            <hr>
                            @php
                                $amount = $paysalary->salary - $paysalary->advance->advance_salary;
                            @endphp
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Due Salary(USD) :</h6>
                                </div>
                                <div class="form-group col-sm-9 text-dark">
                                    <label style="font-size: 20px; font-weight: bold;">{{ $amount }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
