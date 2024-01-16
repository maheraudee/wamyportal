@extends('layouts.wamy.wamy')
@section('css')
@endsection
@section('title')
    <title>تحديث بيانات إشتراك الصندوق - الندوة العالمية للشباب الإسلامي</title>
@endsection
@section('content')
<div class="mb-5"></div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title hedr-font">تحديث بيانات إشتراك الصندوق</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        @include('alert.errors')
                    @endif

                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form id="updateSavings" action="{{ route('savings.update',1) }}"
                                        method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                                        {{ csrf_field() }}
                                        @method('PATCH')
                                        @foreach ($savings as $saving)
                                            <div class="row">
                                                <div class="col">
                                                    <label for="empno" class="font-16">الرقم الوظيفي</label>
                                                    <input type="text" class="form-control font-16" id="empno" name="empno" readonly
                                                        value="{{ $saving->empno }}">
                                                </div>
                                                <div class="col-sm col-md">
                                                    <label for="name" class="font-16">الإسم</label>
                                                    <input type="text" class="form-control font-16" id="name" name="name" readonly
                                                        value="{{ $saving->employee->name }}">
                                                </div>
                                                <div class="col-sm col-md">
                                                    <label for="participationType" class="font-16">تاريخ التعيين</label>
                                                    <input class="form-control fc-datepicker font-16" name="participationType"
                                                        placeholder="YYYY-MM-DD" type="text"
                                                        value="{{ $saving->employee->startdate }}" readonly>
                                                </div>
                                                <div class="col-sm col-md">
                                                    <label for="salary" class="font-16">الراتب</label>
                                                    <input type="text" class="form-control font-16" id="salary" name="salary" readonly
                                                        value="{{ $saving->employee->salary }}"
                                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">

                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm col-md">
                                                    <label for="participationType" class="control-label font-16">نوع الإشتراك</label>
                                                    <select name="participationType" id="participationType" class="form-control font-16" readonly>
                                                        <option value="2">تحديث</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm col-md">
                                                    <label for="premium" class="control-label font-16">مبلغ قسط الإشتراك</label>
                                                    <input type="text" class="form-control form-control-lg font-16 @error('premium') is-invalid @enderror"
                                                        id="premium" name="premium" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                        value="{{$saving->premium}}" required>
                                                    @error('premium')
                                                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6 col-md-6" id="contributediv" {{-- style="display: none" --}}>
                                                    <label for="contribute" class="control-label font-16">مبلغ المساهمة</label>
                                                    <input type="text" class="form-control form-control-lg font-16 @error('contribute') is-invalid @enderror" id="contribute" name="contribute"
                                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                        placeholder="0" onfocusout="checkAmount()" value="{{$saving->contribute}}">
                                                    <label style="color: red; font-weight: bold">يشترط ان لا يقل مبلغ المساهمة عن خمسة الآلآف ريال</label>
                                                    @error('contribute')
                                                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                                    @enderror

                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="row">
                                                <div class="col-sm col-md">
                                                    <h5 class="card-title">التوقيع</h5>
                                                    <div class="row">
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
                                                        {{-- @if ($saving->signature)
                                                            <div class="col-sm-6 col-md-6">
                                                                <img name="signature2" src="{{getImage('Signature/'.$saving->signature)}}" alt="لايوجد توقيع" style="width: 20%">
                                                            </div>
                                                            <div class="col-sm-6 col-md-6">
                                                                <p class="text-danger">* صيغة المرفق jpeg ,.jpg , png </p>
                                                                <p class="text-danger">لتعديل التوقيع الرجاء إرفاق صورة هنا</p>
                                                                <input type="file" name="signature" class="dropify"
                                                                    accept=".jpg, .png, image/jpeg, image/png" data-height="70" />
                                                                <input type="hidden" name="signaturefile" value="{{$saving->signature}}"/>
                                                            </div>
                                                        @else
                                                            <div class="col-sm-6 col-md-6">
                                                                <p class="text-danger">* صيغة المرفق jpeg ,.jpg , png </p>
                                                                <p class="text-danger">لتعديل التوقيع الرجاء إرفاق صورة هنا</p>
                                                                <input type="file" name="signature" class="dropify"
                                                                    accept=".jpg, .png, image/jpeg, image/png" data-height="70" />
                                                            </div>
                                                        @endif --}}


                                                    </div>

                                                </div>
                                            </div>
                                            <br><br>
                                            <div class="row">
                                                <label style="font-size: 16px">
                                                    <input type="checkbox" id="agree" onchange="showlink()" >
                                                    <strong>
                                                        أقر بأنني قد فوضت مجلس إدارة صندوق الادخار للعاملين في الندوة العالمية للشباب الإسلامي بأن يخصم قسطاً شهرياً بقيمة المبلغ
                                                        المذكور أعلاه من الراتب بتاريخ 25 من كل شهر ميلادي ويحوله لحساب الصندوق لادخاره واستثماره باسمي وفقاً للائحة الصندوق.
                                                        كما أقر بأني اطلعت على لائحة الصندوق وتفهمت جميع بنودها وقبلت التعامل
                                                        بموجبها في جميع معاملاتي ومستحقاتي حالياً ومستقبلاً، وفي حال رغبتي الانسحاب من
                                                        الصندوق فإني التزم بإبلاغ مجلس إدارة الصندوق كتابياً بذلك قبل شهرين من التاريخ
                                                        المحدد لانسحابي من الصندوق. وفي حال وجود أي مستحقات مسجلة علي لصالح صندوق
                                                        الادخار فإني أفوض الندوة بأن تخصم هذه المستحقات من مرتبي أو أية مستحقات أخرى.
                                                    </strong>
                                                    <br><br>

                                                    <div id="iqrar" style="display: none; color:red">
                                                        <h4 >* شروط المساهمة: </h4>
                                                        <strong >
                                                                1-	آخر موعد لسداد مبلغ المساهمة يوم 2020/12/28 إما بشيك أو حوالة لحساب الندوة العالمية للشباب الإسلامي بمصرف الراجحي رقم الآيبان (SA1380000279608010666422) أو توريدها في صندوق المالية.
                                                                <br>
                                                                2- لايحق للمساهم سحب مبلغ مساهمته حتى نهاية السنة المالية التي تبدأ في 2021/01/01 , ويجوز إستثناءاً بعد موافقة مجلس إدارة الصندوق سحب 50% من أصل المساهمة بعد مضي النصف الاول من السنة على أن يكون الصرف, خلال شهرين من تاريخ تقديم الطلب.
                                                        </strong>
                                                    </div>
                                                </label>
                                            </div>
                                            <br>
                                        @endforeach
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" id="savelink" class="btn btn-primary" style="display: none;">تحديث</button>
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
<script>
    var date = $('.fc-datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    }).val();

    $(document).ready(function() {
        var contributeselect = document.getElementById('contributeselect').value,
        iqrar = document.getElementById('iqrar');
        if (contributeselect == 2) {
            iqrar.style.display = "block";
        }else{
            iqrar.style.display = "none";
        }
    });
    function validateForm() {
        /* let premium = document.getElementById('premium').value,
            sal = document.getElementById('salary').value,
            agreem = document.getElementById('agree-m'),
            amount = sal * 0.5,
            amount2 = sal * 0.05;
            console.log("Hi");
        if (premium < amount2) {
            alert("يجب ان يكون المبلغ أكبر من 5% من إجمالي الراتب");
            return false;
        }
        if (premium > amount) {
            alert("يجب ان يكون المبلغ أصغر من 50% من إجمالي الراتب");
            return false;
        } */
    }
    function checkAmount()
    {
        var contribute = document.getElementById('contribute').value,
        amount = document.getElementById('contribute');
        if (contribute < 4999) {
            alert('يشترط ان لا يقل مبلغ المساهمة عن خمسة الآلآف ريال');
            contribute = "0";
            amount.focus();
            return false;
        }
    }
    function showlink() {
        var check = document.getElementById('agree').checked,
            savebtn = document.getElementById('savelink');
        if (check === true) {
            savebtn.style.display = "block";
        } else {
            savebtn.style.display = "none";
        }
    }

    /* function contribut() {
        var contributeselect = document.getElementById('contributeselect').value,
            contributediv = document.getElementById('contributediv'),
            iqrar = document.getElementById('iqrar');
        if (contributeselect == 2) {
            contributediv.style.display = "block";
            iqrar.style.display = "block";
        } else {
            contributediv.style.display = "none";
            iqrar.style.display = "none";
        }
    } */

</script>
@endsection


