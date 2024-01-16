<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function index()
    {
        $roles = Role::all();
        return view('Admin.Permissions.roles',compact('roles'));
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('Admin.Permissions.editRole',compact('role','permissions'));
    }

    public function store(Request $request)
    {
        /* return $request->all(); */
        try {
            $validate = Validator::make($request->all(), [
                'name' => 'required|unique:roles',
            ], [
                'name.required' => 'إسم الدور مطلوب',
                'name.unique' => 'هذا الاسم مدخل مسبقاً',
            ]);
            if ($validate->fails()) {
                return back()->withErrors($validate->errors())->withInput();
            }

            $roles = new Role();
            $roles->name = $request->name;
            $roles->save();
            Alert::success('تم حفظ بيانات الدور  ')->autoClose(15000);
            return redirect()->route('admin.roles.index');


        } catch (\Throwable $th) {
            Alert::error('هنالك خطأ', $th->getMessage())->autoClose(15000);
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }

    }

    public function update(Request $request,Role $role)
    {
        $validated = $request->validate(['name' => 'required']);
        $role->update($validated);
        Alert::success('تم تعديل بيانات الدور  ')->autoClose(15000);
        return redirect()->route('admin.roles.index');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return back();
    }
    public function givePermission(Request $request,Role $role)
    {

        foreach ($request->permission as $permission){
            if ($role->hasPermissionTo($permission)) {
                Alert::error('الصلاحية موجودة مسبقاً')->autoClose(15000);
                return redirect()->back();
            }
            $role->givePermissionTo($permission);
        }
        Alert::success('تم منح الصلاحية لهذا الدور ')->autoClose(15000);
        return back();
    }
    public function revokePermission(Role $role,Permission $permission)
    {
        /* return $request->permission; */
        if ($role->hasPermissionTo($permission)) {
            $role->revokePermissionTo($permission);
            Alert::success('تم سحب الصلاحية')->autoClose(15000);
            return redirect()->back();
        }
        Alert::error('الصلاحية غير موجودة مسبقاً')->autoClose(15000);
        return redirect()->back();
    }
}
