@extends('layouts.wamy.wamy')
@section('css')
@endsection
@section('title')
    <title>المستودعات</title>
@endsection
@section('content')
<div class="mb-5"></div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title hedr-font">بيانات المستودعات</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        @include('alert.errors')
                    @endif
                    <div class="row">
                        <div class="col-lg-3">
                            <button type="button" class="btn btn-primary me-3  mt-2 hedr-font"
                                data-bs-toggle="modal" data-bs-target="#createstore">
                                <i class="fe fe-plus me-2"></i>إضافة مستودع
                            </button>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        @if (count($stores) > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                                    <thead class="border-top">
                                        <tr>
                                            <th class="hedr-font text-center">#</th>
                                            <th class="hedr-font text-center">الرقم</th>
                                            <th class="hedr-font text-center">الإسم</th>
                                            <th class="hedr-font text-center">Store</th>
                                            <th class="hedr-font text-center">النوع</th>
                                            <th class="hedr-font text-center">الحالة</th>
                                            <th class="hedr-font text-center">العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($stores as $store)
                                            <tr class="border-bottom font-center">
                                                <td class="font-14 text-center">{{$i++ }}</td>
                                                <td class="font-14 text-center">{{$store->StockId}}</td>
                                                <td class="font-14 text-center">{{$store->StockNameAr }}</td>

                                                <td class="font-14 text-center">{{$store->StockNameEn}}</td>
                                                <td class="font-14 text-center">
                                                    @switch($store->StockTyp)
                                                        @case('M')
                                                            صيانة
                                                            @break
                                                        @case('S')
                                                            مستودع
                                                            @break
                                                        @default
                                                            موظف
                                                    @endswitch
                                                </td>
                                                <td class="font-14 text-center">
                                                    <form action="{{route('updateStatues', 'Inventory\Store')}}" method="post" class="btn btn-sm">
                                                        {{ csrf_field() }}
                                                        @method('PATCH')
                                                        @if ($store->status == 1)
                                                            <input type="hidden" name="id" value="{{ $store->StockId }}">
                                                            <input type="hidden" name="name" value="{{ $store->StockNameAr }}">
                                                            <input type="hidden" name="status" value="1">
                                                            <button style="submit" class="btn btn-pill btn-info">فعال</button>
                                                        @else
                                                            <input type="hidden" name="id" value="{{ $store->StockId }}">
                                                            <input type="hidden" name="name" value="{{ $store->StockNameAr }}">
                                                            <input type="hidden" name="status" value="0">
                                                            <button style="submit" class="btn btn-pill btn-danger">غير
                                                                فعال</button>
                                                        @endif
                                                    </form>

                                                </td>
                                                <td class="font-14 text-center">
                                                    <button type="button" class="btn btn-success btn-sm "
                                                            data-bs-toggle="modal" data-bs-target="#updatestore"

                                                            data-stockid="{{ $store->StockId }}" data-stocknamear="{{ $store->StockNameAr }}"
                                                            data-stocknameen="{{ $store->StockNameEn }}" data-stocktyp="{{ $store->StockTyp }}">
                                                            <i class="fa fa-edit"></i>
                                                    </button>
                                                    |
                                                    <button type="button" class="btn btn-danger btn-sm "
                                                    {{-- #modal-delete-{{ $court->id }} --}}
                                                            data-bs-toggle="modal" data-bs-target="#deletestore"
                                                            data-stockid="{{ $store->StockId }}" data-stocknamear="{{ $store->StockNameAr }}">
                                                            <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
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
                                <h1 class="text-center mt-5">عفواً لا يوجد مستودعات</h1>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--Model-->
<!-- ===============================CreateStore==========================================-->
    <div class="modal fade" id="createstore">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h3 class="card-title hedr-font">مستودع جديد</h3>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate action="{{route('stores.store')}}" method="POST">
                        {{ csrf_field() }}
                        {{-- @method('PATCH') --}}
                            <div class="mb-3">
                                <label for="StockId" class="font-16">رقم المستودع</label>
                                <input type="text" class="form-control @error('StockId') is-invalid @enderror" id="StockId" name="StockId" required>
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
                                <select class="form-control select2" id="StockTyp" name="StockTyp" required>
                                    <option class="font-14">الرجاء إختيار نوع المستودع</option>
                                    <option class="font-14" value="S">مستودع</option>
                                    <option class="font-14" value="E">موظف</option>
                                    <option class="font-14" value="M">صيانة</option>
                                </select>
                                @error('sponsorid')
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
<!-- ===============================UpdateStore==========================================-->
    <div class="modal fade" id="updatestore">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h3 class="card-title hedr-font">تحديث بيانات مستودع</h3>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate action="{{route('stores.update',1)}}" method="POST">
                        {{ csrf_field() }}
                        @method('PATCH')
                            <div class="mb-3">
                                <label for="StockId" class="font-16">رقم المستودع</label>
                                <input type="text" class="form-control" id="StockId" name="StockId" readonly>
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
                        <br>
                        <div class="modal-footer">
                            <button class="btn btn-primary font-16" type="submit"><i class="mdi mdi-autorenew me-2"></i>تعديل</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- ===============================DeleteStore==========================================-->
<div class="modal  fade" id="deletestore" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">حذف المستودع</h4>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
            </div>
            <form class="needs-validation" novalidate action="{{route('stores.destroy',1)}}" method="POST">
                {{ csrf_field() }}
                @method('DELETE')
                    <div class="modal-body">
                        <h5>هل تريد حذف المستودع ؟</h5>
                        <input type="hidden" class="form-control" id="stockid" name="stockid" readonly>
                        <input type="text" class="form-control" id="stocknamear" name="stocknamear" readonly>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">حذف</button>
                        <a href="" class="btn btn-secondary">إلغاء</a>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        $('#updatestore').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var stockid = button.data('stockid')
            var stocknamear = button.data('stocknamear')
            var stocknameen = button.data('stocknameen')
            var stocktyp = button.data('stocktyp')
            var modal = $(this)
            modal.find('.modal-body #StockId').val(stockid);
            modal.find('.modal-body #StockNameAr').val(stocknamear);
            modal.find('.modal-body #StockNameEn').val(stocknameen);
            modal.find('.modal-body #StockTyp').val(stocktyp);
        })
        $('#deletestore').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var stockid = button.data('stockid')
            var stocknamear = button.data('stocknamear')

            var modal = $(this)
            modal.find('.modal-body #stockid').val(stockid);
            modal.find('.modal-body #stocknamear').val(stocknamear);
        })
        function deleteItem() {

        }
    </script>
@endsection


