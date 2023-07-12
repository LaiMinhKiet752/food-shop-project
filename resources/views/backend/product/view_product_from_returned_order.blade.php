@extends('admin.admin_dashboard')
@section('admin')
@section('title')
    Product
@endsection
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Product</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add Product From Returned Orders</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('add.product.from.returned.order') }}" class="btn btn-primary"><i
                        class="lni lni-arrow-left"> Go
                        Back</i></a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                @if ($invoice->isNotEmpty())
                    <h4 class="text-center text-danger">Invoice Number: {{ $invoice[0]->order->invoice_number }}</h4>
                @else
                @endif
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Image</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoice as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><img src="{{ asset($item->product->product_thumbnail) }}"
                                        style="width: 80px; height: 60px;">
                                </td>
                                <td>{{ $item->product->product_code }}</td>
                                <td>{{ Str::limit($item->product->product_name, 50, '...') }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>
                                    <a href="{{ route('view.add.product.from.returned_orders', $item->product->id) }}"
                                        class="btn btn-success" title="Add"><i class="fa fa-add"></i></a>
                                    <a href="{{ route('delete.product.from.returned_orders', ['order_id' => $item->order_id, 'product_id' => $item->product->id]) }}"
                                        class="btn btn-danger" title="Delete" id="delete"><i
                                            class="fa fa-trash"></i></a>
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
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
