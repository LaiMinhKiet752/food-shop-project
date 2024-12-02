//Delete Data
$(function () {
    $(document).on("click", "#delete", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: "Bạn chắc chứ?",
            text: "Bạn sẽ không thể hoàn tác lại!",
            icon: "warning",
            showCancelButton: true,
            timerProgressBar: true,
            timer: 5000,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "Vâng, Xóa nó !",
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
            title: "Bạn chắc chứ?",
            text: "Một khi xác nhận, bạn sẽ không về lại được trạng thái chờ!",
            icon: "warning",
            showCancelButton: true,
            timerProgressBar: true,
            timer: 5000,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Vâng, xác nhận nó !",
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
            title: "Bạn chắc chứ?",
            text: "Một khi xử lý, bạn sẽ không về lại được trạng thái xác nhận!",
            icon: "warning",
            showCancelButton: true,
            timerProgressBar: true,
            timer: 5000,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Vâng, xử lý nó !",
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
            title: "Bạn chắc chứ?",
            text: "Một khi đã giao, bạn sẽ không về lại được trạng thái xử lý!",
            icon: "warning",
            showCancelButton: true,
            timerProgressBar: true,
            timer: 5000,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Vâng, đã giao nó !",
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
            title: "Bạn chắc chứ?",
            text: "Chấp nhận trả lại đơn hàng!",
            icon: "warning",
            showCancelButton: true,
            timerProgressBar: true,
            timer: 5000,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Vâng, chấp nhận nó !",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
            }
        });
    });
});

//Approved Purchase Order
$(function () {
    $(document).on("click", "#approve_purchase", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: "Bạn chắc chứ?",
            text: "Chấp nhận dữ liệu này!",
            icon: "warning",
            showCancelButton: true,
            timerProgressBar: true,
            timer: 5000,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Vâng, chấp nhận nó !",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
            }
        });
    });
});



