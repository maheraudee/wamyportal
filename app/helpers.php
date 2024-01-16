<?php

use App\Models\Employee;
use App\Models\Employeefinancial;
use App\Models\Saving\Boxbalance;
use App\Models\Saving\Orders\Boxorder;
use App\Models\Saving\Orders\Boxordersts;
use App\Models\User;
use Illuminate\Support\Facades\Route;


if (!function_exists('getImage')) {
    function getImage($photo)
    {
        if ($photo) {
            return asset('public/assets/MyImages/'.$photo);
        } else {
            return asset('public/assets/MyImages/no-image.jpg');
        }
    }
}
if (!function_exists('UserId')) {
    function UserId()
    {
        return auth()->user()->id;
    }
}

if (!function_exists('EmpNo')) {
    function EmpNo()
    {
        return auth()->user()->empno;
    }
}
if (!function_exists('EmpNoByUserid')) {
    function EmpNoByUserid($userid)
    {
        $user = User::where('id',$userid)->get('empno');
        return $user[0]->empno;
        /* return auth()->user()->empno; */
    }
}
if (!function_exists('Avatar')) {
    function Avatar()
    {
        return auth()->user()->avatar;
    }
}
if (!function_exists('Signature')) {
    function Signature($empno)
    {
        /* return auth()->user()->signature; */
        return User::where('empno',$empno)->pluck('signature')->first();
    }
}
if (!function_exists('EmpName')) {
    function EmpName($empno)
    {
        return Employee::where('empno',$empno)->pluck('name')->first();
    }
}
if (!function_exists('EmpBalance')) {
    function EmpBalance($empno)
    {
        return Boxbalance::where('empno',$empno)->pluck('balance')->first();
    }
}
if (!function_exists('EmpFincial')) {
    function EmpFincial($empno,$typ)
    {
        return Employeefinancial::where([['empno',$empno],['type',$typ]])->pluck('amnt')->first();
    }
}

if (!function_exists('active')) {
    function active($model,$arr=null,$arr1=null)
    {
        $model = 'App\\Models\\' . $model;

        if ($arr) {
            if ($arr1) {
                return $model::with($arr)->where('status', 1)->get($arr1);
            } else {
            return $model::with($arr)->where('status', 1)->get();
            }
        }
        elseif ($arr1){
            return $model::where('status', 1)->get($arr1);
        }else {
            return $model::where('status', 1)->get();
        }

    }
}

if (!function_exists('deactivate')) {
    function deactivate($model)
    {
        $model = 'App\\Models\\' . $model;
        return $model::where('status', 0)->get();
    }
}

if (!function_exists('GetAll')) {
    function GetAll($model,$arr=null,$arr1=null)
    {
        $model = 'App\\Models\\' . $model;
        if ($arr) {
            if ($arr1) {
                return $model::with($arr)->get($arr1);
            } else {
            return $model::with($arr)->get();
            }
        }elseif ($arr1){
            return $model::get($arr1);
        }else {
            return $model::all();
        }

    }
}

if (!function_exists('isSuperAdmin')) {
    function isSuperAdmin()
    {
        if (auth()->user()->usertypeid == 1) {
            return true;
        }else{ return false;}
    }
}

if (!function_exists('isAdmin')) {
    function isAdmin()
    {
        if (auth()->user()->usertypeid == 1 || auth()->user()->usertypeid == 2) {
            return true;
        }else{ return false;}
    }
}
if (!function_exists('isUser')) {
    function isUser()
    {
        if (auth()->user()->usertypeid == 3 || auth()->user()->usertypeid == 1) {
            return true;
        }else{ return false;}
    }
}
if (!function_exists('ItStaff')) {
    function ItStaff()
    {
        if (auth()->user()->usertypeid == 4) {
            return true;
        }else{ return false;}
    }
}

if (!function_exists('owner')) {
    function owner($model,$arr=null,$arr1=null)
    {
        $model = 'App\\Models\\' . $model;
        if ($arr) {
            $Entery_uesr = $model::where(['id'=>$arr])->get(['empno','userEntry']);
            return $Entery_uesr;
        }
    }
}

if (!function_exists('UserName')) {
    function UserName()
    {
        return auth()->user()->name;
    }
}

if (!function_exists('OrderStatusid')) {
    function OrderStatusid($orderid)
    {
        if ($orderid) {
            $order = Boxorder::where(['id'=>$orderid])->get('statusid');
            return $order[0]->statusid;
        }
    }
}
if (!function_exists('OrderColumn')) {
    function OrderColumn($orderid,$column)
    {
        if ($orderid) {
            $order = Boxorder::where(['id'=>$orderid])->get($column);
            return $order[0]->$column;
        }
    }
}

if (!function_exists('OrderStatusName')) {
    function OrderStatusName($id)
    {
        if ($id) {
            $order = Boxordersts::where(['id'=>$id])->get('name');
            return $order[0]->name;
        }
    }
}






