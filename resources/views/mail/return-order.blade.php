<x-mail::message>
# Đơn hàng đã được trả lại theo yêu cầu của bạn

<x-mail::table>

| <strong style="font-size: 30px;">Số hóa đơn:  {{ $order->invoice_number }}</strong>|
| ------------------------------------------------------------                           |
| Họ và tên: {{ $order->name }}                                                          |
| Email: {{ $order->email }}                                                             |
| Số điện thoại: {{ $order->phone }}                                                     |
| Địa chỉ: {{ $order->address }}                                                         |
| Phương thức thanh toán: {{ $order->payment_method }}                                   |
| Loại thanh toán: {{ $order->payment_type }}                                            |
| Tổng tiền: ${{ $order->amount }}                                                       |
| Ngày đặt hàng: {{ $order->order_date->format("d-m-Y H:i:s") }}                         |
| Ngày trả hàng: {{ $order->return_date }}                                               |
| Lí do: {{ $order->return_reason }}                                                     |
</x-mail::table>

{!! $body !!}
{{ config('app.name') }}
</x-mail::message>
