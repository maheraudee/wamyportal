@extends('layouts.wamy.wamy')
@section('css')
    <link
        href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@1,400;1,700&family=Tajawal:wght@400;700;800;900&display=swap"
        rel="stylesheet">
    <style>
        .tit-padd{
            padding: 0 20px;
        }
        table,table td{
            border: 2px solid #adb5bd;
        }
        @media print {
            #print_Button {
                display: none;
            }
            #print{
                border: 1px solid black;
            }
            .spacess{
                /* margin-bottom: 350px; */
            }
            @page {
                /* size: auto; */
                margin: 0;
            }
        }

    </style>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('menu.savings') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    عقد بيع</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm" >
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice"  >
                @if (count($orderData) <= 0)
                <div class="card bd-0 mg-b-20 bg-danger">
                    <div class="card-body text-white">
                        <div class="main-error-wrapper">
                            <i class="si si-close mg-b-20 tx-50"></i>
                            <h4 class="mg-b-0">تكرماً قم بتسجيل بيناتك اولاَ</h4>
                        </div>
                    </div>
                </div>
                @else
                    <div class="card card-invoice" id="print">
                        <div class="card-header" style="height: 200px;">
                            <img style="width: 100%; height: 100%;" src="{{URL::asset('public/assets/MyImages/Reports/1.jpg')}}" alt="header">
                            {{-- <img style="width: 100%; height: 100%;" src="{{ URL::asset('public/assets/img/media/login.jpg') }}" alt="header"> --}}
                        </div>
                        <div class="card-body" style="margin-top: -30px;">
                            <div class="contract">
                                <div class="contract-title">
                                    <h1>صندوق الإدخـــــار</h1>
                                    <h2>عقد بيع</h2>
                                </div>
                                <div class="contract-title text-center">
                                    <h3>
                                        رقم العقد
                                        ({{$id}})
                                    </h3>
                                </div>
                                <h4 class="tit-padd">1- بيانات الموظف</h4>
                                <table class="table contractTable ">
                                    <tbody>
                                        @foreach ($orderData as $data)
                                            <tr class="border-black font-14 text-center">
                                                <td class="mylable" >الإسم رباعي</td>
                                                <td class="mylable-form" id="empName">{{ $data->emporder->name }}</td>
                                                <td class="mylable">الجنسية</td>
                                                <td class="mylable-form">{{ $data->emporder->nationality }}</td>
                                                <td class="mylable">الرقم الوظيفي</td>
                                                <td class="mylable-form">{{ $data->empno }}</td>
                                            </tr>
                                            <tr class="font-14 text-center">
                                                <td class="mylable">رقم بطاقة الاحوال / الإقامة</td>
                                                <td class="mylable-form">{{ $data->emporder->cardid }}</td>
                                                <td class="mylable">الإدارة</td>
                                                <td class="mylable-form">{{ $data->emporder->department }}</td>
                                                <td class="mylable">القسم</td>
                                                <td class="mylable-form">{{ $data->emporder->section }}</td>
                                            </tr>
                                            <tr class="font-14 text-center">
                                                <td class="mylable">الراتب</td>
                                                <td>{{ number_format($data->emporder->salary,2) }}</td>
                                                <td class="mylable">جوال </td>
                                                <td>{{ $data->emporder->mobile }}</td>
                                                <td class="mylable">اقساط سابقة للصندوق</td>
                                                <td>  @if ( $data->empdebtFurniture > 0 || $data->empdebtCar > 0)
                                                    نعم @else لا @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <h4 class="tit-padd">2- التحليل المالي للموظف</h4>
                                <table class="table contractTable">
                                    <tbody>
                                        @foreach ($orderData as $data)
                                        <tr class="font-14 text-center">
                                            <td class="mylable">تاريخ العقد</td>
                                            <td>{{ date('Y/m/d', strtotime($data->updated_at)) }}</td>
                                            <td class="mylable">النوع</td>
                                            <td>{{ $data->ordertyp->name }}</td>
                                            {{-- <td class="mylable">الكمية</td>
                                            <td>{{ $data->Qty }}</td> --}}
                                            <td class="mylable">وصف الصنف</td>
                                            <td>{{ $data->orderdesc }}</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        {{-- <tr class="font-14 text-center">
                                            <td class="mylable">تاريخ العقد</td>
                                            <td>{{ date('Y/m/d', strtotime($data->updated_at)) }}</td>
                                        </tr> --}}
                                        <tr class="font-14 text-center">
                                            <td class="mylable">الرصيد في الصندوق</td>
                                            <td>{{ number_format($data->analyse[0]->empbalancebox,2) }}</td>
                                            <td class="mylable">نهاية الخدمة</td>
                                            <td>{{ number_format($data->analyse[0]->empendService,2) }}</td>
                                            <td class="mylable">القيمة الشرائية</td>
                                            <td>{{ number_format($data->analyse[0]->purchasingValue,2) }}</td>
                                            <td class="mylable">سعر البيع للموظف </td>
                                            <td>{{ number_format($data->analyse[0]->salesPrice,2) }}</td>
                                        </tr>
                                        <tr class="font-14 text-center">
                                            <td class="mylable">مدة التقسيط</td>
                                            <td>{{ $data->period->name }}</td>
                                            <td class="mylable">القسط الشهري</td>
                                            <td>{{ number_format($data->analyse[0]->monthlyInstallment,2) }}</td>
                                            <td class="mylable">القسط الأول </td>
                                            <td>{{$data->analyse[0]->dateFirstInstallment }}</td>
                                            <td class="mylable">القسط الاخير </td>
                                            <td>{{ $data->analyse[0]->dateLastInstallment }}</td>
                                        </tr>

                                        <tr class="font-14 text-center">
                                            <td class="mylable">إسم العضو</td>
                                            <td>
                                                <strong>{{ EmpName($data->empno) /* $data->analyse[0]->usercontract->name */ }}</strong>
                                            </td>
                                            <td class="mylable">توقيع العضو</td>
                                            {{-- <td>...............................</td> --}}
                                            {{-- {{ $data->analyse[0]->usercontract->name }} --}}
                                            <td><img name="signature" style="width: 20%" src="{{getImage('Signature/'.Signature($data->empno)) }}" alt="Sign"></td>
                                            <td class="mylable">إسم المحاسب </td>
                                            <td><strong>{{ $data->empaccfun->name /* ->empno */ }}</strong></td>
                                            <td class="mylable">توقيع المحاسب </td>
                                            <td><img name="signature" style="width: 20%" src="{{getImage('Signature/'.Signature($data->empacc)) }}" alt="Sign"></td>
                                            {{-- <td>...............................</td> --}}

                                        </tr>
                                    </tbody>
                                </table>
                                {{-- Start from Here --}}
                                @if ($data->sponsor)
                                    <h4 class="tit-padd">3- التحليل المالي للكافل</h4>
                                    <table class="table contractTable">
                                        <tbody>
                                                <tr class="font-14 text-center">
                                                    <td class="mylable">الكافل</td>
                                                    {{-- <td>{{ $sponsorname }}</td> --}}
                                                    <td>{{ $data->sponsororder->name }}</td>
                                                    {{-- <td>{{ $data->sprName }}</td> --}}

                                                    <td class="mylable">الرصيد في الصندوق</td>
                                                    {{-- <td>{{ $sponsorbox }}</td> --}}
                                                    <td>{{ number_format($data->analyse[0]->sprbalancebox,2) }}</td>
                                                    <td class="mylable">نهاية الخدمة</td>
                                                    <td>{{ number_format($data->analyse[0]->sprendService,2) }}</td>
                                                    <td class="mylable">توقيع الكافل</td>
                                                    <td><img name="signature" style="width: 20%" src="{{getImage('Signature/'.Signature($data->sponsor)) }}" alt="Sign"></td>
                                                </tr>

                                        </tbody>
                                    </table>
                                @endif
                                @if ($data->sponsor)
                                    <h4 class="tit-padd">4- التحليل المالي</h4>
                                    <table class="table contractTable">
                                        <tbody>
                                            <tr class="font-14 text-center">
                                                <td class="mylable">إجمالي الضمانات</td>
                                                <td>{{ number_format($data->analyse[0]->totalGuaranteesAll,2) }}</td>
                                                {{-- <td>{{ number_format($data->GuaranteesEmp + $data->GuaranteesSpr,2)}}</td> --}}
                                                <td class="mylable">إجمالي الإلتزمات</td>
                                                <td>{{ number_format($data->analyse[0]->totalCommitmentAll,2) }}</td>
                                                <td class="mylable">الضمانات المتاحة</td>
                                                <td>{{ number_format($data->analyse[0]->guaranteesAvailableAll,2) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <h4 class="tit-padd">5- إقرار</h4>
                                @else
                                    <h4 class="tit-padd">3- التحليل المالي</h4>
                                    <table class="table contractTable">
                                        <tbody>
                                            <tr class="font-14 text-center">
                                                <td class="mylable">إجمالي الضمانات</td>
                                                <td>{{ number_format($data->analyse[0]->totalGuaranteesAll,2)}}</td>
                                                <td class="mylable">إجمالي الإلتزمات</td>
                                                <td>{{ number_format($data->analyse[0]->totalCommitmentAll,2) }}</td>
                                                <td class="mylable">الضمانات المتاحة</td>
                                                <td>{{ number_format($data->analyse[0]->guaranteesAvailableAll,2) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <h4 class="tit-padd">4- إقرار</h4>
                                @endif



                                {{-- End from Here --}}
                                @endforeach
                                <table class="table contractTable">
                                    <tbody>
                                        @foreach ($orderData as $data)
                                            <tr class="font-14 text-center">
                                                <td class="mylable">
                                                    أنا الموقع أدناه اتقدم لصندوق الإدخار بالندوة العالمية للشباب الإسلامي بطلب تقسيط ({{number_format($data->analyse[0]->salesPrice,2)}})  ريال وفق البيانات أعلاه
                                                    وأقر بموجب هذا الطلب ان المعلومات صحيحة وان لصندوق الادخار الحق في التأكد
                                                    والتحقق من صحة هذه المعلومات وافوضهم بان يحصلوا علي ما يلزمهم او يحتاجون اليه من معلومات تخصني. كما أعلن
                                                    التزامي بجميع الشروط والاحكام في الصندوق واوافق علي ان تتم تسوية اي نزاع قد ينشأ فيما يتعلق بوضع
                                                    هذا الطلب عن طريق الجهات الرسمية بالندوة، ويحق للصندوق ان يحتفظ بالمستندات التي اقدمها ، وفي حال
                                                    ثبوت عدم صحة المعلومات أعلاه فانني اتحمل كافة الإجراءات القانونية المترتبة علي ذلك.
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <table class="table contractTable">
                                    <tbody>
                                        <tr class="font-14 text-center">
                                            <td class="mylable">إسم الموظف</td>
                                            <td class="mylable" id="empName2"></td>
                                            <td class="mylable">التوقيع</td>
                                            {{-- <td class="mylable">...............................</td> --}}
                                            <td style="width: 25%"><img name="signature" style="width: 20%" src="{{getImage('Signature/'.Signature($data->empno)) }}" alt="Sign"></td>
                                            <td class="mylable">التاريخ</td>
                                            <td class="mylable">{{ date('Y/m/d', strtotime($data->signempdate)) }}</td>
                                        </tr>
                                        <tr class="font-14 text-center">
                                            <td class="mylable">رئيس صندوق الإدخار</td>
                                            <td class="mylable">د. عبدالعزيز بن محمد الجبرين</td>
                                            <td class="mylable">التوقيع</td>
                                            {{-- empmgr --}}
                                            <td style="width: 25%"><img name="signature" style="width: 20%" src="{{getImage('Signature/'.Signature(11999)) }}" alt="Sign"></td>
                                            {{-- <td class="mylable">...............................</td> --}}
                                            <td class="mylable">التاريخ</td>
                                            <td class="mylable">{{ date('Y/m/d', strtotime($data->aprovalmgrdate))}}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <hr class="mg-b-40">

                                <button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()"> <i
                                        class="mdi mdi-printer ml-1"></i>طباعة
                                </button>

                            </div>

                        </div>

                        <footer class="footer">
                            <div class="card-footer">
                                <img style="width: 100%" src="{{URL::asset('public/assets/MyImages/Reports/2.jpg')}}" alt="header">
                            </div>
                        </footer>
                    </div>
                @endif

            </div>
        </div><!-- COL-END -->
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{ URL::asset('public/assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>
    <script>
        window.onload = function() {
            document.getElementById('empName2').innerHTML = document.getElementById('empName').innerHTML;
        };
    </script>
@endsection
