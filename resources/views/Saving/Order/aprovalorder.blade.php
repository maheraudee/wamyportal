@extends('layouts.wamy.wamy')
@section('css')
@endsection
@section('title')
    <title>إعتماد الطلبات - الندوة العالمية للشباب الإسلامي</title>
@endsection
@section('content')
<div class="mb-5"></div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title hedr-font">إعتماد الطلبات (اللجنة والرئيس)</h3>
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
                                            <th class="hedr-font text-center">الإعتماد المالي</th>
                                            <th class="hedr-font text-center">اللجنة</th>
                                            <th class="hedr-font text-center">الإدارة</th>
                                            {{-- <th class="hedr-font text-center">العقد</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr class="border-bottom font-center">
                                                <td class="font-14 text-center">{{$loop->iteration }}</td>
                                                <td class="font-14 text-center">{{$order->id}}</td>
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
                                                    {{-- الإعتماد المالي --}}
                                                    @foreach ($order->analyse as $item)
                                                        @if ($item->evaluation == 1)
                                                            <span class="tag tag-rounded tag-green">الضمانات  كافية</span>
                                                        @elseif ($item->evaluation == 2)
                                                            <span class="tag tag-rounded tag-red">الضمانات غير كافية</span>
                                                        @else
                                                            <span title="{{ $item->reson }}" class="tag tag-rounded tag-orange">{{\Illuminate\Support\Str::limit($item->reson,10, $end = '...')}}</span>
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td class="font-14 text-center">
                                                    {{-- اللجنة --}}

                                                    @include('Saving.Order.status.displaystatuslink',['statusid' => $order->statusid,'orderid'=>$order->id])
                                                    {{-- @if ($order->statusid == 4)
                                                        <a href="{{ route('contractOrder',[$order->id,1,1]) }}">
                                                            <span class="tag tag-rounded tag-lime">معتمد مالياً</span>
                                                        </a>

                                                    @elseif ($order->statusid == 5)
                                                        <span class="tag tag-rounded tag-red">رفض الطلب مالياً</span>

                                                    @elseif ($order->statusid == 6)

                                                        <a href="{{ route('contractOrder',[$order->id,2,2]) }}">
                                                            <span class="tag tag-rounded tag-green">الموظف</span>
                                                        </a>
                                                    @elseif ($order->statusid == 8)
                                                        <span class="tag tag-rounded tag-green">معتمد من اللجنة</span>
                                                    @endif --}}
                                                </td>
                                                <td class="font-14 text-center">

                                                    {{-- @include('Saving.Order.status.displaystatus',['statusid' => $order->statusid,'orderid'=>$order->id]) --}}
                                                    @include('Saving.Order.status.displaystatuslink',['statusid' => $order->statusid,'orderid'=>$order->id])

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
                                <h1 class="text-center mt-5">لاتوجد طلبات تحتاج لإعتماد الإدارة</h1>
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
                <h3 class="card-title hedr-font">إعتماد الإدارة</h3>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate action="{{ route('boanalyses.update',1) }}" method="POST">
                    @csrf
                    @method('PATCH')
                        <div class="mb-3">
                            <h4>صاحب الطلب : <span id="empname"></span>؟</h4>
                            <input type="hidden" class="form-control" id="id" name="id">
                            <input type="hidden" class="form-control" id="empno" name="empno">
                        </div>
                        <div class="col-sm col-md">
                            <label for="sponsor" class="control-label">الإعتماد</label>
                            <select class="form-control select2-show-search form-select" id="app" name="app">
                                <option value="0" >الرجاء الإختيار </option>
                                @foreach ($aprovals as $app)
                                    <option value="{{ $app->id }}">{{ $app->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    <br>
                    <div class="modal-footer">
                        <button class="btn btn-info font-16" type="submit">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="{{asset('public/assets/js/enterButton.js') }}"></script>
    <script src="{{asset('public/assets/js/Saving/analysis2.js') }}"></script>
    <script>
        $('#Accept').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var empno = button.data('empno')
            var empname = button.data('empname')
            var modal = $(this)

            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #empno').val(empno);
            modal.find('.modal-body #empname').text(empname);
        })
    </script>
@endsection
