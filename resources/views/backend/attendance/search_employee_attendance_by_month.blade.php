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
                    <li class="breadcrumb-item active" aria-current="page">Views Timekeeping By Month</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('timekeeping.by.month') }}" class="btn btn-primary"><i class="lni lni-arrow-left">
                        Go Back</i></a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr />
    <div class="card">
        <div class="card-body">
            <h3 class="hearder-title text-center">{{ $format_month }} - {{ $format_year }}</h3>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Image</th>
                            <th>Employee Code</th>
                            <th>Full Name</th>
                            <th>Present</th>
                            <th>Absent</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allData as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <img src="{{ asset($item->employee->employee_photo) }}" alt=""
                                        style="width: 100px; height: 80px;">
                                </td>
                                <td>{{ $item->employee->employee_code }}</td>
                                <td>{{ $item->employee->employee_name }}</td>
                                <td>
                                    @php
                                        $count_present = \App\Models\Attendance::where('employee_id', $item->employee_id)->where('status','Present')->count();
                                    @endphp
                                    {{ $count_present }}
                                </td>
                                <td>
                                    @php
                                        $count_absent = \App\Models\Attendance::where('employee_id', $item->employee_id)->where('status','Absent')->count();
                                    @endphp
                                    {{ $count_absent }}
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
                            <th>Present</th>
                            <th>Absent</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
