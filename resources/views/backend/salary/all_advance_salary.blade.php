@extends('admin.admin_dashboard')
@section('admin')
@section('title')
    Employee Management
@endsection
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Employee</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Employees Advance Salary <span
                        class="badge rounded-pill bg-danger">{{ count($salary) }}</span></li>
                </ol>
            </nav>
        </div>
        {{-- @if (Auth::user()->can('employee.salary.add'))
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.advance.salary') }}" class="btn btn-primary"><i class="lni lni-plus"> Add
                            New</i></a>
                </div>
            </div>
        @endif --}}
    </div>
    <!--end breadcrumb-->
    <hr />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Image</th>
                            <th>Employee Code</th>
                            <th>Full Name</th>
                            <th>Month</th>
                            <th>Year</th>
                            <th>Salary(USD)</th>
                            <th>Advance Salary(USD)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($salary as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <img src="{{ asset($item->employee->employee_photo) }}" alt=""
                                        style="width: 100px; height: 80px;">
                                </td>
                                <td>{{ $item->employee->employee_code }}</td>
                                <td>{{ $item->employee->employee_name }}</td>
                                <td>{{ date('m', strtotime($item->month)) }}</td>
                                <td>{{ $item->year }}</td>
                                <td>{{ $item->employee->salary }}</td>
                                <td>{{ $item->advance_salary }}</td>
                                <td>
                                    @if (Auth::user()->can('employee.salary.edit'))
                                        <a href="{{ route('edit.advance.salary', $item->id) }}"
                                            class="btn btn-warning">Edit</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Image</th>
                            <th>Employee Code</th>
                            <th>Full Name</th>
                            <th>Month</th>
                            <th>Year</th>
                            <th>Salary(USD)</th>
                            <th>Advance Salary(USD)</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
