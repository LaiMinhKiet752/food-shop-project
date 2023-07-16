@extends('admin.admin_dashboard')
@section('admin')
@section('title')
    Purchase
@endsection
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Purchase</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Approval Purchase</span></li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            @if (Auth::user()->can('purchase.add'))
                <div class="btn-group">
                    <a href="{{ route('purchase.add') }}" class="btn btn-primary"><i class="lni lni-plus"> Add
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
                            <th>PO No.</th>
                            <th>Date</th>
                            <th>Supplier</th>
                            <th>Product Name</th>
                            <th>Unit Price</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allData as $key => $item)
                            <tr>
                                <td> {{ $key + 1 }} </td>
                                <td> {{ $item->purchase_order_no }} </td>
                                <td> {{ date('d-m-Y', strtotime($item->date)) }} </td>
                                <td> {{ $item['supplier']['name'] }} </td>
                                <td> {{ Str::limit($item['product']['product_name'], 50, '...') }} </td>
                                <td> ${{ $item->unit_price }} </td>
                                <td> {{ $item->buying_quantity }} </td>
                                <td>
                                    @if ($item->status == '0')
                                        <span class="btn btn-warning">
                                            Pending
                                        </span>
                                    @elseif($item->status == '1')
                                        <span class="btn btn-success">
                                            Approved
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->status == '0')
                                        <a href="{{ route('purchase.approve', $item->id) }}" class="btn btn-danger"
                                            id="approve_purchase" title="Approved"><i
                                                class="fa fa-check-circle"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>PO No.</th>
                            <th>Date</th>
                            <th>Supplier</th>
                            <th>Product Name</th>
                            <th>Unit Price</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
