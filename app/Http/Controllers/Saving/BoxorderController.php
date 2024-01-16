<?php

namespace App\Http\Controllers\Saving;

use App\Http\Controllers\Controller;
use App\Models\Approval;
use App\Models\Employee;
use App\Models\Employeefinancial;
use App\Models\Saving\Saving;
use App\Models\Saving\Orders;
use App\Models\Saving\Orders\Boxorder;
use App\Models\Saving\Orders\Boxorderstypes;
use App\Models\Saving\Orders\Withdraw;
use App\Models\User;
use App\Notifications\Saving\AddOrder;
use App\Notifications\Saving\AprovalAccnt;
use App\Notifications\Saving\Aprovalsponsor;
use App\Notifications\Saving\OrdersNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Notification;

class BoxorderController extends Controller
{
    protected $savings;
    protected $boxorders;

    public function __construct(Boxorder $boxorders,Saving $savings)
    {
        $this->savings = $savings;
        $this->boxorders = $boxorders;
    }

    public function index()
    {
        /* تقديم طلب خدمة جديد */
        try {
            $oldBox2 = $this->boxorders::where('empno',EmpNo())->WhereIn('statusid',[1,2,3])->get();
            if (count($oldBox2) >= 2){
                $msg = "عفواً لديك أكثر من طلب لم يعتمد بعد";
                Alert::error('هنالك خطأ', $msg)->autoClose(15000);
                return view('alert.warning',compact('msg'));
            }
            $datas = Employee::with('financials')->where('empno',EmpNo())->get();
            return view('Saving.Order.new', compact('datas'));
            /* $savings = $this->savings::with('employee')->where('empno','!=',EmpNo())->ORDERBY('empno')->get('empno','employee.name');
            $boxorderstypes =  Boxorderstypes::where('status',1)->get(['id','name']);
            $datas = Employee::where('empno',EmpNo())->get();
            $hr   = Employeefinancial::where([['empno',EmpNo()],['type','hr']])->get();
            $box  = Employeefinancial::where([['empno',EmpNo()],['type','box']])->get();
            $oldBox = $this->boxorders::where('empno',EmpNo())->pluck('statusid')->last();
            $id = $this->boxorders::where('empno', EmpNo())->pluck('id')->last();
            $deleted_at = $this->boxorders::where('empno',EmpNo())->pluck('deleted_at');


            if (is_null($oldBox) || $oldBox == 3 || $oldBox == 4) {
                if (count($box) == 0) {
                    $month = Carbon::now()->locale("ar_SA")->translatedFormat("F");
                    $msg = 'الرجاء مراجعة شؤون الموظفين لعمل إحتساب لراتب شهر  '.$month;
                    return view('alert.warning',compact('msg'));
                }else{
                    return view('Saving.Order.newOrder', compact('oldBox','datas','savings','boxorderstypes','hr','box'));
                }
            }else{
                return view('Saving.Order.newOrder', compact('oldBox','datas','savings','boxorderstypes','hr','box'));
            } */
        }
        catch (\Throwable $th) {
            return redirect()->back()->withErrors(['erorr' => $th->getMessage()]);
        }
    }

    public function create()
    {
        $guarantees = $this->boxorders::with('emporder','ordertyp')->where('sponsor', EmpNo())->orderBy('id', 'desc')->get();
        return view('Saving.Order.sponsor',compact('guarantees'));
    }

