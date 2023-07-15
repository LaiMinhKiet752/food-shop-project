<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function PurchaseAll()
    {
        $allData = Purchase::orderBy('date', 'desc')->orderBy('id', 'DESC')->get();
        return view('backend.purchase.purchase_all', compact('allData'));
    } //End Method

    public function PurchaseAdd()
    {
        $supplier = Supplier::all();
        $category = Category::all();
        return view('backend.purchase.purchase_add', compact('supplier', 'category'));
    } //End Method

    public function PurchaseStore(Request $request)
    {
        if ($request->category_id == null) {
            $notification = array(
                'message' => 'Sorry You Do Not Select Any Item!',
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        } else {
            $count_category = count($request->category_id);
            for ($i = 0; $i < $count_category; $i++) {
                $purchase = new Purchase();
                $purchase->supplier_id = $request->supplier_id[$i];
                $purchase->category_id = $request->category_id[$i];
                $purchase->product_id = $request->product_id[$i];
                $purchase->unit = $request->unit[$i];
                $purchase->purchase_order_no = $request->purchase_order_no[$i];
                $purchase->date = date('Y-m-d', strtotime($request->date[$i]));
                $purchase->buying_quantity = $request->buying_quantity[$i];
                $purchase->unit_price = $request->unit_price[$i];
                $purchase->total_price = $request->total_price[$i];
                $purchase->description = $request->description[$i];
                $purchase->created_by = Auth::user()->id;
                $purchase->status = '0';
                $purchase->save();
            }
        }
        $notification = array(
            'message' => 'Data Saved Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('purchase.all')->with($notification);
    } //End Method

    public function PurchaseDelete($id)
    {
        Purchase::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Purchase Item Deleted Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    } //End Method

    public function PurchasePending()
    {
        $allData = Purchase::orderBy('date', 'desc')->orderBy('id', 'desc')->where('status', '0')->get();
        return view('backend.purchase.purchase_pending', compact('allData'));
    } //End Method

    public function PurchaseApprove($id)
    {
        $purchase = Purchase::findOrFail($id);
        $product = Product::where('id', $purchase->product_id)->first();
        $purchase_qty = ((float)($purchase->buying_quantity)) + ((float)($product->product_quantity));
        $product->product_quantity = $purchase_qty;
        if ($product->save()) {
            Purchase::findOrFail($id)->update([
                'status' => '1',
            ]);
            $notification = array(
                'message' => 'Status Approved Successfully!',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        }
    } //End Method

    public function DailyPurchaseReport()
    {
        return view('backend.purchase.daily_purchase_report');
    } //End Method

    public function DailyPurchaseView(Request $request)
    {
        $sdate = date('Y-m-d', strtotime($request->start_date));
        $edate = date('Y-m-d', strtotime($request->end_date));
        $allData = Purchase::whereBetween('date', [$sdate, $edate])->where('status', '1')->get();

        $start_date = date('Y-m-d', strtotime($request->start_date));
        $end_date = date('Y-m-d', strtotime($request->end_date));
        return view('backend.purchase.daily_purchase_report_view', compact('allData', 'start_date', 'end_date'));
    }

    public function GetCategory(Request $request)
    {
        $supplier_id = $request->supplier_id;
        $allCategory = Product::with(['category'])->select('category_id')->where('supplier_id', $supplier_id)->groupBy('category_id')->get();
        return response()->json($allCategory);
    } //End Method

    public function GetProduct(Request $request)
    {
        $category_id = $request->category_id;
        $allProduct = Product::where('category_id', $category_id)->get();
        return response()->json($allProduct);
    } //End Method
}
