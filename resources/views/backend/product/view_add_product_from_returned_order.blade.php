@extends('admin.admin_dashboard')
@section('admin')
@section('title')
    Product
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Product </div>
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
                <a href="{{ route('view.product.from.returned.order',$invoice->order->id) }}" class="btn btn-primary"><i class="lni lni-arrow-left"> Go
                        Back</i></a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form id="myForm" method="post" action="{{ route('store.product.from.returned_orders') }}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $products->id }}">
                                <input type="hidden" name="order_id" value="{{ $invoice->order_id }}">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Quantity Of Returned Product <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" class="form-control"
                                            value="{{ $invoice->quantity }}" id="quantity_returned" readonly/>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Quantity You Want To Add <span class="text-danger">*</span></h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="product_quantity" class="form-control"
                                            value="{{ old('product_quantity') }}" id="quantity"/>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-primary px-4 checkQuantity" value="Add" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#myForm').validate({
            rules: {
                product_quantity: {
                    required: true,
                    digits: true,
                    min: 1,
                },
            },
            messages: {
                product_quantity: {
                    required: 'Please enter product quantity.',
                    digits: 'Please enter only positive integers.',
                    min: 'Product quantity must be greater than 0.',
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $(document).on("click", ".checkQuantity", function() {

            var quantity = $('#quantity').val();
            var quantity_returned = $('#quantity_returned').val();
            var check = quantity_returned - quantity;

            if (check < 0) {
                $.notify("An error occurred, please check the quantity again!", {
                    globalPosition: 'top right',
                    className: 'error',
                });

                return false;
            } else {
                return true;
            }
        });
    });
</script>
@endsection