    public function store(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'empno' => 'required',
                'orderTyp' => 'required',
                'installmentPeriod' => 'required',
                'finalRate' => 'required',
                'purchasingValue' => 'required',
                'orderdesc' => 'required',
                /* 'signature' => 'required|mimes:jpeg,png,jpg', */
            ], [
                'empno.required' => 'الرجاء مراجعة بياناتك',
                'orderTyp.required' => 'الرجاء تحديد نوع الطلب',
                'installmentPeriod.required' => 'عفواً لم تقم بتحديد مدة التقسيط',
                'finalRate.required' => 'الرجاء مراجعة المدخلات لتحديد النسبة',
                'purchasingValue.required' => 'عفواً لم تقم بإدخال القيمة الشرائية',
                'orderdesc.required' => 'عفواً لم تقم بإدخال وصف الطلب',
                /* 'signature.required' => 'لايوجد لديك توقيع الرجاء قم بإرفاقه',
                'signature.mimes' => 'صيغة المرفق يجب ان تكون    jpeg , png , jpg', */
            ]);
            if ($validate->fails()) {
                return back()->withErrors($validate->errors())->withInput();
            }
            $ordertypname = Boxorderstypes::where('id',$request->orderTyp)->pluck('name')->first();
            /* $oldBox = $this->boxorders::where('empno',EmpNo())->pluck('orderTyp')->last(); */
            $oldBox = $this->boxorders::where(['empno' => EmpNo(),'orderTyp' =>$request->orderTyp ])->WhereIn('statusid',[1,2])->get();
            /* if ($oldBox == $request->orderTyp) { */
            if (count($oldBox) > 0) {
                $msg = "لديك طلب سابق من نفس نوع " .$ordertypname;
                Alert::error('هنالك خطأ', $msg)->autoClose(15000);
                return redirect()->back()->withErrors(['error' => $msg ]);
            } else {
                if ($request->finalRate > 60) {
                    $msg = 'إجمالي نسبة الاستقطاع من الراتب إعلي من الحد المسموح به يجب تخفيض القيمة الشرائية';
                    Alert::error('هنالك خطأ', $msg)->autoClose(15000);
                    return redirect()->back()->withErrors(['error' => $msg]);
                }
                if ($request->deductionsBox == 0) {
                    $msg = 'الرجاء مراجعة شؤون الموظفين للتأكد من خصم القسط الشهري للصندوق';
                    Alert::error('هنالك خطأ', $msg)->autoClose(15000);
                    return redirect()->back()->withErrors(['error' => $msg]);
                }
                if($request->orderTyp == 1){
                    if($request->purchasingValue > 30000){
                        $msg = 'يجيب ان لايزيد المبلغ عن 30000 ريال';
                        Alert::error('هنالك خطأ', $msg)->autoClose(15000);
                        return redirect()->back()->withErrors(['error' => $msg]);
                    }
                }
                /* if ($request->hasFile('signature')) {
                    $validate = Validator::make($request->all(), [
                        'signature' => 'mimes:jpeg,png,jpg',
                    ], [
                        'signature.mimes' => 'صيغة التوقيع يجب ان تكون    jpeg , png , jpg',
                    ]);
                    if ($validate->fails()) {
                        return back()->withErrors($validate->errors())->withInput();
                    }
                    $signaturefile = time() . '-' . $request->signature->getClientOriginalName();
                    $request->signature->move(public_path('assets\MyImages\Signature'), $signaturefile);
                    User::where('empno',$request->empno)->update([
                        'signature' => $signaturefile,
                    ]);
                } */

                $boxorders = new Boxorder();
                $boxorders->empno = EmpNo();
                $boxorders->orderTyp = $request->orderTyp;
                $boxorders->installmentPeriod = $request->installmentPeriod;
                $boxorders->rate = $request->finalRate;
                $boxorders->hr = $request->deductionsHr;
                $boxorders->box = $request->deductionsBox;

                $boxorders->purchasingValue = $request->purchasingValue;
                $boxorders->orderdesc = $request->orderdesc;
                if($request->sponsor){
                    $boxorders->sponsor = $request->sponsor;
                }
                $boxorders->statusid = 1;
                $boxorders->userEntry = UserId();
                $boxorders->save();

                $nextuser = $request->sponsor ? $request->sponsor: 11402;
                $user = User::whereIn('empno',[$nextuser])->get();
                Notification::send($user, new AddOrder($boxorders->id,EmpNo(),$request->sponsor));
                Alert::success('تم حفظ بيانات الطلب بالرقم  '.$boxorders->id)->autoClose(15000);
                return redirect()->route('orders.show',$boxorders->id);
                /* return redirect()->route('orders.edit',$boxorders->id); */
            }



        } catch (\Throwable $th) {
            Alert::error('هنالك خطأ', $th->getMessage())->autoClose(15000);
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function show($boxorder)
    {
        try {
                $orders = $this->boxorders::with('ordertyp:id,name','sponsororder:empno,name','orderstatus:id,name')->orderBy('id', 'desc')
                    ->get(['id','empno','sponsor','orderTyp','installmentPeriod','purchasingValue','orderdesc','statusid']);
                $withdraws = Withdraw::with('wtype:id,name','emp:empno,name')->orderBy('id', 'desc')->get();
                return view('Saving.Order.serviceorders',compact('orders','withdraws'));
            } catch (\Throwable $th) {
                return redirect()->back()->withErrors(['errors'=> $th->getMessage()]);
            }
    }

    public function getorder(Request $request)
    {
        $empno = $this->boxorders::where('id',$request->orderid)->pluck('empno');
        $datas = Employee::where('empno',$empno)->get();
        $boxorders = $this->boxorders::with('ordertyp:id,name','sponsororder:empno,name','orderstatus:id,name')->where('id',$request->orderid)->get();
        $boxorderstypes =  Boxorderstypes::where('status',1)->get(['id','name']);
        $savings = $this->savings::with('employee')->where('empno','!=',EmpNo())->ORDERBY('empno')->get('empno','employee.name');
        switch ($request->type) {
            case 1:
                    $checknotifn =  DB::table('notifications')->where(['type' => 'App\Notifications\Saving\Aprovalsponsor','notifiable_id' => UserId()])->get();
                    if ($checknotifn) {
                        DB::table('notifications')->where(['type' => 'App\Notifications\Saving\Aprovalsponsor','notifiable_id' => UserId()])->update(['read_at' => now()]);
                    }
                    if ($boxorders) {
                        return view('Saving.Order.status.new',compact('datas','boxorders','boxorderstypes','savings'));
                        /* displayorder */

                    }else{
                        $msg = 'عفواً لايوجد لديك طلب سابق';
                        return view('alert.warning',compact('msg'));
                    }
                break;
            case 2:
                    if ($boxorders) {
                        return view('Saving.Order.status.displayorder',compact('datas','boxorders','boxorderstypes','savings'));
                        /*  */

                    }else{
                        $msg = 'عفواً لايوجد لديك طلب سابق';
                        return view('alert.warning',compact('msg'));
                    }
                break;
        }
    }
    public function edit($boxorder)
    {
        /* تعديل طلب خدمة قبل الكفالة والتحليل */
        try {
            /* return */ $boxorders = $this->boxorders::with('emporder:empno,name,department,section,mobile,nationality,cardid,salary','ordertyp:id,name','period:id,name','sponsororder:empno,name')
            ->where('id',$boxorder)->get(['id','empno','orderTyp','installmentPeriod','rate','hr','box','purchasingValue','orderdesc','sponsor','statusid']);

            foreach (owner('Saving\Orders\Boxorder',$boxorder) as $key => $value) {
                if ($value->empno != EmpNo() || $value->userEntry != UserId()) {
                    $msg = 'تعديل الطلب متاح لصاحبه فقط';
                    Alert::error('هنالك خطأ', $msg)->autoClose(15000);
                    return redirect()->back()->withErrors(['error' => $msg]);
                }else{
                    return view('Saving.Order.edit.editorder', compact('boxorders','boxorder'));
                }
            }

        }
        catch (\Throwable $th) {
            return redirect()->back()->withErrors(['erorr' => $th->getMessage()]);
        }
    }

    public function update(Request $request,$typ)
    {
        try {
            switch ($typ) {
                case 1:  /* قرار الكافل */
                    $id = $request->id ? $request->id : $request->rjid;
                    $empno = $request->empno ? $request->empno : $request->rjempno;
                    $aprovalsponsor = $request->aprovalsponsor ? $request->aprovalsponsor : $request->rjaprovalsponsor;
                    $statusid = $request->statusid ? $request->statusid : $request->rjstatusid;

                    $this->boxorders::where(['id' => $id,'empno' => $empno])->update([
                        'aprovalsponsor' => $aprovalsponsor,
                        'statusid' => $statusid,
                        'aprovalspodate' => Carbon::now(),
                    ]);
                    $aproval = Approval::where('id',$aprovalsponsor)->pluck('name')->first();
                    DB::table('notifications')->where(['type' => 'App\Notifications\Saving\AddOrder','notifiable_id' => UserId()])->update(['read_at' => now()]);
                    $user = User::whereIn('empno',['11402',$empno])->get();
                    Notification::send($user, new Aprovalsponsor($id,$empno,EmpNo(),$aprovalsponsor));
                    Alert::success('تم '.$aproval.' الكفالة بنجاح')->autoClose(15000);
                    return redirect()->back();
                    break;
                case 2:  /* تعديل الطلب من صاحبه */
                    /* return $request; */
                    /* return $request->statusid."@".$request->empno."@".EmpNo(); */
                    if ($request->statusid == 1 && $request->empno == EmpNo()) {
                        if ($request->finalRate > 60) {
                            $msg = 'إجمالي نسبة الاستقطاع من الراتب إعلي من الحد المسموح به يجب تخفيض القيمة الشرائية';
                            Alert::error('هنالك خطأ', $msg)->autoClose(15000);
                            return redirect()->back()->withErrors(['error' => $msg]);
                        }
                        if ($request->deductionsBox == 0) {
                            $msg = 'الرجاء مراجعة شؤون الموظفين للتأكد من خصم القسط الشهري للصندوق';
                            Alert::error('هنالك خطأ', $msg)->autoClose(15000);
                            return redirect()->back()->withErrors(['error' => $msg]);
                        }
                        if($request->orderTyp == 1){
                            if($request->purchasingValue > 30000){
                                $msg = 'يجيب ان لايزيد المبلغ عن 30000 ريال';
                                Alert::error('هنالك خطأ', $msg)->autoClose(15000);
                                return redirect()->back()->withErrors(['error' => $msg]);
                            }
                        }
                        /* if ($request->hasFile('signature')) {
                            $validate = Validator::make($request->all(), [
                                'signature' => 'mimes:jpeg,png,jpg',
                            ], [
                                'signature.mimes' => 'صيغة التوقيع يجب ان تكون    jpeg , png , jpg',
                            ]);
                            if ($validate->fails()) {
                                return back()->withErrors($validate->errors())->withInput();
                            }
                            $signaturefile = time() . '-' . $request->signature->getClientOriginalName();
                            $request->signature->move(public_path('assets\MyImages\Signature'), $signaturefile);
                            User::where('empno',$request->empno)->update([
                                'signature' => $signaturefile,
                            ]);
                        } */
                        $this->boxorders::where(['id' => $request->orderid,'empno' => $request->empno])->update([
                            'rate' => $request->finalRate,
                            'orderTyp' => $request->orderTyp,
                            'installmentPeriod' => $request->installmentPeriod,
                            'purchasingValue' => $request->purchasingValue,
                            'orderdesc' => $request->orderdesc,
                            'sponsor' => $request->sponsor ? $request->sponsor : NULL,
                        ]);

                        $sponsorno = $this->boxorders::where(['id' => $request->orderid,'empno' => $request->empno])->pluck('sponsor')->first();
                        $userid = User::where('empno',$sponsorno)->pluck('id')->first();
                        $checknotifn =  DB::table('notifications')->where(['type' => 'App\Notifications\Saving\AddOrder','notifiable_id' => $userid])->get();
                        if ($checknotifn) {
                            DB::table('notifications')->where(['type' => 'App\Notifications\Saving\AddOrder','notifiable_id' => $userid])->update(['read_at' => now()]);
                        }

                        $nextuser = $request->sponsor ? $request->sponsor: 11402;
                        $user = User::whereIn('empno',[$nextuser])->get();
                        Notification::send($user, new AddOrder($request->id,EmpNo(),$request->sponsor));
                        Alert::success('تم تعديل طلب بالرقم '.$request->orderid.'  بنجاح')->autoClose(15000);
                    } else {
                        Alert::error('عفواً هذا الطلب لا يمكنك التعديل عليه')->autoClose(15000);
                    }
                    return redirect()->route('orders.show',1);
                    break;
                case 3:  /* رفض الطلب */
                    /* return $request; */
                    $this->boxorders::where(['id' => $request->order_id,'empno' => $request->empno])->update([
                        'aprovalacc' => 1,
                        'aprovalaccdate' => Carbon::now(),
                        'empacc' => EmpNo(),
                        'statusid' => 5,
                    ]);

                    $nextuser = $request->empno ? $request->empno : 11402;
                    $user = User::whereIn('empno',[$nextuser])->get();

                    Notification::send($user, new AprovalAccnt($request->order_id,EmpNo(),$request->empno,5));
                    Alert::success('تم رفض طلب بالرقم '.$request->orderid.'  بنجاح')->autoClose(15000);
                    return redirect()->route('orders.show',1);
                    break;
                default:
                    return "Ok";
                    break;
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['errors'=> $th->getMessage()]);
        }
    }

    public function destroy($boxorder)
    {
        return $boxorder;
    }
    public function destroyorder(Request $request)
    {
        try {
            $statusid = $this->boxorders::where(['id' => $request->id,'empno' => $request->empno])->pluck('statusid')->first();
            if ($statusid == 1) {
                $this->boxorders::where(['id' => $request->id,'empno' => $request->empno])->update([
                    'deleted_at' => Carbon::now() ,
                ]);
                Alert::success('تم حذف طلب بالرقم '.$request->id.'  بنجاح')->autoClose(15000);
            }else{
                Alert::error('لا يمكن حذف هذا الطلب')->autoClose(15000);
            }

            return redirect()->route('orders.show',$request->id);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['errors'=> $th->getMessage()]);
        }
    }
}
