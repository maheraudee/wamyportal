@extends('layouts.wamy.wamy')
@section('css')
@endsection
@section('title')
    <title>إضافة عهدة - الندوة العالمية للشباب الإسلامي</title>
@endsection
@section('content')
<div class="mb-5"></div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title hedr-font">إضافة عهدة</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        @include('alert.errors')
                    @endif
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form id="addSavings" action="{{route('inventories.store')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                                        {{ csrf_field() }}
                                            <div class="row">
                                                <div class="col-sm col-md">
                                                    <label for="hdwbarcode" class="font-16">باركود</label>
                                                    <input type="text" class="form-control @error('hdwbarcode') is-invalid @enderror" id="hdwbarcode" name="hdwbarcode" value="{{ old('hdwbarcode') }}">
                                                    @error('hdwbarcode')
                                                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-sm col-md">
                                                    <label for="tphdwid" class="font-16">نوع الجهاز</label>
                                                    <select class="form-control select2-show-search form-select" id="tphdwid" name="tphdwid" required value="{{ old('tphdwid') }}">
                                                        <option class="font-14" value="0">الرجاء إختيار نوع الجهاز</option>
                                                        @foreach ($typhardwares as $typhardware)
                                                            <option class="font-14" value="{{$typhardware->id}}">{{$typhardware->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('tphdwid')
                                                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="manfid" class="font-16">الشركة</label>
                                                    <select class="form-control select2 select2-show-search form-select" id="manfid" name="manfid" required>
                                                        <option class="font-14" value="0">الرجاء إختيار الشركة</option>
                                                        @foreach ($manufacturers as $manufacturer)
                                                            <option class="font-14" value="{{$manufacturer->id}}">{{$manufacturer->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('manfid')
                                                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <label for="hdwmodel" class="font-16">الموديل</label>
                                                    <input type="text" class="form-control @error('hdwmodel') is-invalid @enderror" id="hdwmodel" name="hdwmodel" value="{{ old('hdwmodel') }}">
                                                    @error('hdwmodel')
                                                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="invtypeid" class="font-16">نوع العهدة</label>
                                                    <select class="form-control select2 select2-show-search form-select" id="invtypeid" name="invtypeid" required>
                                                        <option class="font-14" value="0">الرجاء إختيار نوع العهدة</option>
                                                        @foreach ($invtytypes as $invtytype)
                                                            <option class="font-14" value="{{$invtytype->TypeId}}">{{$invtytype->TypeNameAr}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('invtypeid')
                                                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <label for="stockin" class="font-16">صاحب العهدة</label>
                                                    <select class="form-control select2 select2-show-search form-select" id="stockin" name="stockin" required>
                                                        <option class="font-14" value="0">الرجاء إختيار المستودع</option>
                                                        @foreach ($stores as $store)
                                                            <option class="font-14" value="{{$store->StockId}}">{{$store->StockId}} - {{$store->StockNameAr}}</option>
                                                        @endforeach
                                                    </select>

                                                    {{-- <input type="text" class="form-control @error('stockin') is-invalid @enderror" id="stockin" name="stockin"> --}}
                                                    @error('stockin')
                                                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-12">
                                                    <label for="note" class="font-16">ملاحظات</label>
                                                    <input type="text" class="form-control @error('note') is-invalid @enderror" id="note" name="note" value="{{ old('note') }}">
                                                    @error('note')
                                                        <div class="alert alert-danger" role="alert">{{ $message }}</div>
                                                    @enderror
                                                </div>
                        
                                            </div>
                                            {{-- <br>
                                            <div class="modal-footer">
                                                <button class="btn btn-primary font-16" type="submit"><i class="fe fe-plus-circle me-2"></i>إضافة</button>
                                            </div> --}}
                                            <br>
                                            <div class="d-flex justify-content-center">
                                                <button type="submit" id="savelink" class="btn btn-primary">إضافة</button>
                                            </div>
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
    {{-- <script src="{{asset('public/assets/js/Saving/orders.js') }}"></script> --}}
@endsection


