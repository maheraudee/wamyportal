@extends('layouts.wamy.wamy')
@section('css')
@endsection
@section('title')
    <title>بيانات العهد - الندوة العالمية للشباب الإسلامي</title>
@endsection
@section('content')
<div class="mb-5"></div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title hedr-font">بيانات العهد</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        @include('alert.errors')
                    @endif
                    @include('Inventory.btn')
                    <hr>
                    <div class="row">
                        @if (count($inventories) > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                                {{-- <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom"> --}}
                                    <thead class="border-top">
                                        <tr>
                                            <th class="hedr-font text-center">#</th>
                                            <th class="hedr-font text-center">الباركود</th>
                                            <th class="hedr-font text-center">نوع الجهاز</th>
                                            <th class="hedr-font text-center">الشركة</th>
                                            <th class="hedr-font text-center">صاحب العهدة</th>
                                            <th class="hedr-font text-center">العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <form action="{{ route('inventories.update',1) }}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            @foreach ($inventories as $key => $inventory)
                                                <tr class="border-bottom font-center">
                                                    <td class="font-14 text-center">{{$loop->iteration }}</td>
                                                    <td class="font-14 text-center">{{$inventory->HdwBarcode}}</td>
                                                    <td class="font-14 text-center">{{$inventory->hardware->typhardware->name}}</td>
                                                    <td class="font-14 text-center">{{$inventory->hardware->manufacturer->name }}</td>
                                                    <td class="font-14 text-center">{{$inventory->stockin->StockId}} --- {{$inventory->stockin->StockNameAr}} </td>
                                                    <td class="font-14 text-center">
                                                        <input type="checkbox" id="invchbox" name="invchbox{{$key}}" value="{{$inventory->HdwBarcode}}" onclick="boxChecked()">
                                                        {{-- <input type="input" name="barcode" value="{{$inventory->HdwBarcode}}"> --}}
                                                        <div class="col-lg-1 me-5" id="transCustody" style="display:none">
                                                            <button type="submit" class="btn btn-primary me-3  mt-2 hedr-font">
                                                                <i class="fe fe-aperture me-2"></i>نقل عهدة
                                                            </button>
                                                        </div>
                                                    </td>

                                                </tr>
                                            @endforeach

                                        </form>
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
<!-- ===============================TransCustody==========================================-->
    @include('Inventory.Custody.TransCustody')
<!-- ===============================Updatehardware==========================================-->
    <div class="modal fade" id="printCustody">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h3 class="card-title hedr-font">طباعة عهدة</h3>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate action="{{route('getCustody',1)}}" method="POST">
                        {{ csrf_field() }}
                        {{-- @method('PATCH') --}}
                            <div class="mb-3">
                                <label for="StockIN" class="font-16">رقم المستودع</label>
                                <select class="form-control select2" id="StockIN" name="StockIN" required>
                                    <option class="font-14">الرجاء إختيار نوع المستودع</option>
                                    @foreach ($stores as $store)
                                        <option class="font-14" value="{{$store->StockId}}">{{$store->StockId}} / {{$store->StockNameAr}}</option>
                                    @endforeach
                                </select>
                                @error('StockIN')
                                    <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                        <br>
                        <div class="modal-footer">
                            <button class="btn btn-primary font-16" type="submit"><i class="fa fa-print me-2"></i>طباعة</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')


    <script>
        function boxChecked2() {
            let invchboxs = document.querySelectorAll("input[type='checkbox']"),
            transCustody = document.getElementById('transCustody');
            /* let invchboxs = document.querySelectorAll("#invchbox"); */
            for (let i = 0; i < invchboxs.length; i++) {
                if (invchboxs[i].checked == true){
                    return invchboxs[i].value;
                }
            }
        }

        $('#transfCustody').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var barcode = button.data('barcode')

            var modal = $(this)

            /* let invchboxs = document.querySelectorAll("input[type='checkbox']");

            for (let i = 0; i < invchboxs.length; i++) {
                if (invchboxs[i].checked == true){
                    /* alert(invchboxs[i].value); */
                    let node = document.createElement("input[name='mmam']");
                    node.value = invchboxs[i].value;
                    document.getElementById("mma").appendChild(node);

                }
            } */
            modal.find('.modal-body #mma').val(25);
        })
        /* $('#updatehardware').on('show.bs.modal', function(event) {
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
        }) */
    </script>
    <script>
        function boxChecked() {
            let invchboxs = document.querySelectorAll("input[type='checkbox']"),
            transCustody = document.getElementById('transCustody');
            /* let invchboxs = document.querySelectorAll("#invchbox"); */
            for (let i = 0; i < invchboxs.length; i++) {
                if (invchboxs[i].checked == true){
                    transCustody.style.display = "block";
                }
            }
        }
    </script>
@endsection


