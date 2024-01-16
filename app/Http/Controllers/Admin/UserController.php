<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('Admin.Users.index',compact('users'));
    }
    public function show(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('Admin.Users.role',compact('user','roles','permissions'));
    }
    public function destroy(User $user)
    {
        if ($user->hasRole('SuperAdmin')) {
            Alert::error('لايمكن حذف المستخدم المدير')->autoClose(15000);
            return redirect()->back();
        }
        $user->delete();
        Alert::success('تم حذف المستخدم '.$user->name.' بنجاح')->autoClose(15000);
        return redirect()->back();
    }

    public function assignRole(Request $request,User $user)
    {
        if ($user->hasRole($request->role)) {
            Alert::error('الدور موجود مسبقاً')->autoClose(15000);
            return redirect()->back();
        }
        $user->assignRole($request->role);
        Alert::success('تم منح الدور لهذا الصلاحية ')->autoClose(15000);
        return back();
    }

    public function removeRole(User $user,Role $role)
    {
        if ($user->hasRole($role)) {
            $user->removeRole($role);
            Alert::success('تم سحب الدور')->autoClose(15000);
            return redirect()->back();
        }
        Alert::error('الدور غير موجود مسبقاً')->autoClose(15000);
        return redirect()->back();
    }


    public function givePermission(Request $request,User $user)
    {
        /* return $request->permission; */
        if ($user->hasPermissionTo($request->permission)) {
            Alert::error('الصلاحية موجودة مسبقاً')->autoClose(15000);
            return redirect()->back();
        }
        $user->givePermissionTo($request->permission);
        Alert::success('تم منح الصلاحية لهذا الدور ')->autoClose(15000);
        return back();
    }
    public function revokePermission(User $user,Permission $permission)
    {
        /* return $request->permission; */
        if ($user->hasPermissionTo($permission)) {
            $user->revokePermissionTo($permission);
            Alert::success('تم سحب الصلاحية')->autoClose(15000);
            return redirect()->back();
        }
        Alert::error('الصلاحية غير موجودة مسبقاً')->autoClose(15000);
        return redirect()->back();
    }
}
