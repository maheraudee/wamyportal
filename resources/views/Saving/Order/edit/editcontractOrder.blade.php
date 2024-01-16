@extends('layouts.wamy.wamy')
@section('css')
@endsection
@section('title')
    <title>بيانات العقد - الندوة العالمية للشباب الإسلامي</title>
@endsection
@section('content')
<div class="mb-5"></div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title hedr-font">تعديل بيانات العقد رقم ({{ $id }})</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        @include('alert.errors')
                    @endif
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form  action="{{ route('updatecontractOrder',2) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                                        {{ csrf_field() }}
                                        {{-- @method('PATCH') --}}

                                        <h4>بيانات الموظف</h4>
                                        @foreach ($orderData as $data)
                                            <div class="row">
                                                <div class="col">
                                                    <label for="empno" class="control-label"> الرقم الوظيفي </label>
                                                    <input type="text" class="form-control" id="empno" name="empno" readonly
                                                        value="{{ $data->empno }}">
                                                </div>
                                                <div class="col-sm col-md">
                                                    <label for="name" class="control-label">الإسم</label>
                                                    <input type="text" class="form-control" id="name" name="name" readonly
                                                        value="{{ $data->emporder->name }}">
                                                </div>
                                                <div class="col-sm col-md">
                                                    <label for="department" class="control-label">الإدارة</label>
                                                    <input type="text" class="form-control" id="department" name="department" disabled
                                                        value="{{ $data->emporder->department }}">
                                                </div>
                                                <div class="col-sm col-md">
                                                    <label for="section" class="control-label">القسم</label>
                                                    <input type="text" class="form-control" id="section" name="section" disabled
                                                        value="{{ $data->emporder->section }}">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm col-md">
                                                    <label for="" class="control-label">جوال</label>
                                                    <input type="text" class="form-control" id="mobile" name="mobile" readonly
                                                        value="{{ $data->emporder->mobile }}">
                                                </div>
                                                <div class="col-sm col-md">
                                                    <label for="nationality" class="control-label">الجنسية</label>
                                                    <input type="text" class="form-control" id="nationality" name="nationality" disabled
                                                        value="{{ $data->emporder->nationality }}">
                                                </div>
                                                <div class="col-sm col-md">
                                                    <label for="cardid" class="control-label"> رقم بطاقة الأحوال/الإقامة </label>
                                                    <input type="text" class="form-control" id="cardid" name="cardid" readonly
                                                        value="{{ $data->emporder->cardid }}"
                                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                                </div>
                                                <div class="col-sm col-md">
                                                    <label for="salary" class="control-label">الراتب</label>
                                                    <input type="text" class="form-control" id="salary" name="salary" readonly
                                                        value="{{ $data->analyse[0]->empsalary }}"
                                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm col-md">
                                                    <label for="empid" class="control-label">اقساط سابقة للصندوق</label>
                                                    <input type="text" class="form-control" id="mobile" name="mobile" readonly
                                                        value="
                                                        @if ( $data->analyse[0]->empdebtFurniture > 0 || $data->analyse[0]->empdebtCar > 0)
                                                            نعم
                                                        @else
                                                            لا
                                                        @endif
                                                        ">
                                                </div>
                                                <div class="col-sm col-md">
                                                    <label for="empid" class="control-label">نوع القسط</label>
                                                    <input type="text" class="form-control" id="mobile" name="mobile" readonly
                                                        value="
                                                        @if ( $data->analyse[0]->empdebtFurniture > 0)
                                                            أجهزة وأثاث منزلي
                                                        @elseif ($data->analyse[0]->empdebtCar > 0)
                                                            سيارة
                                                        @endif
                                                        ">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row" >
                                                <h4>التحليل المالي للموظف</h4>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <label for="empid" class="control-label">الرصيد في الصندوق</label>
                                                                    <input type="text" class="form-control" id="balanceboxEmp" name="balanceboxEmp" readonly
                                                                        value="{{ $data->analyse[0]->empbalancebox }}">
                                                                </div>
                                                                <div class="col-sm col-md">
                                                                    <label for="name" class="control-label">نهاية الخدمة</label>
                                                                    <input type="text" class="form-control" id="endServiceEmp" name="endServiceEmp" readonly
                                                                        value="{{ $data->analyse[0]->empendService }}">
                                                                </div>
                                                                <div class="col-sm col-md">
                                                                    <label for="empid" class="control-label">مدة التقسيط</label>
                                                                    <input type="hidden" class="form-control" id="installmentPeriod" name="installmentPeriod" value="{{ $data->installmentPeriod }}" readonly>
                                                                    <input type="text" class="form-control" id="installmentPeriodName" name="installmentPeriodName" value="{{ $data->period->name }}"  readonly>
                                                                </div>
                                                                <div class="col-sm col-md">
                                                                    <label for="empid" class="control-label">نوع الطلب</label>
                                                                    <input type="text" class="form-control" id="typeorder" name="typeorder" value="{{$data->ordertyp->name}}" readonly>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-sm-10 col-md-10">
                                                                    <label for="empid" class="control-label">الوصف</label>
                                                                    <input type="text" class="form-control" id="orderdesc" name="orderdesc" value="{{ $data->orderdesc}}">
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <label for="empid" class="control-label">القيمة الشرائية</label>
                                                                    <input type="text" class="form-control" id="purchasingValue" name="purchasingValue" readonly
                                                                    value="{{ $data->purchasingValue }}">

                                                                </div>
                                                                <div class="col-sm col-md">
                                                                    <label for="empid" class="control-label">القيمة الشرائية الفعلية</label>
                                                                    <input type="text" class="form-control" id="lastPurchasingValue" name="lastPurchasingValue" onfocusout="calc()"
                                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="{{ $data->analyse[0]->lastPurchasingValue }}">
                                                                </div>
                                                                <div class="col-sm col-md">
                                                                    <label for="name" class="control-label">سعر البيع للموظف</label>
                                                                    <input type="text" class="form-control" id="salesPrice" name="salesPrice" readonly onfocus="calc2()"
                                                                        value="{{ $data->analyse[0]->salesPrice }}">
                                                                </div>
                                                                <div class="col-sm col-md">
                                                                    <label for="empid" class="control-label">القسط الشهري</label>
                                                                    <input type="text" class="form-control" id="monthlyInstallment" name="monthlyInstallment" readonly
                                                                        value="{{ $data->analyse[0]->monthlyInstallment }}">
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <label for="empid" class="control-label">القسط الأول</label>
                                                                    <input type="date" class="form-control" id="dateFirstInstallment"
                                                                    name="dateFirstInstallment" placeholder="dd/mm/yyyy"  value="{{ $data->analyse[0]->dateFirstInstallment }}">
                                                                </div>
                                                                <div class="col">
                                                                    <label for="empid" class="control-label">القسط الأخير</label>
                                                                    <input type="text" class="form-control" id="dateLastInstallment" placeholder="dd/mm/yyyy"
                                                                    name="dateLastInstallment" value="{{ $data->analyse[0]->dateLastInstallment }}">
                                                                </div>
                                                            </div>

                                                            <br>
                                                            @if ($data->invoices)
                                                                <div class="row">
                                                                    <div class="col ">
                                                                        <label for="empid" class="control-label">الفاتورة</label>
                                                                        <br>
                                                                        <table>
                                                                            <tr>
                                                                                @foreach ($data->invoices as $key => $invoice)
                                                                                    @if ($key <= 2)
                                                                                        <td class="text-center">
                                                                                            <iframe src="{{ getImage('Invoices/'.$data->id."/".$invoice->invoice) }}" style="width:335px; height:280px;" frameborder="0"></iframe>
                                                                                        </td>
                                                                                    @endif
                                                                                @endforeach
                                                                            </tr>
                                                                            <tr>
                                                                                @foreach ($data->invoices as $key => $invoice)
                                                                                    @if ($key <= 2)
                                                                                    <td class="text-center">
                                                                                        <a target="_blank" href="{{ getImage('Invoices/'.$data->id."/".$invoice->invoice) }}" class="btn btn-lg btn-blue">
                                                                                            <i class="mdi mdi-file-pdf fs-20 me-2"></i>
                                                                                            {{ \Illuminate\Support\Str::limit($invoice->invoice,30, $end = '...') }}
                                                                                        </a>
                                                                                    </td>
                                                                                    @endif
                                                                                @endforeach
                                                                            </tr>
                                                                            <hr>
                                                                            <tr>
                                                                                @foreach ($data->invoices as $key => $invoice)
                                                                                    @if ($key > 2)
                                                                                        <td class="text-center">
                                                                                            <iframe src="{{ getImage('Invoices/'.$data->id."/".$invoice->invoice) }}" style="width:335px; height:280px;" frameborder="0"></iframe>
                                                                                        </td>
                                                                                    @endif
                                                                                @endforeach
                                                                            </tr>
                                                                            <tr>
                                                                                @foreach ($data->invoices as $key => $invoice)
                                                                                    @if ($key > 2)
                                                                                    <td class="text-center">
                                                                                        <a target="_blank" href="{{ getImage('Invoices/'.$data->id."/".$invoice->invoice) }}" class="btn btn-lg btn-blue">
                                                                                            <i class="mdi mdi-file-pdf fs-20 me-2"></i>
                                                                                            {{ \Illuminate\Support\Str::limit($invoice->invoice,30, $end = '...') }}
                                                                                        </a>
                                                                                    </td>
                                                                                    @endif
                                                                                @endforeach
                                                                            </tr>
                                                                            <tr>
                                                                                @foreach ($data->invoices as $key => $invoice)
                                                                                    @if ($key > 5)
                                                                                        <td class="text-center">
                                                                                            <iframe src="{{ getImage('Invoices/'.$data->id."/".$invoice->invoice) }}" style="width:335px; height:280px;" frameborder="0"></iframe>
                                                                                        </td>
                                                                                    @endif
                                                                                @endforeach
                                                                            </tr>
                                                                            <tr>
                                                                                @foreach ($data->invoices as $key => $invoice)
                                                                                    @if ($key > 5)
                                                                                    <td class="text-center">
                                                                                        <a target="_blank" href="{{ getImage('Invoices/'.$data->id."/".$invoice->invoice) }}" class="btn btn-lg btn-blue">
                                                                                            <i class="mdi mdi-file-pdf fs-20 me-2"></i>
                                                                                            {{ \Illuminate\Support\Str::limit($invoice->invoice,30, $end = '...') }}
                                                                                        </a>
                                                                                    </td>
                                                                                    @endif
                                                                                @endforeach
                                                                            </tr>

                                                                        </table>




                                                                    </div>
                                                                </div>
                                                                <br><br>
                                                            @endif
                                                            <div class="row">
                                                                <div class="col ">
                                                                    <label for="empid" class="control-label">إضافة فواتير آخرى</label>
                                                                    <p class="text-danger">* صيغة المرفق pdf </p>
                                                                    <input type="file" name="newinvoices[]" class="dropify" multiple accept=".pdf" data-height="70"/>
                                                                </div>
                                                            </div>
                                                            <br>
                                                                <input type="hidden" class="form-control" id="orderID" name="orderID" value="{{$data->id}}">
                                                                <div class="d-flex justify-content-center">
                                                                    <button type="submit" id="savelink" class="btn btn-success">تعديل العقد</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

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
    </div>

