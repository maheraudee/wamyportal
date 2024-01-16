@extends('layouts.wamy.wamy')
@section('css')
@endsection
@section('title')
    <title>تقديم طلب خدمة - الندوة العالمية للشباب الإسلامي</title>
@endsection
@section('content')
<div class="mb-5"></div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">

                    <div class="col-lg-11">
                        <h3 class="card-title hedr-font">تقديم طلب خدمة</h3>
                    </div>
                    <div class="col-lg-1">
                        <a href="{{ URL::previous() }}" class="btn  btn-indigo">رجوع</a>
                    </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        @include('alert.errors')
                    @endif
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form id="addSavings" action="{{ route('orders.store') }}"
                                    method="post" enctype="multipart/form-data" autocomplete="off" onsubmit="return validateForm()">
                                    {{ csrf_field() }}
                                            @foreach ($datas as $data)
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="empno" class="control-label"> الرقم الوظيفي </label>
                                                        <input type="text" class="form-control" id="empno" name="empno" readonly
                                                            value="{{ $data->empno }}">
                                                    </div>
                                                    <div class="col-sm col-md">
                                                        <label for="name" class="control-label">الإسم</label>
                                                        <input type="text" class="form-control" id="name" name="name" readonly
                                                            value="{{ $data->name }}">
                                                    </div>
                                                    <div class="col-sm col-md">
                                                        <label for="department" class="control-label">الإدارة</label>
                                                        <input type="text" class="form-control" id="department" name="department" disabled
                                                            value="{{ $data->department }}">
                                                    </div>
                                                    <div class="col-sm col-md">
                                                        <label for="section" class="control-label">القسم</label>
                                                        <input type="text" class="form-control" id="section" name="section" disabled
                                                            value="{{ $data->section }}">
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-sm col-md">
                                                        <label for="" class="control-label">جوال</label>
                                                        <input type="text" class="form-control" id="mobile" name="mobile" readonly
                                                            value="{{ $data->mobile }}">
                                                    </div>
                                                    <div class="col-sm col-md">
                                                        <label for="nationality" class="control-label">الجنسية</label>
                                                        <input type="text" class="form-control" id="nationality" name="nationality" disabled
                                                            value="{{ $data->nationality }}">
                                                    </div>
                                                    <div class="col-sm col-md">
                                                        <label for="cardid" class="control-label"> رقم بطاقة الأحوال/الإقامة </label>
                                                        <input type="text" class="form-control" id="cardid" name="cardid" readonly
                                                            value="{{ $data->cardid }}"
                                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                                    </div>
                                                    <div class="col-sm col-md">
                                                        <label for="salary" class="control-label">الراتب</label>
                                                        <input type="text" class="form-control" id="salary" name="salary" readonly
                                                            value="{{ $data->salary }}"
                                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                        <div class="col-sm col-md">
                                                            <label for="deductionsHr" class="control-label">إستقطاعات شؤون الموظفين</label>
                                                            <input type="text" class="form-control form-control-lg" id="deductionsHr"  name="deductionsHr" value="{{ EmpFincial($data->empno,'hr') ? EmpFincial($data->empno,'hr') : 0}}" readonly>
                                                        </div>
                                                        <div class="col-sm col-md">
                                                            <label for="deductionsBox" class="control-label"> إستقطاعات الصندوق</label>
                                                            <input type="text" class="form-control form-control-lg" id="deductionsBox" name="deductionsBox" value="{{ EmpFincial($data->empno,'box') ? EmpFincial($data->empno,'box') : 0}}" readonly>
                                                        </div>
                                                    <div class="col-sm col-md">
                                                        <label for="finalRate" class="control-label"> النسبة </label>
                                                        <input type="text" class="form-control form-control-lg" id="finalRate" name="finalRate" readonly>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <br>
                                            <div class="row">
                                                <div class="col-sm col-md">
                                                    <label for="orderTyp " class="control-label"> نوع الطلب </label>
                                                    <select class="form-control border-primary select2-show-search form-select"
                                                        id="orderTypselect" name="orderTyp"
                                                        onchange="changetypeorder()" required>
                                                        <option>الرجاء إختيار نوع الطلب</option>
                                                        @foreach (active('Saving\Orders\Boxorderstypes',null,['id','name']) as $ordtyp)
                                                            <option value="{{$ordtyp->id}}"> {{$ordtyp->name}} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm col-md">
                                                    <label for="installmentPeriod" class="control-label"> مدة التقسيط </label>
                                                    <select class="form-control border-primary select2-show-search form-select" id="installmentPeriod" name="installmentPeriod"
                                                        onchange="changePeriod()" required>
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm col-md">
                                                    <label for="purchasingValue" class="control-label">القيمة الشرائية</label>
                                                    <input type="text" class="form-control border-primary" id="purchasingValue" name="purchasingValue"
                                                    onfocusout ="checkAmount()" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
                                                </div>
                                                <div class="col">
                                                    <label for="orderdesc" class="control-label">وصف <span id="typeorder"></span></label>
                                                    <input type="text" class="form-control border-primary" id="orderdesc" name="orderdesc"
                                                    oninput="checkInput()" required onfocusout ="checkAmount()"
                                                        placeholder="نأمل كتابة مواصفات الجهاز بشكل دقيق مثال: ايفون 12 بروماكس 256 لون ازرق">
                                                </div>
                                            </div>
                                            <br>

                                            <div class="row">
                                                <div class="col-sm col-md" id="sponsor" >
                                                    <label for="sponsor" class="control-label"> الكافل (إن وجد)</label>
                                                    <select class="form-control select2-show-search form-select" id="sponsorId" name="sponsor">
                                                        <option value="0" >الرجاء إختيار الكافل</option>
                                                        @foreach (active('Saving\Saving','employee:empno,name',['empno']) as $emp)
                                                            @if ($emp->empno != EmpNo())
                                                                <option value="{{ $emp->empno }}">{{ $emp->employee->name }}</option>
                                                            @endif

                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm col-md">
                                                    <h5 class="card-title">التوقيع</h5>
                                                    {{-- @if ($signature->signature == 'defualt.png') --}}
                                                    @if (!Signature(EmpNo()))
                                                        <p class="text-danger">* صيغة المرفق jpeg ,.jpg , png </p>
                                                        <div class="col-sm-12 col-md-12">
                                                            <input type="file" name="signature" class="dropify"
                                                                accept=".jpg, .png, image/jpeg, image/png" data-height="70" required/>
                                                        </div>
                                                    @else
                                                        <img name="signature" style="width: 10%" src="{{getImage('Signature/'.Signature(EmpNo())) }}" alt="Sign">
                                                        {{-- <img name="signature" style="width: 10%" src="{{ asset('public/storage/Signature/'.$signature[0]/* ->signature */) }}" alt="Sign"> --}}
                                                    @endif
                                                </div>
                                            </div>
                                            <br><br>

                                            <div class="row">
                                                <label style="font-size: 16px">
                                                    <input type="checkbox" id="agree" onchange="showlink()">
                                                    <strong>
                                                        أنا الموقع أدناه أتقدم لصندوق الادخار بالندوة العالمية للشباب الإسلامي بطلب <span id="typeorder"></span> وفق البيانات أعلاه والعقد المرفق.
                                                        أقر بموجب هذا الطلب أن المعلومات صحيحة وأن لصندوق الادخار الحق في التأكد والتحقق من صحة هذه المعلومات وتبادلها مع الغير. وأفوضهم بأن يحصلوا على ما يلزمهم أو يحتاجون إليه من معلومات تخصني. كما أعلن التزامي بجميع الشروط والأحكام التي سيتم اطلاعي عليها في العقد المبرم بيني وبين صندوق الادخار. وأوافق على أن تتم تسوية أي نزاع قد ينشأ فيما يتعلق بوضع هذا الطلب عن طريق الجهات الرسمية، ويحق للصندوق أن يحتفظ بالمستندات التي أقدمها، وفي حال ثبوت عدم صحة المعلومات أعلاه فإنني أتحمل كافة الإجراءات القانونية المترتبة على ذلك.
                                                        لا يحق سحب الرصيد المتوفر في الصندوق إلا بعد سداد الأقساط كاملة.

                                                    </strong>
                                                </label>
                                            </div>
                                            <br>
                                            <span id="attention" style="font-weight: bold; font-size: 16px; color:red; display: none; text-align: center">
                                                * تقديم الطلب لا يعني الموافقة عليه، سيتم الإعتماد بعد مراجعة البيانات المالية لمقدم الطلب والكافل إن وجد
                                            </span>
                                            <br>
                                            <div class="d-flex justify-content-center">
                                                <button type="submit" id="savelink" class="btn btn-primary"
                                                    style="display: none;">تقديم الطلب
                                                </button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                            <div style="margin-bottom: 180px"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
<script src="{{asset('public/assets/js/Saving/orders.js') }}"></script>
<script>
    $('select[name="orderTyp"]').on('change', function () {
        var orderTyp = $(this).val();
        if (orderTyp) {
            $.ajax({
                url: "{{ URL::to('getPeriodajax') }}",
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('select[name="installmentPeriod"]').empty();
                    $('select[name="installmentPeriod"]').append('<option value="0">الرجاء إختيار مدة التقسيط</option>');
                    $.each(data, function (value,key) {
                        if (orderTyp == 1) {
                            if (key == 1 || key == 2) {
                                $('select[name="installmentPeriod"]').append('<option value="' + key + '">' + value + '</option>');
                            }
                        }else{
                            $('select[name="installmentPeriod"]').append('<option value="' + key + '">' + value + '</option>');
                        }

                    });
                },
            });
        }
        else {
            console.log('AJAX load did not work');
        }
    });
</script>

@endsection

