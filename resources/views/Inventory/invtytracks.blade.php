@extends('layouts.wamy.wamy')
@section('css')
@endsection
@section('title')
    <title>بيانات تفاصيل العهد - الندوة العالمية للشباب الإسلامي</title>
@endsection
@section('content')
<div class="mb-5"></div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title hedr-font">بيانات تفاصيل العهد</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        @include('alert.errors')
                    @endif
                    @include('Inventory.btn')
                    {{-- <div class="row">
                        <div class="col-lg-1 me-5">
                            <button type="button" class="btn btn-primary me-3  mt-2 hedr-font"
                                data-bs-toggle="modal" data-bs-target="#createCustody">
                                <i class="fe fe-plus me-2"></i>إضافة عهدة
                            </button>
                        </div>
                        <div class="col-lg-1 ms-8 me-3">
                            <button type="button" class="btn btn-primary me-3  mt-2 hedr-font"
                                data-bs-toggle="modal" data-bs-target="#createhardware">
                                <i class="fa fa-print me-2"></i>طباعة عهدة
                            </button>
                        </div>
                        <div class="col-lg-1 ms-9">
                            <button type="button" class="btn btn-primary me-3  mt-2 hedr-font"
                                data-bs-toggle="modal" data-bs-target="#createhardware">
                                <i class="fe fe-plus me-2"></i>طباعة عهدة
                            </button>
                        </div>
                    </div> --}}
                    <hr>
                    <div class="row">
                        @if (count($invtytracks) > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                                    <thead class="border-top">
                                        <tr>
                                            <th class="hedr-font text-center">#</th>
                                            <th class="hedr-font text-center">الجهاز</th>
                                            <th class="hedr-font text-center">نوع العهدة</th>
                                            <th class="hedr-font text-center">من</th>
                                            <th class="hedr-font text-center">الي</th>
                                            <th class="hedr-font text-center">تاريخ الجرد</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($invtytracks as $inventory)
                                            <tr class="border-bottom font-center">
                                                <td class="font-14 text-center">{{$i++ }}</td>
                                                <td class="font-14 text-center">{{$inventory->hardware->manufacturer->name }} / {{$inventory->hardware->typhardware->name}} / {{$inventory->HdwBarcode}} </td>
                                                <td class="font-14 text-center">{{$inventory->invtype->TypeNameAr}} </td>
                                                <td class="font-14 text-center">{{$inventory->stockout->StockId}} / {{$inventory->stockout->StockNameAr}} </td>
                                                <td class="font-14 text-center">{{$inventory->stockin->StockId}} / {{$inventory->stockin->StockNameAr}} </td>
                                                <td class="font-14 text-center">{{$inventory->created_at->format('Y/m/d')}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
                                <h1 class="text-center mt-5">عفواً لا يوجد حركات</h1>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--Model-->
<!-- ===============================Createhardware==========================================-->
    @include('Inventory.AddCustody')
<!-- ===============================Updatehardware==========================================-->
    <div class="modal fade" id="updatehardware">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h3 class="card-title hedr-font">تحديث بيانات مستودع</h3>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate action="{{-- {{route('hardwares.update')}} --}}" method="POST">
                        {{ csrf_field() }}
                        {{-- @method('PATCH') --}}
                            <div class="mb-3">
                                <label for="StockId" class="font-16">رقم المستودع</label>
                                <input type="text" class="form-control" id="StockId" name="StockId" required>
                                @error('StockId')
                                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="StockNameAr" class="font-16">الاسم باللغة العربية</label>
                                <input type="text" class="form-control @error('StockNameAr') is-invalid @enderror" id="StockNameAr" name="StockNameAr" required>
                                @error('StockNameAr')
                                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="StockNameEn" class="font-16">الاسم باللغة الإنجلزية</label>
                                <input type="text" class="form-control @error('StockNameEn') is-invalid @enderror" id="StockNameEn" name="StockNameEn">
                                @error('StockNameEn')
                                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="StockTyp" class="font-16">نوع المستودع</label>
                                {{-- <select class="form-control select2" id="StockTyp" name="StockTyp" required>
                                    <option class="font-14">الرجاء إختيار نوع المستودع</option>
                                    <option class="font-14" value="S">مستودع</option>
                                    <option class="font-14" value="E">موظف</option>
                                    <option class="font-14" value="M">صيانة</option>
                                </select> --}}
                                @error('StockTyp')
                                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                        <br>
                        <div class="modal-footer">
                            <button class="btn btn-primary font-16" type="submit"><i class="fe fe-plus-circle me-2"></i>إضافة</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('#updatehardware').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var StockId = button.data('StockId')
            var StockNameAr = button.data('StockNameAr')
            var StockNameEn = button.data('StockNameEn')
            var StockTyp = button.data('StockTyp')
            var modal = $(this)
            modal.find('.modal-body #StockId').val(StockId);
            modal.find('.modal-body #StockNameAr').val(StockNameAr);
            modal.find('.modal-body #StockNameEn').val(StockNameEn);
            modal.find('.modal-body #StockTyp').val(StockTyp);
        })
    </script>
@endsection


