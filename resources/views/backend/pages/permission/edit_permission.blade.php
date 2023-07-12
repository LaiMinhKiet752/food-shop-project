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
                    <li class="breadcrumb-item active" aria-current="page">Edit Permissions</li>
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
                            <form id="myForm" method="post" action="{{ route('update.permission') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $permission->id }}">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Permission Name <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="name" class="form-control"
                                            value="{{ $permission->name }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Group Name <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-dark">
                                        <select name="group_name" class="form-control form-select single-select">
                                            <option></option>
                                            <option
                                                value="brand"{{ $permission->group_name == 'brand' ? 'selected' : '' }}>
                                                Brand Management</option>
                                            <option
                                                value="category"{{ $permission->group_name == 'category' ? 'selected' : '' }}>
                                                Category Management</option>
                                            <option
                                                value="subcategory"{{ $permission->group_name == 'subcategory' ? 'selected' : '' }}>
                                                Subcategory Management</option>
                                            <option
                                                value="product"{{ $permission->group_name == 'product' ? 'selected' : '' }}>
                                                Product Management</option>
                                            <option
                                                value="inventory"{{ $permission->group_name == 'inventory' ? 'selected' : '' }}>
                                                Inventory Management</option>
                                            <option
                                                value="slider"{{ $permission->group_name == 'slider' ? 'selected' : '' }}>
                                                Slider Management</option>
                                            <option
                                                value="banner"{{ $permission->group_name == 'banner' ? 'selected' : '' }}>
                                                Banner Management</option>
                                            <option
                                                value="coupon"{{ $permission->group_name == 'coupon' ? 'selected' : '' }}>
                                                Coupon Management</option>
                                            <option
                                                value="shipping area"{{ $permission->group_name == 'shipping area' ? 'selected' : '' }}>
                                                Shipping Area</option>
                                            <option
                                                value="order"{{ $permission->group_name == 'order' ? 'selected' : '' }}>
                                                Order Management</option>
                                            <option
                                                value="return order"{{ $permission->group_name == 'return order' ? 'selected' : '' }}>
                                                Return Order Management</option>
                                            <option
                                                value="cancel order"{{ $permission->group_name == 'cancel order' ? 'selected' : '' }}>
                                                Cancel Order Management</option>
                                            <option
                                                value="report order"{{ $permission->group_name == 'report order' ? 'selected' : '' }}>
                                                Report Order Management</option>
                                            <option
                                                value="contact"{{ $permission->group_name == 'contact' ? 'selected' : '' }}>
                                                Contact Management</option>
                                            <option
                                                value="blog"{{ $permission->group_name == 'blog' ? 'selected' : '' }}>
                                                Blog Management</option>
                                            <option
                                                value="review"{{ $permission->group_name == 'review' ? 'selected' : '' }}>
                                                Review Management</option>
                                            <option
                                                value="subscriber"{{ $permission->group_name == 'subscriber' ? 'selected' : '' }}>
                                                Subscriber Management</option>
                                            <option
                                                value="setting"{{ $permission->group_name == 'setting' ? 'selected' : '' }}>
                                                Site Setting</option>
                                            <option
                                                value="roles and permissions"{{ $permission->group_name == 'roles and permissions' ? 'selected' : '' }}>
                                                Roles And Permissions</option>
                                            <option
                                                value="admin user account"{{ $permission->group_name == 'admin user account' ? 'selected' : '' }}>
                                                Admin User Account</option>
                                            <option
                                                value="user management"{{ $permission->group_name == 'user management' ? 'selected' : '' }}>
                                                User Management</option>
                                            <option
                                                value="employee"{{ $permission->group_name == 'employee' ? 'selected' : '' }}>
                                                Employee Management</option>
                                            <option
                                                value="employee salary"{{ $permission->group_name == 'employee salary' ? 'selected' : '' }}>
                                                Employee Salary Management</option>
                                            <option
                                                value="timekeeping"{{ $permission->group_name == 'timekeeping' ? 'selected' : '' }}>
                                                Timekeeping Management</option>
                                            <option
                                                value="database backup"{{ $permission->group_name == 'database backup' ? 'selected' : '' }}>
                                                Database Backup</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-success px-4" value="Save Changes" />
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
