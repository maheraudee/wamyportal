<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('Admin.Permissions.permissions',compact('permissions'));
    }

    public function edit(Permission $permission)
    {
        $roles = Role::all();
        return view('Admin.Permissions.editPermission',compact('permission','roles'));
    }
    public function store(Request $request)
    {
        /* return $request->all(); */
        try {
            $validate = Validator::make($request->all(), [
                'name' => 'required|unique:permissions',
                'desc' => 'required',
            ], [
                'name.required' => 'إسم الصلاحية مطلوب',
                'name.unique' => 'هذا الاسم مدخل مسبقاً',
            ]);
            if ($validate->fails()) {
                return back()->withErrors($validate->errors())->withInput();
            }

            $permissions = new Permission();
            $permissions->name = $request->name;
            $permissions->desc = $request->desc;
            $permissions->save();
            Alert::success('تم حفظ بيانات الصلاحية  ')->autoClose(15000);
            return redirect()->route('admin.permissions.index');


        } catch (\Throwable $th) {
            Alert::error('هنالك خطأ', $th->getMessage())->autoClose(15000);
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }

    }

    public function update(Request $request,Permission $permission)
    {
        $validated = $request->validate(['name' => 'required']);
        $permission->update($validated);
        Alert::success('تم تعديل بيانات الصلاحية  ')->autoClose(15000);
        return redirect()->route('admin.permissions.index');
    }

    public function assignRole(Request $request,Permission $permission)
    {
        if ($permission->hasRole($request->role)) {
            Alert::error('الدور موجود مسبقاً')->autoClose(15000);
            return redirect()->back();
        }
        $permission->assignRole($request->role);
        Alert::success('تم منح الدور لهذا الصلاحية ')->autoClose(15000);
        return back();
    }
    public function removeRole(Permission $permission,Role $role)
    {
        if ($permission->hasRole($role)) {
            $permission->removeRole($role);
            Alert::success('تم سحب الدور')->autoClose(15000);
            return redirect()->back();
        }
        Alert::error('الدور غير موجود مسبقاً')->autoClose(15000);
        return redirect()->back();
    }


}
