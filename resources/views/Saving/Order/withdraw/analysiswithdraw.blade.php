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
                    @foreach ($withdraws as $withdraw)
                        <h3 class="card-title hedr-font">
                            طلب رقم: {{ $withdraw->id }} &nbsp; - &nbsp;
                            نوع الطلب: {{ $withdraw->wtype->name }}
                            &nbsp; - &nbsp;
                            @if($withdraw->aprovalacct)
                                <span class="tag-green">تمت المراجعة</span>
                            @else
                                <span class="tag-red">لم تراجع</span>
                            @endif
                        </h3>
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
                                    @foreach ($withdraws as $withdraw)
                                        <form action="{{ route('withdraws.update',1) }}" method="post">
                                            {{ csrf_field() }}
                                            @method('PATCH')
                                            <input type="hidden" name="withdrawid" value="{{ $withdraw->id }}">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="empno" class="control-label"> الرقم الوظيفي </label>
                                                    <input type="text" class="form-control" id="empno" name="empno" readonly value="{{ $withdraw->empno }}">
                                                </div>
                                                <div class="col-sm col-md">
                                                    <label for="name" class="control-label">الإسم</label>
                                                    <input type="text" class="form-control" id="name" name="name" readonly
                                                        value="{{ $withdraw->emp->name }}">
                                                </div>
                                                <div class="col-sm col-md">
                                                    <label for="department" class="control-label">الإدارة</label>
                                                    <input type="text" class="form-control" id="department" name="department" disabled
                                                        value="{{ $withdraw->emp->department }}">
                                                </div>
                                                <div class="col-sm col-md">
                                                    <label for="section" class="control-label">القسم</label>
                                                    <input type="text" class="form-control" id="section" name="section" disabled
                                                        value="{{ $withdraw->emp->section }}">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm col-md">
                                                    <label for="witype " class="control-label"> نوع الطلب </label>
                                                    <input type="hidden" class="form-control form-control-lg" id="witypeid"  name="witypeid" value="{{ $withdraw->witype }}">
                                                    <input type="text" class="form-control form-control-lg" id="witype"  name="witype" value="{{ $withdraw->wtype->name }}" readonly>
                                                </div>
                                                <div class="col-sm col-md">
                                                    <label for="amnt" class="control-label">المبلغ</label>
                                                    <input type="text" class="form-control form-control-lg" id="amnt" name="amnt" value="{{ $withdraw->amnt }}" {{$withdraw->aprovalacct ? "readonly" : ""}}>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm col-md">
                                                    <label for="hr" class="control-label">إستقطاع شؤون الموظفين</label>
                                                    <input type="text" class="form-control form-control-lg" id="hr" name="hr" value="{{ $withdraw->hr }}" {{$withdraw->aprovalacct ? "readonly" : ""}}>
                                                </div>
                                                <div class="col-sm col-md">
                                                    <label for="box" class="control-label">إستقطاع صندوق الإدخار </label>
                                                    <input type="text" class="form-control form-control-lg" id="box" name="box" value="{{ $withdraw->box }}" {{$withdraw->aprovalacct ? "readonly" : ""}}>
                                                </div>
                                                <div class="col-sm col-md">
                                                    <label for="endService" class="control-label">نهاية الخدمة</label>
                                                    <input type="text" class="form-control form-control-lg" id="endService" name="endService" value="{{ $withdraw->endService }}" readonly>
                                                </div>

                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-col-md">
                                                    <label for="comitbankamt" class="control-label">إلتزامات بنك </label>
                                                    <input type="text" class="form-control form-control-lg" id="comitbankamt" name="comitbankamt" value="{{ $withdraw->comitbankamt }}" {{$withdraw->aprovalacct ? "readonly" : ""}} >
                                                </div>
                                                <div class="col-sm-col-md">
                                                    <label for="comitanthoramt" class="control-label">إلتزامات آخرى </label>
                                                    <input type="text" class="form-control form-control-lg" id="comitanthoramt" name="comitanthoramt" value="{{ $withdraw->comitanthoramt }}" {{$withdraw->aprovalacct ? "readonly" : ""}} >
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col">
                                                    <label for="debtFurniture" class="control-label">مديونية أجهزة واثاث</label>
                                                    <input type="text" class="form-control" id="debtFurniture" name="debtFurniture" value="{{ $withdraw->debtFurniture }}" {{$withdraw->aprovalacct ? "readonly" : ""}}>
                                                </div>
                                                <div class="col">
                                                    <label for="debtCar" class="control-label"> مديونية سيارات</label>
                                                    <input type="text" class="form-control" id="debtCar" name="debtCar" value="{{ $withdraw->debtCar }}" {{$withdraw->aprovalacct ? "readonly" : ""}}>
                                                </div>
                                                <div class="col">
                                                    <label for="anothSponosr" class="control-label">مبلغ كفالة موظف آخر</label>
                                                    <input type="text" class="form-control" id="anothSponosr" name="anothSponosr" value="{{ $withdraw->anothSponosr }}" {{$withdraw->aprovalacct ? "readonly" : ""}}>

                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <label for="outsite" class="control-label">تقرير المحاسب</label>
                                                @if($withdraw->aprovalacct)
                                                    <textarea class="form-control form-control-lg" name="acctext" id="acctext" cols="30" rows="5" readonly>{{ $withdraw->acctext }}</textarea>
                                                @else
                                                    <textarea class="form-control form-control-lg" name="acctext" id="acctext" cols="30" rows="10" required></textarea>
                                                @endif
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-3 col-md-4">
                                                    <label for="aprovalacct" class="control-label"> القرار</label>
                                                    <select class="form-control select2-show-search form-select" id="aprovalacct" name="aprovalacct" {{-- onchange="changbalnc()" --}}>
                                                        <option value="0" >الرجاء إختيار القرار</option>
                                                        @foreach ($aprovals as $app)
                                                            <option value="{{ $app->id }}">{{ $app->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <br><br>
                                            {{-- <div class="row" id="balancewitaldiv" style="display:none">
                                                <label style="font-size: 16px">
                                                    <input type="checkbox" id="balancewital" name="balancewital" onchange="showlink()">
                                                    <strong>
                                                        سحب المبلغ من الرصيد
                                                    </strong>
                                                </label>
                                            </div> --}}
                                            <br>
                                            <div class="d-flex justify-content-center">
                                                @if(!$withdraw->aprovalacct)
                                                    <button type="submit" class="btn btn-primary">إعتماد</button>
                                                @endif
                                            </div>
                                        </form>
                                    @endforeach
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
<!-- Internal Treeview js -->
    <script src="{{asset('public/assets/plugins/treeview/treeview.js')}}"></script>

    <script>
        /* function changbalnc() {
             let aprovalacct = document.getElementById('aprovalacct'),
             balancewitaldiv = document.getElementById('balancewitaldiv');
            if (aprovalacct.value == 1) {
                balancewitaldiv.style.display = "none";
            }else{
                balancewitaldiv.style.display = "block";
            }
         } */
    </script>
@endsection
