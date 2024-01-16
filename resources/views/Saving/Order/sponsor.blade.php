@extends('layouts.wamy.wamy')
@section('css')
@endsection
@section('title')
    <title>الكفالة - الندوة العالمية للشباب الإسلامي</title>
@endsection
@section('content')
<div class="mb-5"></div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title hedr-font">الكفالة</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        @include('alert.errors')
                    @endif

                    <div class="row">
                        @if (count($guarantees) > 0)
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
                                            <th class="hedr-font text-center">العمليات</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($guarantees as $guarantee)
                                            <tr class="border-bottom font-center">
                                                <td class="font-14 text-center">{{$loop->iteration }}</td>
                                                <td class="font-14 text-center">{{ $guarantee->id }}</td>
                                                <td class="font-14 text-center">{{\Carbon\Carbon::parse($guarantee->created_at)->format('d/m/Y');}}</td>
                                                <td class="font-14 text-center">{{$guarantee->emporder->name }}  </td>
                                                <td class="font-14 text-center">{{$guarantee->ordertyp->name}} </td>
                                                <td class="font-14 text-center">{{$guarantee->orderdesc}} </td>
                                                <td class="font-14 text-center">
                                                    @switch($guarantee->installmentPeriod)
                                                        @case(1)
                                                            سنة
                                                            @break
                                                        @case(2)
                                                            سنتان
                                                            @break
                                                        @default
                                                        {{ $guarantee->installmentPeriod }}      سنوات
                                                    @endswitch
                                                </td>
                                                <td class="font-14 text-center">{{number_format($guarantee->purchasingValue,2)}}</td>

                                                <td class="font-14 text-center">

                                                    @if (!$guarantee->aprovalsponsor)
                                                        <span class="tag tag-blue" data-bs-toggle="modal" data-bs-target="#Accept"
                                                            data-id="{{ $guarantee->id }}" data-empno="{{ $guarantee->empno }}"
                                                            data-emporder="{{ $guarantee->emporder->name }}">
                                                            قبول
                                                        </span>
                                                        {{-- <button class="btn btn-info btn-pill" data-bs-toggle="modal" data-bs-target="#Accept"
                                                            data-id="{{ $guarantee->id }}" data-empno="{{ $guarantee->empno }}"
                                                            data-emporder="{{ $guarantee->emporder->name }}">
                                                            قبول
                                                        </button> --}}
                                                        &nbsp;&nbsp;&nbsp;
                                                        <span class="tag tag-red" data-bs-toggle="modal" data-bs-target="#Reject"
                                                            data-rjid="{{ $guarantee->id }}" data-rjempno="{{ $guarantee->empno }}"
                                                            data-rjemporder="{{ $guarantee->emporder->name }}">
                                                            رفض
                                                        </span>
                                                        {{-- <button class="btn btn-danger btn-pill" data-bs-toggle="modal" data-bs-target="#Reject"
                                                                data-rjid="{{ $guarantee->id }}" data-rjempno="{{ $guarantee->empno }}"
                                                                data-rjemporder="{{ $guarantee->emporder->name }}">
                                                            رفض
                                                        </button> --}}
                                                    @else
                                                    {{--     @switch($guarantee->aprovalsponsor)
                                                            @case(1)
                                                                <span class="tag tag-red">تم رفض طلب الكفالة</span>
                                                                @break
                                                            @case(2)
                                                                <span class="tag tag-green">تم قبول طلب الكفالة</span>
                                                                @break
                                                        @endswitch --}}
                                                        @include('Saving.Order.status.displaystatus',['statusid' => $guarantee->statusid,'orderid'=>$guarantee->id])
                                                    @endif

                                                </td>
                                            </tr>
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
                                <h1 class="text-center mt-5">عفواً لا يوجد لديك طلبات كفالة</h1>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--Model-->
<div class="modal fade" id="Accept">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h3 class="card-title hedr-font">قبول كفالة</h3>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate action="{{ route('orders.update',1) }}" method="POST">
                    {{-- {{ csrf_field() }}
                    @method('PATCH') --}}
                    @csrf
                    @method('PATCH')
                        <div class="mb-3">
                            <h4>هل أنت متاكد من قبول طلب الكفالة للموظف <span id="emporder"></span>؟</h4>
                            <input type="hidden" class="form-control" id="id" name="id">
                            <input type="hidden" class="form-control" id="aprovalsponsor" name="aprovalsponsor" value="2">
                            <input type="hidden" class="form-control" id="statusid" name="statusid" value="2">
                            <input type="hidden" class="form-control" id="empno" name="empno">
                        </div>
                    <br>
                    <div class="modal-footer">
                        <button class="btn btn-info font-16" type="submit">قبول</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- ------------------------------------------------------------------ --}}
<div class="modal fade" id="Reject">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h3 class="card-title hedr-font">رفض كفالة</h3>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate action="{{ route('orders.update',1) }}" method="POST">
                    @csrf
                    @method('PATCH')
                        <div class="mb-3">
                            <h4>هل أنت متاكد من رفض طلب الكفالة للموظف <span id="rjemporder"></span>؟</h4>
                            <input type="hidden" class="form-control" id="rjid" name="rjid">
                            <input type="hidden" class="form-control" id="rjaprovalsponsor" name="rjaprovalsponsor" value="1">
                            <input type="hidden" class="form-control" id="rjstatusid" name="rjstatusid" value="3">
                            <input type="hidden" class="form-control" id="rjempno" name="rjempno">
                        </div>
                    <br>
                    <div class="modal-footer">
                        <button class="btn btn-danger font-16" type="submit">رفض</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        $('#Accept').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var empno = button.data('empno')
            var emporder = button.data('emporder')
            var modal = $(this)

            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #empno').val(empno);
            modal.find('.modal-body #emporder').text(emporder);
        })

        $('#Reject').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('rjid')
            var empno = button.data('rjempno')
            var emporder = button.data('rjemporder')
            var modal = $(this)

            modal.find('.modal-body #rjid').val(id);
            modal.find('.modal-body #rjempno').val(empno);
            modal.find('.modal-body #rjemporder').text(emporder);
        })
    </script>
@endsection
