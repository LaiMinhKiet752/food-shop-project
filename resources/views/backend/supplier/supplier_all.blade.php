@extends('admin.admin_dashboard')
@section('admin')
@section('title')
    Supplier
@endsection
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Supplier</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Suppliers: <span
                            class="badge rounded-pill bg-danger">{{ count($suppliers) }}</span></li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            @if (Auth::user()->can('supplier.add'))
                <div class="btn-group">
                    <a href="{{ route('add.supplier') }}" class="btn btn-primary"><i class="lni lni-plus"> Add
                            New</i></a>
                </div>
            @endif
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
                            <th>No.</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($suppliers as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ Str::limit($item->address, 50, '...') }}</td>
                                <td>
                                    @if (Auth::user()->can('supplier.edit'))
                                        <a href="{{ route('edit.supplier', $item->id) }}"
                                            class="btn btn-warning">Edit</a>
                                    @endif

                                    @if (Auth::user()->can('supplier.edit'))
                                        <a href="{{ route('delete.supplier', $item->id) }}" class="btn btn-danger"
                                            id="delete">Delete</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
