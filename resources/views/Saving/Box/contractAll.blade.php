@extends('layouts.wamy.wamy')
@section('css')
<style>
    @media print {
        #print_Button {
            display: none;
        }
    }
    .contractBox{
        font-family: 'Tajawal', sans-serif;
        margin-top: 10px;
    }
    .contractBox label{
        font-size: 17px;
        font-weight: bold;
    }
    .contractBox .signbox{
        /* display: flex;
        flex-direction: column;
        justify-content:flex-end;
        align-content:flex-start;
        align-items:center */
    }
    .contractBox .signbox img{
        width: 5%;
    }
    .contractBox .signbox th{
        font-size: 18px;
        font-weight: bold;
    }
    .contractTable{
        font-family: 'Tajawal', sans-serif;
        font-size: 16px;
        text-align: center;
    }
    .contractTable .tit{
        font-weight: bold;

    }
    .contractTable td{
        border: 0.5px solid ;
    }
    .contract-footer{
        margin-bottom: 0;
    }
    .contract-title{
        text-align: center;
        font-family: 'Tajawal', sans-serif;
    }
</style>
@endsection
@section('title')
    <title>عقد إشتراك صندوق الإدخار - الندوة العالمية للشباب الإسلامي</title>
@endsection
@section('content')
<div class="mb-5"></div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title hedr-font">عقد إشتراك صندوق الإدخار</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        @include('alert.errors')
                    @endif
                    <div class="row">
                        <div class="col-md-12 col-xl-12">
                            <div class=" main-content-body-invoice"  >
                                @if (count($savings) <= 0)
                                    <div class="card bd-0 mg-b-20 bg-danger">
                                        <div class="card-body text-white">
                                            <div class="main-error-wrapper">
                                                <i class="si si-close mg-b-20 tx-50"></i>
                                                <h4 class="mg-b-0">تكرماً قم بتسجيل بيناتك اولاَ</h4>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    @foreach ($savings as $item)
                                        <div class="card card-invoice" id="print">
                                            <div class="card-body">
                                                <div class="invoice-header">
                                                    <div class="billed-from">
                                                        <img style="width: 100%" src="{{ getImage('Reports\1.jpg')}}" alt="">
                                                        {{-- <img src="{{ asset('assets\img\contract\header.jpg') }}" alt=""> --}}
                                                    </div>
                                                </div>
                                                <div style="margin-bottom: 100px"></div>
                                                <div class="contract">
                                                    <div class="contract-title">
                                                        <h1>صندوق الإدخـــــار</h1>
                                                        <h4>عقد إشتراك</h4>
                                                    </div>

                                                    <table class="table contractTable">
                                                        <tbody>
                                                            <tr>
                                                                <td class="tit">رقم العضوية</td>
                                                                <td>{{ $item->empno }}</td>
                                                                <td class="tit">الإسم</td>
                                                                <td>{{ $item->employee->name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="tit">تاريخ التعين</td>
                                                                <td>{{ $item->employee->startdate }}</td>
                                                                <td class="tit">الراتب</td>
                                                                <td>{{  number_format($item->employee->salary,2) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="tit">تاريخ الإشتراك</td>
                                                                <td>{{ $item->datePremium }}</td>
                                                                <td class="tit">قسط الاشتراك </td>
                                                                <td>{{  number_format($item->premium,2) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="tit">المساهمة</td>
                                                                <td>{{ $item->contribute ?  number_format($item->contribute,2) : 'لاتوجد'  }}</td>
                                                            </tr>
                                                        </tbody>

                                                    </table>
                                                    <div class="contractBox">
                                                        <div>
                                                            <label>إقرار</label>
                                                            <p>
                                                                أقر بأنني قد فوضت مجلس إدارة صندوق الادخار بأن تخصم قسطاً شهرياً بقيمة المبلغ
                                                                المذكور إعلاه من الراتب وتحوله لحساب صندوق الادخار في الندوة العالمية للشباب
                                                                الإسلامي لادخاره واستثماره باسمي وفقاً للائحة الصندوق. كما أقر بأني اطلعت على لائحة
                                                                صندوق الادخار وتفهمت جميع بنودها وقبلت التعامل بموجبها في جميع معاملاتي ومستحقاتي
                                                                حالياً ومستقبلاً، وفي حال رغبتي الانسحاب من الصندوق فإني التزم بإبلاغ مجلس إدارة
                                                                الصندوق كتابياً بذلك قبل شهرين من التاريخ المحدد لانسحابي من الصندوق. وفي حال وجود
                                                                أي مستحقات مسجلة علي لصالح صندوق الادخار فإني أفوض الندوة بأن تخصم هذه المستحقات من
                                                                مرتبي أو أية مستحقات أخرى.
                                                            </p>
                                                        </div>
                                                        <br><br>
                                                        <div>
                                                            <table class="table">
                                                                <tbody class="signbox">
                                                                            <tr>
                                                                                <th scope="row">الإسم :</th>
                                                                                <th>{{ $item->employee->name }}</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">التوقيع :</th>
                                                                                <td><img src="{{ getImage('Signature/'. $item->signature)}}" alt=""></td>
                                                                            </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <hr class="mg-b-40">
                                                    {{-- <a class="btn btn-purple float-left mt-3 mr-2" href="">
                                                        <i class="mdi mdi-currency-usd ml-1"></i>Pay Now
                                                    </a>
                                                    <a href="#" class="btn btn-danger float-left mt-3 mr-2">
                                                        <i class="mdi mdi-printer ml-1"></i>Print
                                                    </a> --}}
                                                    <button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()"> <i
                                                            class="mdi mdi-printer ml-1"></i>طباعة</button>
                                                    {{-- <a href="#" class="btn btn-success float-left mt-3">
                                                        <i class="mdi mdi-telegram ml-1"></i>Send Invoice
                                                    </a> --}}
                                                </div>
                                                <div style="margin-bottom: 180px"></div>
                                                <div class="contract-footer">
                                                    <img style="width: 100%" src="{{ getImage('Reports\2.jpg')}}" alt="">
                                                </div>
                                            </div>

                                        </div>
                                    @endforeach
                                @endif

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
        function printDiv() {
            let printContents = document.querySelectorAll('#print'),
            originalContents = document.body.innerHTML;
            for (let n = 0; n < printContents.length; n++) {
                document.body.innerHTML = printContents[n].innerHTML;
                window.print();
            }
            /* var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload(); */
        }
    </script>
@endsection


