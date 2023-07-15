@extends('admin.admin_dashboard')
@section('admin')
@section('title')
    Purchase
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Purchase</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Purchase Order</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('purchase.all') }}" class="btn btn-primary"><i class="lni lni-arrow-left"> Go
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
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Date</label>
                                        <input class="form-control example-date-input" name="date" type="date"
                                            id="date">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Purchase Order No.</label>
                                        <input class="form-control example-date-input" name="purchase_order_no"
                                            type="text" id="purchase_order_no">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="md-3 text-dark">
                                        <label for="example-text-input" class="form-label">Select Supplier</label>
                                        <select id="supplier_id" name="supplier_id" class="form-select single-select"
                                            aria-label="Default select example">
                                            <option value="" ></option>
                                            @foreach ($supplier as $supp)
                                                <option value="{{ $supp->id }}">{{ $supp->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 pt-3">
                                    <div class="md-3 text-dark">
                                        <label for="example-text-input" class="form-label">Select Category</label>
                                        <select name="category_id" id="category_id" class="form-select single-select"
                                            aria-label="Default select example">
                                            <option value="" ></option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 pt-3">
                                    <div class="md-3 text-dark">
                                        <label for="example-text-input" class="form-label">Select Product</label>
                                        <select name="product_id" id="product_id" class="form-select single-select"
                                            aria-label="Default select example">
                                            <option value="" ></option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 pt-3">
                                    <div class="md-3 text-dark">
                                        <label for="example-text-input" class="form-label">Select Unit </label>
                                        <select name="unit" id="unit" class="form-select single-select"
                                            aria-label="Default select example">
                                            <option value="">None</option>
                                            <option value="Kilogam">Kilogam</option>
                                            <option value="Gram">Gram</option>
                                            <option value="Liter">Liter</option>
                                            <option value="Mililiter">Mililiter</option>
                                            <option value="Box">Box</option>
                                            <option value="Pack">Pack</option>
                                            <option value="Bottle">Bottle</option>
                                            <option value="Bag">Bag</option>
                                            <option value="Tube">Tube</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label" style="margin-top:43px;">
                                        </label>
                                        <i
                                            class="btn btn-secondary btn-rounded waves-effect waves-light fas fa-plus-circle addeventmore">
                                            Add More</i>
                                    </div>
                                </div>
                            </div> <!-- // end row -->
                        </div> <!-- // End card body 1  -->


                        <div class="card-body">
                            <form method="post" action="{{ route('purchase.store') }}">
                                @csrf
                                <table class="table-sm table-bordered" width="100%" style="border-color: #ddd;">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Unit</th>
                                            <th>Quantity</th>
                                            <th>Price (USD)</th>
                                            <th>Description</th>
                                            <th>Total Price (USD)</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="addRow" class="addRow">

                                    </tbody>

                                    <tbody>
                                        <tr>
                                            <td colspan="5"></td>
                                            <td>
                                                <input type="text" name="estimated_amount" value="0"
                                                    id="estimated_amount" class="form-control estimated_amount" readonly
                                                    style="background-color: #ddd;">
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table><br>
                                <div class="row">
                                    <div class="col-sm-10"></div>
                                    <div class="col-sm-2 text-secondary">
                                        <button type="submit" class="btn btn-success px-4" id="storeButton">
                                            Save</button>
                                    </div>
                                </div>
                            </form>
                        </div> <!-- End card body 2 -->


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script id="document-template" type="text/x-handlebars-template">
    <tr class="delete_add_more_item" id="delete_add_more_item">
            <input type="hidden" name="date[]" value="@{{date}}">
            <input type="hidden" name="purchase_order_no[]" value="@{{purchase_order_no}}">
            <input type="hidden" name="supplier_id[]" value="@{{supplier_id}}">
            <input type="hidden" name="category_id[]" value="@{{category_id}}">

        <td>
            <input type="hidden" name="product_id[]" value="@{{product_id}}">
            @{{ product_name }}
        </td>

        <td>
            <input type="hidden" name="unit[]" value="@{{unit}}">
            @{{ unit }}
        </td>

        <td>
            <input type="number" min="1" class="form-control buying_quantity text-right" name="buying_quantity[]" value="">
        </td>

        <td>
            <input type="number" class="form-control unit_price text-right" name="unit_price[]" value="">
        </td>

        <td>
            <input type="text" class="form-control" name="description[]">
        </td>

        <td>
            <input type="number" class="form-control total_price text-right" name="total_price[]" value="0" readonly>
        </td>

        <td>
            <i class="btn btn-danger btn-sm fas fa-window-close removeeventmore"></i>
        </td>
    </tr>
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on("click", ".addeventmore", function() {
            var date = $('#date').val();
            var purchase_order_no = $('#purchase_order_no').val();
            var supplier_id = $('#supplier_id').val();
            var category_id = $('#category_id').val();
            var category_name = $('#category_id').find('option:selected').text();
            var product_id = $('#product_id').val();
            var product_name = $('#product_id').find('option:selected').text();
            var unit = $('#unit').val();

            if (date == '') {
                $.notify("Date is Required", {
                    globalPosition: 'top right',
                    className: 'error'
                });
                return false;
            }
            if (purchase_order_no == '') {
                $.notify("Purchase Order No. is Required", {
                    globalPosition: 'top right',
                    className: 'error'
                });
                return false;
            }

            if (supplier_id == '') {
                $.notify("Supplier is Required", {
                    globalPosition: 'top right',
                    className: 'error'
                });
                return false;
            }
            if (category_id == '') {
                $.notify("Category is Required", {
                    globalPosition: 'top right',
                    className: 'error'
                });
                return false;
            }
            if (product_id == '') {
                $.notify("Product is Required", {
                    globalPosition: 'top right',
                    className: 'error'
                });
                return false;
            }
            // if (unit == '') {
            //     $.notify("Unit is Required", {
            //         globalPosition: 'top right',
            //         className: 'error'
            //     });
            //     return false;
            // }

            var source = $("#document-template").html();
            var tamplate = Handlebars.compile(source);
            var data = {
                date: date,
                purchase_order_no: purchase_order_no,
                supplier_id: supplier_id,
                category_id: category_id,
                category_name: category_name,
                product_id: product_id,
                product_name: product_name,
                unit: unit,
            };
            var html = tamplate(data);
            $("#addRow").append(html);
        });

        $(document).on("click", ".removeeventmore", function(event) {
            $(this).closest(".delete_add_more_item").remove();
            totalAmountPrice();
        });

        $(document).on('keyup click', '.unit_price,.buying_quantity', function() {
            var unit_price = $(this).closest("tr").find("input.unit_price").val();
            var qty = $(this).closest("tr").find("input.buying_quantity").val();
            var total = unit_price * qty;
            $(this).closest("tr").find("input.total_price").val(total);
            totalAmountPrice();
        });

        //Calculate sum of amout in invoice
        function totalAmountPrice() {
            var sum = 0;
            $(".total_price").each(function() {
                var value = $(this).val();
                if (!isNaN(value) && value.length != 0) {
                    sum += parseFloat(value);
                }
            });
            $('#estimated_amount').val(sum);
        }

    });
</script>
<script type="text/javascript">
    $(function() {
        $(document).on('change', '#supplier_id', function() {
            var supplier_id = $(this).val();
            $.ajax({
                url: "{{ route('purchase.get-category') }}",
                type: "GET",
                data: {
                    supplier_id: supplier_id
                },
                success: function(data) {
                    var html =
                        '<option value="" selected="" disabled>Select Category</option>';
                    $.each(data, function(key, v) {
                        html += '<option value=" ' + v.category_id + ' "> ' + v
                            .category.category_name + '</option>';
                    });
                    $('#category_id').html(html);
                }
            })
        });
    });
</script>
<script type="text/javascript">
    $(function() {
        $(document).on('change', '#category_id', function() {
            var category_id = $(this).val();
            $.ajax({
                url: "{{ route('purchase.get-product') }}",
                type: "GET",
                data: {
                    category_id: category_id
                },
                success: function(data) {
                    var html =
                        '<option value="" selected="" disabled>Select Product</option>';
                    $.each(data, function(key, v) {
                        html += '<option value=" ' + v.id + ' "> ' + v
                            .product_name +
                            '</option>';
                    });
                    $('#product_id').html(html);
                }
            })
        });
    });
</script>
@endsection
