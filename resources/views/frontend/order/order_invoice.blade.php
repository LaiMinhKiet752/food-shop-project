<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hóa đơn</title>
    <style type="text/css">
        * {
            font-family: Roboto;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }

        .font {
            font-size: 15px;
        }

        .authority {
            /*text-align: center;*/
            float: right
        }

        .authority h5 {
            margin-top: -10px;
            color: green;
            /*text-align: center;*/
            margin-left: 35px;
        }

        .thanks p {
            color: green;
            ;
            font-size: 16px;
            font-weight: normal;
            font-family: serif;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
        <tr>
            <td valign="top">
                <img src="{{ public_path('/upload/logo.png') }}" alt="" style="width: 200px; height: 70px;" />
                <h2 style="color: green; font-size: 26px;"><strong>Bảo Linh</strong></h2>
            </td>
            <td align="right">
                <pre class="font">
               Địa chỉ: 10 Lê Lai, Quận 1, Thành phố Hồ Chí Minh
               Hotline: 1900 900
            </pre>
            </td>
        </tr>
    </table>
    <table width="100%" style="background:white; padding:2px;"></table>

    <table width="100%" style="background: #F7F7F7; padding:0 5 0 5px;" class="font">
        <tr>
            <td>
                <p class="font" style="margin-left: 20px;">
                    <strong>Họ và tên: </strong> {{ $order->name }}<br>
                    <strong>Email: </strong> {{ $order->email }}<br>
                    <strong>Số điện thoại: </strong> {{ $order->phone }} <br>
                    <strong>Địa chỉ: </strong> {{ $order->address }} <br>
                    <strong>Mã bưu điện: </strong> {{ $order->post_code }}
                </p>
            </td>
            <td>
                <p class="font">
                <h3><span style="color: green;">Invoice Number :</span> #{{ $order->invoice_number }}</h3>
                @php
                    $order_date = strtotime($order->order_date);
                    $order_date_format = date('d-m-Y H:i:s', $order_date);

                    $delivered_date = strtotime($order->delivered_date);
                    $delivered_date_format = date('d-m-Y H:i:s', $delivered_date);
                @endphp
                <strong>Ngày đặt: </strong> {{ $order_date_format }}<br>
                @if ($order->status == 'delivered' && $order->return_order_status == 0)
                    <strong>Ngày giao: </strong> {{ $delivered_date_format }}<br>
                @endif
                <strong>Loại thanh toán: </strong> {{ $order->payment_type }}<br>
                <strong>Phương thức thanh toán: </strong> {{ $order->payment_method }}<br>
                <strong>Ghi chú: </strong> {{ $order->notes }}
                </p>
            </td>
        </tr>
    </table>
    <br />
    <h3>Products</h3>
    <table width="100%">
        <thead style="background-color: green; color:#FFFFFF;">
            <tr class="font">
                <th>Hình</th>
                <th>Mã</th>
                <th>Tên</th>
                <th>Giá</th>
                <th>SL</th>
                <th>Tổng tiền</th>
            </tr>
        </thead>
        <tbody>
            @php
                $subtotal = 0;
            @endphp
            @foreach ($orderItem as $item)
                @php
                    $subtotal = $subtotal + $item->price * $item->quantity;
                @endphp
                <tr class="font">
                    <td align="center">
                        <img src="{{ public_path($item->product->product_thumbnail) }}" height="60px;" width="60px;"
                            alt="">
                    </td>
                    <td align="center">{{ $item->product->product_code }}</td>
                    <td align="center">{{ $item->product->product_name }}</td>
                    <td align="center">${{ $item->price }}</td>
                    <td align="center">{{ $item->quantity }}</td>
                    <td align="center">{{ number_format($item->price * $item->quantity, 0, ',', '.') }}đ</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <table width="100%" style=" padding:0 10px 0 10px;">
        <tr>
            <td align="right">
                <h2><span style="color: green;">Subtotal: </span>{{ number_format($subtotal, 0, ',', '.') }}đ</h2>
                @if ($order->discount == 0)
                    <h2><span style="color: green;">Discount: </span>0đ</h2>
                @else
                    <h2><span style="color: green;">Discount: </span>{{ number_format($order->discount, 0, ',', '.') }}đ</h2>
                @endif
                <h2><span style="color: green;">Total: </span>{{ number_format($order->amount, 0, ',', '.') }}đ</h2>
            </td>
        </tr>
    </table>
    <div class="thanks mt-3">
        <p>Cảm ơn đã mua sản phẩm của chúng tôi . . . !!!</p>
    </div>
    <div class="authority float-right mt-5">
        <p>-----------------------------------</p>
        <h5>Chữ ký của cơ quan có thẩm quyền:</h5>
    </div>
</body>

</html>
