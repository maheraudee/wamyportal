<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Employeefinancial;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    protected $employees;
    protected $employeefinancial;

    public function __construct(Employee $employees,Employeefinancial $employeefinancial)
    {
        $this->employees = $employees;
        $this->employeefinancial = $employeefinancial;
    }

    public function index()
    {
        return view('BasicData.GetEmplyees');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

    }

    function storeEmp(){
        try {
            $emps = Http::post("10.1.10.7/wamyApi/public/api-v01/Get-EmployeesAll")->json();
            $empscount =  count($emps);
            /* $this->employees::truncate(); */
            for ($i=0; $i < count($emps); $i++) {
                $empNow = $this->employees::where('empno',$emps[$i]['emp_no'])->get();
                if(count($empNow) != 0)
                {
                    $this->employees::where('empno',$emps[$i]['emp_no'])->update([
                        'empno' => $emps[$i]['emp_no'],
                        'name' => $emps[$i]['emp_nm'],
                        'email' => $emps[$i]['e_mail'],
                        'salary' => $emps[$i]['total_sal'],
                        'section' => $emps[$i]['hirch_nm'],
                        'department' => $emps[$i]['hirchy_prnt_nm'],
                        'startdate' => $emps[$i]['start_date'],
                        'qualification' => $emps[$i]['qlfction_lst_nm'],
                        'job' => $emps[$i]['emp_job_nm'],
                        'mobile' => $emps[$i]['mobile_no'],
                        'cardid' => $emps[$i]['card_no'],
                        'nationality' => $emps[$i]['nat_nm'],
                        'status' => 1
                    ]);
                }else{
                    $this->employees::create([
                        'empno' => $emps[$i]['emp_no'],
                        'name' => $emps[$i]['emp_nm'],
                        'email' => $emps[$i]['e_mail'],
                        'salary' => $emps[$i]['total_sal'],
                        'section' => $emps[$i]['hirch_nm'],
                        'department' => $emps[$i]['hirchy_prnt_nm'],
                        'startdate' => $emps[$i]['start_date'],
                        'qualification' => $emps[$i]['qlfction_lst_nm'],
                        'job' => $emps[$i]['emp_job_nm'],
                        'mobile' => $emps[$i]['mobile_no'],
                        'cardid' => $emps[$i]['card_no'],
                        'nationality' => $emps[$i]['nat_nm'],
                        'status' => 1
                    ]);
                }
            }
            $msg = "تم تحديث بيانات عدد ".$empscount." موظف";
            Alert::success($msg)->autoClose(15000);
            return redirect()->route('employees.index');
        } catch (\Throwable $th) {
            Alert::error('هنالك خطأ', $th->getMessage())->autoClose(15000);
            return redirect()->back()->withErrors(['errors' => $th->getMessage()]);
        }
    }
    public function storeBox()
    {
        try {
            $year = Carbon::now()->format('Y');

            $month = Carbon::now()->format('m');

            $hr = Http::post('10.1.10.7/wamyApi/public/api-v01/Get-DeductionsHrAll/'.$year.'/'.$month)->json();

            $box  = Http::post('10.1.10.7/wamyApi/public/api-v01/Get-DeductionsBoxAll/'.$year.'/'.$month)->json();
            $endService  = Http::post("10.1.10.7/wamyApi/public/api-v01/Get-EndServiceAll")->json();

            /* return count($endService); */


            $this->employeefinancial::truncate();
            for ($i=0; $i < count($hr); $i++) {
                $hrNow = $this->employeefinancial::where([
                    ['empno','=',$hr[$i]['emp_no']],
                    ['type','=', 'hr']])->get();
                if (count($hrNow) != 0){
                    $this->employeefinancial::where([
                        ['empno','=',$hr[$i]['emp_no']],
                        ['type','=', 'hr']])->update([
                        'amnt' => $hr[$i]['amt'] ? $hr[$i]['amt'] : 0,
                        'userEntry' => 1
                    ]);
                }else{
                    $this->employeefinancial::create([
                        'type' => 'hr',
                        'empno' => $hr[$i]['emp_no'],
                        'amnt' => $hr[$i]['amt'] ? $hr[$i]['amt'] : 0,
                        'userEntry' => 1
                    ]);
                }
            }
            for ($i=0; $i < count($box); $i++) {
                $boxNow = $this->employeefinancial::where([
                    ['empno','=',$box[$i]['emp_no']],
                    ['type','=', 'box']])->get();
                if (count($boxNow) != 0){
                    $this->employeefinancial::where([
                        ['empno','=',$box[$i]['emp_no']],
                        ['type','=', 'box']])->update([
                        'amnt' => $box[$i]['amt'] ? $box[$i]['amt'] : 0,
                        'userEntry' => 1
                    ]);
                }else{
                    $this->employeefinancial::create([
                        'type' => 'box',
                        'empno' => $box[$i]['emp_no'],
                        'amnt' => $box[$i]['amt'] ? $box[$i]['amt'] : 0,
                        'userEntry' => 1
                    ]);
                }
            }
            for ($i=0; $i < count($endService); $i++) {
                $endServiceNow = $this->employeefinancial::where([
                    ['empno','=',$endService[$i]['emp_no']],
                    ['type','=', 'endService']])->get();
                if (count($endServiceNow) != 0){
                    $this->employeefinancial::where([
                        ['empno','=',$endService[$i]['emp_no']],
                        ['type','=', 'endService']])->update([
                        'amnt' => $endService[$i]['amt'] ? $endService[$i]['amt'] : 0,
                        'userEntry' => 1
                    ]);
                }else{
                    $this->employeefinancial::create([
                        'type' => 'endService',
                        'empno' => $endService[$i]['emp_no'],
                        'amnt' => $endService[$i]['amt'] ? $endService[$i]['amt'] : 0,
                        'userEntry' => 1
                    ]);
                }
            }

            $msg = "تم تحديث بيانات شهر ".$month;
            Alert::success($msg)->autoClose(15000);
            return redirect()->route('employees.index');
        } catch (\Throwable $th) {
            Alert::error('هنالك خطأ', $th->getMessage())->autoClose(15000);
            return redirect()->back()->withErrors(['errors' => $th->getMessage()]);
        }
    }

    function storeboxtemp(){
        DB::insert("INSERT INTO employeefinancials(userEntry,type,empno,amnt,created_at,updated_at)
        VALUES
                (1,'box',11001,'5000.00','2023-02-19 04:49:29','2023-02-19 04:49:29'),
                (1,'endService',11001,'963651.81','2023-02-19 04:49:24','2023-02-19 04:49:24'),
                (1,'hr',11084,'883.64','2023-02-19 04:49:23','2023-02-19 04:49:23'),
                (1,'endService',11084,'181893.33','2023-02-19 04:49:24','2023-02-19 04:49:24'),
                (1,'hr',11748,'631.90','2023-02-19 04:49:23','2023-02-19 04:49:23'),
                (1,'box',11748,'2000.00','2023-02-19 04:49:29','2023-02-19 04:49:29'),
                (1,'endService',11748,'55855.96','2023-02-19 04:49:26','2023-02-19 04:49:26'),
                (1,'hr',11950,'665.44','2023-02-19 04:49:23','2023-02-19 04:49:23'),
                (1,'endService',11950,'5305.73','2023-02-19 04:49:27','2023-02-19 04:49:27'),
                (1,'hr',11952,'665.44','2023-02-19 04:49:23','2023-02-19 04:49:23'),
                (1,'endService',11952,'4998.71','2023-02-19 04:49:27','2023-02-19 04:49:27'),
                (1,'hr',11960,'732.52','2023-02-19 04:49:23','2023-02-19 04:49:23'),
                (1,'hr',11975,'530.21','2023-02-19 04:49:23','2023-02-19 04:49:23'),
                (1,'hr',11980,'631.90','2023-02-19 04:49:23','2023-02-19 04:49:23'),
                (1,'hr',11987,'598.46','2023-02-19 04:49:23','2023-02-19 04:49:23'),
                (1,'hr',11988,'598.46','2023-02-19 04:49:23','2023-02-19 04:49:23'),
                (1,'hr',11992,'631.90','2023-02-19 04:49:23','2023-02-19 04:49:23'),
                (1,'hr',11996,'598.46','2023-02-19 04:49:23','2023-02-19 04:49:23'),
                (1,'hr',11998,'598.46','2023-02-19 04:49:23','2023-02-19 04:49:23'),
                (1,'hr',12003,'881.79','2023-02-19 04:49:23','2023-02-19 04:49:23'),
                (1,'hr',12004,'598.46','2023-02-19 04:49:23','2023-02-19 04:49:23'),
                (1,'hr',12005,'598.46','2023-02-19 04:49:23','2023-02-19 04:49:23'),
                (1,'hr',12014,'1119.40','2023-02-19 04:49:23','2023-02-19 04:49:23'),
                (1,'hr',12016,'598.46','2023-02-19 04:49:23','2023-02-19 04:49:23'),
                (1,'hr',12017,'598.46','2023-02-19 04:49:23','2023-02-19 04:49:23'),
                (1,'hr',12018,'598.46','2023-02-19 04:49:23','2023-02-19 04:49:23'),
                (1,'hr',12019,'631.90','2023-02-19 04:49:23','2023-02-19 04:49:23'),
                (1,'hr',12021,'598.46','2023-02-19 04:49:23','2023-02-19 04:49:23'),
                (1,'hr',12022,'598.46','2023-02-19 04:49:23','2023-02-19 04:49:23'),
                (1,'hr',12024,'598.46','2023-02-19 04:49:23','2023-02-19 04:49:23'),
                (1,'hr',12026,'548.44','2023-02-19 04:49:23','2023-02-19 04:49:23'),
                (1,'hr',12028,'548.44','2023-02-19 04:49:23','2023-02-19 04:49:23'),
                (1,'hr',11776,'500.00','2023-02-19 04:49:23','2023-02-19 04:49:24'),
                (1,'hr',11695,'700.83','2023-02-19 04:49:23','2023-02-19 04:49:23'),
                (1,'hr',11932,'1250.00','2023-02-19 04:49:23','2023-02-19 04:49:24'),
                (1,'hr',11994,'598.46','2023-02-19 04:49:24','2023-02-19 04:49:24'),
                (1,'hr',11857,'732.52','2023-02-19 04:49:24','2023-02-19 04:49:24'),
                (1,'hr',11941,'665.44','2023-02-19 04:49:24','2023-02-19 04:49:24'),
                (1,'hr',11923,'1101.17','2023-02-19 04:49:24','2023-02-19 04:49:24'),
                (1,'hr',11948,'585.00','2023-02-19 04:49:24','2023-02-19 04:49:24'),
                (1,'hr',11971,'665.44','2023-02-19 04:49:24','2023-02-19 04:49:24'),
                (1,'box',11829,'1350.00','2023-02-19 04:49:24','2023-02-19 04:49:24'),
                (1,'endService',11829,'15000.00','2023-02-19 04:49:24','2023-02-19 04:49:24'),
                (1,'hr',11829,'500.00','2023-02-19 04:49:24','2023-02-19 04:49:24'),
                (1,'endService',11513,'186778.78','2023-02-19 04:49:24','2023-02-19 04:49:24'),
                (1,'box',11513,'2000.00','2023-02-19 04:49:24','2023-02-19 04:49:24'),
                (1,'endService',11402,'80000.00','2023-02-19 04:49:24','2023-02-19 04:49:24')");
    }
    public function show(Employee $employee)
    {
        if ($employee->empno == EmpNo()) {
            return view('BasicData.profile',compact('employee'));
        } else {
            $msg = 'عفواً لايمكنك الإطلاع علي هذه البيانات';
            return view('alert.warning',compact('msg'));
        }


    }

    public function edit(Employee $employee)
    {
        //
    }


    public function update(Request $request, Employee $employee)
    {
        /* return $request; */
        /* تحديث الملف الشخصي */
        try {
            $validate = Validator::make($request->all(), [
                'name' => 'required',
                'mobile' => 'required|min:10|max:10',
            ], [
                'name.required' => 'بياناتك غير مكتملة',
                'mobile.required' => 'بياناتك غير مكتملة',
                'mobile.min' => 'رقم الجوال غير مكتملة',
                'mobile.max' => 'رقم الجوال يجب ان يكون 10 ارقام',
            ]);
            if ($validate->fails()) {
                return back()->withErrors($validate->errors())->withInput();
            }

            if ($request->hasFile('profile')) {
                $validate = Validator::make($request->all(), [
                    'profile' => 'mimes:jpeg,png,jpg',
                ], [
                    'profile.mimes' => 'صيغة الصورة الشخصية يجب ان تكون    jpeg , png , jpg',
                ]);
                if ($validate->fails()) {
                    return back()->withErrors($validate->errors())->withInput();
                }
                $profilefile = time() . '-' . $request->profile->getClientOriginalName();
                $request->profile->move(public_path('assets\MyImages\Users'), $profilefile);
                User::where('empno',$request->empno)->update([
                    'avatar' => $profilefile,
                ]);
            }

            if ($request->hasFile('signature')) {
                $validate = Validator::make($request->all(), [
                    'signature' => 'mimes:jpeg,png,jpg',
                ], [
                    'signature.mimes' => 'صيغة التوقيع يجب ان تكون    jpeg , png , jpg',
                ]);
                if ($validate->fails()) {
                    return back()->withErrors($validate->errors())->withInput();
                }

                $signaturefile = time() . '-' . $request->signature->getClientOriginalName();
                /* $request->signature->storeAs('Signature', $signaturefile, 'mmaFiles'); */
                $request->signature->move(public_path('assets\MyImages\Signature'), $signaturefile);
                User::where('empno',$request->empno)->update([
                    'signature' => $signaturefile,
                ]);
            }

            User::where('empno',$request->empno)->update([
                'name' => $request->name,
                'mobile' => $request->mobile
            ]);

            Employee::where('empno',$request->empno)->update([
                'name' => $request->name,
                'mobile' => $request->mobile
            ]);
            $msg = "تم تحديث بيانات الملف الشخصي بنجاح للموظف   ".($employee->name);
            Alert::success($msg)->autoClose(15000);
            return back();
        } catch (\Throwable $th) {
            Alert::error('هنالك خطأ', $th->getMessage())->autoClose(15000);
            return redirect()->back()->withErrors(['errors' => $th->getMessage()]);
        }
    }

    public function destroy(Employee $employee)
    {
        //
    }
}
