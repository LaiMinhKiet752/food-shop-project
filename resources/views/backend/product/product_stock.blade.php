@extends('admin.admin_dashboard')
@section('admin')
@section('title')
    Product
@endsection
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Product Warehouse</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Products: <span
                            class="badge rounded-pill bg-danger">{{ count($products) }}</span></li>
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
                            <th>No.</th>
                            <th>Image</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Manufacturing Date</th>
                            <th>Expiry Date</th>
                            <th>In Stock</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><img src="{{ asset($item->product_thumbnail) }}" style="width: 80px; height: 60px;">
                                </td>
                                <td>{{ $item->product_code }}</td>
                                <td>{{ Str::limit($item->product_name, 50, '...') }}</td>
                                @php
                                    $manufacturing_date = strtotime($item->manufacturing_date);
                                    $manufacturing_date_format = date('d-m-Y', $manufacturing_date);

                                    $expiry_date = strtotime($item->expiry_date);
                                    $expiry_date_format = date('d-m-Y', $expiry_date);
                                @endphp
                                @if ($item->manufacturing_date == null)
                                    <td></td>
                                @else
                                    <td>{{ $manufacturing_date_format }}</td>
                                @endif
                                @if ($item->expiry_date == null)
                                    <td></td>
                                @else
                                    <td>{{ $expiry_date_format }}</td>
                                @endif
                                @if ($item->product_quantity <= 20)
                                <td class="text-danger" style="font-weight: bold;">{{ $item->product_quantity }}</td>
                                @else
                                <td>{{ $item->product_quantity }}</td>
                                @endif
                                <td>
                                    @if ($item->status == 1)
                                        <span class="badge rounded-pill bg-success"
                                            style="font-size: 13px;">Active</span>
                                    @else
                                        <span class="badge rounded-pill bg-secondary"
                                            style="font-size: 13px;">InActive</span>
                                    @endif
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
                            <th>Manufacturing Date</th>
                            <th>Expiry Date</th>
                            <th>In Stock</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
