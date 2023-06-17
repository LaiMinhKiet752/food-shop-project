@extends('vendor.vendor_dashboard')
@section('vendor')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Restore Product</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Product <span
                                class="badge rounded-pill bg-danger"> {{ count($products) }} </span> </li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                @if (!$products->isEmpty())
                    <div class="btn-group">
                        <a href="{{ route('vendor.restore.all.product.submit') }}" class="btn btn-danger"
                            id="vendor_restore_all_product"><i class="lni lni-angle-double-up"> Restore All Product</i></a>
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
                                <th>Image</th>
                                <th>Product Code</th>
                                <th>Product Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><img src="{{ asset($item->product_thumbnail) }}" style="width: 70px; height: 40px;">
                                    </td>
                                    <td>{{ $item->product_code }}</td>
                                    <td>{{ $item->product_name }}</td>
                                    <td>
                                        <a href="{{ route('vendor.restore.product.submit', $item->id) }}" class="btn btn-warning"
                                            id="vendor_restore_product">Restore</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Image</th>
                                <th>Product Code</th>
                                <th>Product Name</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
