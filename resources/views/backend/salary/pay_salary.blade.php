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
                    <li class="breadcrumb-item active" aria-current="page">Pay Salary</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            {{-- <div class="btn-group">
                <a href="{{ route('add.advance.salary') }}" class="btn btn-primary"><i class="lni lni-plus"> Add
                        New</i></a>
            </div> --}}
        </div>
    </div>
    <!--end breadcrumb-->
    <hr />
    <div class="card">
        <div class="card-body">
            <h3 class="hearder-title text-center">{{ date('F Y') }}</h3>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Image</th>
                            <th>Full Name</th>
                            <th>Month</th>
                            <th>Year</th>
                            <th>Salary(USD)</th>
                            <th>Advance Salary(USD)</th>
                            <th>Due Salary(USD)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employee as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <img src="{{ asset($item->employee_photo) }}" alt=""
                                        style="width: 100px; height: 80px;">
                                </td>
                                <td>{{ $item->employee_name }}</td>
                                <td>
                                    <span class="badge rounded-pill bg-success"
                                        style="font-size: 13px;">{{ date('F', strtotime('-1 month')) }}</span>
                                </td>
                                <td>
                                    <span class="badge rounded-pill bg-danger"
                                        style="font-size: 13px;">{{ date('Y') }}</span>
                                </td>
                                <td>{{ $item->salary }}</td>
                                <td>
                                    @if ($item->advance->advance_salary == 0)
                                        <p>0</p>
                                    @else
                                        {{ $item->advance->advance_salary }}
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $amount = $item->salary - $item->advance->advance_salary;
                                    @endphp
                                    @if ($item->advance->advance_salary == 0)
                                        <strong> {{ $item->salary }}</strong>
                                    @else
                                        <strong>
                                            {{ $amount }}
                                        </strong>
                                    @endif
                                </td>
                                @php
                                    $check = \App\Models\PaySalary::where('employee_id', $item->id)
                                        ->where('salary_month', $current_month)
                                        ->where('salary_year', $current_year)
                                        ->first();
                                @endphp
                                <td>
                                    @if ($check == '')
                                    <a href="{{ route('pay.now.salary', $item->id) }}" class="btn btn-info">Pay
                                        Now</a>
                                    @else
                                    <button class="btn btn-warning">Paid</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Image</th>
                            <th>Full Name</th>
                            <th>Month</th>
                            <th>Year</th>
                            <th>Salary(USD)</th>
                            <th>Advance Salary(USD)</th>
                            <th>Due Salary(USD)</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
