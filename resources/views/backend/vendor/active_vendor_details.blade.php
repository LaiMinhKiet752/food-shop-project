@extends('admin.admin_dashboard')
@section('admin')
@section('title')
    Vendor
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Vendor</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Active Vendor Details</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('active.vendor') }}" class="btn btn-primary"><i class="lni lni-arrow-left"> Go
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
                            <form method="post" action="{{ route('inactive.vendor.approve') }}" id="SubmitForm">
                                @csrf

                                <input type="hidden" name="id" value="{{ $activeVendorDetails->id }}">

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Vendor Full Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="name"
                                            value="{{ $activeVendorDetails->name }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Shop Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="shop_name" class="form-control"
                                            value="{{ $activeVendorDetails->shop_name }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Vendor UserName</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="form-control" name="username"
                                            value="{{ $activeVendorDetails->username }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Vendor Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="email" name="email" class="form-control"
                                            value="{{ $activeVendorDetails->email }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Vendor Phone</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="phone" class="form-control"
                                            value="{{ $activeVendorDetails->phone }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Vendor Address</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="address" class="form-control"
                                            value="{{ $activeVendorDetails->address }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Founded Year</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="address" class="form-control"
                                            value="{{ $activeVendorDetails->vendor_join }}" />
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Vendor Info</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <textarea name="vendor_short_info" class="form-control" id="inputAddress2" placeholder="Vendor Info " style="height: 200px;">{{ $activeVendorDetails->vendor_short_info }}</textarea>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Vendor Photo</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <img id="showImage"
                                            src="{{ !empty($activeVendorDetails->photo) ? url('upload/vendor_images/' . $activeVendorDetails->photo) : url('upload/no_image.jpg') }}"
                                            alt="Vendor" style="width:100px; height: 100px;">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <button type="submit" class="btn btn-danger px-4" title="Inactive Vendor"
                                            onclick="submitInactiveVendor(event)">INACTIVE</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function submitInactiveVendor(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            timer: 5000,
            timerProgressBar: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Inactive it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("SubmitForm").submit();
            }
        })
    }
</script>
@endsection
