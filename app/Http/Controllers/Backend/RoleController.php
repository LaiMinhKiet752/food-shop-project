<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Exports\PermissionExport;
use App\Imports\PermissionImport;
use Maatwebsite\Excel\Facades\Excel;

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

    public function AddRolePermissions()
    {
        $roles = Role::orderBy('name', 'ASC')->get();
        $permissions = Permission::orderBy('group_name', 'ASC')->get();
        $permission_groups = User::getPermissionGroups();
        return view('backend.pages.role.add_role_permissions', compact('roles', 'permissions', 'permission_groups'));
    } //End Method

    public function RolePermissionStore(Request $request)
    {
        $request->validate([
            'permission' => 'required|array',
        ], [
            'permission.required' => 'Please select a permission for the role.',
        ]);
        $role_id = $request->role_id;
        $check = DB::table('role_has_permissions')->where('role_id', $role_id)->groupBy('role_id')->select('role_id')->get();
        if (count($check) > 0) {
            $notification = array(
                'message' => 'This Role Already Has Permissions Please Update Only!',
                'alert-type' => 'warning'
            );
            return redirect()->back()->with($notification);
        }
        $data = array();
        $permissions = $request->permission;
        foreach ($permissions as $key => $item) {
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;

            DB::table('role_has_permissions')->insert($data);
        }
        $notification = array(
            'message' => 'Successfully Added New Permission To Role!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.role.permissions')->with($notification);
    } //End Method

    public function AllRolePermissions()
    {
        $roles = Role::all();
        return view('backend.pages.role.all_role_permissions', compact('roles'));
    } //End Method

    public function AdminEditRolePermissions($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $permission_groups = User::getPermissionGroups();
        return view('backend.pages.role.role_permission_edit', compact('role', 'permissions', 'permission_groups'));
    } //End Method

    public function AdminUpdateRolePermissions(Request $request, $id)
    {
        $request->validate([
            'permission' => 'required|array',
        ], [
            'permission.required' => 'Please select a permission for the role.',
        ]);
        $role = Role::findOrFail($id);
        $permissions = $request->permission;
        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }
        $notification = array(
            'message' => 'Successfully Updated Permission To Role!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.role.permissions')->with($notification);
    } //End Method

    public function AdminDeleteRolePermissions($id)
    {
        $role = Role::findOrFail($id);
        if (!is_null($role)) {
            $role->delete();
        }
        $notification = array(
            'message' => 'Successfully Deleted Permission To Role!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // End Method

    public function ImportPermission()
    {
        return view('backend.pages.permission.import_permission');
    } //End Method

    public function ExportPermission()
    {
        return Excel::download(new PermissionExport, 'permission.xlsx');
    } //End Method

    public function ImportPermissionSubmit(Request $request)
    {
        Excel::import(new PermissionImport, $request->file('import_file'));
        $notification = array(
            'message' => 'Permission Imported Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.permission')->with($notification);
    } //End Method
}
