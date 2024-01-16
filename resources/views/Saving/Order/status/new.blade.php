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
                    @foreach ($boxorders as $boxorder)
                        <div class="col-xl-11">
                            <h3 class="card-title hedr-font">
                                طلب رقم {{ $boxorder->id }} &nbsp; - &nbsp;
                                حالة الطلب {{ $boxorder->orderstatus->name }}
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
                        </div>

                        <div class="col-xl-1">
                            <div class="d-flex justify-content-left">
                                <button class="btn btn-danger" id="destroybtn" data-bs-toggle="modal" data-bs-target="#Delete"
                                    data-id="{{ $boxorder->id }}" data-empno="{{ $boxorder->empno }}" data-ordertyp="{{ $boxorder->ordertyp->name }}">
                                    إلغاء الطلب
                                </button>
                            </div>
                        </div>

                    @endforeach
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        @include('alert.errors')
                    @endif
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('orders.update',2) }}" method="POST" enctype="multipart/form-data" autocomplete="off" onsubmit="return validateForm()">
                                        {{ csrf_field() }}
                                        @method('PATCH')
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
                                        @endforeach

                                        @foreach ($boxorders as $boxorder)
                                            <div class="row">
                                                <input type="hidden" class="form-control form-control-lg" id="orderid"  name="orderid" value="{{ $boxorder->id }}">
                                                <input type="hidden" class="form-control form-control-lg" id="statusid"  name="statusid" value="{{ $boxorder->statusid }}">
                                                <div class="col-sm col-md">
                                                    <label for="deductionsHr" class="control-label">إستقطاعات شؤون الموظفين</label>
                                                    <input type="text" class="form-control form-control-lg" id="deductionsHr"  name="deductionsHr" value="{{ $boxorder->hr }}" readonly>
                                                </div>
                                                <div class="col-sm col-md">
                                                    <label for="deductionsBox" class="control-label"> إستقطاعات الصندوق</label>
                                                    <input type="text" class="form-control form-control-lg" id="deductionsBox" name="deductionsBox" value="{{ $boxorder->box }}" readonly>

                                                </div>
                                                <div class="col-sm col-md">
                                                    <label for="finalRate" class="control-label"> النسبة </label>
                                                    <input type="text" class="form-control form-control-lg" id="finalRate" name="finalRate" value="{{ $boxorder->rate }}" readonly>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm col-md">
                                                    <label for="orderTyp " class="control-label"> نوع الطلب </label>
                                                    <select class="form-control" id="orderTypselect" name="orderTyp"
                                                        onchange="changetypeorder()" required>
                                                        @foreach ($boxorderstypes as $type)
                                                            @if ($boxorder->orderTyp == $type->id)
                                                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm col-md">
                                                    <label for="installmentPeriod" class="control-label"> مدة التقسيط </label>
                                                    <select class="form-control " id="installmentPeriod" name="installmentPeriod"
                                                        onchange="changePeriod()" required>
                                                        @foreach (active('Saving\Installmentperiod',NULL,['id','name']) as $period)
                                                            @if ($boxorder->installmentPeriod == $period->id)
                                                                <option value="{{ $period->id }}" id="rdoall" style="display: none"> {{ $period->name }} </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm col-md">
                                                    <label for="purchasingValue" class="control-label">القيمة الشرائية</label>
                                                    <input type="text" class="form-control" id="purchasingValue" name="purchasingValue" value="{{ $boxorder->purchasingValue }}"
                                                    onfocusout ="checkAmount()" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
                                                </div>
                                                <div class="col">
                                                    <label for="orderdesc" class="control-label">وصف <span id="typeorder"></span></label>
                                                    <input type="text" class="form-control" id="orderdesc" name="orderdesc"  value="{{ $boxorder->orderdesc }}"
                                                    oninput="checkInput()" required
                                                        placeholder="نأمل كتابة مواصفات الجهاز بشكل دقيق مثال: ايفون 12 بروماكس 256 لون ازرق">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm col-md" id="sponsor" >
                                                    <label for="sponsor" class="control-label"> الكافل (إن وجد)</label>
                                                    <select class="form-control select2-show-search form-select" id="sponsorId" name="sponsor">
                                                        @if ($boxorder->sponsor)
                                                            @foreach ($savings as $saving)
                                                                @if ($boxorder->sponsor == $saving->empno)
                                                                    <option value="{{ $saving->empno }}">{{ $saving->employee->name }}</option>
                                                                    @foreach ($savings as $saving)
                                                                        @if ($boxorder->sponsor != $saving->empno)
                                                                        <option value="{{ $saving->empno }}">{{ $saving->employee->name }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <option value="0" >الرجاء إختيار الكافل</option>
                                                            @foreach ($savings as $saving)
                                                                <option value="{{ $saving->empno }}">{{ $saving->employee->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm col-md">
                                                    <h5 class="card-title">التوقيع</h5>
                                                    @if (!Signature(EmpNo()))
                                                        <p class="text-danger">* صيغة المرفق jpeg ,.jpg , png </p>
                                                        <div class="col-sm-12 col-md-12">
                                                            <input type="file" name="signature" class="dropify"
                                                                accept=".jpg, .png, image/jpeg, image/png" data-height="70" required/>
                                                        </div>
                                                    @else
                                                        <img name="signature" style="width: 10%" src="{{getImage('Signature/'.Signature(EmpNo())) }}" alt="Sign">
                                                    @endif
                                                </div>
                                            </div>
                                            <br><br>
                                            {{-- <div class="row">
                                                <label style="font-size: 16px">
                                                    <input type="checkbox" id="agree" onchange="showlink()">
                                                    <strong>
                                                        أنا الموقع أدناه أتقدم لصندوق الادخار بالندوة العالمية للشباب الإسلامي بطلب <span id="typeorder"></span> وفق البيانات أعلاه والعقد المرفق.
                                                        أقر بموجب هذا الطلب أن المعلومات صحيحة وأن لصندوق الادخار الحق في التأكد والتحقق من صحة هذه المعلومات وتبادلها مع الغير. وأفوضهم بأن يحصلوا على ما يلزمهم أو يحتاجون إليه من معلومات تخصني. كما أعلن التزامي بجميع الشروط والأحكام التي سيتم اطلاعي عليها في العقد المبرم بيني وبين صندوق الادخار. وأوافق على أن تتم تسوية أي نزاع قد ينشأ فيما يتعلق بوضع هذا الطلب عن طريق الجهات الرسمية، ويحق للصندوق أن يحتفظ بالمستندات التي أقدمها، وفي حال ثبوت عدم صحة المعلومات أعلاه فإنني أتحمل كافة الإجراءات القانونية المترتبة على ذلك.
                                                        لا يحق سحب الرصيد المتوفر في الصندوق إلا بعد سداد الأقساط كاملة.

                                                    </strong>
                                                </label>
                                            </div> --}}
                                        @endforeach
                                        <br>
                                        <span id="attention" style="font-weight: bold; font-size: 16px; color:red; text-align: center">
                                            * تقديم الطلب لا يعني الموافقة عليه، سيتم الإعتماد بعد مراجعة البيانات المالية لمقدم الطلب والكافل إن وجد
                                        </span>
                                        <br>
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" {{-- id="savelink" --}} class="btn btn-primary"
                                                >تقديم الطلب
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
<!--Model-->
<div class="modal fade" id="Delete">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h3 class="card-title hedr-font">إلغاء طلب</h3>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate action="{{ route('destroyorder') }}" method="POST">
                    {{ csrf_field() }}
                        <div class="mb-3">
                            <h4>هل أنت متاكد من حذف طلب  <span id="ordertyp"></span>؟</h4>
                            <input type="hidden" class="form-control" id="id" name="id">
                            <input type="hidden" class="form-control" id="empno" name="empno">
                        </div>
                    <br>
                    <div class="modal-footer">
                        <button class="btn btn-danger font-16" type="submit">حذف</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        $('#Delete').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var empno = button.data('empno')
            var ordertyp = button.data('ordertyp')
            var modal = $(this)

            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #empno').val(empno);
            modal.find('.modal-body #ordertyp').text(ordertyp);
        })
        $(document).on('click','#destroybtn',function(){
            let id = $(this).attr('data-id');
            $('#id').val(id);
        });
    </script>
    <script src="{{asset('public/assets/js/Saving/orders.js') }}"></script>

@endsection
