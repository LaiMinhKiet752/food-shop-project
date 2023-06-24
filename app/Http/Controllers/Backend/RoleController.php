<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function AllPermission()
    {
        $permissions = Permission::all();
        return view('backend.pages.permission.all_permission', compact('permissions'));
    } //End Method

    public function AddPermission()
    {
        return view('backend.pages.permission.add_permission');
    } //End Method

    public function StorePermission(Request $request)
    {
        Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);
        $notification = array(
            'message' => 'Permission Added Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.permission')->with($notification);
    } //End Method

    public function EditPermission($id)
    {
        $permission = Permission::findOrFail($id);
        return view('backend.pages.permission.edit_permission', compact('permission'));
    } //End Method

    public function UpdatePermission(Request $request)
    {
        $permission_id = $request->id;
        Permission::findOrFail($permission_id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);
        $notification = array(
            'message' => 'Permission Updated Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.permission')->with($notification);
    } //End Method

    public function DeletePermission($id)
    {
        Permission::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Permission Deleted Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.permission')->with($notification);
    } //End Method

    public function AllRole()
    {
        $roles = Role::all();
        return view('backend.pages.role.all_role', compact('roles'));
    } //End Method

    public function AddRole()
    {
        return view('backend.pages.role.add_role');
    } //End Method

    public function StoreRole(Request $request)
    {
        Role::create([
            'name' => $request->name,
        ]);
        $notification = array(
            'message' => 'Role Added Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.role')->with($notification);
    } //End Method

    public function EditRole($id)
    {
        $role = Role::findOrFail($id);
        return view('backend.pages.role.edit_role', compact('role'));
    } //End Method

    public function UpdateRole(Request $request)
    {
        $role_id = $request->id;
        Role::findOrFail($role_id)->update([
            'name' => $request->name,
        ]);
        $notification = array(
            'message' => 'Role Updated Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.role')->with($notification);
    } //End Method

    public function DeleteRole($id)
    {
        Role::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Role Deleted Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.role')->with($notification);
    } //End Method
}
