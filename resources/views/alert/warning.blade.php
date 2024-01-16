@extends('layouts.wamy.wamy')
@section('css')
@endsection
@section('title')
    <title>تنبيه - الندوة العالمية للشباب الإسلامي</title>
@endsection
@section('content')
<div class="mb-5"></div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title hedr-font">تنبيه</h3>
                </div>
                <div class="card-body">
                    {{-- @if ($errors->any())
                        @include('alert.errors')
                    @endif

                    <div class="row">

                    </div> --}}
                    @if ($msg)
                        <div class="card bd-0 mg-b-20 bg-danger">
                            <div class="card-body text-white">
                                <div class="main-error-wrapper">
                                    {{-- <i class="si si-close mg-b-20 tx-50"></i> --}}
                                    <h3 class="mg-b-0">{{$msg}}</h3>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')

@endsection