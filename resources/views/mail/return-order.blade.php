<x-mail::message>
# Order has been returned at your request

<x-mail::table>

| <strong style="font-size: 30px;">Invoice Number:  {{ $order->invoice_number }}</strong>|
| ------------------------------------------------------------                           |
| Full Name: {{ $order->name }}                                                          |
| Email: {{ $order->email }}                                                             |
| Phone Number: {{ $order->phone }}                                                      |
| Payment Method: {{ $order->payment_method }}                                           |
| Payment Type: {{ $order->payment_type }}                                               |
| Total: ${{ $order->amount }}                                                           |
| Order Date: {{ $order->order_date->format("d-m-Y H:i:s") }}                            |
| Return Date: {{ $order->return_date }}                                                 |
| Return Reason: {{ $order->return_reason }}                                                 |
</x-mail::table>

{!! $body !!}
{{ config('app.name') }}
</x-mail::message>
