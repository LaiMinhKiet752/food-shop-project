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
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Services\CurrencyService;

class PaypalController extends Controller
{
    protected $currencyService;

    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    public function PaypalOrder(Request $request)
    {
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
            // Lưu thông tin đơn hàng vào session để xử lý sau khi thanh toán thành công
            Session::put('paypal_order_data', [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'post_code' => $request->post_code,
                'notes' => $request->notes,
                'total_amount' => $total_amount,
                'discount_amount' => $discount_amount,
                'order_number' => hexdec(uniqid()),
            ]);

            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $paypalToken = $provider->getAccessToken();

            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('paypal.success'),
                    "cancel_url" => route('paypal.cancel'),
                ],
                "purchase_units" => [
                    [
                        "amount" => [
                            "currency_code" => "USD",
                            "value" => $usd_amount
                        ]
                    ]
                ],
            ]);

            if (isset($response['id']) && $response['id'] != null) {
                foreach ($response['links'] as $link) {
                    if ($link['rel'] == 'approve') {
                        return redirect()->away($link['href']);
                    }
                }
            } else {
                return redirect()->route('paypal.cancel');
            }
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors('Lỗi thanh toán: ' . $e->getMessage());
        }
    } //End Method

    public function PaypalSuccess(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);
        // dd($response);
        $transaction_id = $response['id'];

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            $orderData = Session::get('paypal_order_data');

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
                'payment_method' => 'Paypal',
                'transaction_id' => $transaction_id,
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
                $checkCouponExists = CouponUse::where('coupon_code', Session::get('coupon')['coupon_code'])->first();
                if (!$checkCouponExists) {
                    CouponUse::insert([
                        'coupon_code' => Session::get('coupon')['coupon_code'],
                        'user_id' => Auth::id(),
                        'created_at' => Carbon::now()
                    ]);
                    Session::forget('coupon');
                }
            }

            // Gửi thông báo đến admin
            $user = User::where('role', 'admin')->get();
            Notification::send($user, new OrderCompleteNotification($orderData['name']));

            Cart::destroy();
            Session::forget('paypal_order_data');

            $notification = array(
                'order_success' => 'success',
            );
            return redirect()->route('dashboard')->with($notification);
        } else {
            return redirect()->route('paypal.cancel');
        }
    } //End Method

    public function PaypalCancel()
    {
        $notification = array(
            'order_cancel' => 'cancel',
        );
        return redirect()->route('dashboard')->with($notification);
    } //End Method
}
