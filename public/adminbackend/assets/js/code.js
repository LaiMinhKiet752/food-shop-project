//Delete Data
$(function () {
    $(document).on("click", "#delete", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            timerProgressBar: true,
            timer: 5000,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it !'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
            }
        });
    });
});

//Confirm Order
$(function () {
    $(document).on("click", "#confirm", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: "Are you sure?",
            text: "Once 'Confirm', You will not be able to 'Pending' again!",
            icon: "warning",
            showCancelButton: true,
            timerProgressBar: true,
            timer: 5000,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Confirm it !",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
            }
        });
    });
});

//Processing Order
$(function () {
    $(document).on("click", "#processing", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: "Are you sure?",
            text: "Once 'Processing', You will not be able to 'Confirm' again!",
            icon: "warning",
            showCancelButton: true,
            timerProgressBar: true,
            timer: 5000,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Processing it !",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
            }
        });
    });
});

//Delivered Order
$(function () {
    $(document).on("click", "#delivered", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: "Are you sure?",
            text: "Once 'Delivered', You will not be able to 'Processing' again!",
            icon: "warning",
            showCancelButton: true,
            timerProgressBar: true,
            timer: 5000,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Delivered it !",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
            }
        });
    });
});

//Approved Return Order
$(function () {
    $(document).on("click", "#approved_return", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: "Are you sure?",
            text: "Approve Return Order!",
            icon: "warning",
            showCancelButton: true,
            timerProgressBar: true,
            timer: 5000,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Approved it !",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
            }
        });
    });
});

//Approved Cancel Order
$(function () {
    $(document).on("click", "#approved_cancel", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: "Are you sure?",
            text: "Approve Cancel Order!",
            icon: "warning",
            showCancelButton: true,
            timerProgressBar: true,
            timer: 5000,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Approved it !",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
            }
        });
    });
});

//Restore Brand
$(function () {
    $(document).on("click", "#restore_brand", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: "Are you sure?",
            text: "Restore this brand!",
            icon: "warning",
            showCancelButton: true,
            timerProgressBar: true,
            timer: 5000,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Restore it !",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
            }
        });
    });
});

//Restore All Brand
$(function () {
    $(document).on("click", "#restore_all_brand", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: "Are you sure?",
            text: "Restore all brand!",
            icon: "warning",
            showCancelButton: true,
            timerProgressBar: true,
            timer: 5000,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Restore all !",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
            }
        });
    });
});

//Restore Category
$(function () {
    $(document).on("click", "#restore_category", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: "Are you sure?",
            text: "Restore this category!",
            icon: "warning",
            showCancelButton: true,
            timerProgressBar: true,
            timer: 5000,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Restore it !",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
            }
        });
    });
});

//Restore All Category
$(function () {
    $(document).on("click", "#restore_all_category", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: "Are you sure?",
            text: "Restore all category!",
            icon: "warning",
            showCancelButton: true,
            timerProgressBar: true,
            timer: 5000,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Restore all !",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
            }
        });
    });
});

//Restore Subcategory
$(function () {
    $(document).on("click", "#restore_subcategory", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: "Are you sure?",
            text: "Restore this subcategory!",
            icon: "warning",
            showCancelButton: true,
            timerProgressBar: true,
            timer: 5000,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Restore it !",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
            }
        });
    });
});

//Restore All Subcategory
$(function () {
    $(document).on("click", "#restore_all_subcategory", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: "Are you sure?",
            text: "Restore all subcategory!",
            icon: "warning",
            showCancelButton: true,
            timerProgressBar: true,
            timer: 5000,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Restore all !",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
            }
        });
    });
});

//Admin Restore Product
$(function () {
    $(document).on("click", "#restore_product", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: "Are you sure?",
            text: "Restore this product!",
            icon: "warning",
            showCancelButton: true,
            timerProgressBar: true,
            timer: 5000,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Restore it !",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
            }
        });
    });
});

//Admin Restore All Product
$(function () {
    $(document).on("click", "#restore_all_product", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: "Are you sure?",
            text: "Restore all product!",
            icon: "warning",
            showCancelButton: true,
            timerProgressBar: true,
            timer: 5000,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Restore all !",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
            }
        });
    });
});

//Vendor Restore Product
$(function () {
    $(document).on("click", "#vendor_restore_product", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: "Are you sure?",
            text: "Restore this product!",
            icon: "warning",
            showCancelButton: true,
            timerProgressBar: true,
            timer: 5000,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Restore it !",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
            }
        });
    });
});

//Vendor Restore All Product
$(function () {
    $(document).on("click", "#vendor_restore_all_product", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: "Are you sure?",
            text: "Restore all product!",
            icon: "warning",
            showCancelButton: true,
            timerProgressBar: true,
            timer: 5000,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Restore all !",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
            }
        });
    });
});

//Restore Coupon
$(function () {
    $(document).on("click", "#restore_coupon", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: "Are you sure?",
            text: "Restore this coupon!",
            icon: "warning",
            showCancelButton: true,
            timerProgressBar: true,
            timer: 5000,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Restore it !",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
            }
        });
    });
});

//Restore All Coupon
$(function () {
    $(document).on("click", "#restore_all_coupon", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: "Are you sure?",
            text: "Restore all coupon!",
            icon: "warning",
            showCancelButton: true,
            timerProgressBar: true,
            timer: 5000,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Restore all !",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
            }
        });
    });
});
