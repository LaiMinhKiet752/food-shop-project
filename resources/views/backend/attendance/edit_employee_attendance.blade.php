@extends('admin.admin_dashboard')
@section('admin')
@section('title')
    Employee Management
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<link rel="stylesheet" href="{{ asset('adminbackend/assets/css/attend.css') }}">
<style>
    .switch-toggle {
        width: auto;
    }

    .switch-toggle label:not(.disabled) {
        cursor: pointer;
    }

    .switch-candy a {
        border: 1px solid #333;
        border-radius: 3px;
        background-color: white;
        background-image: -webkit-linear-gradient(top, rgba(255, 255, 255, 0.2), transparent);
        background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.2), transparent);
    }

    .switch-toggle.switch-candy,
    .switch-light.switch-candy>span {
        background-color: #5a6268;
        border-radius: 3px;
        box-shadow: inset 0 2px 6px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.2);
    }
</style>
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Employee </div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Employees
                        Attendance</li>
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
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('employee.attendance.store') }}" method="post">
                                @csrf
                                @php
                                    $ts = strtotime($editData['0']->date);
                                    $date_format = date('Y-m-d', $ts);
                                @endphp
                                <div class="form-group col-md-4">
                                    <label for="date" class="control-label"
                                        style="font-size: 20px; font-weight: 500;">Employees Attendance Date</label><br>
                                    <input type="date" name="date" id="date"
                                        class="checkdate form-control form-control-sm singledatepicker"
                                        value="{{ $date_format }}" placeholder="Attendance Date" autocomplete="off">
                                </div>
                                <br>
                                <table class="table sm table-bordered table-striped dt-responsive" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="text-center" style="vertical-align: middle">No.
                                            </th>
                                            <th rowspan="2" class="text-center" style="vertical-align: middle">
                                                Employee
                                                Code</th>
                                            <th rowspan="2" class="text-center" style="vertical-align: middle">
                                                Employee
                                                Name</th>
                                            <th colspan="3" class="text-center" style="vertical-align: middle">
                                                Attendance
                                                Status</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center btn present_all"
                                                style="display: table-cell;background-color:#dd0d0d; color: white;">
                                                Present</th>
                                            <th class="text-center btn absent_all"
                                                style="display: table-cell;background-color:#dd0d0d; color: white;">
                                                Absent</th>
                                            <th class="text-center btn leave_all"
                                                style="display: table-cell;background-color:#dd0d0d; color: white;">
                                                Leave</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($editData as $key => $item)
                                            <tr class="text-center">
                                                <input type="hidden" name="employee_id[]"
                                                    value="{{ $item->employee_id }}" class="employee_id">
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item['employee']['employee_code'] }}</td>
                                                <td>{{ $item['employee']['employee_name'] }}</td>
                                                <td colspan="3">
                                                    <div class="switch-toggle switch-3 switch-candy">
                                                        <input class="present" id="present{{ $key }}"
                                                            name="status{{ $key }}" value="Present"
                                                            type="radio"
                                                            {{ $item->status == 'Present' ? 'checked' : '' }}>
                                                        <label for="present{{ $key }}">Present</label>


                                                        <input class="absent" id="absent{{ $key }}"
                                                            name="status{{ $key }}" value="Absent"
                                                            type="radio"
                                                            {{ $item->status == 'Absent' ? 'checked' : '' }}>
                                                        <label for="absent{{ $key }}">Absent</label>

                                                        
                                                        <input class="leave" id="leave{{ $key }}"
                                                            name="status{{ $key }}" value="Leave"
                                                            type="radio"
                                                            {{ $item->status == 'Leave' ? 'checked' : '' }}>
                                                        <label for="leave{{ $key }}">Leave</label>

                                                        <a></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <br>
                                <input type="submit" class="btn btn-success px-4 checkPrice checkDate"
                                    style="float: right;" value="Save Changes">
                            </form>
                        </div>
                        <!-- end card body-->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col-->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).on('click', '.present', function() {
        $(this).parents('tr').find('.datetime').css('pointer-events', 'none').css('background-color', '#dee2e6')
            .css('color', '#495057');
    });
    $(document).on('click', '.leave', function() {
        $(this).parents('tr').find('.datetime').css('pointer-events', '').css('background-color', 'white').css(
            'color', '#495057');
    });
    $(document).on('click', '.absent', function() {
        $(this).parents('tr').find('.datetime').css('pointer-events', 'none').css('background-color', '#dee2e6')
            .css('color', '#dee2e6');
    });
</script>
<script type="text/javascript">
    $(document).on('click', '.present_all', function() {
        $("input[value=Present]").prop('checked', true);
        $('.datetime').css('ponter-events', 'none').css('background-color', '#dee2e6').css('color', '#495057');
    });
    $(document).on('click', '.leave_all', function() {
        $("input[value=Leave]").prop('checked', true);
        $('.datetime').css('ponter-events', '').css('background-color', 'white').css('color', '#495057');
    });
    $(document).on('click', '.absent_all', function() {
        $("input[value=Absent]").prop('checked', true);
        $('.datetime').css('ponter-events', 'none').css('background-color', '#dee2e6').css('color', '#dee2e6');
    });
</script>
@endsection
