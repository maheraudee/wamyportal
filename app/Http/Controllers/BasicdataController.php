<?php

namespace App\Http\Controllers;

use App\Models\Employeefinancial;
use App\Models\Saving\Installmentperiod;
use App\Models\Saving\Orders\boanalyse_guarantee_pivot;
use App\Models\Saving\Orders\Boxorder;
use App\Models\Saving\Orders\Boxordersanalyse;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class BasicdataController extends Controller
{
    public function updateStatues(Request $request, $type)
    {
        try {
            $model = 'App\Models\\' . $type;
            if ($type == 'Inventory\Store') {
                $id = 'StockId';
            }else{
                $id = 'id';
            }
            if ($request->status == 0) {
                $model::where($id, $request->id)->update([
                    'status' => 1,
                ]);
                Alert::success('تم التفعيل بنجاح', $request->name)->autoClose(15000);
            } else {
                $model::where($id, $request->id)->update([
                    'status' => 0,
                ]);
                Alert::success('تم التعطيل بنجاح', $request->name,)->autoClose(15000);
            }
            return redirect()->back();
        } catch (\Throwable $th) {
            Alert::error('هنالك خطأ', $th->getMessage())->autoClose(15000);
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    function transferfromoldData(){


        $boxordersanalyses = Boxordersanalyse::all();
        $ids= [1,2,4,5,6,7,8,9,10,11,12,13,14,16,17,18,20,21,22,23,24,26,28,29,30,31,32,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,
                63,64,65,67,68,69,70,71,72,73,74,75,76,77,78,79,83,86,87,88,89,92,93,95,96,98,102,103,105,107,108,109,111,114,117,118,119,121,122,123,125,126,127,129,130,131,132,133,134,135,
                139,140,141,142,145,147,148,149,150,152,154,155,156,157,159,160,161,165,166,167,168,169,172,173,174,175,176,177,178,180,182,183,185,188,189,190,194,195,197,198];


        foreach ($boxordersanalyses as  $boxordersanalyse) {
            switch ($boxordersanalyse->evaluation) {
                case 1:
                    $evaluation = 2;
                    break;
                case 2:
                    $evaluation = 1;
                    break;

                default:
                    $evaluation = null;
                    break;
            }
            foreach ($ids as $key => $id) {
                $boxorders = Boxorder::where(['id' => $id,'empno' => $boxordersanalyse->empno])->update([
                    /* 'aprovalacc' => $evaluation,
                    'aprovalaccdate' => $boxordersanalyse->created_at,
                    'empacc' => 11402,
                    'aprovalmgr' => $evaluation,
                    'aprovalmgrdate' => $boxordersanalyse->created_at,
                    'empmgr' => $boxordersanalyse->lastUser ?EmpNoByUserid($boxordersanalyse->lastUser): null, */
                    'signemp' => $evaluation,
                    'signempdate' => $boxordersanalyse->created_at,
                    'emp' => $boxordersanalyse->empno,
                ]);
            }
            /* $boxorders = Boxorder::where(['id' => $boxordersanalyse->boxorders_id,'empno' => $boxordersanalyse->empno])->update([
                'aprovalacc' => $evaluation,
                'aprovalaccdate' => $boxordersanalyse->created_at,
                'empacc' => 11402,
                'aprovalmgr' => $evaluation,
                'aprovalmgrdate' => $boxordersanalyse->created_at,
                'empmgr' => $boxordersanalyse->lastUser ?EmpNoByUserid($boxordersanalyse->lastUser): null,
                'signemp' => $boxordersanalyse->,
                'signempdate' => $boxordersanalyse->,
                'emp' => $boxordersanalyse->,
            ]); */
        }
        return "Ok";
        /* $savings = DB::select('SELECT id, empid,signature,
        SUBSTRING(signature, 60) new FROM oldportal.savings where signature like ?',
        ['%http://portal.wamy.org/wamyportal/public/storage/Signature/%']);

        foreach ($savings as $key => $saving) {
            DB::update('update oldportal.savings set signature = ? where id = ? and empid = ?',[$saving->new,$saving->id, $saving->empid]);
        }
        return "Ok"; */
    }

    public function getPeriodajax()
    {
        $banks = Installmentperiod::where('status',1)->pluck('id','name');
        return json_encode($banks);
    }
}
