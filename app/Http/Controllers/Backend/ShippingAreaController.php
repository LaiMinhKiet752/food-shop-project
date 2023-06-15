<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShipCity;
use App\Models\ShipCommune;
use App\Models\ShipDistricts;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShippingAreaController extends Controller
{
    ////////// CITY CRUD //////////
    public function AllCity()
    {
        $city = ShipCity::latest()->get();
        return view('backend.ship.city.city_all', compact('city'));
    } //End Method

    public function AddCity()
    {
        return view('backend.ship.city.city_add');
    } //End Method

    public function StoreCity(Request $request)
    {
        ShipCity::insert([
            'city_name' => $request->city_name,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'City, Province Added Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('all.city')->with($notification);
    } //End Method

    public function EditCity($id)
    {
        $city = ShipCity::findOrFail($id);
        return view('backend.ship.city.city_edit', compact('city'));
    } // End Method

    public function UpdateCity(Request $request)
    {
        $city_id = $request->id;
        ShipCity::findOrFail($city_id)->update([
            'city_name' => $request->city_name,
        ]);

        $notification = array(
            'message' => 'City, Province Updated Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.city')->with($notification);
    } // End Method

    public function DeleteCity($id)
    {
        ShipCity::findOrFail($id)->delete();
        $notification = array(
            'message' => 'City, Province Deleted Successfully!',
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
        $city = ShipCity::orderBy('city_name', 'ASC')->get();
        return view('backend.ship.district.district_add', compact('city'));
    } //End Method

    public function StoreDistrict(Request $request)
    {
        ShipDistricts::insert([
            'city_id' => $request->city_id,
            'district_name' => $request->district_name,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'District Added Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('all.district')->with($notification);
    } //End Method

    public function EditDistrict($id)
    {
        $city = ShipCity::orderBy('city_name', 'ASC')->get();
        $district = ShipDistricts::findOrFail($id);
        return view('backend.ship.district.district_edit', compact('district', 'city'));
    } // End Method

    public function UpdateDistrict(Request $request)
    {
        $district_id = $request->id;
        ShipDistricts::findOrFail($district_id)->update([
            'city_id' => $request->city_id,
            'district_name' => $request->district_name,
        ]);

        $notification = array(
            'message' => 'District Updated Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.district')->with($notification);
    } // End Method

    public function DeleteDistrict($id)
    {
        ShipDistricts::findOrFail($id)->delete();
        $notification = array(
            'message' => 'District Deleted Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // End Method



    ////////// COMMUNE CRUD //////////
    public function AllCommune()
    {
        $commune = ShipCommune::latest()->get();
        return view('backend.ship.commune.commune_all', compact('commune'));
    } //End Method

    public function AddCommune()
    {
        $city = ShipCity::orderBy('city_name', 'ASC')->get();
        $district = ShipDistricts::orderBy('district_name', 'ASC')->get();
        return view('backend.ship.commune.commune_add', compact('city', 'district'));
    } //End Method

    public function GetDistrict($city_id)
    {
        $data_district = ShipDistricts::where('city_id', $city_id)->orderBy('district_name', 'ASC')->get();
        return json_encode($data_district);
    } //End Method

    public function StoreCommune(Request $request)
    {
        ShipCommune::insert([
            'city_id' => $request->city_id,
            'district_id' => $request->district_id,
            'commune_name' => $request->commune_name,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Commune Added Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('all.commune')->with($notification);
    } //End Method

    public function EditCommune($id)
    {
        $city = ShipCity::orderBy('city_name', 'ASC')->get();
        $district = ShipDistricts::orderBy('district_name', 'ASC')->get();
        $commune = ShipCommune::findOrFail($id);
        return view('backend.ship.commune.commune_edit', compact('city', 'district', 'commune'));
    } // End Method

    public function UpdateCommune(Request $request)
    {
        $commune_id = $request->id;
        ShipCommune::findOrFail($commune_id)->update([
            'city_id' => $request->city_id,
            'district_id' => $request->district_id,
            'commune_name' => $request->commune_name,
        ]);

        $notification = array(
            'message' => 'Commune Updated Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.commune')->with($notification);
    } // End Method

    public function DeleteCommune($id)
    {
        ShipCommune::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Commune Deleted Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // End Method
}
