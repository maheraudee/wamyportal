<?php

namespace App\Http\Controllers;

use App\Models\Saving\Boxbalance;
use App\Models\Saving\Boxbalancestran;
use App\Models\Saving\Saving;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BoxbalanceController extends Controller
{
    protected $boxbalances;
    protected $boxbalancestrans;

    public function __construct(Boxbalance $boxbalances,Boxbalancestran $boxbalancestrans)
    {
        $this->boxbalances = $boxbalances;
        $this->boxbalancestrans = $boxbalancestrans;
    }
    public function index()
    {
        try {

            $boxbalances = $this->boxbalances::with('employee:empno,name,salary')->get();
            return view('Saving.Balance.opbalance',compact('boxbalances'));
        }
        catch (\Throwable $th) {
            return redirect()->back()->withErrors(['erorr' => $th->getMessage()]);
        }
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show($boxbalance)
    {
        try {
            $boxbalancestrans = $this->boxbalancestrans::with('employee:empno,name,salary')->where('empno',$boxbalance)->orderBy('id', 'DESC')->get();
            return view('Saving.Balance.balancetrans',compact('boxbalancestrans'));
        }
        catch (\Throwable $th) {
            return redirect()->back()->withErrors(['erorr' => $th->getMessage()]);
        }
    }

    public function edit(Boxbalance $boxbalance)
    {
        //
    }

    public function update(Request $request,$boxbalance)
    {
        /* return $request; */
        try {

            $boxbalances = $this->boxbalances::where(['status' => 1,'deleted_at' => NULL])->get(['id','empno','premium','balance']);
            $month = Carbon::now()->locale("ar_SA")->translatedFormat("F");/* Carbon::now()->format('m'); */
            $msg = NULL;
            switch ($boxbalance) {
                case 1:
                    $this->boxbalances::where(['id' => $request->id,'empno' => $request->empno])->update([
                        'balance' => $request->balance,
                    ]);
                    $balance = $request->balance;
                    $typetran = 'رصيد إفتتاحي';
                    $msg = 'تم تعديل رصيد  '.$request->empname.' بنجاح';

                    break;
                case 2:
                    /* إضافة قسط لموظف */

                    $lastDate =  $this->boxbalancestrans::where(['empno' => $request->empno])->where('typetran','LIKE','%إضافة قسط لشهر%')->pluck('created_at')->last();
                    if ($lastDate) {
                        if ($lastDate->format('m-Y') == Carbon::now()->format('m-Y')) {
                            Alert::error('تم خصم شهر '.$lastDate->locale("ar_SA")->translatedFormat("F")."  مسبقاً")->autoClose(15000);
                            return redirect()->back();
                        } else {
                            $savings = Saving::where(['status' => 1,'deleted_at' => NULL,'empno'=>$request->empno])->pluck('premium')->first();
                            $this->boxbalances::where(['id' => $request->id,'empno' => $request->empno])->update([
                                'balance' => $request->balance + $savings,
                            ]);
                            $balance = $request->balance + $savings;
                            $typetran = 'إضافة قسط لشهر '.$month;
                            $msg = 'إضافة قسط للموظف   '.$request->empname.' بنجاح';
                        }
                    } else{
                        $lastDateB =  $this->boxbalances::where(['empno' => $request->empno])->pluck('created_at')->last();
                        if ($lastDateB->format('m-Y') == Carbon::now()->format('m-Y')) {
                            Alert::error('تم ')->autoClose(15000);
                            return redirect()->back();
                        } else {
                            $savings = Saving::where(['status' => 1,'deleted_at' => NULL,'empno'=>$request->empno])->pluck('premium')->first();
                            $this->boxbalances::where(['id' => $request->id,'empno' => $request->empno])->update([
                                'balance' => $request->balance + $savings,
                            ]);
                            $balance = $request->balance + $savings;
                            $typetran = 'إضافة قسط لشهر '.$month;
                            $msg = 'إضافة قسط للموظف   '.$request->empname.' بنجاح';
                        }
                    }





                    break;
                case 3:
                    /* إضافة قسط لكل الموظفين */
                    $savings = Saving::where(['status' => 1,'deleted_at' => NULL])->get(['id','empno','premium','contribute']);
                    $typetran = 'إضافة قسط لشهر '.$month;
                    if (count($savings) == count($boxbalances)) {
                        foreach ($boxbalances as $key => $boxbalanc) {
                            $lastDate =  $this->boxbalancestrans::where(['empno' => $boxbalanc->empno,'typetran' => 'إضافة قسط لشهر '.$month])->pluck('created_at')->last();
                            if ($lastDate) {
                                if ($lastDate->format('m-Y') != Carbon::now()->format('m-Y')) {
                                    $savings = Saving::where(['status' => 1,'deleted_at' => NULL,'empno'=>$boxbalanc->empno])->pluck('premium')->first();
                                    $this->boxbalances::where(['empno' => $boxbalanc->empno])->update([
                                        'balance' => $boxbalanc->balance + $savings,
                                    ]);
                                    $balance = $boxbalanc->balance + $savings;
                                    $typetran = 'إضافة قسط لشهر '.$month;

                                    $balance = $boxbalanc->premium + $boxbalanc->balance;
                                    $boxbalancestrans = new Boxbalancestran();
                                    $boxbalancestrans->balanceid  = $boxbalanc->id;
                                    $boxbalancestrans->empno  = $boxbalanc->empno;
                                    $boxbalancestrans->balance  = $balance;
                                    $boxbalancestrans->typetran  = $typetran;
                                    $boxbalancestrans->userEntry  = UserId();
                                    $boxbalancestrans->save();
                                    $msg = $msg = 'إضافة أقساط شهر   '.$month.' لجميع المشتركين ';
                                }
                            } else{
                                $lastDateB =  $this->boxbalances::where(['empno' => $boxbalanc->empno])->pluck('created_at')->last();
                                if ($lastDateB->format('m-Y') != Carbon::now()->format('m-Y')) {
                                    $savings = Saving::where(['status' => 1,'deleted_at' => NULL,'empno'=>$boxbalanc->empno])->pluck('premium')->first();
                                    $this->boxbalances::where(['empno' => $boxbalanc->empno])->update([
                                        'balance' => $boxbalanc->balance + $savings,
                                    ]);
                                    $balance = $boxbalanc->balance + $savings;
                                    $typetran = 'إضافة قسط لشهر '.$month;
                                    $balance = $boxbalanc->premium + $boxbalanc->balance;
                                    $boxbalancestrans = new Boxbalancestran();
                                    $boxbalancestrans->balanceid  = $boxbalanc->id;
                                    $boxbalancestrans->empno  = $boxbalanc->empno;
                                    $boxbalancestrans->balance  = $balance;
                                    $boxbalancestrans->typetran  = $typetran;
                                    $boxbalancestrans->userEntry  = UserId();
                                    $boxbalancestrans->save();
                                    $msg = $msg = 'إضافة أقساط شهر   '.$month.' لجميع المشتركين ';
                                }
                            }

                        }

                        /* return $lastDate =  $this->boxbalancestrans::where('typetran' , 'إضافة قسط لشهر '.$month)->pluck('created_at');
                        $lastDateB =  $this->boxbalances::pluck('created_at');*/

                    }else{
                        return "No Equal";
                    }
                    break;
            }

            if ($boxbalance != 3) {
                $boxbalancestrans = new Boxbalancestran();
                $boxbalancestrans->balanceid  = $request->id;
                $boxbalancestrans->empno  = $request->empno;
                $boxbalancestrans->balance  = $balance;
                $boxbalancestrans->typetran  = $typetran;
                $boxbalancestrans->userEntry  = UserId();
                $boxbalancestrans->save();
            }
            Alert::success($msg)->autoClose(15000);
            return redirect()->back();
        }
        catch (\Throwable $th) {
            return redirect()->back()->withErrors(['erorr' => $th->getMessage()]);
        }
    }

    public function destroy(Boxbalance $boxbalance)
    {
        //
    }
}
