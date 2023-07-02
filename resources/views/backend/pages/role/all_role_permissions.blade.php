@extends('admin.admin_dashboard')
@section('admin')
@section('title')
    Roles & Permissions
@endsection
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Role Has Permissions</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Role Has Permissions</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">

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
                            <th style="width: 5%">No.</th>
                            <th style="width: 10%">Role Name</th>
                            <th style="width: 80% ; margin-right: 5px;">
                                Permissions</th>
                            <th style="width: 5%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td
                                    style=" width: 99.9%;
                                height: 100%;
                                display: flex;
                                flex-wrap: wrap;
                                padding: 0;
                                margin: 0;">
                                    @foreach ($item->permissions as $permission)
                                        <span class="badge rounded-pill bg-success"
                                            style="font-size: 13px; margin: 5px;">
                                            {{ $permission->name }}</span>
                                    @endforeach
                                </td>
                                </td>
                                <td>
                                    <a href="{{ route('admin.edit.role', $item->id) }}" class="btn btn-warning">Edit</a>
                                    <a href="{{ route('admin.delete.role', $item->id) }}" class="btn btn-danger"
                                        id="delete">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="width: 5%">No.</th>
                            <th style="width: 10%">Role Name</th>
                            <th style="width: 80%;">Permissions</th>
                            <th style="width: 5%">Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
