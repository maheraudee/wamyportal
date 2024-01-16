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
                    <h3 class="card-title hedr-font">العنوان</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        @include('alert.errors')
                    @endif

                    <div class="row">

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')

@endsection