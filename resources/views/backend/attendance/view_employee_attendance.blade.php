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
                    <li class="breadcrumb-item active" aria-current="page">Timekeeping By Day</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('add.employee.attendance') }}" class="btn btn-primary"><i class="lni lni-plus"> Add
                        New</i></a>
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
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allData as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ date('d-m-Y', strtotime($item->date)) }}</td>
                                <td>
                                    <a href="{{ route('employee.attendance.edit', $item->date) }}"
                                        class="btn btn-warning" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ route('employee.attendance.view', $item->date) }}" class="btn btn-info"
                                        title="Details"><i class="fa fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
