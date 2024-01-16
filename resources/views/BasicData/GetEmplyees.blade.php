@extends('layouts.wamy.wamy')
@section('css')
@endsection
@section('title')
    <title>نقل البيانات - الندوة العالمية للشباب الإسلامي</title>
@endsection
@section('content')
<div class="mb-5"></div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title hedr-font">نقل البيانات</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        @include('alert.errors')
                    @endif
                    @if (Auth()->user()->empno == 11829)
                        <div class="row">
                            <div class="col-lg-1 me-5">
                                <a href="{{ route('storeEmp') }}" class="btn btn-primary me-3  mt-2 hedr-font">
                                    <i class="fe fe-user-plus me-2"></i>نقل بيانات الموظفين
                                </a>

                            </div>
                            <div class="col-lg-1 ms-9">
                                <a href="{{ route('storeboxtemp') }}" class="btn btn-primary me-3  mt-2 hedr-font">
                                    <i class="fe fe-plus me-2"></i>
                                    نهاية الخدمة والإستقطاعات
                                </a>
                            {{--  <a href="{{ route('storeBox') }}" class="btn btn-primary me-3  mt-2 hedr-font">
                                    <i class="fe fe-plus me-2"></i>
                                    نهاية الخدمة والإستقطاعات
                                </a> --}}
                            </div>
                        </div>
                    @endif

                    <hr>
                    <div class="row">
                        {{-- @if (count($inventories) > 0)
                            <div class="card card-invoice" id="print">
                                <div class="card-body">
                                    <div class="card-header" style="height: 200px;">
                                        <img style="width: 100%; height: 100%;" src="{{URL::asset('public/storage/Reports/1.jpg')}}" alt="header">
                                    </div>
                                    <div class="contract">
                                        <div class="contract-title">
                                            <h1>إدارة الإعلام والعلاقات العامة</h1>
                                            <h4 class="foz36">قسم تقنية المعلومات</h4>
                                            <h5><strong><u class="foz36">عهدة موظف</u></strong></h5>
                                        </div>
                                        <br><br><br>
                                        <table class="table contractTable">
                                            <thead>
                                                <tr>
                                                    <th style="font-size: 16px; font-weight: bolder">الباركود</th>
                                                    <th style="font-size: 16px; font-weight: bolder">الجهاز</th>
                                                    <th style="font-size: 16px; font-weight: bolder">الموديل</th>
                                                    <th style="font-size: 16px; font-weight: bolder">نوع العهدة</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($inventories as $item)
                                                        <tr>
                                                            <td>{{$item->HdwBarcode}}</td>
                                                            <td>{{$item->device}}</td>
                                                            <td>{{$item->HdwModel}}</td>
                                                            <td> {{ $item->HdwType == 101 ? $item->TypeNameAr . " من " .$item->stockName : $item->TypeNameAr }}</td>
                                                        </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <br><br>
                                        <div class="contractBox">
                                            <div>
                                                <table class="table">
                                                    <tbody class="signbox">

                                                            @foreach ($empInfo as $info)
                                                                <tr>
                                                                    <th scope="row">الإسم :</th>
                                                                    <th>{{$info->emp_nm}}</th>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">التاريخ :</th>

                                                                    <th>{{$day}}</th>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">التوقيع :</th>

                                                                    <td><img src="{{ asset('public/storage/Signature/'. $item->signature)}}" alt="Sign"></td>
                                                                    <td><button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()">
                                                                        <i class="mdi mdi-printer ml-1"></i>طباعة</button></td>
                                                                </tr>
                                                            @endforeach

                                                    </tbody>
                                                </table>

                                            </div>

                                        </div>

                                        <hr class="mg-b-40">



                                    </div>
                                    <div class="card-footer">
                                        <img style="width: 100%" src="{{URL::asset('public/storage/Reports/2.jpg')}}" alt="header">
                                    </div>
                                </div>

                            </div>
                        @else
                            <div class="alert alert-danger">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>
                                <span class=""><svg xmlns="http://www.w3.org/2000/svg" height="40" width="40" viewBox="0 0 24 24">
                                        <path fill="#f07f8f"
                                            d="M20.05713,22H3.94287A3.02288,3.02288,0,0,1,1.3252,17.46631L9.38232,3.51123a3.02272,3.02272,0,0,1,5.23536,0L22.6748,17.46631A3.02288,3.02288,0,0,1,20.05713,22Z" />
                                        <circle cx="12" cy="17" r="1" fill="#e62a45" />
                                        <path fill="#e62a45" d="M12,14a1,1,0,0,1-1-1V9a1,1,0,0,1,2,0v4A1,1,0,0,1,12,14Z" />
                                    </svg></span>
                                <strong class="font-center mylable">تنبيه</strong>
                                <hr class="message-inner-separator">
                                <h1 class="text-center mt-5">عفواً لا يوجد مستودعات</h1>
                            </div>
                        @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
    </script>
@endsection


