@extends('layouts.wamy.wamy')
@section('css')
@endsection
@section('title')
    <title>طلب - الندوة العالمية للشباب الإسلامي</title>
@endsection
@section('content')
<div class="mb-5"></div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-lg-11">
                        @foreach ($boxorders as $boxorder)
                            <h3 class="card-title hedr-font">
                                طلب رقم {{ $boxorder->id }} &nbsp; - &nbsp;
                                <span class="btn btn-outline-danger">حالة الطلب {{ $boxorder->orderstatus->name }}</span>
                                &nbsp; - &nbsp;
                                @if($boxorder->sponsor)
                                    @switch($boxorder->aprovalsponsor)
                                        @case(NULL)
                                            <span class="tag-blue">طلب كافل</span>
                                            @break
                                        @case(1)
                                            <span class="tag-red">رفض الكافل</span>
                                            @break
                                        @case(2)
                                            <span class="tag-green">موافقة الكافل</span>
                                            @break
                                    @endswitch
                                @else
                                    <span class="tag-gray">لايوجد كافل</span>
                                @endif
                            </h3>
                        @endforeach
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
                                    <form>
                                        @foreach ($datas as $data)
                                            <div class="row">
                                                <div class="col">
                                                    <label for="empno" class="control-label"> الرقم الوظيفي </label>
                                                    <input type="text" class="form-control" id="empno" name="empno" readonly value="{{ $data->empno }}">
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
                                        @endforeach

                                        @foreach ($boxorders as $boxorder)
                                            <div class="row">
                                                <div class="col-sm col-md">
                                                    <label for="orderTyp " class="control-label"> نوع الطلب </label>
                                                    <input type="text" class="form-control form-control-lg" id="orderTyp"  name="orderTyp" value="{{ $boxorder->ordertyp->name }}" readonly>
                                                </div>
                                                <div class="col-sm col-md">
                                                    <label for="installmentPeriod" class="control-label"> مدة التقسيط </label>
                                                    <input type="text" class="form-control form-control-lg" id="installmentPeriod"  name="installmentPeriod" 
                                                    value="@switch($boxorder->installmentPeriod)@case(1)سنة@break @case(2)سنتان @break @default{{ $boxorder->installmentPeriod }}  سنة @endswitch" readonly>
                                                </div>
                                            </div>
                                            <br>   
                                            <div class="row">
                                                <div class="col-sm col-md">
                                                    <label for="purchasingValue" class="control-label">القيمة الشرائية</label>
                                                    <input type="text" class="form-control" id="purchasingValue" name="purchasingValue" value="{{ $boxorder->purchasingValue }}" readonly>
                                                </div>
                                                <div class="col">
                                                    <label for="orderdesc" class="control-label">وصف <span id="typeorder"></span></label>
                                                    <input type="text" class="form-control" id="orderdesc" name="orderdesc" value="{{ $boxorder->orderdesc }}" readonly>
                                                </div>
                                            </div>
                                            <br>
                                            @if ($boxorder->sponsororder != NULL)
                                                <div class="row">
                                                    <div class="col-sm col-md" id="sponsor" >
                                                        <label for="sponsor" class="control-label"> الكافل - <span class="{{ $boxorder->statusid == 3 || $boxorder->statusid == 5 ? 'tag-red': 'tag-lime' }}">{{ $boxorder->orderstatus->name }}</span></label>  
                                                        <input type="text" class="form-control" id="orderdesc" name="orderdesc" value="{{ $boxorder->sponsororder->name }}" readonly>
                                                    </div>
                                                </div>
                                                <br><br>
                                            @endif
                                            {{-- <div class="row">
                                                <label style="font-size: 16px">
                                                    <strong>
                                                        أنا الموقع أدناه أتقدم لصندوق الادخار بالندوة العالمية للشباب الإسلامي بطلب <span>{{ $boxorder->ordertyp->name }}</span> وفق البيانات أعلاه والعقد المرفق.
                                                        أقر بموجب هذا الطلب أن المعلومات صحيحة وأن لصندوق الادخار الحق في التأكد والتحقق من صحة هذه المعلومات وتبادلها مع الغير. وأفوضهم بأن يحصلوا على ما يلزمهم أو يحتاجون إليه من معلومات تخصني. كما أعلن التزامي بجميع الشروط والأحكام التي سيتم اطلاعي عليها في العقد المبرم بيني وبين صندوق الادخار. وأوافق على أن تتم تسوية أي نزاع قد ينشأ فيما يتعلق بوضع هذا الطلب عن طريق الجهات الرسمية، ويحق للصندوق أن يحتفظ بالمستندات التي أقدمها، وفي حال ثبوت عدم صحة المعلومات أعلاه فإنني أتحمل كافة الإجراءات القانونية المترتبة على ذلك.
                                                        لا يحق سحب الرصيد المتوفر في الصندوق إلا بعد سداد الأقساط كاملة.
                                                    </strong>
                                                </label>
                                            </div> --}}
                                        @endforeach
                                        {{-- <br>
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" id="savelink" class="btn btn-primary">
                                                تقديم الطلب
                                            </button>
                                        </div> --}}
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

@endsection