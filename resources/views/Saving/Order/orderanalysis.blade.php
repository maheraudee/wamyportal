@extends('layouts.wamy.wamy')
@section('css')
@endsection
@section('title')
    <title>التحليل المالي - الندوة العالمية للشباب الإسلامي</title>
@endsection
@section('content')
<div class="mb-5"></div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-lg-6 col-md-6">
                        <h3 class="card-title hedr-font">التحليل المالي لطلب رقم  {{ $boxorder }}</h3>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <h3 class="card-title hedr-font">حالة الطلب :
                            @include('Saving.Order.status.displaystatus',['statusid' => $statusid,'orderid' => $boxorder])
                        </h3>


                        {{-- <span class="tag tag-blue">إنتظار موافقة الكافل</span> --}}
                    </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        @include('alert.errors')
                    @endif
                    <form action="{{ route('boanalyses.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            {{-- صاحب الطلب --}}
                            <div class="col-lg-6 col-md-6 ">
                                <div class="card border border-primary">
                                    <div class="card-body">
                                        @foreach ($orders as $order)
                                            <h4>صاحب الطلب :  {{$order->emporder->name}}</h4>
                                            <h6> الرقم الوظيفي: {{ $order->empno}}</h6>
                                            <hr>
                                        @endforeach
                                        <div class="row">
                                            <div class="col">
                                                <label for="ordertyp" class="control-label">نوع الطلب</label>
                                                <input type="text" class="form-control" id="ordertyp" name="ordertyp" value="{{ $order->ordertyp->name }}" readonly required>
                                                <input type="hidden" class="form-control" id="ordertypid" name="ordertypid" value="{{ $order->ordertyp->id }}" readonly>
                                                <input type="hidden" class="form-control" id="boxorders_id" name="boxorders_id" value="{{ $order->id }}" readonly>
                                                <input type="hidden" class="form-control" id="empno" name="empno" value="{{ $order->empno }}" readonly>
                                                <input type="hidden" class="form-control" id="orderempname" name="orderempname" value="{{ $order->emporder->name }}" readonly>
                                            </div>
                                            <div class="col">
                                                <label for="purchasingValue" class="control-label">القيمة الشرائية</label>
                                                <input type="text" class="form-control" id="purchasingValue" name="purchasingValue" value="{{$order->purchasingValue}}" required>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col">
                                                <label for="empsalary" class="control-label">الراتب</label>
                                                <input type="text" class="form-control" id="empsalary" name="empsalary" value="{{ $order->emporder->salary }}" readonly required>
                                            </div>
                                            <div class="col">
                                                <label for="empremiumBox" class="control-label">قسط الإشتراك</label>
                                                <input type="text" class="form-control" id="empremiumBox" name="empremiumbox" value="{{$order->saveing['savings'][0]->premium}}" readonly required>
                                            </div>
                                        </div>
                                        <br>
                                        <h5 class="text-center">الضمانات</h5>
                                        <div class="row">
                                            <div class="col">
                                                <label for="empendService" class="control-label">رصيد نهاية الخدمة</label>
                                                <input type="text" class="form-control" id="empendService" name="empendService" value="{{ $empendService }}" readonly required>
                                            </div>
                                            <div class="col">
                                                <label for="empbalancebox" class="control-label">رصيد اشتراك الصندوق</label>
                                                <input type="text" class="form-control" id="empbalancebox" name="empbalancebox" onfocusout="calc()" value="{{EmpBalance($order->empno)}}" required>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col">
                                            <label for="emptotalGuarantees" class="control-label">إجمالي الضمانات</label>
                                            <input type="text" class="form-control" id="emptotalGuarantees" name="emptotalGuarantees"  readonly required>
                                        </div>
                                        <br>
                                        <h5 class="text-center">الإلتزمات</h5>
                                        <div class="row">
                                            <div class="col">
                                                <label for="empdebtFurniture" class="control-label">مديونية أجهزة واثاث</label>
                                                <input type="text" class="form-control" id="empdebtFurniture" name="empdebtFurniture" value="" onfocusout="calc()" required>
                                            </div>
                                            <div class="col">
                                                <label for="empdebtCar" class="control-label"> مديونية سيارات</label>
                                                <input type="text" class="form-control" id="empdebtCar" name="empdebtCar" value="" onfocusout="calc()" required>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col">
                                            <label for="empanothSponosr" class="control-label">مبلغ كفالة موظف آخر</label>
                                            <input type="text" class="form-control" id="empanothSponosr" name="empanothSponosr" onfocusout="calc()" value="" required>

                                        </div>
                                        <br>
                                        <div class="col">
                                            <label for="totalCommitmentEmp" class="control-label">إجمالي الإلتزامات</label>
                                            <input type="text" class="form-control" id="totalCommitmentEmp" name="totalCommitmentEmp" readonly  required>
                                        </div>
                                        <br>
                                        <div class="col">
                                            <label for="guaranteesAvailableEmp" class="control-label">الضمانات المتاحة</label>
                                            <input type="text" class="form-control" id="guaranteesAvailableEmp" name="guaranteesAvailableEmp"  readonly  required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- الكافل --}}
                            <div class="col-lg-6 col-md-6 ">
                                @if (!$order->sponsororder)
                                    <input type="hidden" id="sprAvilb" name="sprAvilb" value="0">
                                    {{-- <div class="card bd-0 mg-b-20 bg-danger">
                                        <div class="card-body text-white">
                                            <div class="main-error-wrapper">
                                                <i class="si si-close mg-b-20 tx-50"></i>
                                                <h4 class="mg-b-0">هذا الطلب ليس به كافل</h4>
                                            </div>
                                        </div>
                                    </div> --}}
                                @else
                                    <input type="hidden" id="sprAvilb" name="sprAvilb" value="1">
                                    <div class="card border border-primary">
                                        <div class="card-body">
                                            @foreach ($sponsordatas as $sponsor)
                                                <h4>الكافل :  {{$sponsor->name}}</h4>
                                                <h6> الرقم الوظيفي: {{ $sponsor->empno}}</h6>
                                                <hr>
                                            @endforeach
                                            <div class="row">
                                                <label class="control-label">حالة الكافل</label>
                                                {{-- {{ $order->orderstatus }} --}}
                                                {{-- @if ($order->aprovalsponsor == 1) --}}
                                                @switch($order->orderstatus->id)
                                                    @case(1)
                                                        @if ($order->sponsor)
                                                            <input type="text" class="form-control" id="aprovalSponsor" value=" في إنتظار رد الكافل" disabled style="color: blue; font-weight: bold">
                                                        @endif
                                                        @break
                                                    @case(2)
                                                        <input type="text" class="form-control" id="aprovalSponsor" value="{{$order->orderstatus->name}}" disabled style="color: green; font-weight: bold">
                                                        @break
                                                    @case(3)
                                                        <input type="text" class="form-control" id="aprovalSponsor" value="{{$order->orderstatus->name}}" disabled style="color: red; font-weight: bold">
                                                        @break
                                                @endswitch
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col">
                                                    <input type="hidden" name="sprno" class="form-control" value="{{ $sponsor->empno }}" >
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label for="sprsalary" class="control-label">الراتب</label>
                                                    <input type="text" class="form-control" id="sprsalary" name="sprsalary" value="{{ $sponsor->salary }}" readonly>
                                                </div>
                                                <div class="col">
                                                    <label for="sprpremiumBox" class="control-label">قسط الإشتراك</label>
                                                    <input type="text" class="form-control" id="sprpremiumBox" name="sprpremiumBox" value="{{  $sponsorbox }}" readonly>
                                                </div>
                                            </div>
                                            <br>
                                            <h5 class="text-center">الضمانات</h5>
                                            <div class="row">
                                                <div class="col">
                                                    <label for="sprendService" class="control-label">رصيد نهاية الخدمة</label>
                                                    <input type="text" class="form-control" id="sprendService" name="sprendService" value="{{$sponsorendService}}" readonly>
                                                </div>
                                                <div class="col">
                                                    <label for="sprbalancebox" class="control-label">رصيد اشتراك الصندوق</label>
                                                    <input type="text" class="form-control" id="sprbalancebox" name="sprbalancebox" onfocusout="calc()"  value="{{EmpBalance($sponsor->empno)}}">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="col">
                                                <label for="empid" class="control-label">إجمالي الضمانات</label>
                                                <input type="text" class="form-control" id="totalGuaranteesSpr" name="totalGuaranteesSpr"  readonly>
                                            </div>
                                            <br>
                                            <h5 class="text-center">الإلتزمات</h5>
                                            <div class="row">
                                                <div class="col">
                                                    <label for="sprdebtFurniture" class="control-label">مديونية أجهزة واثاث</label>
                                                    <input type="text" class="form-control" id="sprdebtFurniture" name="sprdebtFurniture" value="" onfocusout="calc()">
                                                </div>
                                                <div class="col">
                                                    <label for="sprdebtCar" class="control-label"> مديونية سيارات</label>
                                                    <input type="text" class="form-control" id="sprdebtCar" name="sprdebtCar"value="" onfocusout="calc()">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="col">
                                                <label for="spranothSponosr" class="control-label">مبلغ كفالة موظف آخر</label>
                                                <input type="text" class="form-control" id="spranothSponosr" name="spranothSponosr" onfocusout="calc()" value="">
                                            </div>
                                            <br>
                                            <div class="col">
                                                <label for="totalCommitmentSpr" class="control-label">إجمالي الإلتزامات</label>
                                                <input type="text" class="form-control" id="totalCommitmentSpr" name="totalCommitmentSpr" readonly >
                                            </div>
                                            <br>
                                            <div class="col">
                                                <label for="guaranteesAvailableSpr" class="control-label">الضمانات المتاحة</label>
                                                <input type="text" class="form-control" id="guaranteesAvailableSpr" name="guaranteesAvailableSpr"  readonly >
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <br>
                            <div class="col-lg-12 col-md-12 ">
                                <div class="card border border-primary">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <label for="totalGuaranteesAll" class="control-label">إجمالي الضمانات</label>
                                                <input type="text" class="form-control" id="totalGuaranteesAll" name="totalGuaranteesAll" onfocusout="netamnterr()" readonly>
                                            </div>
                                            <div class="col">
                                                <label for="totalCommitmentAll" class="control-label">إجمالي الإلتزامات</label>
                                                <input type="text" class="form-control" id="totalCommitmentAll" name="totalCommitmentAll" onfocusout="netamnterr()" readonly>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col">
                                                <label for="guaranteesAvailableAll" class="control-label">الضمانات المتاحة</label>
                                                <input type="text" class="form-control" id="guaranteesAvailableAll" name="guaranteesAvailableAll" onfocusout="netamnterr()" readonly>
                                            </div>
                                            <div class="col">
                                                <label for="purchasingValueGurnt" class="control-label">مبلغ الضمان المطلوب</label>
                                                <input type="text" class="form-control" id="purchasingValueGurnt" name="purchasingValueGurnt" onfocusout="netamnterr()" readonly>
                                            </div>
                                        </div>
                                        <br>
                                        <div id="netamntalert" class="alert alert-danger rounded-pill" role="alert">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>
                                            <h3 class="mylable text-center">الضمانات المتاحة أصغر من المبلغ المطلوب</h3>
                                        </div>
                                        <div class="row">
                                            <div class="col">

                                            </div>
                                        </div>
                                        <br>

                                        <div class="row">
                                            <div class="col">
                                                <label for="empid" class="control-label"> تقييم الوضع المالي لمقدم الطلب</label>
                                                <select class="form-control" id="evaluation" name="evaluation" onchange="refusal()">
                                                    <option >الرجاء إختيار التقييم المناسب</option>
                                                    <option value="1" >الضمانات  كافية</option>
                                                    <option value="2" >الضمانات غير كافية</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div id="aprvgurntdiv" style="display:none">
                                            <label for="approvedGuarantees" class="control-label"> الضمانات المعتمدة</label>
                                            <div class="row">
                                                @foreach ($guarantees as $app)
                                                    <div class="col-lg-3">
                                                        <label class="ckbox"><input type="checkbox" id="approvedGuarantees" name="approvedGuarantees[]" value="{{$app->id}}"><span>{{$app->name}}</span></label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <br><br>
                                        <div class="row" id="resonRefusal" style="display:none">
                                            <div class="col-lg">
                                                <label for="">السبب</label>
                                                <textarea class="form-control" name="reson" rows="3">{{-- {{$item->reson}} --}}</textarea>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="d-flex justify-content-center">
                                            {{-- <button type="submit" id="refusalBtn" class="btn btn-danger" style="display: none" >رفض الطلب</button> --}}
                                            <button type="submit" id="acceptBtn"  class="btn btn-primary" style="display: none">إعتماد التحليل المالي</button>
                                        </div>
                                    </div>
                                </div>
                                <div style="margin-bottom: 180px"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script src="{{asset('public/assets/js/enterButton.js') }}"></script>
    <script src="{{asset('public/assets/js/Saving/analysis2.js') }}"></script>
    <script>
        let netamntalert = document.getElementById('netamntalert');
        netamntalert.style.display = "none";

        function refusal() {
            let  guaranteesAvailable = document.getElementById('guaranteesAvailableAll').value,
            purchasingValueGurnt = document.getElementById('purchasingValueGurnt').value,
            evaluation = document.getElementById('evaluation').value,
            refusalBtn = document.getElementById('refusalBtn'),
            acceptBtn = document.getElementById('acceptBtn'),
            aprvgurntdiv = document.getElementById('aprvgurntdiv'),
            resonRefusal = document.getElementById('resonRefusal');

            if (guaranteesAvailable || purchasingValueGurnt)
            {
                if (evaluation == 1) {
                    resonRefusal.style.display = "block";
                    acceptBtn.style.display = "block";
                    aprvgurntdiv.style.display = "block";
                    refusalBtn.style.display = "none";


                } else if(evaluation == 2) {
                    resonRefusal.style.display = "block";
                    acceptBtn.style.display = "block";
                    aprvgurntdiv.style.display = "none";
                    refusalBtn.style.display = "block";

                }else{
                    resonRefusal.style.display = "none";
                    acceptBtn.style.display = "none";
                    aprvgurntdiv.style.display = "none"
                    refusalBtn.style.display = "none";
                }
            } else {
                alert('الرجاء مراجعة المدخلات');
            }

            /* if(guaranteesAvailable > purchasingValueGurnt){
                alert('الضمانات المتاحة أضغر من المبلغ المطلوب');
            } */
        }
    </script>
@endsection
