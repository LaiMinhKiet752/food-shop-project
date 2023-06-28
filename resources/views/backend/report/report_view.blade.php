@extends('admin.admin_dashboard')
@section('admin')
@section('title')
    Report
@endsection
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Report</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Report By Day, Month, Year</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr />
    <div class="row row-cols-1 row-cols-md-1 row-cols-lg-3 row-cols-xl-3">
        <form action="{{ route('search-by-date') }}" method="post">
            @csrf
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Search By Date</h5>
                        <label class="form-label">Date: </label>
                        <input type="date" name="date" class="form-control">
                        <br>
                        <input type="submit" class="btn btn-rounded btn-primary" value="Search">
                    </div>
                </div>
            </div>
        </form>

        <form action="{{ route('search-by-month') }}" method="post">
            @csrf
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Search By Month</h5>
                        <label class="form-label">Select Month: </label>
                        <select name="month" class="form-select mb-3" aria-label="Default select example">
                            <option selected="" disabled></option>
                            <option value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                        <label class="form-label">Select Year: </label>
                        <select name="year_name" class="form-select mb-3" aria-label="Default select example">
                            <option selected="" disabled></option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                        </select>
                        <br>
                        <input type="submit" class="btn btn-rounded btn-primary" value="Search">
                    </div>
                </div>
            </div>
        </form>

        <form action="{{ route('search-by-year') }}" method="post">
            @csrf
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Search By Year</h5>
                        <label class="form-label">Select Year: </label>
                        <select name="year" class="form-select mb-3" aria-label="Default select example">
                            <option selected="" disabled></option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                        </select>
                        <br>
                        <input type="submit" class="btn btn-rounded btn-primary" value="Search">
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection
