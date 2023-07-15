<x-mail::message>
# Order has been canceled at your request

<x-mail::table>

| <strong style="font-size: 30px;">Invoice Number:  {{ $order->invoice_number }}</strong>|
| ------------------------------------------------------------                           |
| Full Name: {{ $order->name }}                                                          |
| Email: {{ $order->email }}                                                             |
| Phone Number: {{ $order->phone }}                                                      |
| Adress: {{ $order->address }}                                                          |
| Payment Method: {{ $order->payment_method }}                                           |
| Payment Type: {{ $order->payment_type }}                                               |
| Total: ${{ $order->amount }}                                                           |
| Order Date: {{ $order->order_date->format("d-m-Y H:i:s") }}                            |
| Cancel Date: {{ $order->cancel_date }}                                                 |
</x-mail::table>

{!! $body !!}
{{ config('app.name') }}
</x-mail::message>
