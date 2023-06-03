<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShipDistricts;
use App\Models\ShipDivision;
use App\Models\ShipState;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShippingAreaController extends Controller
{
    ////////// DIVISION CRUD //////////
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



    ////////// DISTRICT CRUD //////////
    public function AllDistrict()
    {
        $district = ShipDistricts::latest()->get();
        return view('backend.ship.district.district_all', compact('district'));
    } //End Method

    public function AddDistrict()
    {
        $division = ShipDivision::orderBy('division_name', 'ASC')->get();
        return view('backend.ship.district.district_add', compact('division'));
    } //End Method

    public function StoreDistrict(Request $request)
    {
        ShipDistricts::insert([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Ship District Inserted Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('all.district')->with($notification);
    } //End Method

    public function EditDistrict($id)
    {
        $division = ShipDivision::orderBy('division_name', 'ASC')->get();
        $district = ShipDistricts::findOrFail($id);
        return view('backend.ship.district.district_edit', compact('district', 'division'));
    } // End Method

    public function UpdateDistrict(Request $request)
    {
        $district_id = $request->id;
        ShipDistricts::findOrFail($district_id)->update([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
        ]);

        $notification = array(
            'message' => 'Ship District Updated Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.district')->with($notification);
    } // End Method

    public function DeleteDistrict($id)
    {
        ShipDistricts::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Ship District Deleted Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // End Method



    ////////// STATE CRUD //////////
    public function AllState()
    {
        $state = ShipState::latest()->get();
        return view('backend.ship.state.state_all', compact('state'));
    } //End Method

    public function AddState()
    {
        $division = ShipDivision::orderBy('division_name', 'ASC')->get();
        $district = ShipDistricts::orderBy('district_name', 'ASC')->get();
        return view('backend.ship.state.state_add', compact('division', 'district'));
    } //End Method

    public function GetDistrict($division_id)
    {
        $data_district = ShipDistricts::where('division_id', $division_id)->orderBy('district_name', 'ASC')->get();
        return json_encode($data_district);
    } //End Method

    public function StoreState(Request $request)
    {
        ShipState::insert([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Ship State Inserted Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('all.state')->with($notification);
    } //End Method

    public function EditState($id)
    {
        $division = ShipDivision::orderBy('division_name', 'ASC')->get();
        $district = ShipDistricts::orderBy('district_name', 'ASC')->get();
        $state = ShipState::findOrFail($id);
        return view('backend.ship.state.state_edit', compact('division', 'district', 'state'));
    } // End Method

    public function UpdateState(Request $request)
    {
        $state_id = $request->id;
        ShipState::findOrFail($state_id)->update([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
        ]);

        $notification = array(
            'message' => 'Ship State Updated Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.state')->with($notification);
    } // End Method

    public function DeleteState($id)
    {
        ShipState::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Ship State Deleted Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // End Method
}
