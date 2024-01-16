@extends('layouts.wamy.wamy')
@section('css')
@endsection
@section('title')
    <title>الطلبات - الندوة العالمية للشباب الإسلامي</title>
@endsection
@section('content')
<div class="mb-5"></div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-lg-11">
                        <h3 class="card-title hedr-font">طلبات الخدمة</h3>
                    </div>
                    <div class="col-lg-1">
                        <a href="{{ URL::previous() }}" class="btn  btn-indigo">رجوع</a>
                    </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        @include('alert.errors')
                    @endif
                    <div class="row">
                        @if (count($orders) > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                                    <thead class="border-top">
                                        <tr>
                                            <th class="hedr-font text-center">#</th>
                                            <th class="hedr-font text-center">رقم الطلب</th>
                                            <th class="hedr-font text-center">التاريخ</th>
                                            <th class="hedr-font text-center">صاحب الطلب</th>
                                            <th class="hedr-font text-center">نوع الطلب</th>
                                            <th class="hedr-font text-center">وصف</th>
                                            <th class="hedr-font text-center">مدة القسط</th>
                                            <th class="hedr-font text-center">المبلغ</th>
                                            <th class="hedr-font text-center">الحالة</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            @if ($order->empno == EmpNo() || EmpNo() == 11402)
                                                <tr class="border-bottom font-center">
                                                    <td class="font-14 text-center">{{$loop->iteration }}</td>
                                                    <td class="font-14 text-center">{{$order->id }}</td>
                                                    <td class="font-14 text-center">{{\Carbon\Carbon::parse($order->created_at)->format('d/m/Y');}}</td>
                                                    <td class="font-14 text-center">{{$order->emporder->name }}  </td>
                                                    <td class="font-14 text-center">{{$order->ordertyp->name}} </td>
                                                    <td class="font-14 text-center">{{\Illuminate\Support\Str::limit($order->orderdesc,30, $end = '...')}} </td>
                                                    <td class="font-14 text-center">
                                                        @switch($order->installmentPeriod)
                                                            @case(1)
                                                                سنة
                                                                @break
                                                            @case(2)
                                                                سنتان
                                                                @break
                                                            @default
                                                            {{ $order->installmentPeriod }}      سنوات
                                                        @endswitch
                                                    </td>
                                                    <td class="font-14 text-center">{{number_format($order->purchasingValue,2)}}</td>
                                                    <td class="font-14 text-center">
                                                        @include('Saving.Order.status.displaystatuslink',['statusid' => $order->statusid,'orderid' => $order->id])
                                                        {{-- @switch($order->statusid)
                                                            @case(1)
                                                                @if (!$order->sponsor)
                                                                    @if ($order->empno == EmpNo())
                                                                        <form action="{{ route('getorder')}}" method="POST" enctype="multipart/form-data">
                                                                            {{ csrf_field() }}
                                                                            <input type="hidden" name="type" value="1">
                                                                            <input type="hidden" name="orderid" value="{{ $order->id }}">
                                                                            <button class="btn  btn-green" type="submit">جديد</button>
                                                                        </form>

                                                                    @elseif (EmpNo() == 11402)
                                                                        <a href="{{ route('boanalyses.show',$order->id) }}" class="btn  btn-blue">التحليل المالي</a>
                                                                    @endif
                                                                @else
                                                                    <span class="tag tag-blue">إنتظار موافقة الكافل</span>
                                                                @endif
                                                                @break
                                                            @case(2)
                                                                @if (EmpNo() == 11402)
                                                                    <a href="{{ route('boanalyses.show',$order->id) }}" class="btn  btn-blue">{{ $order->orderstatus->name }}</a>
                                                                @else
                                                                    <form action="{{ route('getorder')}}" method="POST" enctype="multipart/form-data">
                                                                        {{ csrf_field() }}
                                                                        <input type="hidden" name="type" value="2">
                                                                        <input type="hidden" name="orderid" value="{{ $order->id }}">
                                                                        <button class="btn  btn-lime" type="submit">{{ $order->orderstatus->name }}</button>
                                                                    </form>
                                                                @endif
                                                                @break
                                                            @case(3)
                                                                @if (EmpNo() == 11402)
                                                                    <button type="button" class="btn btn-blue rejectbtn" value="{{ $order->id }}"
                                                                        data-bs-toggle="modal" data-bs-target="#RejectModal" data-id="{{ $order->id }}" data-empno="{{ $order->empno }}"
                                                                        data-emporder="{{ $order->emporder->name }}" data-sponsorname="{{ $order->sponsororder->name }}">
                                                                        {{ $order->orderstatus->name }}
                                                                    </button>
                                                                @else
                                                                    <form action="{{ route('getorder')}}" method="POST" enctype="multipart/form-data">
                                                                        {{ csrf_field() }}
                                                                        <input type="hidden" name="type" value="2">
                                                                        <input type="hidden" name="orderid" value="{{ $order->id }}">
                                                                        <button class="btn  btn-red" type="submit">{{ $order->orderstatus->name }}</button>
                                                                    </form>
                                                                @endif
                                                                @break
                                                            @case(4)
                                                                <span class="tag tag-indigo">{{ $order->orderstatus->name }}</span>
                                                                @break
                                                            @case(5)
                                                                <form action="{{ route('getorder')}}" method="POST" enctype="multipart/form-data">
                                                                    {{ csrf_field() }}
                                                                    <input type="hidden" name="type" value="2">
                                                                    <input type="hidden" name="orderid" value="{{ $order->id }}">
                                                                    <button class="btn  btn-red" type="submit">{{ $order->orderstatus->name }}</button>
                                                                </form>
                                                                @break
                                                            @case(6)
                                                                <span class="tag tag-green">{{ $order->orderstatus->name }}</span>
                                                                @break
                                                            @default
                                                                @break
                                                        @endswitch --}}
                                                    </td>
                                                </tr>
                                            @endif

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="col-lg-12">
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
                                    <h1 class="text-center mt-5">عفواً لا يوجد طلبات</h1>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (count($withdraws) > 0)

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="col-lg-11">
                            <h3 class="card-title hedr-font">طلبات السحب</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            @include('alert.errors')
                        @endif
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                                    <thead class="border-top">
                                        <tr>
                                            <th class="hedr-font text-center">#</th>
                                            <th class="hedr-font text-center">رقم الطلب</th>
                                            <th class="hedr-font text-center">التاريخ</th>
                                            <th class="hedr-font text-center">صاحب الطلب</th>
                                            <th class="hedr-font text-center">نوع الطلب</th>
                                            {{-- <th class="hedr-font text-center">وصف</th>
                                            <th class="hedr-font text-center">مدة القسط</th> --}}
                                            <th class="hedr-font text-center">المبلغ</th>
                                            <th class="hedr-font text-center">الإعتماد المالي</th>
                                            <th class="hedr-font text-center">الإدارة</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($withdraws as $withdraw)
                                            @if ($withdraw->empno == EmpNo() || EmpNo() == 11402)
                                                <tr class="border-bottom font-center">
                                                    <td class="font-14 text-center">{{$loop->iteration }}</td>
                                                    <td class="font-14 text-center">{{$order->id }}</td>
                                                    <td class="font-14 text-center">{{\Carbon\Carbon::parse($withdraw->created_at)->format('d/m/Y');}}</td>
                                                    <td class="font-14 text-center">{{$withdraw->emp->name }}  </td>
                                                    <td class="font-14 text-center">{{$withdraw->wtype->name}} </td>
                                                    {{-- <td class="font-14 text-center">{{\Illuminate\Support\Str::limit($withdraw->orderdesc,30, $end = '...')}} </td>
                                                    <td class="font-14 text-center">
                                                        @switch($order->installmentPeriod)
                                                            @case(1)
                                                                سنة
                                                                @break
                                                            @case(2)
                                                                سنتان
                                                                @break
                                                            @default
                                                            {{ $order->installmentPeriod }}      سنوات
                                                        @endswitch
                                                    </td> --}}
                                                    <td class="font-14 text-center">{{number_format($withdraw->amnt,2)}}</td>
                                                    <td class="font-14 text-center">
                                                        @if (!$withdraw->aprovalacct)
                                                            <span class="tag tag-rounded tag-blue">جديد</span>
                                                        @elseif ($withdraw->aprovalacct == 2)
                                                            <span class="tag tag-rounded tag-green">تم قبول الطلب</span>
                                                        @elseif ($withdraw->aprovalacct == 1)
                                                            <span class="tag tag-rounded tag-red">تم رفض الطلب</span>
                                                        @endif


                                                    </td>
                                                    <td class="font-14 text-center">
                                                        @if ($withdraw->aprovalmgr)
                                                            @if ($withdraw->aprovalmgr == 1)
                                                                <span class="tag tag-rounded tag-red">تم رفض الطلب</span>
                                                            @else
                                                                <span class="tag tag-rounded tag-green">تم قبول الطلب</span>
                                                            @endif
                                                        @else
                                                            @if ($withdraw->aprovalacct == 2)
                                                                    <span class="tag tag-rounded tag-blue">
                                                                        إعتماد الإدارة
                                                                    </span>
                                                            @elseif ($withdraw->aprovalacct == 1)
                                                                <span class="tag tag-rounded tag-red">تم رفض الطلب</span>
                                                            @elseif (!$withdraw->approvalacct)
                                                                <span class="tag tag-rounded tag-blue">التحليل المالي</span>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
<!--Model-->
<div class="modal fade" id="RejectModal">
    <div class="modal-dialog" role="document">
        {{-- <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h3 class="card-title hedr-font">رفض كفالة طلب بالرقم  <span id="myid"></span></h3>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate action="{{ route('orders.update',3) }}" method="POST">
                    {{ csrf_field() }}
                    @method('PATCH')
                        <div class="mb-3">
                            <h4>الكافل <span id="sponsorname" class="text-info"></span> قد قام برفض طلب الكفالة للموظف   <span id="emporder" class="text-info"></span></h4>
                            <h4>هل تريد رفض الطلب ام التحليل المالي ؟</h4>
                            <input type="hidden" class="form-control" id="order_id" name="order_id">
                            <input type="hidden" class="form-control" id="empno" name="empno">
                        </div>
                    <br>
                    <div class="modal-footer">
                        <button class="btn btn-red font-16" type="submit">رفض الطلب</button>
                        <a href="{{ route('boanalyses.show',$order->id) }}" class="btn btn-info font-16">التحليل المالي</a>
                    </div>
                </form>
            </div>
        </div> --}}
    </div>
</div>

@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('.rejectbtn').click(function (e) {
                e.preventDefault();
                var order_id = $(this).val();
                $('#order_id').val(order_id);
                $('#myid').text(order_id);
                $('#RejectModal').modal('show');
            });
        })
        $('#RejectModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var empno = button.data('empno')
            var emporder = button.data('emporder')
            var sponsorname = button.data('sponsorname')
            var modal = $(this)

            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #empno').val(empno);
            modal.find('.modal-body #emporder').text(emporder);
            modal.find('.modal-body #sponsorname').text(sponsorname);
        })

    </script>
@endsection
