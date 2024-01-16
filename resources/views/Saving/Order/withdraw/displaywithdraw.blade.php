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
                                    <form>
                                        @foreach ($withdraws as $withdraw)
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
                                                    <input type="text" class="form-control form-control-lg" id="witype"  name="witype" value="{{ $withdraw->wtype->name }}" readonly>
                                                </div>
                                                <div class="col-sm col-md">
                                                    <label for="amnt" class="control-label">المبلغ</label>
                                                    <input type="text" class="form-control form-control-lg" id="amnt" name="amnt" value="{{ $withdraw->amnt }}" readonly>
                                                </div>
                                            </div>
                                            <br>
                                            {{-- <div class="row">

                                                <div class="col-sm col-md">
                                                    <label for="hr" class="control-label">إستقطاع شؤون الموظفين</label>
                                                    <input type="text" class="form-control form-control-lg" id="hr" name="hr" value="{{ $withdraw->hr }}" readonly>
                                                </div>
                                                <div class="col-sm col-md">
                                                    <label for="box" class="control-label">إستقطاع صندوق الإدخار </label>
                                                    <input type="text" class="form-control form-control-lg" id="box" name="box" value="{{ $withdraw->box }}" readonly>
                                                </div>
                                                <div class="col-sm col-md">
                                                    <label for="outsite" class="control-label">إستقطاع بنك </label>
                                                    <input type="text" class="form-control form-control-lg" id="outsite" name="outsite" value="{{ $withdraw->outsite }}" readonly>
                                                </div>
                                            </div> --}}
                                            <br>
                                            <div class="row">
                                                <div class="col-sm col-md">
                                                    <ul id="treeview1" style="font-size: 36px">
                                                        <li class="control-label"><a style="font-size: 36px" href="javascript:void(0)">إجمالي الإلتزامات  = {{ $totalsum }}</a>
                                                            <ul>
                                                                <li class="control-label">إستقطاع شؤون الموظفين  =  {{ $withdraw->hr }}</li>
                                                                <li class="control-label">إستقطاع صندوق الإدخار   =  {{ $withdraw->box }}</li>
                                                                <li class="control-label">إستقطاع بنك   =  {{ $withdraw->outsite ? $withdraw->outsite : "لايوجد" }}</li>
                                                            </ul>
                                                        </li>
                                                    </ul>
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

@endsection
@section('js')
<!-- Internal Treeview js -->
    <script src="{{asset('public/assets/plugins/treeview/treeview.js')}}"></script>
@endsection
