@extends('admin.admin_dashboard')
@section('admin')
@section('title')
    Roles & Permissions
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<style>
    .form-check-label{
        text-transform: capitalize;
    }
</style>
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Role Has Permissions </div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Role Has Permissions</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('all.role.permissions') }}" class="btn btn-primary"><i class="lni lni-arrow-left"> Go
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
                            <form id="myForm" method="post" action="{{ route('admin.update.role', $role->id) }}">
                                @error('permission')
                                    <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
                                        <div class="text-white">{{ $message }}</div>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @enderror
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Role Name <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-dark">
                                        <label for="" name="name"
                                            style="font-size: 22px; font-weight: bold;">{{ $role->name }}</label>
                                    </div>
                                </div>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefaultAll">
                                    <label class="form-check-label" for="flexCheckDefaultAll">Allow all
                                        permissions</label>
                                </div>
                                <hr>
                                @foreach ($permission_groups as $group)
                                    <div class="row">
                                        <div class="col-3">
                                            @php
                                                $permissions = \App\Models\User::getPermissionByGroupName($group->group_name);
                                            @endphp
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefault"
                                                    {{ \App\Models\User::roleHasPermissions($role, $permissions) ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                    for="flexCheckDefault">{{ $group->group_name }}</label>
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            @foreach ($permissions as $permission)
                                                <div class="form-check">
                                                    <input name="permission[]"
                                                        {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                                        class="form-check-input" type="checkbox"
                                                        value="{{ $permission->id }}"
                                                        id="flexCheckDefault{{ $permission->id }}">
                                                    <label class="form-check-label"
                                                        for="flexCheckDefault{{ $permission->id }}">{{ $permission->name }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <hr>
                                @endforeach
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
<script>
    $('#flexCheckDefaultAll').click(function(e) {
        if ($(this).is(':checked')) {
            $('input[type = checkbox]').prop('checked', true);
        } else {
            $('input[type = checkbox]').prop('checked', false);
        }
    });
</script>
@endsection
