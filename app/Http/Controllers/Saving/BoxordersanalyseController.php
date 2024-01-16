<?php

namespace App\Http\Controllers\Saving;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Employeefinancial;
use App\Models\Invoice;
use App\Models\Saving\Boxbalance;
use App\Models\Saving\Orders\Boxinvoice;
use App\Models\Saving\Orders\Boxorder;
use App\Models\Saving\Orders\Boxorderguarantee;
use App\Models\Saving\Orders\Boxordersanalyse;
use App\Models\Saving\Saving;
use App\Models\User;
use App\Notifications\Saving\Aprovalaccount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class BoxordersanalyseController extends Controller
{
    protected $boxorders;
    protected $boanalyses;

    public function __construct(Boxordersanalyse $boanalyses ,Boxorder $boxorders)
    {
        $this->boanalyses = $boanalyses;
        $this->boxorders = $boxorders;
    }

    public function index()
    {
        try {
            $orders = $this->boxorders::with('emporder','emporder.financials','saveing.Savings','ordertyp:id,name','sponsororder:empno,name','orderstatus:id,name')->orderBy('id', 'desc')->get();
            return view('Saving.Order.analysis',compact('orders'));

        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['errors'=> $th->getMessage()]);
        }
    }

    public function create()
    {
        $orders = $this->boxorders::with('emporder','emporder:empno,name','ordertyp:id,name','analyse:id,boxorders_id,evaluation,reson','sponsororder:empno,name','orderstatus:id,name')
        /* ->whereIn('id',[20,22,24,39,46,54,60,64]) */
        ->orderBy('id', 'desc')->get(['id','empno','orderdesc','orderTyp','installmentPeriod','purchasingValue','aprovalmgr','aprovalacc','statusid']);
        $aprovals = active('Approval',NULL,['id','name']);
        return view('Saving.Order.aprovalorder',compact('orders','aprovals'));
    }


    public function store(Request $request)
    {
        $empremiumbox = (int)$request->empremiumbox;
        /* return var_dump($empbox); */
        $valdmsg = 'عفواُ الرجاء التاكد من ';
        try {
            $validate = Validator::make($request->all(), [
                'boxorders_id' => 'required |integer|unique:boxordersanalyses',
                'empno' => 'required |integer',
                'purchasingValue' => 'required',
                'empsalary' => 'required',
                /* 'empremiumBox' => 'required', */
                'empendService' => 'required',
                'empbalancebox' => 'required',
                'emptotalGuarantees' => 'required',
                'empdebtFurniture' => 'required',
                'empdebtCar' => 'required',
                'empanothSponosr' => 'required',
                'totalCommitmentEmp' => 'required',
                'guaranteesAvailableEmp' => 'required',
                'totalGuaranteesAll' => 'required',
                'totalCommitmentAll' => 'required',
                'guaranteesAvailableAll' => 'required',
                'purchasingValueGurnt' => 'required',
                'evaluation' => 'required',
                /* 'signature' => 'required|mimes:jpeg,png,jpg', */
            ], [
                'boxorders_id.required' => $valdmsg.'رقم الطلب',
                'boxorders_id.unique' => 'تم تحليل هذا الطلب مسبقاً',
                'empno.required' => $valdmsg.'صاحب الطلب',
                'purchasingValue.required' => $valdmsg.'القيمة الشرائية',
                'empsalary.required' => $valdmsg.'راتب صاحب الطلب',
                /* 'empremiumBox.required' => $valdmsg.'قسط الإشتراك لصاحب الطلب', */
                'empendService.required' => $valdmsg.'نهاية الخدمة',
                'empbalancebox.required' => $valdmsg.'رصيد صندوق الإدخار',
                'emptotalGuarantees.required' => $valdmsg.'إجمالي الضمانات',
                'empdebtFurniture.required' => $valdmsg.'مديونية أجهزة واثاث',
                'empdebtCar.required' => $valdmsg.'مديونية السيارات',
                'empanothSponosr.required' => $valdmsg.'مبلغ كفالة موظف آخر',
                'totalCommitmentEmp.required' => $valdmsg.'إجمالي الإلتزامات',
                'guaranteesAvailableEmp.required' => $valdmsg.'الضمانات المتاحة',
                'totalGuaranteesAll.required' => $valdmsg.'إجمالي الضمانات',
                'totalCommitmentAll.required' => $valdmsg.'إجمالي الإلتزامات',
                'guaranteesAvailableAll.required' => $valdmsg.'الضمانات المتاحة',
                'purchasingValueGurnt.required' => $valdmsg.'مبلغ الضمان المطلوب',
                'evaluation.required' => $valdmsg.'التقييم',

                /* 'signature.required' => 'لايوجد لديك توقيع الرجاء قم بإرفاقه',
                'signature.mimes' => 'صيغة المرفق يجب ان تكون    jpeg , png , jpg', */
            ]);
            if ($validate->fails()) {
                return back()->withErrors($validate->errors())->withInput();
            }

            if ($empremiumbox < 0 || !$empremiumbox) {
                return back()->withErrors($valdmsg.'قسط الإشتراك لصاحب الطلب')->withInput();
            }
            if($request->evaluation == 1){
                if(!$request->approvedGuarantees){
                    return back()->withErrors('الرجاء إختيار نوع الضمانات المعتمدة')->withInput();
                }
            }
            if($request->guaranteesAvailableAll < $request->purchasingValueGurnt ){
                return back()->withErrors('الضمانات المتاحة أصغر من المبلغ المطلوب')->withInput();
            }
            /* return $request; */
            if ($request->sprAvilb == 0) {
                $boanalyses = new Boxordersanalyse();
                $boanalyses->boxorders_id = $request->boxorders_id;
                $boanalyses->empno = $request->empno;
                $boanalyses->purchasingValue = $request->purchasingValue;
                $boanalyses->empsalary = $request->empsalary;
                $boanalyses->empremiumBox = $empremiumbox /* $request->empremiumBox */;
                $boanalyses->empendService = $request->empendService;
                $boanalyses->empbalancebox = $request->empbalancebox;
                $boanalyses->emptotalGuarantees = $request->emptotalGuarantees;
                $boanalyses->empdebtFurniture = $request->empdebtFurniture;
                $boanalyses->empdebtCar = $request->empdebtCar;
                $boanalyses->empanothSponosr = $request->empanothSponosr;
                $boanalyses->totalCommitmentEmp = $request->totalCommitmentEmp;
                $boanalyses->guaranteesAvailableEmp = $request->guaranteesAvailableEmp;

                $boanalyses->totalGuaranteesAll = $request->totalGuaranteesAll;
                $boanalyses->totalCommitmentAll = $request->totalCommitmentAll;
                $boanalyses->guaranteesAvailableAll = $request->guaranteesAvailableAll;
                $boanalyses->purchasingValueGurnt = $request->purchasingValueGurnt;
                $boanalyses->evaluation = $request->evaluation;
                $boanalyses->reson = $request->reson;
                $boanalyses->userEntry = UserId();
                $boanalyses->status = 1;
                $boanalyses->save();

            } else {
                $boanalyses = new Boxordersanalyse();
                $boanalyses->boxorders_id = $request->boxorders_id;
                $boanalyses->empno = $request->empno;
                $boanalyses->purchasingValue = $request->purchasingValue;
                $boanalyses->empsalary = $request->empsalary;
                $boanalyses->empremiumBox = $empremiumbox /* $request->empremiumBox */;
                $boanalyses->empendService = $request->empendService;
                $boanalyses->empbalancebox = $request->empbalancebox;
                $boanalyses->emptotalGuarantees = $request->emptotalGuarantees;
                $boanalyses->empdebtFurniture = $request->empdebtFurniture;
                $boanalyses->empdebtCar = $request->empdebtCar;
                $boanalyses->empanothSponosr = $request->empanothSponosr;
                $boanalyses->totalCommitmentEmp = $request->totalCommitmentEmp;
                $boanalyses->guaranteesAvailableEmp = $request->guaranteesAvailableEmp;
                $boanalyses->sprno = $request->sprno;
                $boanalyses->sprsalary = $request->sprsalary;
                $boanalyses->sprpremiumBox = $request->sprpremiumBox;
                $boanalyses->sprendService = $request->sprendService;
                $boanalyses->sprbalancebox = $request->sprbalancebox;
                $boanalyses->totalGuaranteesSpr = $request->totalGuaranteesSpr;
                $boanalyses->sprdebtFurniture = $request->sprdebtFurniture;
                $boanalyses->sprdebtCar = $request->sprdebtCar;
                $boanalyses->spranothSponosr = $request->spranothSponosr;
                $boanalyses->totalCommitmentSpr = $request->totalCommitmentSpr;
                $boanalyses->guaranteesAvailableSpr = $request->guaranteesAvailableSpr;
                $boanalyses->totalGuaranteesAll = $request->totalGuaranteesAll;
                $boanalyses->totalCommitmentAll = $request->totalCommitmentAll;
                $boanalyses->guaranteesAvailableAll = $request->guaranteesAvailableAll;
                $boanalyses->purchasingValueGurnt = $request->purchasingValueGurnt;
                $boanalyses->evaluation = $request->evaluation;
                $boanalyses->reson = $request->reson;
                $boanalyses->userEntry = UserId();
                $boanalyses->status = 1;
                $boanalyses->save();
            }

            if ($request->approvedGuarantees) {
                foreach ($request->approvedGuarantees as $key => $value) {
                    DB::insert('insert into boanalyse_guarantee_pivots (analyse_id,guarantee_id) values (?, ?)', [$boanalyses->id, $value]);
                }
            }

            $this->boxorders::where(['id' => $request->boxorders_id,'empno'=>$request->empno,'orderTyp'=>$request->ordertypid])->update([
                'purchasingValue' => $request->purchasingValue,
                'statusid' => $request->evaluation == 1 ? 4 : 5,
                'aprovalacc' => $request->evaluation == 1 ? 2 : 1,
                'aprovalaccdate' => Carbon::now() ,
                'empacc' => EmpNo(),
            ]);
            /* $checknotifn =  DB::table('notifications')->where(['type' => 'App\Notifications\Saving\Aprovalsponsor','notifiable_id' => UserId()])->get();
            if ($checknotifn) {
                DB::table('notifications')->where(['type' => 'App\Notifications\Saving\Aprovalsponsor','notifiable_id' => UserId()])->update(['read_at' => now()]);
            } */
            $user = User::whereIn('empno',[$request->empno])->get();
            $sprno = $request->sprno ? $request->sprno : 0;
            Notification::send($user, new Aprovalaccount($request->boxorders_id,EmpNo(),$sprno,4));
            Alert::success('تم تحليل بيانات الطلب بالرقم  '.$request->boxorders_id)->autoClose(15000);
            return redirect()->route('boanalyses.index');
        }catch (\Throwable $th) {
            return redirect()->back()->withErrors(['errors'=> $th->getMessage()]);
        }
    }


    public function show($boxorder)
    {
        /* عرض التحليل المالي */
        try {

            if(EmpNo() == 11829 || EmpNo() == 11402){
                /* صاحب الطلب */
                $emporder = $this->boxorders::where('id',$boxorder)->pluck('empno')->first(); /* رقم صاحب الطلب */
                $statusid = $this->boxorders::where('id',$boxorder)->pluck('statusid')->first();
                $empdatas = Employee::where('empno',$emporder)->get();
                $empbox = Employeefinancial::where(['empno' => $emporder,'type' => 'box'])->pluck('amnt')->first();
                $empendService = Employeefinancial::where(['empno' => $emporder,'type' => 'endService'])->pluck('amnt')->first();

                $orders = $this->boxorders::with('emporder:empno,name,salary','saveing.Savings','ordertyp:id,name','sponsororder:empno,name','orderstatus:id,name')->where('id',$boxorder)->get();

                $guarantees = active('Saving\Orders\Boxorderguarantee',null,['id','name']);

                $sponsororder = $this->boxorders::where('id',$boxorder)->pluck('sponsor')->first(); /* رقم كافل الطلب */
                $sponsordatas = Employee::where('empno',$sponsororder)->get();
                $sponsorbox = Saving::where(['empno' => $sponsororder])->pluck('premium')->first();
                $sponsorendService = Employeefinancial::where(['empno' => $sponsororder,'type' => 'endService'])->pluck('amnt')->first();

                return view('Saving.Order.orderanalysis',compact(['boxorder','statusid','empdatas','empbox','empendService','orders','guarantees','sponsordatas','sponsorbox','sponsorendService']));


            }else{
                return 'الصفحة لا تعمل لاغراض الصيانة';
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['errors'=> $th->getMessage()]);
        }
    }

    /*  اللجنة  - committee*/
    public function contractOrder($id,$typ,$m)
    {
        switch ($typ) {
            case 1:
                /* Create Contract */
                $empid = $this->boxorders::where('id',$id)->pluck('empno')->first(); /* رقم صاحب الطلب */
                $datas = Employee::where('empno',$empid)->get();
                $order = $this->boxorders::where('id',$id)->first();
                $orderData = $this->boxorders::with('analyse','ordertyp:id,name','period:id,name')->where('id',$id)->get();
                return view('Saving.Order.contractOrder',compact('datas','order','orderData','id'));
                break;
            case 2:
                /* Edit Contract */
                $orderData = $this->boxorders::with('emporder','analyse','ordertyp:id,name','period:id,name','invoices:boxorders_id,invoice')->where('id',$id)->get();

                return view('Saving.Order.edit.editcontractOrder',compact('orderData','id'));

                break;
            case 3:
                /* Sign Contract Emp , Acc and Mangr*/
                if ($m == 3) {
                    foreach (owner('Saving\Orders\Boxorder',$id) as $key => $value) {
                        if ($value->userEntry !=  UserId() && $value->empno != EmpNo()) {
                            Alert::error("عفواً لايمكن توقيع الطلب الا من صاحبه")->autoClose(15000);
                            return redirect()->back();
                        }
                    }
                }
                $orderData = $this->boxorders::with('emporder:empno,name,department,section,mobile,nationality,cardid','analyse:boxorders_id,empno,empsalary,empdebtFurniture,empdebtFurniture,empdebtCar,empbalancebox,empendService,dateFirstInstallment,dateLastInstallment,lastPurchasingValue,salesPrice,monthlyInstallment'
                    ,'ordertyp:id,name','period:id,name','invoices:boxorders_id,invoice')
                    ->where('id',$id)->get();
                return view('Saving.Order.edit.signContractEmp',compact('orderData','id','m'));
                break;

            default:

                break;
        }
    }

    public function updatecontractOrder(Request $request,$typ)
    {
        try {
                switch ($typ) {
                    case 1:
                        /* Create Contract */
                        $validate = Validator::make($request->all(), [
                            'lastPurchasingValue' => 'required',
                            'dateFirstInstallment' => 'required',
                            /* 'dateLastInstallment' => 'required', */
                        ], [
                            'lastPurchasingValue.required' => 'لابد من إدخال القيمة الشرائية الفعلية',
                            'dateFirstInstallment.required' => 'لابد من تحديد تاريخ القسط الاول',
                            /* 'dateLastInstallment.required' => 'لابد من تحديد تاريخ القسط الأخير', */
                        ]);

                        if ($validate->fails()) {
                            return back()->withErrors($validate->errors())->withInput();
                        }
                        $y = Carbon::parse($request->dateFirstInstallment)->addYears($request->installmentPeriod)->format('Y');
                        $m = Carbon::parse($request->dateFirstInstallment)->subMonths(1)->format('m');
                        $d = Carbon::parse($request->dateFirstInstallment)->subDay(1)->format('d');
                        $datelast = $y."-".$m."-".$d;
                        /* Carbon::parse($datelast)->format('Y/m/d'); */
                        /* return $request->dateFirstInstallment."@@@@".$datelast; */
                        $newDate = date('Y-m-d', strtotime($request->dateFirstInstallment. ' + '.$request->installmentPeriod.' years'));
                        if ($request->hasFile('invoices')) {
                            $validate = Validator::make($request->all(), [
                                'invoice' => 'mimes:pdf',
                            ], [
                                'invoice.mimes' => 'صيغة الفاتورة يجب ان تكون    pdf',
                            ]);
                            if ($validate->fails()) {
                                return back()->withErrors($validate->errors())->withInput();
                            }
                            foreach ($request->invoices as  $value) {
                                $invoicefile = time() . '-' . $value->getClientOriginalName();
                                $value->move(public_path('assets\MyImages\Invoices\\'.$request->orderID), $invoicefile);

                                $boxinvoices = new Boxinvoice();
                                $boxinvoices->boxorders_id = $request->orderID;
                                $boxinvoices->invoice = $invoicefile;
                                $boxinvoices->userEntry = UserId();
                                $boxinvoices->save();
                            }

                        }else{
                            $msg = 'لابد من إرفاق الفاتورة';
                            Alert::error('هنالك خطأ', $msg)->autoClose(15000);
                            return redirect()->back()->withErrors(['error' => $msg]);
                        }
                        $msg = 'تم إنشاء عقد للطلب رقم ';
                        $this->boanalyses::where(['boxorders_id' => $request->orderID,'empno' => $request->empno])->update([
                            'lastPurchasingValue' => $request->lastPurchasingValue,
                            'salesPrice' => $request->salesPrice,
                            'monthlyInstallment' => $request->monthlyInstallment,
                            'dateFirstInstallment' => $request->dateFirstInstallment,
                            'dateLastInstallment' => $datelast,
                            'lastUser' => Auth()->user()->id,
                        ]);
                        $this->boxorders::where(['id'=> $request->orderID,'empno' => $request->empno])->update([
                            'statusid' => 6
                        ]);
                        Alert::success($msg.'  '.$request->orderID)->autoClose(15000);
                        return redirect()->route('boanalyses.create');
                        break;
                    case 2:
                        /* Edit Contract */
                        $validate = Validator::make($request->all(), [
                            'lastPurchasingValue' => 'required',
                            'dateFirstInstallment' => 'required',
                            /* 'dateLastInstallment' => 'required', */
                        ], [
                            'lastPurchasingValue.required' => 'لابد من إدخال القيمة الشرائية الفعلية',
                            'dateFirstInstallment.required' => 'لابد من تحديد تاريخ القسط الاول',
                            /* 'dateLastInstallment.required' => 'لابد من تحديد تاريخ القسط الأخير', */
                        ]);

                        if ($validate->fails()) {
                            return back()->withErrors($validate->errors())->withInput();
                        }
                        $y = Carbon::parse($request->dateFirstInstallment)->addYears($request->installmentPeriod)->format('Y');
                        $m = Carbon::parse($request->dateFirstInstallment)->subMonths(1)->format('m');
                        $d = Carbon::parse($request->dateFirstInstallment)->subDay(1)->format('d');
                        $datelast = $y."-".$m."-".$d;
                        /* Carbon::parse($datelast)->format('Y/m/d'); */
                        /* return $request->dateFirstInstallment."@@@@".$datelast; */
                        $newDate = date('Y-m-d', strtotime($request->dateFirstInstallment. ' + '.$request->installmentPeriod.' years'));
                        if ($request->hasFile('newinvoices')) {
                            $validate = Validator::make($request->all(), [
                                'invoice' => 'mimes:pdf',
                            ], [
                                'invoice.mimes' => 'صيغة الفاتورة يجب ان تكون    pdf',
                            ]);
                            if ($validate->fails()) {
                                return back()->withErrors($validate->errors())->withInput();
                            }
                            foreach ($request->newinvoices as  $value) {
                                $invoicefile = time() . '-' . $value->getClientOriginalName();
                                $value->move(public_path('assets\MyImages\Invoices\\'.$request->orderID), $invoicefile);
                                $boxinvoices = new Boxinvoice();
                                $boxinvoices->boxorders_id = $request->orderID;
                                $boxinvoices->invoice = $invoicefile;
                                $boxinvoices->userEntry = UserId();
                                $boxinvoices->save();
                            }
                        }
                        $msg = 'تم تعديل عقد الطلب رقم ';

                        $this->boanalyses::where(['boxorders_id' => $request->orderID,'empno' => $request->empno])->update([
                            'lastPurchasingValue' => $request->lastPurchasingValue,
                            'salesPrice' => $request->salesPrice,
                            'monthlyInstallment' => $request->monthlyInstallment,
                            'dateFirstInstallment' => $request->dateFirstInstallment,
                            'dateLastInstallment' => $datelast,
                            'lastUser' => Auth()->user()->id,
                        ]);
                        $this->boxorders::where(['id'=> $request->orderID,'empno' => $request->empno])->update([
                            'statusid' => 6
                        ]);
                        Alert::success($msg.'  '.$request->orderID)->autoClose(15000);
                        return redirect()->route('boanalyses.create');
                        break;
                    case 3:
                        /* Sign Contract Emp and Acc*/

                        $validate = Validator::make($request->all(), [
                            'signcontract' => 'required',
                        ], [
                            'signcontract.required' => 'الموافقة علي التوقيع',
                        ]);

                        if ($validate->fails()) {
                            return back()->withErrors($validate->errors())->withInput();
                        }

                        if ($request->signcontract == 0) {
                            return back()->withErrors('الرجاء إتخاذ قرار التوقيع')->withInput();
                        }

                        switch ($request->m) {
                            case 3:
                                $this->boxorders::where(['id'=> $request->orderID,'empno' => $request->empno])->update([
                                    'statusid' => $request->signcontract == 1? 10 : 7,
                                    'signemp' =>  $request->signcontract,
                                    'signempdate' =>  Carbon::now() ,
                                    'emp' => EmpNo(),
                                ]);
                                $msg = 'تم توقيع العقد رقم ( '.$request->orderID."".') من جانب صاحب الطلب ';
                                $request->signcontract == 1? "Alert::error(".$msg.")->autoClose(15000)" :"Alert::success(".$msg.")->autoClose(15000)";
                                return redirect()->route('orders.show',1);
                                break;
                            case 4:
                                $this->boxorders::where(['id'=> $request->orderID,'empno' => $request->empno])->update([
                                    'statusid' => $request->signcontract == 1? 10 : 8,
                                    'aprovalacc' =>  $request->signcontract,
                                    'aprovalaccdate' =>  Carbon::now() ,
                                    'empacc' => EmpNo(),
                                ]);
                                $msg = 'تم توقيع العقد رقم ( '.$request->orderID."".') من جانب المحاسب ';
                                $request->signcontract == 1? "Alert::error(".$msg.")->autoClose(15000)" :"Alert::success(".$msg.")->autoClose(15000)";
                                return redirect()->route('boanalyses.index');
                                break;
                            case 5:
                                $this->boxorders::where(['id'=> $request->orderID,'empno' => $request->empno])->update([
                                    'statusid' => $request->signcontract == 1? 10 : 9,
                                    'aprovalmgr' =>  $request->signcontract,
                                    'aprovalmgrdate' =>  Carbon::now() ,
                                    'empmgr' => EmpNo(),
                                ]);
                                $msg = 'تم توقيع العقد رقم ( '.$request->orderID."".') من جانب رئيس الصندوق ';
                                $request->signcontract == 1? "Alert::error(".$msg.")->autoClose(15000)" :"Alert::success(".$msg.")->autoClose(15000)";
                                return redirect()->route('boanalyses.create');
                                break;
                            default:
                                # code...
                                break;
                        }

                        /* if($request->signcontract == 1){
                            $this->boxorders::where(['id'=> $request->orderID,'empno' => $request->empno])->update([
                                'statusid' => 10,
                                'signemp' =>  $request->signcontract,
                                'signempdate' =>  Carbon::now() ,
                                'emp' => EmpNo(),
                            ]);
                            Alert::error('تم رفض الطلب')->autoClose(15000);
                            switch ($request->m) {
                                case 4:
                                    $go = 'boanalyses.index';
                                    break;
                                case 5:
                                    $go = 'boanalyses.create';
                                    break;

                                default:
                                    $go = 'orders.show,1';
                                    break;

                            }
                            return redirect()->route($go);

                        }else{

                        } */
                        break;

                    default:
                        # code...
                        break;
                }

        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['errors'=> $th->getMessage()]);
        }

    }
    public function printcontractOrder($id)
    {
        try {
            $orderData = $this->boxorders::with('emporder:empno,name,nationality,cardid,department,section,salary,mobile','sponsororder:empno,name'
                ,'analyse:boxorders_id,empno,empbalancebox,empendService,purchasingValue,monthlyInstallment,dateFirstInstallment,dateLastInstallment,salesPrice,sprendService,sprbalancebox,totalGuaranteesAll,totalCommitmentAll,guaranteesAvailableAll'
                ,'empaccfun:empno,name','empmgrfun:empno,name','ordertyp:id,name','period:id,name')
                ->where('id',$id)->get();



            return view('Saving.Order.fcontractOrder',compact('orderData','id'/* ,'sponsorname','sponsorbox','sponsorendService' */));
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['errors'=> $th->getMessage()]);
        }

    }
    public function edit($boxordersanalyse)
    {
        /* return  */$orders = $this->boanalyses::with('emp:empno,name','order.orderTyp:id,name','spr:empno,name')->where('boxorders_id',$boxordersanalyse)->get();
        /* $orders = $this->boxorders::with('emporder:empno,name,salary','saveing.Savings','ordertyp:id,name','sponsororder:empno,name','orderstatus:id,name')->where('id',$boxorder)->get(); */
        $boxordersanalyseid = $this->boanalyses::where('boxorders_id',$boxordersanalyse)->pluck('id')->first();
        /* return */ $guarantees = DB::select('select p.analyse_id,p.guarantee_id,b.name FROM boanalyse_guarantee_pivots p,boxorderguarantees b WHERE p.guarantee_id = b.id and p.analyse_id = ?',[$boxordersanalyseid]);

        /* return $orders; */
        return view('Saving.Order.edit.editorderanalysis',compact('orders','guarantees','boxordersanalyse'));
        /* return view('Saving.Order.displayorderanalysis',compact('orders','guarantees','boxordersanalyse')); */

    }


    public function update(Request $request, $boxordersanalyse)
    {

        try {
            switch ($boxordersanalyse) {
                case 1:
                    if ($request->app == 1) {
                        $status = 5;
                    } elseif ($request->app == 2) {
                        $status = 6;
                    }
                    $this->boxorders::where(['id' => $request->id,'empno' => $request->empno])->update([
                        'aprovalmgr' => $request->app,
                        'aprovalmgrdate' => Carbon::now(),
                        'empmgr' => EmpNo(),
                        'statusid' => $status
                    ]);
                    /* $user = User::whereIn('empno',[$request->empno])->get();
                    $sprno = $request->sprno ? $request->sprno : 0;
                    Notification::send($user, new Aprovalaccount($request->boxorders_id,EmpNo(),$sprno,4)); */
                    Alert::success('تم إعتماد بيانات الطلب بالرقم  '.$request->id)->autoClose(15000);
                    return redirect()->back();
                    break;

                case 2:
                    /* تعديل التحليل */

                    if (OrderStatusid($request->boxorders_id) == 4 || OrderStatusid($request->boxorders_id) == 5) {
                        $empremiumbox = (int)$request->empremiumbox;
                        $valdmsg = 'عفواُ الرجاء التاكد من ';
                        $validate = Validator::make($request->all(), [
                            'boxorders_id' => 'required |integer',
                            'empno' => 'required |integer',
                            'purchasingValue' => 'required',
                            'empsalary' => 'required',
                            'empendService' => 'required',
                            'empbalancebox' => 'required',
                            'emptotalGuarantees' => 'required',
                            'empdebtFurniture' => 'required',
                            'empdebtCar' => 'required',
                            'empanothSponosr' => 'required',
                            'totalCommitmentEmp' => 'required',
                            'guaranteesAvailableEmp' => 'required',
                            'totalGuaranteesAll' => 'required',
                            'totalCommitmentAll' => 'required',
                            'guaranteesAvailableAll' => 'required',
                            'purchasingValueGurnt' => 'required',
                            'evaluation' => 'required',
                        ], [
                            'boxorders_id.required' => $valdmsg.'رقم الطلب',
                            /* 'boxorders_id.unique' => 'تم تحليل هذا الطلب مسبقاً', */
                            'empno.required' => $valdmsg.'صاحب الطلب',
                            'purchasingValue.required' => $valdmsg.'القيمة الشرائية',
                            'empsalary.required' => $valdmsg.'راتب صاحب الطلب',
                            'empendService.required' => $valdmsg.'نهاية الخدمة',
                            'empbalancebox.required' => $valdmsg.'رصيد صندوق الإدخار',
                            'emptotalGuarantees.required' => $valdmsg.'إجمالي الضمانات',
                            'empdebtFurniture.required' => $valdmsg.'مديونية أجهزة واثاث',
                            'empdebtCar.required' => $valdmsg.'مديونية السيارات',
                            'empanothSponosr.required' => $valdmsg.'مبلغ كفالة موظف آخر',
                            'totalCommitmentEmp.required' => $valdmsg.'إجمالي الإلتزامات',
                            'guaranteesAvailableEmp.required' => $valdmsg.'الضمانات المتاحة',
                            'totalGuaranteesAll.required' => $valdmsg.'إجمالي الضمانات',
                            'totalCommitmentAll.required' => $valdmsg.'إجمالي الإلتزامات',
                            'guaranteesAvailableAll.required' => $valdmsg.'الضمانات المتاحة',
                            'purchasingValueGurnt.required' => $valdmsg.'مبلغ الضمان المطلوب',
                            'evaluation.required' => $valdmsg.'التقييم',
                        ]);
                        if ($validate->fails()) {
                            return back()->withErrors($validate->errors())->withInput();
                        }

                        if ($empremiumbox < 0 || !$empremiumbox) {
                            return back()->withErrors($valdmsg.'قسط الإشتراك لصاحب الطلب')->withInput();
                        }
                        if($request->evaluation == 1){
                            if(!$request->approvedGuarantees){
                                return back()->withErrors('الرجاء إختيار نوع الضمانات المعتمدة')->withInput();
                            }
                        }
                        if($request->guaranteesAvailableAll < $request->purchasingValueGurnt ){
                            return back()->withErrors('الضمانات المتاحة أصغر من المبلغ المطلوب')->withInput();
                        }
                        if ($request->sprAvilb == 0) {
                            $this->boanalyses::where(['boxorders_id'=>$request->boxorders_id,'empno'=>$request->empno])->update([
                                'purchasingValue' => $request->purchasingValue,
                                'empsalary' => $request->empsalary,
                                'empremiumbox' => $request->empremiumbox,
                                'empendService' => $request->empendService,
                                'empbalancebox' => $request->empbalancebox,
                                'emptotalGuarantees' => $request->emptotalGuarantees,
                                'empdebtFurniture' => $request->empdebtFurniture,
                                'empdebtCar' => $request->empdebtCar,
                                'empanothSponosr' => $request->empanothSponosr,
                                'totalCommitmentEmp' => $request->totalCommitmentEmp,
                                'guaranteesAvailableEmp' => $request->guaranteesAvailableEmp,
                                'totalGuaranteesAll' => $request->totalGuaranteesAll,
                                'totalCommitmentAll' => $request->totalCommitmentAll,
                                'guaranteesAvailableAll' => $request->guaranteesAvailableAll,
                                'purchasingValueGurnt' => $request->purchasingValueGurnt,
                                'evaluation' => $request->evaluation,
                                'reson' => $request->reson,
                                'userEntry' => UserId(),
                            ]);

                        } else {
                            $this->boanalyses::where(['boxorders_id'=>$request->boxorders_id,'empno'=>$request->empno])->update([
                                'purchasingValue' => $request->purchasingValue,
                                'empsalary' => $request->empsalary,
                                'empremiumbox' => $request->empremiumbox,
                                'empendService' => $request->empendService,
                                'empbalancebox' => $request->empbalancebox,
                                'emptotalGuarantees' => $request->emptotalGuarantees,
                                'empdebtFurniture' => $request->empdebtFurniture,
                                'empdebtCar' => $request->empdebtCar,
                                'empanothSponosr' => $request->empanothSponosr,
                                'totalCommitmentEmp' => $request->totalCommitmentEmp,
                                'guaranteesAvailableEmp' => $request->guaranteesAvailableEmp,
                                'sprno' => $request->sprno,
                                'sprsalary' => $request->sprsalary,
                                'sprpremiumBox' => $request->sprpremiumBox,
                                'sprendService' => $request->sprendService,
                                'sprbalancebox' => $request->sprbalancebox,
                                'totalGuaranteesSpr' => $request->totalGuaranteesSpr,
                                'sprdebtFurniture' => $request->sprdebtFurniture,
                                'sprdebtCar' => $request->sprdebtCar,
                                'spranothSponosr' => $request->spranothSponosr,
                                'totalCommitmentSpr' => $request->totalCommitmentSpr,
                                'guaranteesAvailableSpr' => $request->guaranteesAvailableSpr,
                                'totalGuaranteesAll' => $request->totalGuaranteesAll,
                                'totalCommitmentAll' => $request->totalCommitmentAll,
                                'guaranteesAvailableAll' => $request->guaranteesAvailableAll,
                                'purchasingValueGurnt' => $request->purchasingValueGurnt,
                                'evaluation' => $request->evaluation,
                                'reson' => $request->reson,
                                'userEntry' => UserId(),
                            ]);
                        }
                        $boanalyseguarantes = DB::select('SELECT analyse_id,guarantee_id FROM boanalyse_guarantee_pivots where analyse_id = ?',[$request->boxorders_id]);

                        if ($request->approvedGuarantees) {
                            foreach ($boanalyseguarantes as $key => $boanalyseguarante) {
                                foreach ($request->approvedGuarantees as $key => $value) {
                                    if ($boanalyseguarante->guarantee_id != $value) {
                                        DB::table('boanalyse_guarantee_pivots')->where(['analyse_id' =>$request->boxorders_id,
                                        'guarantee_id' => $value])->delete();
                                    }
                                }
                            }

                        }

                        $this->boxorders::where(['id' => $request->boxorders_id,'empno'=>$request->empno,'orderTyp'=>$request->ordertypid])->update([
                            'purchasingValue' => $request->purchasingValue,
                            'statusid' => $request->evaluation == 1 ? 4 : 5,
                            'aprovalacc' => $request->evaluation == 1 ? 2 : 1,
                            'aprovalaccdate' => Carbon::now() ,
                            'empacc' => EmpNo(),
                        ]);

                        Alert::success('تم تعديل تحليل بيانات الطلب بالرقم  '.$request->boxorders_id)->autoClose(15000);
                        return redirect()->route('boanalyses.index');
                    } else {
                        Alert::error('حالة الطلب لا تسمح بالتعديل عليه')->autoClose(15000);
                        return redirect()->route('boanalyses.index');
                    }
                    break;
                default:
                    # code...
                    break;
            }

        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['errors'=> $th->getMessage()]);
        }
    }


    public function destroy($boxordersanalyse)
    {
        //
    }

    function updatecontract($request,$typ) {
        return $typ;

    }
}
