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
                    <li class="breadcrumb-item active" aria-current="page">Daily Purchase Report</span></li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->
    <hr />
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div>
                                        <div class="p-2 text-center">
                                            <span
                                                class="btn btn-warning">{{ date('d-m-Y', strtotime($start_date)) }}</span>
                                            -
                                            <span
                                                class="btn btn-success">{{ date('d-m-Y', strtotime($end_date)) }}</span></strong>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end row -->
                            <div>
                                <div class="p-2">
                                </div>
                                <div class="">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <td><strong>No. </strong></td>
                                                    <td class="text-center"><strong>PO No.</strong></td>
                                                    <td class="text-center"><strong>Date</strong></td>
                                                    <td class="text-center"><strong>Product Name</strong>
                                                    </td>
                                                    <td class="text-center"><strong>Quantity</strong>
                                                    </td>
                                                    <td class="text-center"><strong>Unit Price</strong>
                                                    </td>
                                                    <td class="text-center"><strong>Total Price</strong>
                                                    </td>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $total_sum = '0';
                                                @endphp
                                                @foreach ($allData as $key => $item)
                                                    <tr>
                                                        <td class="text-center">{{ $key + 1 }}</td>
                                                        <td class="text-center">
                                                            {{ $item->purchase_order_no }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ date('d-m-Y', strtotime($item->date)) }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ Str::limit($item['product']['product_name'], 50, '...') }}
                                                        </td>
                                                        <td class="text-center">{{ $item->buying_quantity }}</td>
                                                        <td class="text-center">
                                                            ${{ $item->unit_price }}
                                                        </td>
                                                        <td class="text-center">
                                                            ${{ $item->total_price }}
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $total_sum += $item->total_price;
                                                    @endphp
                                                @endforeach
                                                <tr>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line"></td>
                                                    <td class="no-line text-center">
                                                        <strong>Grand Total:</strong>
                                                    </td>
                                                    <td class="no-line text-center">
                                                        <h4 class="m-0">${{ $total_sum }}</h4>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end row -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
