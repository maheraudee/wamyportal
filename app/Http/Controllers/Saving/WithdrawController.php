<?php

namespace App\Http\Controllers\Saving;

use App\Http\Controllers\Controller;
use App\Models\Employeefinancial;
use App\Models\Saving\Orders\Boxorder;
use App\Models\Saving\Orders\Withdraw;
use App\Models\Saving\Orders\Withdrawtype;
use App\Models\Saving\Saving;
use App\Models\User;
use App\Models\Saving\Boxbalance;
use App\Models\Saving\Boxbalancestran;
use App\Notifications\Saving\AddWithdraw;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class WithdrawController extends Controller
{
    protected $savings;
    protected $boxorders;
    protected $withdraw;
    protected $withdrawtype;
    public function __construct(Withdraw $withdraw,Withdrawtype $withdrawtype, Boxorder $boxorders,Saving $savings)
    {
        $this->withdraw = $withdraw;
        $this->withdrawtype = $withdrawtype;
        $this->savings = $savings;
        $this->boxorders = $boxorders;
    }

    public function index()
    {
        $savings = $savings = $this->savings::with('employee')->where('empno',EmpNo())->ORDERBY('empno')->get('empno','employee.name');
        $hr   = Employeefinancial::where(['empno' => EmpNo(),'type' => 'hr'])->pluck('amnt');
        $box  = Employeefinancial::where(['empno' => EmpNo(),'type' =>'box'])->pluck('amnt');
        $endService  = Employeefinancial::where(['empno' => EmpNo(),'type' =>'endService'])->pluck('amnt');
        $signature = $this->savings::where('empno',EmpNo())->pluck('signature');
        $withdrawtypes = $this->withdrawtype::where('status',1)->get();
        return view('Saving.Order.withdraw.withdraw',compact('withdrawtypes','savings','hr','box','endService','signature'));

    }

    public function create()
    {
        $withdraws = $this->withdraw::with('emp:empno,name,department,section','wtype:id,name')->get();
        $aprovals = active('Approval',NULL,['id','name']);
        return view('Saving.Order.withdraw.withdrawall',compact('withdraws','aprovals'));
    }

    public function store(Request $request)
    {
        /* return $request; */
        try {

            switch ($request->witype) {
                case 1:
                    $validate = Validator::make($request->all(), [
                        'empno' => 'required',
                        'witype' => 'required',
                        'amnt' => 'required',
                    ], [
                        'empno.required' => 'الرجاء مراجعة بياناتك',
                        'orderTyp.required' => 'الرجاء تحديد نوع الطلب',
                        'amnt.required' => 'عفواً لم تقم بتحديد المبلغ',
                    ]);
                    break;
                default:
                    $validate = Validator::make($request->all(), [
                        'empno' => 'required',
                        'witype' => 'required',
                    ], [
                        'empno.required' => 'الرجاء مراجعة بياناتك',
                        'orderTyp.required' => 'الرجاء تحديد نوع الطلب',
                    ]);
                    break;
            }

            if ($request->witype == 'الرجاء إختيار نوع الطلب') {
                return back()->withErrors('الرجاء إختيار نوع الطلب')->withInput();
            }

            if ($validate->fails()) {
                return back()->withErrors($validate->errors())->withInput();
            }

            $withdraw = new Withdraw();
            $withdraw->empno = EmpNo();
            $withdraw->witype = $request->witype;
            $withdraw->amnt = $request->amnt ? $request->amnt : NULL;
            $withdraw->hr = $request->hr ? $request->hr : 0;
            $withdraw->box = $request->box ? $request->box : 0;
            $withdraw->endService = $request->endService;
            $withdraw->debtFurniture = $request->debtFurniture ? $request->debtFurniture : 0;
            $withdraw->debtCar = $request->debtCar ? $request->debtCar : 0;
            $withdraw->anothSponosr = $request->anothSponosr ? $request->anothSponosr : 0;
            $withdraw->comitbankamt = $request->comitbankamt ? $request->comitbankamt : 0;
            $withdraw->comitanthoramt = $request->comitanthoramt ? $request->comitanthoramt : 0;
            $withdraw->agree = $request->agree ? 1 : 0;
            $withdraw->status = 1;
            $withdraw->userEntry = UserId();
            $withdraw->save();

            $user = User::whereIn('empno',[11402])->get();
            Notification::send($user, new AddWithdraw($withdraw->id,EmpNo()));

            Alert::success('تم حفظ بيانات الطلب بالرقم  '.$withdraw->id)->autoClose(15000);
            return redirect()->route('withdraws.show',$withdraw->id);

        } catch (\Throwable $th) {
            Alert::error('هنالك خطأ', $th->getMessage())->autoClose(15000);
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function show($withdraw)
    {
        $users = User::wherein('empno',[11402,11829])->pluck('empno');
        /* $signature = $signature = $this->savings::where('empno',EmpNo())->pluck('signature'); */
        $withdraws = $this->withdraw::with('emp:empno,name,department,section','wtype:id,name')->where(['id' => $withdraw])->get();
        $aprovals = active('Approval',NULL,['id','name']);
        if (EmpNo() != $users[0]) {
            foreach ($withdraws as $value) {
                $totalsum = $value->hr + $value->box + $value->outsite;
            }
            return view('Saving.Order.withdraw.displaywithdraw',compact('withdraws','totalsum'));
        }else{
            return view('Saving.Order.withdraw.analysiswithdraw',compact('withdraws','aprovals'));
        }
    }


    public function edit(Withdraw $withdraw)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Saving\Orders\Withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$withdraw)
    {
        /* return $request; */
        /*$this->withdraw::where(['id' => $request->withdrawid,'empno' => $request->empno])->get(); */
        try {
            return $withdraw;
            switch ($withdraw) {
                case 1:
                    $validate = Validator::make($request->all(), [
                        'acctext' => 'required',
                        'amnt' => 'required',
                        'endService' => 'required',
                    ], [
                        'acctext.required' => 'الرجاء إدخال التقرير' ,
                        'amnt.required' => 'الرجاء تحديد المبلغ',
                        'endService.required' => 'الرجاء تحديد مبلغ نهاية الخدمة',
                    ]);

                    if ($validate->fails()) {
                        return back()->withErrors($validate->errors())->withInput();
                    }

                    $this->withdraw::where(['id' => $request->withdrawid,'empno' => $request->empno,'witype' => $request->witypeid])->update([
                        'amnt' => $request->amnt,
                        'hr' => $request->hr ? $request->hr : 0,
                        'box' => $request->box ? $request->box : 0,
                        'endService' => $request->endService,
                        'debtFurniture' => $request->debtFurniture ? $request->debtFurniture : 0,
                        'debtCar' => $request->debtCar ? $request->debtCar : 0,
                        'anothSponosr' => $request->anothSponosr ? $request->anothSponosr : 0,
                        'comitbankamt' => $request->comitbankamt ? $request->comitbankamt : 0,
                        'comitanthoramt' => $request->comitanthoramt ? $request->comitanthoramt : 0,
                        'acctext' => $request->acctext,
                        'aprovalacct' => $request->aprovalacct,
                        'aprovalaccdate' => Carbon::now(),
                        'empacc' => EmpNo()
                    ]);
                    /* return $request->balancewital; */
                    /* if ($request->balancewital) {
                    } */
                    $typetran  = 'خصم مبلغ لطلب سحب بالرقم '.$request->withdrawid;
                    $balanceid = Boxbalance::where(['empno' => $request->empno,'status' => 1,'deleted_at' => NULL])->pluck('id')->first();
                    $balance = Boxbalance::where(['empno' => $request->empno,'status' => 1,'deleted_at' => NULL])->pluck('balance')->first();
                    Boxbalance::where(['empno' => $request->empno])->update([
                        'balance' => $balance - $request->amnt,
                    ]);

                    $boxbalancestrans = new Boxbalancestran();
                    $boxbalancestrans->balanceid  = $balanceid;
                    $boxbalancestrans->empno  = $request->empno;
                    $boxbalancestrans->balance  = $balance - $request->amnt;
                    $boxbalancestrans->typetran  = $typetran;
                    $boxbalancestrans->userEntry  = UserId();
                    $boxbalancestrans->save();


                    break;
                case 2:
                    if ($request->app == 0) {
                        return back()->withErrors('الرجاء تحديد القرار قبل الحفظ')->withInput();
                    } else {
                        $this->withdraw::where(['id' => $request->id,'empno' => $request->empno])->update([
                            'aprovalmgr' => $request->app,
                            'aprovalmgrdate' => Carbon::now(),
                            'empmgr' => EmpNo()
                        ]);

                        if ($request->witype == 3) {
                            $this->savings::where('empno',$request->empno)->update(['deleted_at' => Carbon::now()]);
                            Alert::success('تم إلغاء إشتراك الموظف  ' .EmpName($request->empno))->autoClose(15000);
                        }
                    }
                    break;
            }
            /* Alert::success('تم حفظ بيانات الطلب بالرقم  '.$withdraw->id)->autoClose(15000);
            return redirect()->route('withdraws.show',$withdraw->id); */

            /* $user = User::whereIn('empno',[11402])->get();
            Notification::send($user, new AddWithdraw($withdraw->id,EmpNo())); */

            Alert::success('تم إعتماد طلب '.$request->witype)->autoClose(15000);

            DB::table('notifications')->where(['type' => 'App\Notifications\Saving\AddWithdraw','notifiable_id' => UserId()])->update(['read_at' => now()]);
            return redirect()->route('withdraws.create');

        } catch (\Throwable $th) {
            Alert::error('هنالك خطأ', $th->getMessage())->autoClose(15000);
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Saving\Orders\Withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function destroy(Withdraw $withdraw)
    {
        //
    }
}
