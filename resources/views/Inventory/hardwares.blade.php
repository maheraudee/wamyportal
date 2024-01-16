@extends('layouts.wamy.wamy')
@section('css')
@endsection
@section('title')
    <title>أنواع الأجهزة - الندوة العالمية للشباب الإسلامي</title>
@endsection
@section('content')
<div class="mb-5"></div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title hedr-font">بيانات أنواع الأجهزة</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        @include('alert.errors')
                    @endif
                    <div class="row">
                        <div class="col-lg-3">
                            <button type="button" class="btn btn-primary me-3  mt-2 hedr-font"
                                data-bs-toggle="modal" data-bs-target="#createCustody">
                                <i class="fe fe-plus me-2"></i>إضافة نوع جهاز
                            </button>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        @if (count($hardwares) > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                                    <thead class="border-top">
                                        <tr>
                                            <th class="hedr-font text-center">#</th>
                                            <th class="hedr-font text-center">الباركود</th>
                                            <th class="hedr-font text-center">النوع</th>
                                            <th class="hedr-font text-center">الشركة</th>
                                            <th class="hedr-font text-center">الموديل</th>
                                            <th class="hedr-font text-center">الحالة</th>
                                            <th class="hedr-font text-center">العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($hardwares as $hardware)
                                            <tr class="border-bottom font-center">
                                                <td class="font-14 text-center">{{$i++ }}</td>
                                                <td class="font-14 text-center">{{$hardware->HdwBarcode}}</td>
                                                <td class="font-14 text-center">{{$hardware->typhardware->name}}</td>
                                                <td class="font-14 text-center">{{$hardware->manufacturer->name}}</td>
                                                <td class="font-14 text-center">{{$hardware->HdwModel}}</td>
                                                <td class="font-14 text-center">
                                                    <form action="{{route('updateStatues', 'Inventory\Hardware')}}" method="post" class="btn btn-sm">
                                                        {{ csrf_field() }}
                                                        @method('PATCH')
                                                        {{-- <button type="submit" class="btn btn-info btn-pill btn-sm">
                                                            فعال
                                                        </button> --}}
                                                        @if ($hardware->status == 1)
                                                            <input type="hidden" name="id" value="{{ $hardware->id }}">
                                                            <input type="hidden" name="name" value="{{ $hardware->typhardware->name }}">
                                                            <input type="hidden" name="status" value="1">
                                                            <button style="submit" class="btn btn-pill btn-info">فعال</button>
                                                        @else
                                                            <input type="hidden" name="id" value="{{ $hardware->id }}">
                                                            <input type="hidden" name="name" value="{{ $hardware->typhardware->name }}">
                                                            <input type="hidden" name="status" value="0">
                                                            <button style="submit" class="btn btn-pill btn-danger">غير
                                                                فعال</button>
                                                        @endif
                                                    </form>

                                                </td>
                                                <td class="font-14 text-center">
                                                    <button type="button" class="btn btn-success btn-sm "
                                                            data-bs-toggle="modal" data-bs-target="#updatehardware"
                                                            data-hdwbarcode="{{ $hardware->HdwBarcode }}" data-typhardware="{{ $hardware->typhardware->name }}"
                                                            data-manufacturer="{{$hardware->manufacturer->name}}" data-hdwmodel = "{{$hardware->HdwModel}}">
                                                            <i class="fa fa-edit"></i>
                                                    </button>
                                                    |
                                                    <form action="{{route('hardwares.destroy',$hardware->id)}}" method="post" class="btn btn-sm">
                                                        {{ csrf_field() }}
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
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
<!-- ===============================Createhardware==========================================-->
    <div class="modal fade" id="createhardware">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h3 class="card-title hedr-font">نوع جهاز جديد</h3>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate action="{{route('hardwares.store')}}" method="POST">
                        {{ csrf_field() }}
                        {{-- @method('PATCH') --}}
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="HdwBarcode" class="font-16">الباركود</label>
                                    <input type="text" class="form-control @error('HdwBarcode') is-invalid @enderror" id="HdwBarcode" name="HdwBarcode">
                                    @error('HdwBarcode')
                                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="TphdwId" class="font-16">نوع الجهاز</label>
                                    <select class="form-select form-control select2-show-search form-select" id="TphdwId" name="TphdwId" required>
                                        <option selected value="" value="">الرجاء إختيار نوع الجهاز</option>
                                        @foreach ($typhardwares as $typhardware)
                                            <option value="{{$typhardware->id}}">{{$typhardware->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('TphdwId')
                                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="ManfId" class="font-16">الشركة</label>
                                    <select class="form-select form-control select2-show-search form-select" id="ManfId" name="ManfId" required>
                                        <option selected value="" value="">الرجاء إختيار الشركة المصنعة</option>
                                        @foreach ($manufacturers as $manufacturer)
                                            <option value="{{$manufacturer->id}}">{{$manufacturer->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('ManfId')
                                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="HdwModel" class="font-16">الموديل</label>
                                    <input type="text" class="form-control @error('HdwModel') is-invalid @enderror" id="HdwModel" name="HdwModel">
                                    @error('HdwModel')
                                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                            <div class="mb-3" id="OSystemsDiv">
                                <label for="OSystems" class="font-16">نظام التشغيل</label>
                                <input type="text" class="form-control @error('OSystems') is-invalid @enderror" id="OSystems" name="OSystems">
                                @error('OSystems')
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
<!-- ===============================Updatehardware==========================================-->
<div class="modal fade" id="updatehardware">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h3 class="card-title hedr-font">تحديث بيانات جهاز</h3>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate action="{{route('hardwares.update',1)}}" method="POST">
                    {{ csrf_field() }}
                    @method('PATCH')
                        <div class="mb-3">
                            <label for="hdwbarcode" class="font-16">باركود الجهاز</label>
                            <input type="text" class="form-control" id="hdwbarcode" name="hdwbarcode" required>
                            @error('hdwbarcode')
                                <div class="alert alert-danger" role="alert">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- <h1>{{ $hardware->typhardware->id }} -- {{ $hardware->typhardware->name }}</h1> --}}
                        <div class="mb-3">
                            <label for="typhardware" class="font-16">نوع الجهاز</label>
                            <select class="form-control select2" id="typhardware" name="typhardware" required>
                                {{-- <option value="{{ $hardware->typhardware->id }}">{{ $hardware->typhardware->name }}</option> --}}
                                <option value=""></option>
                                {{-- @foreach ($typhardwares as $typhardware)
                                    @if ($typhardware->id != $hardware->typhardware->id)
                                        <option class="font-14" value="{{$typhardware->id}}">{{$typhardware->name}}</option>
                                    @endif
                                @endforeach --}}
                            </select>
                            @error('typhardware')
                                <div class="alert alert-danger" role="alert">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="manufacturer" class="font-16">الشركة المصنعة</label>
                            <input type="text" class="form-control @error('manufacturer') is-invalid @enderror" id="manufacturer" name="manufacturer">
                            @error('manufacturer')
                                <div class="alert alert-danger" role="alert">{{ $message }}</div>
                            @enderror
                        </div>
                    <br>
                    <div class="modal-footer">
                        <button class="btn btn-primary font-16" type="submit"><i class="mdi mdi-autorenew me-2"></i>تحديث</button>
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
            var hdwbarcode = button.data('hdwbarcode')
            var typhardware = button.data('typhardware')
            var manufacturer = button.data('manufacturer')
            var hdwmodel = button.data('hdwmodel')
            var modal = $(this)
            modal.find('.modal-body #hdwbarcode').val(hdwbarcode);
            modal.find('.modal-body #typhardware').val(typhardware);
            modal.find('.modal-body #manufacturer').val(manufacturer);
            modal.find('.modal-body #StockTyp').val(hdwmodel);
        })
    </script>
@endsection


