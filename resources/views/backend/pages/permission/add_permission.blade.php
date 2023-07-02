@extends('admin.admin_dashboard')
@section('admin')
@section('title')
    Roles & Permissions
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Permissions </div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Permission</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('all.permission') }}" class="btn btn-primary"><i class="lni lni-arrow-left"> Go
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
                            <form id="myForm" method="post" action="{{ route('store.permission') }}">
                                @csrf

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Permission Name <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('name') }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Group Name <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-dark">
                                        <select name="group_name" class="form-control form-select single-select">
                                            <option></option>
                                            <option value="brand">Brand</option>
                                            <option value="category">Category</option>
                                            <option value="subcategory">Subcategory</option>
                                            <option value="product">Product</option>
                                            <option value="inventory">Inventory</option>
                                            <option value="slider">Slider</option>
                                            <option value="banner">Banner</option>
                                            <option value="coupon">Coupon</option>
                                            <option value="shipping area">Shipping Area</option>
                                            <option value="order">Order</option>
                                            <option value="return order">Return Order</option>
                                            <option value="cancel order">Cancel Order</option>
                                            <option value="report order">Report Order</option>
                                            <option value="blog">Blog</option>
                                            <option value="review">Review</option>
                                            <option value="setting">Site Setting</option>
                                            <option value="roles and permissions">Roles And Permissions</option>
                                            <option value="admin user account">Admin User Account</option>
                                            <option value="vendor management">Vendor Management</option>
                                            <option value="user management">User Management</option>
                                            <option value="employee">Employee Management</option>
                                            <option value="employee salary">Employee Salary Management</option>
                                            <option value="timekeeping">Timekeeping Management</option>
                                            <option value="database backup">Database Backup</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-primary px-4" value="Add" />
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

<script type="text/javascript">
    $(document).ready(function() {
        $('#myForm').validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 255,
                },
                group_name: {
                    required: true,
                },
            },
            messages: {
                name: {
                    required: 'Please enter permission name.',
                    maxlength: 'The permission name must not be greater than 255 characters.',
                },
                group_name: {
                    required: 'Please select a group name.',
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
