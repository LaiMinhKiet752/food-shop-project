@extends('admin.admin_dashboard')
@section('admin')
@section('title')
    Brand
@endsection
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Brand</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Brand: <span
                            class="badge rounded-pill bg-danger">{{ count($brands) }}</span></li>
                </ol>
            </nav>
        </div>
        @if (Auth::user()->can('brand.add'))
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.brand') }}" class="btn btn-primary"><i class="lni lni-plus"> Add New</i></a>
                </div>
            </div>
        @endif
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
                            <th>Brand Name</th>
                            <th>Brand Image</th>
                            <th>Brand Email</th>
                            <th>Brand Phone</th>
                            <th>Brand Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brands as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->brand_name }}</td>
                                <td><img src="{{ asset($item->brand_image) }}" style="width: 100px; height: 70px;"></td>
                                <td>{{ $item->brand_email }}</td>
                                <td>{{ $item->brand_phone }}</td>
                                <td>{{ Str::limit($item->brand_address, 30, '...') }}</td>
                                <td>
                                    @if (Auth::user()->can('brand.edit'))
                                        <a href="{{ route('edit.brand', $item->id) }}" class="btn btn-warning">Edit</a>
                                    @endif
                                    @if (Auth::user()->can('brand.delete'))
                                        <a href="{{ route('delete.brand', $item->id) }}" class="btn btn-danger"
                                            id="delete">Delete</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Brand Name</th>
                            <th>Brand Image</th>
                            <th>Brand Email</th>
                            <th>Brand Phone</th>
                            <th>Brand Address</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
