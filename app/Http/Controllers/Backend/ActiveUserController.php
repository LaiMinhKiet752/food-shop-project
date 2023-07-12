<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActiveUserController extends Controller
{
    public function AllUser()
    {
        $users = User::where('role', 'user')->latest()->get();
        return view('backend.user.user_all_data', compact('users'));
    } //End Method

    public function UpdateStatusNewCustomer($id)
    {
        DB::table('notifications')->where('id', $id)->update(['status' => 1]);
        return response()->json([
            'success' => 'OK!'
        ]);
    } // End Method
    
}
