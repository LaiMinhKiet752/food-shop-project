@extends('admin.admin_dashboard')
@section('admin')
@section('title')
    Employee
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
                    <li class="breadcrumb-item active" aria-current="page">All Employees</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('add.employee') }}" class="btn btn-primary"><i class="lni lni-plus"> Add New</i></a>
            </div>
        </div>
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
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Salary (USD)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employee as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <img src="{{ asset($item->employee_photo) }}" alt=""
                                        style="width: 60px; height: 60px;">
                                </td>
                                <td>{{ $item->employee_name }}</td>
                                <td>{{ $item->employee_email }}</td>
                                <td>{{ $item->employee_phone }}</td>
                                <td>{{ Str::limit($item->employee_address, 30, '...') }}</td>
                                <td>{{ $item->salary }}</td>
                                <td>
                                    <a href="{{ route('edit.employee', $item->id) }}" class="btn btn-info">Edit</a>
                                    <a href="#" class="btn btn-danger" id="delete">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Image</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Salary (USD)</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
