<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\CouponUse;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderCompleteNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Services\CurrencyService;

class StripeController extends Controller
{
    protected $currencyService;

    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    public function StripeOrder(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('stripe.stripe_sk'));

        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
            $discount_amount = Session::get('coupon')['discount_amount'];
        } else {
            $total_amount = round(Cart::total(), 2);
            $discount_amount = 0;
        }

        if (Cart::total() < 200000) {
            $total_amount = $total_amount + 25000;
        }

        $rates = $this->currencyService->convertCurrency();

        if ($rates === null || !isset($rates['USD'])) {
            return redirect()->back()->withErrors('Không thể lấy tỷ giá tiền tệ.');
        }

        $usd_amount = $total_amount / $rates['VND'] * $rates['USD'];
        $usd_amount = round($usd_amount, 2);

        try {
            $response = \Stripe\Checkout\Session::create([
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => 'product',
                            ],
                            'unit_amount' => $usd_amount * 100,
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'metadata' => ['order_id' => hexdec(uniqid())],
                'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('stripe.cancel'),
            ]);

            // Lưu thông tin đơn hàng vào session để xử lý sau khi thanh toán thành công
            Session::put('stripe_order_data', [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'post_code' => $request->post_code,
                'notes' => $request->notes,
                'total_amount' => $total_amount,
                'discount_amount' => $discount_amount,
                'order_number' => $response->metadata->order_id,
            ]);

            return redirect()->away($response->url);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Lỗi thanh toán: ' . $e->getMessage());
        }
    }

    public function StripeSuccess(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('stripe.stripe_sk'));

        try {
            $session = \Stripe\Checkout\Session::retrieve($request->get('session_id'));
            // Kiểm tra trạng thái thanh toán từ Stripe
            if ($session->payment_status === 'paid') {
                $orderData = Session::get('stripe_order_data');

                // Tạo đơn hàng mới
                $order_id = Order::insertGetId([
                    'user_id' => Auth::id(),
                    'name' => $orderData['name'],
                    'email' => $orderData['email'],
                    'phone' => $orderData['phone'],
                    'address' => $orderData['address'],
                    'post_code' => $orderData['post_code'],
                    'notes' => $orderData['notes'],
                    'payment_type' => 'Thẻ tín dụng',
                    'payment_method' => 'Stripe',
                    'transaction_id' => $session->id, // Sử dụng ID session từ Stripe
                    'currency' => 'VND',
                    'amount' => $orderData['total_amount'],
                    'discount' => $orderData['discount_amount'],
                    'order_number' => $orderData['order_number'],
                    'invoice_number' => 'BL' . time() . mt_rand(100000, 1000000),
                    'order_date' => Carbon::now()->format('d-m-Y H:i:s'),
                    'order_day' => Carbon::now()->format('d'),
                    'order_month' => Carbon::now()->format('m'),
                    'order_year' => Carbon::now()->format('Y'),
                    'status' => 'pending', // Hoặc một trạng thái phù hợp khác
                    'created_at' => Carbon::now(),
                ]);

                $carts = Cart::content();
                foreach ($carts as $cart) {
                    OrderDetails::insert([
                        'order_id' => $order_id,
                        'product_id' => $cart->id,
                        'brand_id' => $cart->options->brand_id,
                        'price' => $cart->price,
                        'quantity' => $cart->qty,
                        'created_at' => Carbon::now(),
                    ]);
                }

                $product = OrderDetails::where('order_id', $order_id)->get();
                foreach ($product as $item) {
                    Product::where('id', $item->product_id)
                        ->update([
                            'product_quantity' => DB::raw('product_quantity - ' . $item->quantity)
                        ]);
                }

                if (Session::has('coupon')) {
                    CouponUse::insert([
                        'coupon_code' => Session::get('coupon')['coupon_code'],
                        'user_id' => Auth::id(),
                        'created_at' => Carbon::now()
                    ]);
                    Session::forget('coupon');
                }

                // Gửi thông báo đến admin
                $user = User::where('role', 'admin')->get();
                Notification::send($user, new OrderCompleteNotification($orderData['name']));

                Cart::destroy();
                Session::forget('stripe_order_data');

                $notification = array(
                    'order_success' => 'success',
                );
                return redirect()->route('dashboard')->with($notification);
            } else {
                // Xử lý khi thanh toán không thành công
                $notification = array(
                    'order_cancel' => 'cancel',
                );
                return redirect()->route('dashboard')->with($notification);
            }
        } catch (\Exception $e) {
            $notification = array(
                'order_cancel' => 'cancel',
            );
            return redirect()->route('dashboard')->with($notification);
        }
    }

    public function StripeCancel()
    {
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        Cart::destroy();
        $notification = array(
            'order_cancel' => 'cancel',
        );
        return redirect()->route('dashboard')->with($notification);
    }
}
