@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Category</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Restore Category</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                @if (!$categories->isEmpty())
                    <div class="btn-group">
                        <a href="{{ route('restore.all.category.submit') }}" class="btn btn-danger"
                            id="restore_all_category"><i class="lni lni-angle-double-up"> Restore All Category</i></a>
                    </div>
                @else
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
                                <th>Category Name</th>
                                <th>Category Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->category_name }}</td>
                                    <td><img src="{{ asset($item->category_image) }}" style="width: 100px; height: 70px;">
                                    </td>
                                    <td>
                                        <a href="{{ route('restore.category.submit', $item->id) }}" class="btn btn-warning"
                                            id="restore_category">Restore</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Category Name</th>
                                <th>Category Image</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
