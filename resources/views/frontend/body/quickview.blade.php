<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<div class="modal fade custom-modal" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeModal"></button>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                        <div class="detail-gallery">
                            <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                            <!-- MAIN SLIDES -->
                            <div class="product-image-slider">
                                <figure class="border-radius-10">
                                    <img src="" alt="product image" id="pimage" />
                                </figure>
                            </div>
                        </div>
                        <!-- End Gallery -->
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="detail-info pr-30 pl-30">
                            <h3 class="title-detail"><a href=" " class="text-heading" id="pname"> </a></h3>
                            <br>

                            <div class="clearfix product-price-cover">
                                <div class="product-price primary-color float-left">
                                    <span class="current-price text-brand" id="pprice"></span>
                                    <span class="old-price font-md ml-15" id="oldprice"></span>
                                </div>
                            </div>

                            <div class="detail-extralink mb-30">
                                <div class="detail-qty border radius">
                                    <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                    <input type="text" name="qty" id="qty" class="qty-val numbers-only" value="1"
                                        min="1" max="100">
                                    <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                </div>
                                <div class="product-extra-link2">
                                    <input type="hidden" id="product_id">
                                    <input type="hidden" id="brand_id" value="">
                                    <button type="submit" class="button button-add-to-cart" onclick="addToCart()"><i
                                            class="fi-rs-shopping-cart"></i>Thêm vào giỏ hàng</button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6"
                                    style="padding-right: 0px !important; padding-left: 0px !important;">
                                    <div class="font-xs">
                                        <ul>
                                            <li class="mb-5">THƯƠNG HIỆU : <span class="text-brand" id="pbrand">
                                                </span>
                                            </li>
                                            <li class="mb-5">DANH MỤC : <span class="text-brand" id="pcategory">
                                                </span>
                                            </li>
                                            <li class="mb-5">DANH MỤC CON : <span class="text-brand" id="psubcategory">
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div> <!-- // End col  -->


                                <div class="col-md-6"
                                    style="padding-left: 5px !important; padding-right: 0px !important;">
                                    <div class="font-xs">
                                        <ul>
                                            <li class="mb-5">MÃ SẢN PHẨM : <span class="text-brand" id="pcode">
                                                </span></li>
                                            <li class="mb-5">NGÀY SX : <span class="text-brand" id="pmfg"> </span>
                                            </li>
                                            <li class="mb-5">TRẠNG THÁI : <span
                                                    class="badge badge-pill badge-success" id="instock"
                                                    style="background:green; color: white;"> </span>
                                                <span class="badge badge-pill badge-danger" id="outofstock"
                                                    style="background:red; color: white;"> </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div> <!-- // End col  -->
                            </div> <!-- // end row -->
                        </div>
                        <!-- Detail Info -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {

        $('.numbers-only').keypress(function(e) {
            var charCode = (e.which) ? e.which : event.keyCode;
            var inputValue = $(this).val() + String.fromCharCode(charCode);

            // Kiểm tra nếu ký tự không phải là số
            if (String.fromCharCode(charCode).match(/[^0-9]/g)) {
                return false;
            }

            // Ràng buộc số lượng phải trong phạm vi 1 đến 99
            if (parseInt(inputValue) < 1 || parseInt(inputValue) > 99) {
                return false;
            }
        });

        // Thêm sự kiện cho input field để chặn không cho nhập khi vượt quá 2 chữ số
        $('.numbers-only').on('input', function() {
            var value = $(this).val();
            if (parseInt(value) < 1 || parseInt(value) > 99) {
                $(this).val('');
            }
        });

    });
</script>
