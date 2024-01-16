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
                    <h3 class="card-title hedr-font">التحليل المالي لطلب رقم  {{ $boxordersanalyse }}</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        @include('alert.errors')
                    @endif
                    @foreach ($orders as $order)
                        <div class="row">
                            {{-- صاحب الطلب --}}
                            <div class="col-lg-6 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4>صاحب الطلب :  {{$order->emp->name}}</h4>
                                        <h6> الرقم الوظيفي: {{ $order->empno}}</h6>
                                        <hr>
                                        <div class="row">
                                            <div class="col">
                                                <label for="ordertyp" class="control-label">نوع الطلب</label>
                                                <input type="text" class="form-control" id="ordertyp" name="ordertyp" value="{{ $order->order->ordertyp->name }}" readonly required>
                                                {{-- <input type="hidden" class="form-control" id="ordertypid" name="ordertypid" value="{{ $order->ordertyp->id }}" readonly>
                                                <input type="hidden" class="form-control" id="boxorders_id" name="boxorders_id" value="{{ $order->id }}" readonly>
                                                <input type="hidden" class="form-control" id="empno" name="empno" value="{{ $order->empno }}" readonly>
                                                <input type="hidden" class="form-control" id="orderempname" name="orderempname" value="{{ $order->emporder->name }}" readonly> --}}
                                            </div>
                                            <div class="col">
                                                <label for="purchasingValue" class="control-label">القيمة الشرائية</label>
                                                <input type="text" class="form-control" id="purchasingValue" name="purchasingValue" value="{{$order->purchasingValue}}" readonly required>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col">
                                                <label for="empsalary" class="control-label">الراتب</label>
                                                <input type="text" class="form-control" id="empsalary" name="empsalary" value="{{ $order->empsalary }}" readonly required>
                                            </div>
                                            <div class="col">
                                                <label for="empremiumBox" class="control-label">قسط الإشتراك</label>
                                                <input type="text" class="form-control" id="empremiumBox" name="empremiumbox" value="{{$order->empremiumBox}}" readonly required>
                                            </div>
                                        </div>
                                        <br>
                                        <h5 class="text-center">الضمانات</h5>
                                        <div class="row">
                                            <div class="col">
                                                <label for="empendService" class="control-label">رصيد نهاية الخدمة</label>
                                                <input type="text" class="form-control" id="empendService" name="empendService" value="{{ $order->empendService }}" readonly required>
                                            </div>
                                            <div class="col">
                                                <label for="empbalancebox" class="control-label">رصيد اشتراك الصندوق</label>
                                                <input type="text" class="form-control" id="empbalancebox" name="empbalancebox" onfocusout="calc()" value="{{ $order->empbalancebox }}"  required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label for="emptotalGuarantees" class="control-label">إجمالي الضمانات</label>
                                            <input type="text" class="form-control" id="emptotalGuarantees" name="emptotalGuarantees" value="{{ $order->emptotalGuarantees }}" readonly required>
                                        </div>
                                        <br>
                                        <h5 class="text-center">الإلتزمات</h5>
                                        <div class="row">
                                            <div class="col">
                                                <label for="empdebtFurniture" class="control-label">مديونية أجهزة واثاث</label>
                                                <input type="text" class="form-control" id="empdebtFurniture" name="empdebtFurniture" value="{{ $order->empdebtFurniture }}" readonly required>
                                            </div>
                                            <div class="col">
                                                <label for="empdebtCar" class="control-label"> مديونية سيارات</label>
                                                <input type="text" class="form-control" id="empdebtCar" name="empdebtCar" value="{{ $order->empdebtCar }}" readonly required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label for="empanothSponosr" class="control-label">مبلغ كفالة موظف آخر</label>
                                            <input type="text" class="form-control" id="empanothSponosr" name="empanothSponosr" readonly value="{{ $order->empanothSponosr }}" required>

                                        </div>
                                        <div class="col">
                                            <label for="totalCommitmentEmp" class="control-label">إجمالي الإلتزامات</label>
                                            <input type="text" class="form-control" id="totalCommitmentEmp" name="totalCommitmentEmp" value="{{ $order->totalCommitmentEmp }}" readonly  required>
                                        </div>
                                        <div class="col">
                                            <label for="guaranteesAvailableEmp" class="control-label">الضمانات المتاحة</label>
                                            <input type="text" class="form-control" id="guaranteesAvailableEmp" name="guaranteesAvailableEmp" value="{{ $order->guaranteesAvailableEmp }}" readonly  required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- الكافل --}}
                            <div class="col-lg-6 col-md-6">
                                @if (!$order->sprno)
                                    <input type="hidden" id="sprAvilb" name="sprAvilb" value="0">
                                    <div class="card bd-0 mg-b-20 bg-danger">
                                        <div class="card-body text-white">
                                            <div class="main-error-wrapper">
                                                <i class="si si-close mg-b-20 tx-50"></i>
                                                <h4 class="mg-b-0">هذا الطلب ليس به كافل</h4>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <input type="hidden" id="sprAvilb" name="sprAvilb" value="1">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4>الكافل :  {{$order->spr->name}}</h4>
                                            <h6> الرقم الوظيفي: {{ $order->sprno}}</h6>
                                            <hr>
                                            <div class="row">
                                                <label class="control-label">حالة الكافل</label>
                                                @switch($order->aprovalsponsor)
                                                    @case(1)
                                                        <input type="text" class="form-control" id="aprovalSponsor" value="رفض الكافل" disabled style="color: red; font-weight: bold">
                                                        @break
                                                    @case(2)
                                                        <input type="text" class="form-control" id="aprovalSponsor" value="موافقة الكافل" disabled style="color: green; font-weight: bold">
                                                        @break
                                                @endswitch
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col">
                                                    <input type="hidden" name="sprno" class="form-control" value="{{ $order->sprno }}" >
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label for="sprsalary" class="control-label">الراتب</label>
                                                    <input type="text" class="form-control" id="sprsalary" name="sprsalary" value="{{ $order->sprsalary }}" readonly>
                                                </div>
                                                <div class="col">
                                                    <label for="sprpremiumBox" class="control-label">قسط الإشتراك</label>
                                                    <input type="text" class="form-control" id="sprpremiumBox" name="sprpremiumBox" value="{{ $order->sprpremiumBox }}" readonly>
                                                </div>
                                            </div>
                                            <br>
                                            <h5 class="text-center">الضمانات</h5>
                                            <div class="row">
                                                <div class="col">
                                                    <label for="sprendService" class="control-label">رصيد نهاية الخدمة</label>
                                                    <input type="text" class="form-control" id="sprendService" name="sprendService" value="{{$order->sprendService}}" readonly>
                                                </div>
                                                <div class="col">
                                                    <label for="sprbalancebox" class="control-label">رصيد اشتراك الصندوق</label>
                                                    <input type="text" class="form-control" id="sprbalancebox" name="sprbalancebox" onfocusout="calc()" value="{{ $order->sprbalancebox }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label for="empid" class="control-label">إجمالي الضمانات</label>
                                                <input type="text" class="form-control" id="totalGuaranteesSpr" name="totalGuaranteesSpr" value="{{ $order->totalGuaranteesSpr }}"  readonly>
                                            </div>
                                            <br>
                                            <h5 class="text-center">الإلتزمات</h5>
                                            <div class="row">
                                                <div class="col">
                                                    <label for="sprdebtFurniture" class="control-label">مديونية أجهزة واثاث</label>
                                                    <input type="text" class="form-control" id="sprdebtFurniture" name="sprdebtFurniture" value="{{ $order->sprdebtFurniture }}" readonly>
                                                </div>
                                                <div class="col">
                                                    <label for="sprdebtCar" class="control-label"> مديونية سيارات</label>
                                                    <input type="text" class="form-control" id="sprdebtCar" name="sprdebtCar"value="{{ $order->sprdebtCar }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label for="spranothSponosr" class="control-label">مبلغ كفالة موظف آخر</label>
                                                <input type="text" class="form-control" id="spranothSponosr" name="spranothSponosr" readonly value="{{ $order->spranothSponosr }}">
                                            </div>
                                            <div class="col">
                                                <label for="totalCommitmentSpr" class="control-label">إجمالي الإلتزامات</label>
                                                <input type="text" class="form-control" id="totalCommitmentSpr" name="totalCommitmentSpr" readonly  value="{{ $order->totalCommitmentSpr }}">
                                            </div>
                                            <div class="col">
                                                <label for="guaranteesAvailableSpr" class="control-label">الضمانات المتاحة</label>
                                                <input type="text" class="form-control" id="guaranteesAvailableSpr" name="guaranteesAvailableSpr"  readonly  value="{{ $order->guaranteesAvailableSpr }}">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <br>
                            <div class="col-lg-12 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <label for="totalGuaranteesAll" class="control-label">إجمالي الضمانات</label>
                                                <input type="text" class="form-control" id="totalGuaranteesAll" name="totalGuaranteesAll" value="{{ $order->totalGuaranteesAll }}"  readonly>
                                            </div>
                                            <div class="col">
                                                <label for="totalCommitmentAll" class="control-label">إجمالي الإلتزامات</label>
                                                <input type="text" class="form-control" id="totalCommitmentAll" name="totalCommitmentAll" value="{{ $order->totalCommitmentAll }}" readonly>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col">
                                                <label for="guaranteesAvailableAll" class="control-label">الضمانات المتاحة</label>
                                                <input type="text" class="form-control" id="guaranteesAvailableAll" name="guaranteesAvailableAll" value="{{ $order->guaranteesAvailableAll }}" readonly>
                                            </div>
                                            <div class="col">
                                                <label for="purchasingValueGurnt" class="control-label">مبلغ الضمان المطلوب</label>
                                                <input type="text" class="form-control" id="purchasingValueGurnt" name="purchasingValueGurnt" value="{{ $order->purchasingValueGurnt }}" readonly>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col">
                                                <label for="evaluation" class="control-label"> تقييم الوضع المالي لمقدم الطلب</label>
                                                <input type="text" class="form-control" id="evaluation" name="evaluation" value="{{ $order->evaluation == 1 ? 'الضمانات  كافية' : 'الضمانات غير كافية' }}" readonly>
                                                {{-- <select class="form-control" id="evaluation" name="evaluation" onchange="refusal()">
                                                    <option >الرجاء إختيار التقييم المناسب</option>
                                                    <option value="1" >الضمانات  كافية</option>
                                                    <option value="2" >الضمانات غير كافية</option>
                                                </select> --}}
                                            </div>
                                        </div>
                                        <br>
                                        @if ($guarantees)
                                            {{-- <label for="empid" class="control-label"> الضمانات المعتمدة</label> --}}
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    {{-- <label class="ckbox"><span>{{$app->name}}</span></label> --}}
                                                    <ul id="treeview1" style="font-size: 26px">
                                                        <li class="control-label"><a style="font-size: 28px" href="javascript:void(0)">الضمانات المعتمدة</a>
                                                            <ul>
                                                                @foreach ($guarantees as $app)
                                                                    <li class="control-label">{{$app->name}}</li>
                                                                        {{-- <label class="ckbox"><input type="checkbox" name="approvedGuarantees" value="{{$app->boxorderguarantee_id}}"><span>{{$app->name}}</span></label> --}}
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <br><br>
                                        @endif

                                        <div class="row" id="resonRefusal">
                                            <div class="col-lg">
                                                <label for="">السبب</label>
                                                <textarea class="form-control" name="reson" rows="3" readonly>{{$order->reson}}</textarea>
                                            </div>
                                        </div>
                                        <br>
                                        @if (EmpNo() == 11829)
                                            <div class="d-flex justify-content-center">
                                                <form action="{{ route('boanalyses.update',1) }}" method="post">
                                                    {{ csrf_field() }}
                                                    @method('PATCH')
                                                    <input type="hidden" class="form-control" id="orderid" name="orderid" value="{{ $boxordersanalyse }}">
                                                    <button type="submit" class="btn btn-primary">إعتماد التحليل المالي</button>
                                                </form>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                                <div style="margin-bottom: 180px"></div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <!-- Internal Treeview js -->
    <script src="{{asset('public/assets/plugins/treeview/treeview.js')}}"></script>
    {{-- <script src="{{asset('public/assets/js/enterButton.js') }}"></script>
    <script src="{{asset('public/assets/js/Saving/analysis2.js') }}"></script>


    <script>
        function refusal() {
            let  guaranteesAvailable = document.getElementById('guaranteesAvailableAll').value,
            purchasingValueGurnt = document.getElementById('purchasingValueGurnt').value,
            evaluation = document.getElementById('evaluation').value,
            refusalBtn = document.getElementById('refusalBtn'),
            acceptBtn = document.getElementById('acceptBtn'),
            resonRefusal = document.getElementById('resonRefusal');
            if (guaranteesAvailable || purchasingValueGurnt)
            {
                if (evaluation == 1) {
                    /* resonRefusal.style.display = "none"; */
                    acceptBtn.style.display = "block";
                    refusalBtn.style.display = "none"
                } else if(evaluation == 2) {
                    /* resonRefusal.style.display = "block"; */
                    acceptBtn.style.display = "none"
                    refusalBtn.style.display = "block";
                }else{
                    /* resonRefusal.style.display = "none"; */
                    acceptBtn.style.display = "none"
                    refusalBtn.style.display = "none";
                }
            } else {
                alert('الرجاء مراجعة المدخلات');
            }
        }
    </script> --}}
@endsection
