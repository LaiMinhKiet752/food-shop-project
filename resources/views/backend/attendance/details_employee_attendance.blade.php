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
                    <li class="breadcrumb-item active" aria-current="page">Views All Employees Attendance</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('employee.attendance.list') }}" class="btn btn-primary"><i class="lni lni-arrow-left">
                        Go Back</i></a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr />
    <div class="card">
        <div class="card-body">
            <h3 class="hearder-title text-center"> Date : {{ $details['0']->date }}</h3>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Image</th>
                            <th>Employee Code</th>
                            <th>Employee Name</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($details as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <img src="{{ asset($item->employee->employee_photo) }}" alt=""
                                        style="width: 100px; height: 80px;">
                                </td>
                                <td>{{ $item->employee->employee_code }}</td>
                                <td>{{ $item->employee->employee_name }}</td>
                                <td>{{ date('d-m-Y', strtotime($item->date)) }}</td>
                                <td>
                                    @if ($item->status == 'Present')
                                    <span class="badge rounded-pill bg-success" style="font-size: 13px;">Present</span>
                                    @elseif($item->status == 'Absent')
                                    <span class="badge rounded-pill bg-dark" style="font-size: 13px;">Absent</span>
                                    @elseif($item->status == 'Leave')
                                    <span class="badge rounded-pill bg-danger" style="font-size: 13px;">Leave</span>
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
                            <th>Employee Name</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
