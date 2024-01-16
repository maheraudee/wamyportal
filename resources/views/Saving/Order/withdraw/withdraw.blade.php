@extends('layouts.wamy.wamy')
@section('css')
@endsection
@section('title')
    <title>سحب/إنسحاب - الندوة العالمية للشباب الإسلامي</title>
@endsection
@section('content')
<div class="mb-5"></div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title hedr-font">سحب/إنسحاب من الصندوق</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        @include('alert.errors')
                    @endif

                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('withdraws.store') }}" method="post" >
                                            {{ csrf_field() }}
                                        @foreach ($savings as $data)
                                            <div class="row">
                                                <div class="col">
                                                    <label for="empno" class="control-label"> الرقم الوظيفي </label>
                                                    <input type="text" class="form-control" id="empno" name="empno" readonly value="{{ $data->employee->empno }}">
                                                </div>
                                                <div class="col-sm col-md">
                                                    <label for="name" class="control-label">الإسم</label>
                                                    <input type="text" class="form-control" id="name" name="name" readonly
                                                        value="{{ $data->employee->name }}">
                                                </div>
                                                <div class="col-sm col-md">
                                                    <label for="department" class="control-label">الإدارة</label>
                                                    <input type="text" class="form-control" id="department" name="department" disabled
                                                        value="{{ $data->employee->department }}">
                                                </div>
                                                <div class="col-sm col-md">
                                                    <label for="section" class="control-label">القسم</label>
                                                    <input type="text" class="form-control" id="section" name="section" disabled
                                                        value="{{ $data->employee->section }}">
                                                </div>
                                            </div>
                                        @endforeach
                                        <br>
                                        <div class="row">
                                            <div class="col-sm col-md">
                                                <label for="witype " class="control-label"> نوع الطلب </label>
                                                <select class="form-control font-16" name="witype" id="witype" onchange="changetypeorder()" required>
                                                    <option>الرجاء إختيار نوع الطلب</option>
                                                    <option value="1">سحب جزء من الرصيد</option>
                                                    <option value="2">كامل الرصيد مع بقاء الإشتراك</option>
                                                    <option value="3">إنسحاب نهائي</option>
                                                </select>
                                            </div>
                                            <div class="col-sm col-md">
                                                <label for="amnt" class="control-label"> المبلغ </label>
                                                <input type="text" class="form-control form-control-lg" id="amnt"  name="amnt"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                                <label for="amnt" class="control-label" style="color:red"> {{EmpBalance(EmpNo()) ? 'رصيدك المتوقع هو  '.EmpBalance(EmpNo()) : ''}} </label>
                                            </div>
                                            <div class="col-sm col-md">
                                                <label for="endService" class="control-label"> نهاية الخدمة </label>
                                                <input type="text" class="form-control form-control-lg" id="endService"  name="endService" value="{{ $endService ? $endService[0] : 'لا تتوفر بيانات'}}"
                                                readonly oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                                <input type="hidden" class="form-control form-control-lg" id="hr"  name="hr" value="{{ $hr ? $hr[0] : 0 }}"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" readonly>
                                                <input type="hidden" class="form-control form-control-lg" id="box"  name="box" value="{{ $box ? $box[0] :  0 }}"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" readonly>
                                            </div>
                                        </div>
                                        <br>
                                        {{-- <div class="row">
                                            <div class="col-sm col-md">
                                                <label for="hr " class="control-label"> إستقطاع شؤون الموظفين</label>
                                                <input type="hidden" class="form-control form-control-lg" id="hr"  name="hr" value="{{ $hr ? $hr[0] : 0 }}"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" readonly>
                                            </div>
                                            <div class="col-sm col-md">
                                                <label for="box" class="control-label"> إستقطاع صندوق الإدخار </label>
                                                <input type="hidden" class="form-control form-control-lg" id="box"  name="box" value="{{ $box ? $box[0] :  0 }}"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" readonly>
                                            </div>
                                        </div> --}}
                                        <br>
                                        <h5 class="text-center">الإلتزمات</h5>
                                        <hr>
                                        <div class="row">
                                            <div class="col">
                                                <label for="debtFurniture" class="control-label">مديونية أجهزة واثاث</label>
                                                <input type="text" class="form-control" id="debtFurniture" name="debtFurniture">
                                            </div>
                                            <div class="col">
                                                <label for="debtCar" class="control-label"> مديونية سيارات</label>
                                                <input type="text" class="form-control" id="debtCar" name="debtCar">
                                            </div>
                                            <div class="col">
                                                <label for="anothSponosr" class="control-label">مبلغ كفالة موظف آخر</label>
                                                <input type="text" class="form-control" id="anothSponosr" name="anothSponosr">

                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm col-md">
                                                <label for="comitbank " class="control-label"> هل لديك إلتزامات مع أحد البنوك ؟ </label>
                                                <select class="form-control font-16" name="comitbank" id="comitbank" onchange="changecomitbank()" required>
                                                    <option>الرجاء إختيار</option>
                                                    <option value="1">نعم</option>
                                                    <option value="2">لا</option>
                                                </select>
                                            </div>
                                            <div class="col-sm col-md" id="comitbankdiv" style="display: none">
                                                <label for="comitbankamt" class="control-label">الرصيد المتبقي من الإلتزام</label>
                                                <input type="text" class="form-control form-control-lg" id="comitbankamt"  name="comitbankamt"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm col-md">
                                                <label for="comitanthor" class="control-label"> هل لديك إلتزامات آخرى ؟ </label>
                                                <select class="form-control font-16" name="comitanthor" id="comitanthor" onchange="changecomitanthor()" required>
                                                    <option>الرجاء إختيار</option>
                                                    <option value="1">نعم</option>
                                                    <option value="2">لا</option>
                                                </select>
                                            </div>
                                            <div class="col-sm col-md" id="comitanthordiv" style="display: none">
                                                <label for="comitanthoramt" class="control-label">الرصيد المتبقي من الإلتزام</label>
                                                <input type="text" class="form-control form-control-lg" id="comitanthoramt"  name="comitanthoramt"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                            </div>
                                        </div>
                                        <br>
                                        <br><br>
                                        <div class="row" id="labeldiv" style="display: none">
                                            <label style="font-size: 18px ">
                                                <span id="label" style="color:red"></span>
                                            </label>
                                            <br><br>
                                        </div>
                                        <br><br>
                                        <div class="row">
                                            <label style="font-size: 18px ">
                                                <input type="checkbox" id="agree" name="agree" onchange="showlink()">
                                                <strong>
                                                    تم إخطاري من قبل مجلس إدارة الصندوق بأنه في حالة (سحب رصيد / إنسحاب) خلال الأشهر الستة الأولى من العام لا يحتسب لها أرباح ، وكذلك إذا تم السحب في الأشهر الستة الأخيرة من العام لا يحتسب لها أرباح.
                                                </strong>
                                            </label>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm col-md">
                                                <h5 class="card-title">التوقيع</h5>
                                                {{-- @if ($signature->signature == 'defualt.png') --}}
                                                @if ($signature[0] == 'defualt.png')
                                                    <p class="text-danger">* صيغة المرفق jpeg ,.jpg , png </p>
                                                    <div class="col-sm-12 col-md-12">
                                                        <input type="file" name="signature" class="dropify"
                                                            accept=".jpg, .png, image/jpeg, image/png" data-height="70" required/>
                                                    </div>
                                                @else
                                                    <img name="signature" style="width: 10%" src="{{getImage('Signature/'.Signature(EmpNo())) }}" alt="Sign">
                                                    {{-- <img name="signature" style="width: 10%" src="{{getImage('Signature/'.$signature[0]) }}" alt="Sign"> --}}
                                                    {{-- <img name="signature" style="width: 10%" src="{{ asset('public/storage/Signature/'.$signature[0]/* ->signature */) }}" alt="Sign"> --}}
                                                @endif
                                            </div>
                                        </div>
                                        <br><br>
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" id="savelink" class="btn btn-primary" style="display: none">تقديم الطلب</button>
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
        function showlink() {
            let check = document.getElementById('agree').checked,
                savebtn = document.getElementById('savelink');
                if (check === true) {
                        savebtn.style.display = "block";
                    } else {
                        savebtn.style.display = "none";
                    }
        }

        function changetypeorder() {
            const orderTypselect = document.getElementById('witype').value,
            labeldiv = document.getElementById('labeldiv'),
            label = document.getElementById('label');

            if (orderTypselect == 1) {
                labeldiv.style.display = "flex";
                label.innerHTML = "أرغب بسحب المبلغ المذكور من رصيد اشتراكي في صندوق الإدخار مع بقاء اشتراكي في الصندوق";

            }else if(orderTypselect == 2){
                labeldiv.style.display = "flex";
                label.innerHTML = "أرغب بسحب رصيد اشتراكي كاملاً من صندوق الإدخار مع بقاء اشتراكي في الصندوق";
            }else if(orderTypselect == 3){
                labeldiv.style.display = "flex";
                label.innerHTML = "أرغب الإنسحاب من صندوق الادخار وبهذا اتقدم لسعادتكم بطلب تصفية مستحقاتي لدى الصندوق نهائياً، كما أقر بموافقتي علي خصم أي مبالغ مسجلة علي لصالح الصندوق من مستحقاتي في الصندوق وافوض الندوة في حال تطلب الأمر بأن تخصم هذه المستحقات من مرتبي أو أية مستحقات أخرى.";
            }else{
                labeldiv.style.display = "none";
            }
        }


        function changecomitbank() {
            const comitbank = document.getElementById('comitbank').value,
            comitbankdiv = document.getElementById('comitbankdiv');
            if (comitbank == 1) {
                comitbankdiv.style.display = "block";
            }else if(comitbank == 2){
                comitbankdiv.style.display = "none";
            }else{
                comitbankdiv.style.display = "none";
            }
    }
        function changecomitanthor() {
            const comitanthor = document.getElementById('comitanthor').value,
            comitanthordiv = document.getElementById('comitanthordiv');
            if (comitanthor == 1) {
                comitanthordiv.style.display = "block";
            }else if(comitanthor == 2){
                comitanthordiv.style.display = "none";
            }else{
                comitanthordiv.style.display = "none";
            }
    }
    </script>
@endsection
