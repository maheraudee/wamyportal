@extends('layouts.wamy.wamy')
@section('css')
@endsection
@section('title')
    <title>التحليل المالي - الندوة العالمية للشباب الإسلامي</title>
@endsection
@section('content')
<div class="mb-5"></div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title hedr-font">التحليل المالي</h3>
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
                                        <th class="hedr-font text-center">وصف</th>
                                        <th class="hedr-font text-center">مدة القسط</th>
                                        <th class="hedr-font text-center">المبلغ</th>
                                        <th class="hedr-font text-center">الحالة</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr class="border-bottom font-center">
                                            <td class="font-14 text-center">{{$loop->iteration }}</td>
                                            <td class="font-14 text-center">{{ $order->id }}</td>
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

                                                {{-- @include('Saving.Order.status.displaystatus',['statusid' => $order->statusid,'orderid'=> $order->id]) --}}
                                                @include('Saving.Order.status.displaystatuslink',['statusid' => $order->statusid,'orderid'=> $order->id])

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script src="{{asset('public/assets/js/enterButton.js') }}"></script>
    <script src="{{asset('public/assets/js/Saving/analysis2.js') }}"></script>

@endsection