@endsection
@section('js')
<script>
    function calc() {
        let purchasingValue = document.getElementById('purchasingValue').value,
        lastPurchasingValue = document.getElementById('lastPurchasingValue').value,

        salesPrice = document.getElementById('salesPrice'),
        monthlyInstallment = document.getElementById('monthlyInstallment'),
        installmentPeriod = document.getElementById('installmentPeriod').value,
        typeorder = document.getElementById('typeorder').value,
        year,monthValue;

        if (parseInt(lastPurchasingValue) <= parseInt(purchasingValue)) {

            /* if(installmentPeriod == 'سنة'){ year = 1; }else if(installmentPeriod == 'سنتان'){year = 2;}else if(installmentPeriod == 'ثلاث سنوات'){year = 3;}
            else if(installmentPeriod == 'أربع سنوات'){year = 4;}else if(installmentPeriod == 'خمس سنوات'){year = 5;} */
            year = installmentPeriod;

            if (typeorder == 'أجهزة وأثاث منزلي') {
                if (year == 1) {
                    salesPrice.value = parseFloat(lastPurchasingValue) * 0.1 + parseFloat(lastPurchasingValue);
                    monthValue =  parseFloat(salesPrice.value) / 12;
                    monthlyInstallment.value = monthValue.toFixed(2);
                }else if (year == 2) {
                    salesPrice.value = parseFloat(lastPurchasingValue) * 0.2 + parseFloat(lastPurchasingValue);
                    monthValue =  parseFloat(salesPrice.value) / 24;
                    monthlyInstallment.value = monthValue.toFixed(2);
                }
            } else if (typeorder == 'سيارة') {
                if (year == 1) {
                    salesPrice.value = parseFloat(lastPurchasingValue) * 0.5 + parseFloat(lastPurchasingValue);
                    monthlyInstallment.value =  parseFloat(salesPrice.value) / 12;
                }else if (year == 2) {
                    salesPrice.value = parseFloat(lastPurchasingValue) *  0.10 + parseFloat(lastPurchasingValue);
                    monthlyInstallment.value =  parseFloat(salesPrice.value) / 24;
                }else if (year == 3) {
                    salesPrice.value = parseFloat(lastPurchasingValue) * 0.15 + parseFloat(lastPurchasingValue);
                    monthlyInstallment.value =  parseFloat(salesPrice.value) / 36;
                }else if (year == 4) {
                    salesPrice.value = parseFloat(lastPurchasingValue) *0.20 + parseFloat(lastPurchasingValue);
                    monthlyInstallment.value =  parseFloat(salesPrice.value) / 48;
                }else if (year == 5) {
                    salesPrice.value = parseFloat(lastPurchasingValue) * 0.25 + parseFloat(lastPurchasingValue);
                    monthlyInstallment.value =  parseFloat(salesPrice.value) / 60;
                }

            }
        } else {
            alert('القيمة المدخلة أكير من القيمة الشرائية');
        }
    }
    function calc2() {
        let purchasingValue = document.getElementById('purchasingValue').value,
        lastPurchasingValue = document.getElementById('lastPurchasingValue').value,
        lastPurchasingValue2 = document.getElementById('lastPurchasingValue');
        if (lastPurchasingValue2.value > purchasingValue) {
            lastPurchasingValue2.focus();
        }
    }

    function add_years(dt,n)
    {
        /* return setFullYear(dt.getFullYear() + n); */
        return new Date(dt.setFullYear(dt.getFullYear() + n));
    }

    function changeDate() {
        let dateFirstInstallment = document.getElementById('dateFirstInstallment').value,
        dateLastInstallment  = document.getElementById('dateLastInstallment'),
        installmentPeriod = document.getElementById('installmentPeriod').value,
        year;

        /* if(installmentPeriod == 'سنة'){ year = 1; }else if(installmentPeriod == 'سنتان'){year = 2;}else if(installmentPeriod == 'ثلاث سنوات'){year = 3;}
        else if(installmentPeriod == 'أربع سنوات'){year = 4;}
        else if(installmentPeriod == 'خمس سنوات'){year = 5;} */

        year = installmentPeriod;

        dt = new Date(dateFirstInstallment);

        /* newDate =    add_years(dt, year); */
        newDate =    add_years(dt, year).toLocaleDateString();


        /* alert(newDate); */

        dateLastInstallment.value = newDate;


    }
</script>
@endsection
