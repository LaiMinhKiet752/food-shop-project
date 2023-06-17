@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Brand</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Restore Brand</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                @if (!$brands->isEmpty())
                    <div class="btn-group">
                        <a href="{{ route('restore.all.brand.submit') }}" class="btn btn-danger" id="restore_all_brand"><i
                                class="lni lni-angle-double-up"> Restore All
                                Brand</i></a>
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
                                    <td><img src="{{ asset($item->brand_image) }}" style="width: 70px; height: 40px;"></td>
                                    <td>{{ $item->brand_email }}</td>
                                    <td>{{ $item->brand_phone }}</td>
                                    <td>{{ $item->brand_address }}</td>
                                    <td>
                                        <a href="{{ route('restore.brand.submit', $item->id) }}" class="btn btn-warning"
                                            id="restore_brand">Restore</a>
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
