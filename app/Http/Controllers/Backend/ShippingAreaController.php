<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShipDivision;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShippingAreaController extends Controller
{
    public function AllDivision()
    {
        $division = ShipDivision::latest()->get();
        return view('backend.ship.divison.division_all', compact('division'));
    } //End Method

    public function AddDivision()
    {
        return view('backend.ship.divison.division_add');
    } //End Method

    public function StoreDivision(Request $request)
    {
        ShipDivision::insert([
            'division_name' => $request->division_name,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Ship Division Inserted Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('all.division')->with($notification);
    } //End Method

    public function EditDivision($id)
    {
        $division = ShipDivision::findOrFail($id);
        return view('backend.ship.divison.division_edit', compact('division'));
    } // End Method

    public function UpdateDivision(Request $request)
    {
        $division_id = $request->id;
        ShipDivision::findOrFail($division_id)->update([
            'division_name' => $request->division_name,
        ]);

        $notification = array(
            'message' => 'Ship Division Updated Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.division')->with($notification);
    } // End Method

    public function DeleteDivision($id)
    {
        ShipDivision::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Ship Division Deleted Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // End Method
}
