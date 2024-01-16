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
                    <h3 class="card-title hedr-font">
                        إعتماد العقد رقم ({{ $id }}) من قبل
                        @if ($m == 3)
                        الموظف
                        @elseif ($m == 4)
                        المحاسب
                        @else
                        رئيس الصندوق
                        @endif
                        {{-- {{ $m == 3 ? 'الموظف':'' }} --}}
                    </h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        @include('alert.errors')
                    @endif
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form  action="{{ route('updatecontractOrder',3) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
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
                                                                    <input type="text" class="form-control" id="lastPurchasingValue" name="lastPurchasingValue" onfocusout="calc()" readonly
                                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="{{ $data->analyse[0]->lastPurchasingValue }}">
                                                                </div>
                                                                <div class="col-sm col-md">
                                                                    <label for="name" class="control-label">سعر البيع للموظف</label>
                                                                    <input type="text" class="form-control" id="salesPrice" name="salesPrice" readonly onfocus="calc2()" readonly
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
                                                                    <input type="text" class="form-control" id="dateFirstInstallment"
                                                                    name="dateFirstInstallment" placeholder="dd/mm/yyyy"  value="{{ $data->analyse[0]->dateFirstInstallment }}" readonly>
                                                                </div>
                                                                <div class="col">
                                                                    <label for="empid" class="control-label">القسط الأخير</label>
                                                                    <input type="text" class="form-control" id="dateLastInstallment" placeholder="dd/mm/yyyy" readonly
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
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-sm-3 col-md-3">
                                                                    <label for="installmentPeriod" class="control-label"> التوقيع على العقد </label>
                                                                    <select class="form-control border-primary select2-show-search form-select" id="signcontract" name="signcontract"
                                                                        onchange="showlink()" required>
                                                                        <option value="0">الرجاء إتخاذ قرار التوقيع</option>
                                                                        @foreach (active('Approval',NULL,['id','name']) as $period)
                                                                            <option value="{{ $period->id }}" id="rdoall" style="display: none"> {{ $period->name }} </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                {{-- <label style="font-size: 16px">
                                                                    <input type="checkbox" id="agree" name="agree" onchange="showlink()">
                                                                    <strong>
                                                                        {{ $m == 3? 'الموافقة علي التوقيع':'التوقيع على العقد' }}
                                                                    </strong>
                                                                </label> --}}
                                                            </div>
                                                            <br>
                                                                <input type="hidden" class="form-control" id="orderID" name="orderID" value="{{$data->id}}">
                                                                <input type="hidden" class="form-control" id="m" name="m" value="{{$m}}">
                                                                <div class="d-flex justify-content-center" id="btndiv">
                                                                    <button type="submit" id="savelink" class="btn btn-success" >توقيع العقد</button>
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

@endsection
