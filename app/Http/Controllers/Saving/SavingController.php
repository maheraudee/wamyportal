<?php

namespace App\Http\Controllers\Saving;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Employee;
use App\Models\Saving\Boxbalance;
use App\Models\Saving\Saving;
use App\Models\Saving\Savingstran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SavingController extends Controller
{

    protected $savings;

    public function __construct(Saving $savings)
    {
        $this->savings = $savings;
    }

    public function index()
    {
        $savings = $this->savings::where('empno',Auth()->user()->empno)->get();
        if (count($savings) == 1) {
            Alert::error('عفواً انت مسجل في صندوق الإدخار من قبل')->autoClose(15000);
            return redirect()->route('dashboard');
        }else{
            return view('Saving.Box.slate');
        }
    }


    public function create()
    {
        $savings = $this->savings::where('empno',Auth()->user()->empno)->get();
        if (count($savings) == 1) {
            Alert::error('عفواً انت مسجل في صندوق الإدخار من قبل')->autoClose(15000);
            return redirect()->route('dashboard');
        }else{
            $employees = Employee::where('empno',Auth()->user()->empno)->get();
            return view('Saving.Box.registration',compact('employees'));
        }
    }

    public function store(Request $request)
    {
        try {
            $date = Carbon::now()->format('Y-m-d');
            /* return $request; */
            $validate = Validator::make($request->all(), [
                'empno' => 'required|unique:savings',
                'participationType' => 'required',
                'signature' => 'mimes:jpeg,png,jpg',
            ], [
                'empno.required' => 'الرجاء مراجعة بياناتك',
                'empno.unique' => 'هذه المستخدم مدخل من قبل',
                'participationType.required' => 'نوع الإشتراك مطلوب',
                'signature.mimes' => 'صيغة المرفق يجب ان تكون    jpeg , png , jpg',
            ]);
            if ($validate->fails()) {
                return back()->withErrors($validate->errors())->withInput();
            }

            $minamount = $request->salary * 0.5;
            $maxamount = $request->salary * 0.05;

            if ($request->premium < $maxamount) {
                $msg = 'يجب ان يكون المبلغ أكبر من 5% من إجمالي الراتب';
                Alert::error('خطأ', $msg)->autoClose(15000);
                return back()->withErrors(['error' => $msg]);
            }

            if ($request->premium > $minamount) {
                $msg = 'يجب ان يكون المبلغ أصغر من 50% من إجمالي الراتب';
                Alert::error('خطأ', $msg)->autoClose(15000);
                return back()->withErrors(['error' => $msg]);
            }
            if ($request->contributeselect == 2) {
                if ($request->contribute < 4999) {
                    $msg =  'في حالة المساهمة يشترط ان لا يقل المبلغ عن خمسة الآلآف ريال';
                    Alert::error('خطأ',$msg)->autoClose(15000);
                    return back()->withErrors(['error' => $msg]);
                }
            }
            if ($request->hasFile('signature')) {
                $filename = time() . '-' . $request->signature->getClientOriginalName();
                $request->signature->move(public_path('assets\MyImages\Signature'), $filename);
                User::where('empno',$request->empno)->update([
                    'signature' => $filename,
                ]);
                $this->savings::create([
                    'empno' => $request->empno,
                    'participationType' => $request->participationType,
                    'datePremium' => $date,
                    'premium' => $request->premium,
                    'contribute' => $request->contribute,
                    'userEntry' => UserId(),
                    'agree' => 1
                ]);
            } else {
                $this->savings::create([
                    'empno' => $request->empno,
                    'participationType' => $request->participationType,
                    'datePremium' => $date,
                    'premium' => $request->premium,
                    'contribute' => $request->contribute,
                    'userEntry' => UserId(),
                    'agree' => 1
                ]);

            }
            /* $user = $this->user::whereIn ('empid',['11829','11547'])->get(); */
            $savings = $this->savings::latest()->first();
            /* Notification::send($user, new RegisterBox($savings)); */
            Alert::success('تم حفظ بيناتك بنجاح')->autoClose(15000);
            return redirect()->route('savings.show',EmpNo());
        } catch (\Throwable $th) {
            Alert::error('هنالك خطأ', $th->getMessage())->autoClose(15000);
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function show($empno)
    {
        $savings = $this->savings::with('employee')->where('empno',$empno)->get();
        return view('Saving.Box.contract', compact('savings'));
    }


    public function edit($empno)
    {
        $savings = $this->savings::with('employee')->where(['empno' => $empno,'status' => 1])->get();
        if (count($savings) > 0) {
            return view('Saving.Box.update',compact('savings'));
        }else{
            Alert::error('الرجاء التسجيل في الصندوق ')->autoClose(15000);
            return redirect()->route('savings.index');
        }
    }

    public function update(Request $request,$saving)
    {
        try {
            /* return $saving; */
            /* let premium = document.getElementById('premium').value,
            sal = document.getElementById('salary').value,

            amount = sal * 0.5,
            amount2 = sal * 0.05;

            if (premium < amount2) {
                alert("يجب ان يكون المبلغ أكبر من 5% من إجمالي الراتب");
                return false;
            }
            if (premium > amount) {
                alert("يجب ان يكون المبلغ أصغر من 50% من إجمالي الراتب");
                return false;
            } */

            $myamount  = $request->salary * 0.5; /* 50% */
            $myamount2 = $request->salary * 0.05; /* 5% */

            if ($request->premium < $myamount2) {
                Alert::error('هنالك خطأ','يجب ان يكون المبلغ أكبر من 5% من إجمالي الراتب والمبلغ المقترح هو  '.$myamount2)->autoClose(15000);
                return back();
            } elseif($request->premium > $myamount) {
                Alert::error('هنالك خطأ','يجب ان يكون المبلغ أصغر من 50% من إجمالي الراتب والمبلغ المقترح هو  '.$myamount)->autoClose(15000);
                return back();
            }
            /* return $request; */
            if ($request->contribute >= 5000 || $request->contribute == 0) {
                switch ($saving) {
                    case 1: /* تحديث بيانات الإشتراك */
                        $savings = $this->savings::with('employee')->where('empno',$request->empno)->get();
                        foreach ($savings as $key => $saving) {
                            $savingid = $saving->id;
                            $premium = $saving->premium;
                            $contribute =  $saving->contribute;
                        }

                        if ($request->premium != $premium || $request->contribute != $contribute) {
                            $savingstrans = new Savingstran();
                            $savingstrans->savingid = $savingid;
                            $savingstrans->empno = $request->empno;
                            $savingstrans->premium = $premium;
                            $savingstrans->contribute = $contribute;
                            $savingstrans->typetran = 'تحديث بيانات الإشتراك';
                            $savingstrans->userEntry = UserId();
                            $savingstrans->save();

                            if ($request->hasFile('signature')) {
                                $filename = time() . '-' . $request->signature->getClientOriginalName();
                                $request->signature->move(public_path('assets\MyImages\Signature'), $filename);
                                User::where('empno',$request->empno)->update([
                                    'signature' => $filename,
                                ]);
                                $this->savings::where('empno',$request->empno)->update([
                                    'premium' => $request->premium,
                                    'contribute' => $request->contribute
                                ]);
                            }else {
                                $this->savings::where('empno',$request->empno)->update([
                                    'premium' => $request->premium,
                                    'contribute' => $request->contribute,
                                ]);
                            }
                            Boxbalance::where('empno',$request->empno)->update([
                                'premium' => $request->premium,
                            ]);
                            Alert::success('تم تحديث بيناتك بنجاح')->autoClose(15000);
                            return redirect()->route('savings.show',EmpNo());
                        }else{
                            Alert::error('لم تقم بتحديث بياناتك')->autoClose(15000);
                            return back();
                        }
                        break;
                    case 2:  /* تحديث مبلغ المساهمة */
                        /* return $request; */
                        $this->savings::where('empno',$request->empno)->update([
                            'contribute' => $request->contribute,
                        ]);
                        if ($request->contribute > 0) {
                            $msg = 'تم تحديث مبلغ المساهمة بنجاح';
                        } else {
                            $msg = 'لم يعد السيد/ '.$request->name.' مساهماً في صندوق الإدخار';
                        }

                        Alert::success($msg)->autoClose(15000);
                        return back();
                        break;
                }
            } else {
                Alert::error('هنالك خطأ','يجب ان يكون مبلغ المساهمة أكبر من 5000 ريال')->autoClose(15000);
                return redirect()->back();
            }


        } catch (\Throwable $th) {
            Alert::error('هنالك خطأ', $th->getMessage())->autoClose(15000);
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function destroy($saving)
    {
        try {
            $empno = $this->savings::where('id',$saving)->get('empno');

            $name = Employee::where('empno',$empno[0]['empno'])->pluck('name');
            $this->savings::where('id',$saving)->delete();
            $msg = 'تم إيقاف إشتراك السيد/  '.$name[0]. ' بنجاح';
            Alert::success($msg)->autoClose(15000);
            return redirect()->back();
        } catch (\Throwable $th) {
            Alert::error('هنالك خطأ', $th->getMessage())->autoClose(15000);
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function alltrans($empno)
    {
        return $infos = Employee::with('financials:empno,type,amnt','Savings:id,empno,premium,contribute,created_at','boxorderemps:id,empno,orderTyp,purchasingValue,statusid,created_at',
        'withdraws:id,empno,witype,amnt,aprovalacct,aprovalmgr,created_at','withdraws.wtype:id,name')
            ->where('empno',$empno)->get(['empno','name']);
            return view('Saving.Box.alltrans', compact('infos'));
    }
    public function showAll($m)
    {
        if (EmpNo() == 11829 || EmpNo() == 11402){
            $savings = $this->savings::with('employee')->get();
        }else{
            $savings = $this->savings::with('employee')->where('empno',EmpNo())->get();
        }

        return view('Saving.Box.subscribers', compact('savings'));
    }

    public function getcontractAll($m)
    {
        $savings = $this->savings::with('employee')->get();
        return view('Saving.Box.contractAll', compact('savings'));
    }
    public function getcontributors($m)
    {
        $savings = $this->savings::with('employee')->where('contribute','>',0)->get();
        return view('Saving.Box.contributors', compact('savings'));
    }
    public function getDownload($filename)
    {
        $file = public_path() . "/assets/MyImages/BoxSlate/" . $filename;
        return response()->download($file);
    }

    public function open_file($filename)
    {
        $file = public_path() . "/assets/MyImages/BoxSlate/" . $filename;
        return response()->file($file);
    }
}
