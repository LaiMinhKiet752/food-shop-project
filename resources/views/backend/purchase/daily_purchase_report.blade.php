@extends('admin.admin_dashboard')
@section('admin')
@section('title')
    Report
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Report</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Daily
                        Purchase Report</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr />
    <div class="row row-cols-1 row-cols-md-1 row-cols-lg-3 row-cols-xl-3">
        <form action="{{ route('daily.purchase.pdf') }}" method="get" target="_blank" id="myForm">
            @csrf
            <div class="col">
                <div class="card">
                    <div class="card-body form-group">
                        <div class="col-md-12 form-group">
                            <label class="form-label">Start Date: </label>
                            <input class="form-control example-date-input" name="start_date" type="date"
                                id="start_date" placeholder="YY-MM-DD">
                        </div>
                        <br>

                        <div class="col-md-12 form-group">
                            <label class="form-label">End Date: </label>
                            <input class="form-control example-date-input" name="end_date" type="date" id="end_date"
                                placeholder="YY-MM-DD">
                        </div>
                        <br>
                        <input type="submit" class="btn btn-rounded btn-primary" value="Search">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#myForm').validate({
            rules: {
                start_date: {
                    required: true,
                },
                end_date: {
                    required: true,
                },
            },
            messages: {
                start_date: {
                    required: 'Please select start date.',
                },
                end_date: {
                    required: 'Please select end date.',
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
