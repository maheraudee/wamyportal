@extends('layouts.wamy.wamy')
@section('css')
<style>
    @media print {
        #print_Button,.pagination, #responsive-datatable_length, #responsive-datatable_info {
            display: none;
        }
        /* .pagination {
            display: none;
        }
        #responsive-datatable_length{
            display: none;
        }
        #responsive-datatable_info{
            display: none;
        } */

        .foz36{
            font-size: 36px;
        }
    }

</style>
@endsection
@section('title')
    <title>طباعة عهدة - الندوة العالمية للشباب الإسلامي</title>
@endsection
@section('content')
<div class="mb-5"></div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                {{-- <div class="card-header">
                    <h3 class="card-title hedr-font">بيانات العهد</h3>
                </div> --}}
                <div class="card-body">
                    @if ($errors->any())
                        @include('alert.errors')
                    @endif
                    <div class="row">
                        @if (count($inventories) > 0)
                            <div class="card card-invoice" id="print">
                                <div class="card-header" style="height: 200px;">
                                    <img style="width: 100%; height: 100%;" src="{{getImage('\Reports\1.jpg')}}" alt="header">
                                </div>
                                <div class="card-body">
                                    <div class="contract">
                                        <div class="contract-title">
                                            <h1>إدارة الإعلام وتقنية المعلومات</h1>
                                            <h4 class="foz36">قسم تقنية المعلومات</h4>
                                            <h5><strong><u class="foz36">عهدة موظف</u></strong></h5>
                                        </div>
                                        <br><br><br>
                                        @foreach ($empInfo as $emp)
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <h3>الرقم الوظيفي : <span>{{$emp->empno}}</span></h3>
                                                </div>
                                                <div class="col-sm-4">
                                                    <h3>الإسم : <span>{{$emp->name}}</span></h3>
                                                </div>
                                                <div class="col-sm-4">
                                                    <h3>البريد الإلكتروني : <span>{{$emp->email}}</span></h3>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h3>الإدارة : <span>{{$emp->department}}</span></h3>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h3>القسم : <span>{{$emp->section}}</span></h3>
                                                </div>
                                            </div>
                                            <br>
                                        @endforeach
                                        <br><br>
                                        {{-- <table class="table contractTable"> --}}
                                        <div class="table-responsive">
                                            
                                            <table class="table border text-nowrap text-md-nowrap table-bordered mb-0" >
                                            {{-- <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable"> --}}
                                            {{-- <table  id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom"> --}}
                                                <thead>
                                                    <tr>
                                                        <th style="font-size: 16px; font-weight: bolder">الباركود</th>
                                                        <th style="font-size: 16px; font-weight: bolder">الجهاز</th>
                                                        <th style="font-size: 16px; font-weight: bolder">الموديل</th>
                                                        <th style="font-size: 16px; font-weight: bolder">نوع العهدة</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($inventories as $inv)
                                                            <tr>
                                                                <td>{{$inv->HdwBarcode}}</td>
                                                                <td>{{$inv->hardware->typhardware->name}}</td>
                                                                <td>{{$inv->hardware->HdwModel}}</td>
                                                                {{-- <td>{{ $inv->InvTypeId == 101 ? $inv->TypeNameAr . " من " .$inv->stockName : $inv->invtytype->TypeNameAr }}</td> --}}
                                                                <td>{{$inv->invtytype->TypeNameAr }}</td>
                                                            </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <br><br>
                                        <div class="contractBox">
                                            <div>
                                                <table class="table">
                                                    <tbody class="signbox">

                                                            @foreach ($empInfo as $info)
                                                                <tr>
                                                                    <td style="width: 8%">الإسم :</td>
                                                                    <td class="text-right">{{$info->name}}</td>
                                                                    {{-- <th class="w-auto" scope="col">الإسم :</th>
                                                                    <th class="text-right">{{$info->name}}</th> --}}
                                                                </tr>
                                                                <tr>
                                                                    <td>التاريخ :</td>
                                                                    <td class="text-right">{{$day}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>التوقيع :</th>

                                                                    <td>{{-- <img src="{{ asset('public/storage/Signature/'. $item->signature)}}" alt="Sign"> --}}</td>
                                                                    <td></td>
                                                                </tr>
                                                            @endforeach

                                                    </tbody>
                                                </table>

                                            </div>

                                        </div>
                                        <button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()">
                                            <i class="mdi mdi-printer ml-1"></i>طباعة
                                        </button>
                                        <hr class="mg-b-40">
                                    </div>
                                    <div style="margin-bottom: 180px"></div>
                                    <div class="card-footer">
                                        {{-- <img style="width: 100%" src="{{URL::asset('public/storage/Reports/2.jpg')}}" alt="header"> --}}
                                        <img style="width: 100%" src="{{getImage('\Reports\2.jpg')}}" alt="header">
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
                                @foreach ($empInfo as $item)
                                    <h1 class="text-center mt-5">عفواً لا يوجد عهدة للموظف {{$item->name}} </h1>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>
@endsection


