@extends('layouts.wamy.wamy')
@section('css')
@endsection
@section('title')
    <title>لوحة التحكم</title>
@endsection
@section('content')
<div class="mb-5"></div>
<div class="row">
    {{-- <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
        <div class="card bg-secondary img-card box-secondary-shadow">
            <div class="card-body">
                <div class="d-flex">
                    <div class="text-white">
                        <h2 class="mb-0 number-font">{{$ststcOrphans}}</h2>
                        <h4 class="text-white mb-0">الأيتام</h4>
                    </div>
                    <div class="ms-auto"> <i class="fa fa-heart-o text-white fs-30 me-2 mt-2"></i> </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
        <div class="card bg-primary img-card box-primary-shadow">
            <div class="card-body">
                <div class="d-flex">
                    <div class="text-white">
                        <h2 class="mb-0 number-font">{{$ststcSponsors}}</h2>
                        <h4 class="text-white mb-0">الكفلاء</h4>
                    </div>
                    <div class="ms-auto"> <i class="fa fa-user-o text-white fs-30 me-2 mt-2"></i> </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
        <div class="card  bg-success img-card box-success-shadow">
            <div class="card-body">
                <div class="d-flex">
                    <div class="text-white">
                        <h2 class="mb-0 number-font">{{$ststcNewOrphans}}</h2>
                        <p class="text-white mb-0">إيتام غير معتمدين</p>
                    </div>
                    <div class="ms-auto"> <i class="fa fa-comment-o text-white fs-30 me-2 mt-2"></i> </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
        <div class="card bg-info img-card box-info-shadow">
            <div class="card-body">
                <div class="d-flex">
                    <div class="text-white">
                        <h2 class="mb-0 number-font">{{$ststcNewSponsors}}</h2>
                        <p class="text-white mb-0">كفلاء غير معتمدين</p>
                    </div>
                    <div class="ms-auto"> <i class="fa fa-envelope-o text-white fs-30 me-2 mt-2"></i> </div>
                </div>
            </div>
        </div>
    </div> --}}
</div>
@endsection
@section('js')
<!-- CHART-CIRCLE JS-->
    <script src="{{asset('public/assets/js/circle-progress.min.js')}}"></script>
    <script src="{{asset('public/assets/js/widget.min.js')}}"></script>
@endsection

