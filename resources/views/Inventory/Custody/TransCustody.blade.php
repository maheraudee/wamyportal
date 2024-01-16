<div class="modal fade " id="transfCustody">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h3 class="card-title hedr-font">نقل عهدة</h3>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate action="" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-6">
                            <label for="invtypeid" class="font-16">نوع العهدة</label>
                            <select class="form-control select2" id="invtypeid" name="invtypeid" required>
                                <option class="font-14">الرجاء إختيار نوع العهدة</option>
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
                            @error('stockin')
                                <div class="alert alert-danger" role="alert">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <input type="text" class="form-control" id="mma">
                            {{-- <div id="mma"></div> --}}
                            <label for="note" class="font-16">ملاحظات</label>
                            <input type="text" class="form-control @error('note') is-invalid @enderror" id="note" name="note">
                            @error('note')
                                <div class="alert alert-danger" role="alert">{{ $message }}</div>
                            @enderror
                        </div>

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
