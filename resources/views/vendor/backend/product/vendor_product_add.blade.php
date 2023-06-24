@extends('vendor.vendor_dashboard')
@section('vendor')
@section('title')
    Product
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Product</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Product</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('vendor.all.product') }}" class="btn btn-primary"><i class="lni lni-arrow-left"> Go
                        Back</i></a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <form action="{{ route('vendor.store.product') }}" id="myForm" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="form-body mt-4">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="border border-3 p-4 rounded">
                                <div class="form-group mb-3 text-dark">
                                    <label for="inputProductTitle" class="form-label">Product Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="product_name" class="form-control"
                                        value="{{ old('product_name') }}">
                                </div>

                                <div class="mb-3 text-dark">
                                    <label for="inputProductTitle" class="form-label">Product Tags </label>
                                    <input type="text" name="product_tags" class="form-control visually-hidden"
                                        data-role="tagsinput" value="new product">
                                </div>

                                <div class="row g-3">
                                    <div class="form-group numbers-only col-md-6 text-dark">
                                        <label for="inputProductTitle" class="form-label">Product Weight</label>
                                        <input type="text" name="product_weight" class="form-control"
                                            value="{{ old('product_weight') }}">
                                    </div>
                                    <div class="form-group col-md-6 text-dark">
                                        <label for="inputProductTitle" class="form-label">Select Weight/Volume</label>
                                        <select name="product_measure" class="form-control form-select single-select">
                                            <option></option>
                                            <option value="kilogam">Kilogam</option>
                                            <option value="gram">Gram</option>
                                            <option value="liter">Liter</option>
                                            <option value="mililiter">Mililiter</option>
                                        </select>
                                    </div>
                                </div>
                                <br>

                                <div class="form-group mb-3 text-dark">
                                    <label for="inputProductTitle" class="form-label">Product Dimensions</label>
                                    <input type="text" name="product_dimensions" class="form-control"
                                        value="{{ old('product_dimensions') }}">
                                </div>

                                <div class="form-group mb-3 text-dark">
                                    <label for="inputProductDescription" class="form-label">Short Description <span
                                            class="text-danger">*</span></label>
                                    <textarea name="short_description" class="form-control" rows="5">{{ old('short_description') }}</textarea>
                                </div>

                                <div class="mb-3 text-dark">
                                    <label for="inputProductDescription" class="form-label">Long Description</label>
                                    <textarea id="mytextarea" name="long_description">{{ old('long_description') }}</textarea>
                                </div>
                                <br>
                                <div class="form-group mb-3 text-dark">
                                    <label for="inputProductTitle" class="form-label">Main Thumbnail <span
                                            class="text-danger">*</span></label>
                                    <input name="product_thumbnail" class="form-control" type="file"
                                        onchange="mainThumbnailUrl(this)">
                                    @if ($errors->has('product_thumbnail'))
                                        <div class="text-danger">{{ $errors->first('product_thumbnail') }}</div>
                                    @endif
                                    <img src="" id="mainthumbnail" alt="" style="margin-top: 10px;">
                                </div>

                                <div class="form-group mb-3 text-dark">
                                    <label for="inputProductTitle" class="form-label">Multiple Images <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" name="multiple_image[]" type="file"
                                        id="multipleImage" multiple="" required>
                                    @error('multiple_image.*')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="row" id="preview_image" style="margin-top: 10px;">

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="border border-3 p-4 rounded">
                                @error('product_code')
                                    <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show">
                                        <div class="text-white">{{ $message }}</div>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @enderror
                                <div class="row g-3">
                                    <div class="form-group numbers-only col-md-6 text-dark">
                                        <label for="inputPrice" class="form-label">Selling Price (USD) <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="selling_price" class="form-control"
                                            id="product_selling_price" placeholder="00.00"
                                            value="{{ old('selling_price') }}">
                                    </div>
                                    <div class="form-group numbers-only col-md-6 text-dark">
                                        <label for="inputCompareatprice" class="form-label">Discount Price
                                            (USD)</label>
                                        <input type="text" name="discount_price" class="form-control"
                                            id="product_discount_price" placeholder="00.00"
                                            value="{{ old('discount_price') }}">
                                    </div>
                                    <div class="form-group col-md-6 text-dark">
                                        <label for="inputCostPerPrice" class="form-label">Product Code <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="product_code" class="form-control"
                                            id="inputCostPerPrice" placeholder="1q2w3e"
                                            value="{{ old('product_code') }}">
                                    </div>
                                    <div class="form-group numbers-only col-md-6 text-dark">
                                        <label for="inputStarPoints" class="form-label">Product Quantity <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="product_quantity" class="form-control"
                                            id="inputStarPoints" placeholder="0"
                                            value="{{ old('product_quantity') }}">
                                    </div>

                                    <div class="col-md-6 text-dark">
                                        <label class="form-label">Manufacturing Date </label>
                                        <input type="date" name="manufacturing_date" class="form-control"
                                            id="mfg_product">
                                    </div>

                                    <div class="col-md-6 text-dark">
                                        <label class="form-label">Expiry Date </label>
                                        <input type="date" name="expiry_date" class="form-control"
                                            id="exp_product">
                                    </div>

                                    <div class="form-group col-12 text-dark">
                                        <label for="inputProductType" class="form-label">Product Brand <span
                                                class="text-danger">*</span></label>
                                        <select name="brand_id" class="form-control form-select single-select">
                                            <option></option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-12 text-dark">
                                        <label for="inputVendor" class="form-label">Product Category <span
                                                class="text-danger">*</span></label>
                                        <select name="category_id" class="form-control form-select single-select">
                                            <option></option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-12 text-dark">
                                        <label for="inputVendor" class="form-label">Product SubCategory <span
                                                class="text-danger">*</span></label>
                                        <select name="subcategory_id" class="form-control form-select single-select">
                                            <option></option>

                                        </select>
                                    </div>

                                    <div class="col-12 text-dark">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" name="hot_deals" type="checkbox"
                                                        value="1" />
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Hot Deals</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" name="featured" type="checkbox"
                                                        value="1" />
                                                    <label class="form-check-label"
                                                        for="flexCheckDefault">Featured</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" name="special_offer"
                                                        type="checkbox" value="1" />
                                                    <label class="form-check-label" for="flexCheckDefault">Special
                                                        Offer</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" name="special_deals"
                                                        type="checkbox" value="1" />
                                                    <label class="form-check-label" for="flexCheckDefault">Special
                                                        Deals</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- // end row  -->
                                    </div>

                                    <hr>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <input type="submit" class="btn btn-primary px-4 checkPrice checkDate"
                                                value="Add Product">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">
    function mainThumbnailUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#mainthumbnail').attr('src', e.target.result).width(150).height(140);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<script>
    $(document).ready(function() {
        $('#multipleImage').on('change', function() { //on file input change
            if (window.File && window.FileReader && window.FileList && window
                .Blob) //check File API supported browser
            {
                var data = $(this)[0].files; //this file data

                $.each(data, function(index, file) { //loop though each file
                    if (/(\.|\/)(gif|jpe?g|png|jpg|webp)$/i.test(file
                            .type)) { //check supported file type
                        var fRead = new FileReader(); //new filereader
                        fRead.onload = (function(file) { //trigger function on successful read
                            return function(e) {
                                var img = $('<img/>').addClass('thumb').attr('src',
                                        e.target.result).width(140)
                                    .height(140); //create image element
                                $('#preview_image').append(
                                    img); //append image to output element
                            };
                        })(file);
                        fRead.readAsDataURL(file); //URL representing the file's data.
                    }
                });

            } else {
                alert("Your browser doesn't support File API!"); //if File API is absent
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="category_id"]').on('change', function() {
            var category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    url: "{{ url('/vendor/subcategory/ajax') }}/" + category_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="subcategory_id"]').html('');
                        var d = $('select[name="subcategory_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="subcategory_id"]').append(
                                '<option value="' + value.id + '">' + value
                                .subcategory_name + '</option>');
                        });
                    },

                });
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#myForm').validate({
            rules: {
                product_name: {
                    required: true,
                    maxlength: 255,
                },
                product_weight: {
                    digits: true,
                    min: 1,
                },
                short_description: {
                    required: true,
                    maxlength: 255,
                },
                product_thumbnail: {
                    required: true,
                },
                selling_price: {
                    required: true,
                    min: 1,
                },
                discount_price: {
                    min: 1,
                },
                product_code: {
                    required: true,
                },
                product_quantity: {
                    required: true,
                    digits: true,
                    min: 1,
                },
                brand_id: {
                    required: true,
                },
                category_id: {
                    required: true,
                },
                subcategory_id: {
                    required: true,
                },
            },
            messages: {
                product_name: {
                    required: 'Please enter product name.',
                    maxlength: 'The product name must not be greater than 255 characters.',
                },
                product_weight: {
                    digits: 'Please enter only positive integers.',
                    min: 'The product weight must be greater than 0.',
                },
                short_description: {
                    required: 'Please enter short description.',
                    maxlength: 'The short description must not be greater than 255 characters.',
                },
                product_thumbnail: {
                    required: 'Please select product thumbnail image.',
                },
                selling_price: {
                    required: 'Please enter selling price.',
                    min: 'The selling price must be greater than 0.',
                },
                discount_price: {
                    min: 'The discount price must be greater than 0.',
                },
                product_code: {
                    required: 'Please enter product code.',
                },
                product_quantity: {
                    required: 'Please enter product quantity.',
                    digits: 'Please enter only positive integers.',
                    min: 'Product quantity must be greater than 0.',
                },
                brand_id: {
                    required: 'Please select a brand name.',
                },
                category_id: {
                    required: 'Please select a category name.',
                },
                subcategory_id: {
                    required: 'Please select a subcategory name.',
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
    $(".numbers-only").keypress(function(e) {
        if (e.which == 46) {
            if ($(this).val().indexOf('.') != -1) {
                return false;
            }
        }
        if (e.which != 8 && e.which != 0 && e.which != 46 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $(document).on("click", ".checkPrice", function() {

            var p_selling_price = $('#product_selling_price').val();
            var p_discount_price = $('#product_discount_price').val();
            var check = p_selling_price - p_discount_price;

            if (p_selling_price == '' && p_discount_price == '') {
                return true;
            }
            if (check < 0.01) {
                $.notify("There is an error in the selling price and discount!", {
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

<script type="text/javascript">
    $(document).ready(function() {
        $(document).on("click", ".checkDate", function() {

            var manufacturing_date = $('#mfg_product').val().split("-");
            var expiry_date = $('#exp_product').val().split("-");

            var today = new Date();
            var today_day = String(today.getDate()).padStart(2, '0');
            var today_month = String(today.getMonth() + 1).padStart(2, '0');
            var today_year = today.getFullYear();

            if (manufacturing_date != '' && expiry_date != '') {

                manufacturing_day = manufacturing_date[2];
                manufacturing_month = manufacturing_date[1];
                manufacturing_year = manufacturing_date[0];

                expiry_day = expiry_date[2];
                expiry_month = expiry_date[1];
                expiry_year = expiry_date[0];


                //
                if (manufacturing_year < today_year && expiry_year > today_year) {
                    return true;
                }





                //
                else if ((manufacturing_year == today_year && manufacturing_month == today_month &&
                        manufacturing_day <= today_day) && expiry_year > today_year) {
                    return true;
                }
                //
                else if ((manufacturing_year == today_year && manufacturing_month < today_month) &&
                    expiry_year > today_year) {
                    return true;
                }
                //
                else if ((manufacturing_year == today_year && manufacturing_month < today_month) &&
                    (expiry_year == today_year && expiry_month > today_month)) {
                    return true;
                }
                //
                else if ((manufacturing_year == today_year && manufacturing_month < today_month) &&
                    (expiry_year == today_year && expiry_month == today_month && expiry_day > today_day)
                ) {
                    return true;
                }





                //
                else if ((expiry_year == today_year && expiry_month ==
                        today_month && expiry_day > today_day) && manufacturing_year < today_year) {
                    return true;
                }
                //
                else if ((expiry_year == today_year && expiry_month > today_month) &&
                    manufacturing_year < today_year) {
                    return true;
                }
                //
                else if ((expiry_year == today_year && expiry_month > today_month) &&
                    (manufacturing_year == today_year && manufacturing_month < today_month)) {
                    return true;
                }
                //
                else if ((expiry_year == today_year && expiry_month > today_month) &&
                    (manufacturing_year == today_year && manufacturing_month == today_month &&
                        manufacturing_day <= today_day)) {
                    return true;
                }





                //
                else if ((manufacturing_year == today_year && manufacturing_month <= today_month &&
                        manufacturing_day <= today_day) && (expiry_year == today_year &&
                        expiry_month >= today_month && expiry_day > today_day)) {
                    return true;
                }





                //
                else {
                    $.notify(
                        "You have selected an invalid product's manufacture or expiration date!", {
                            globalPosition: 'top right',
                            className: 'error'
                        });
                    return false;
                }





                //
            } else if (manufacturing_date == '' && expiry_date == '') {
                return true;
            }
            //
            else if (manufacturing_date != '') {
                manufacturing_day = manufacturing_date[2];
                manufacturing_month = manufacturing_date[1];
                manufacturing_year = manufacturing_date[0];

                if (manufacturing_year > today_year) {
                    $.notify("Invalid production date!", {
                        globalPosition: 'top right',
                        className: 'error'
                    });
                    return false;
                } else if (manufacturing_year == today_year && manufacturing_month >
                    today_month) {
                    $.notify("Invalid production date!", {
                        globalPosition: 'top right',
                        className: 'error'
                    });
                    return false;
                } else if (manufacturing_year == today_year && manufacturing_month ==
                    today_month && manufacturing_day > today_day) {
                    $.notify("Invalid production date!", {
                        globalPosition: 'top right',
                        className: 'error'
                    });
                    return false;
                }
                return true;

            }
            //
            else if (expiry_date != '') {
                expiry_day = expiry_date[2];
                expiry_month = expiry_date[1];
                expiry_year = expiry_date[0];

                if (expiry_year < today_year) {
                    $.notify("Invalid expiration date!", {
                        globalPosition: 'top right',
                        className: 'error'
                    });
                    return false;
                } else if (expiry_year == today_year && expiry_month <
                    today_month) {
                    $.notify("Invalid expiration date!", {
                        globalPosition: 'top right',
                        className: 'error'
                    });
                    return false;
                } else if (expiry_year == today_year && expiry_month ==
                    today_month && expiry_day <= today_day) {
                    $.notify("Invalid expiration date!", {
                        globalPosition: 'top right',
                        className: 'error'
                    });
                    return false;
                }
                return true;
            }
        });
    });
</script>
@endsection
