@extends('layouts.wamy.wamy')
@section('css')
@endsection
@section('title')
    <title>بيانات المساهمين - الندوة العالمية للشباب الإسلامي</title>
@endsection
@section('content')
<div class="mb-5"></div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title hedr-font">بيانات المساهمين</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        @include('alert.errors')
                    @endif

                    <div class="row">
                        @if (count($savings) > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                                    <thead class="border-top">
                                        <tr>
                                            {{-- <th class="hedr-font text-center">#</th> --}}
                                            <th class="hedr-font text-center">الرقم الوظيفي</th>
                                            <th class="hedr-font text-center">الإسم</th>
                                            <th class="hedr-font text-center">تاريخ الإنضمام</th>
                                            <th class="hedr-font text-center">الراتب</th>
                                            <th class="hedr-font text-center">مبلغ القسط</th>
                                            <th class="hedr-font text-center">مبلغ المساهمة</th>
                                            <th class="hedr-font text-center">العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($savings as $saving)
                                            <tr class="border-bottom font-center">
                                                {{-- <td class="font-14 text-center">{{$i++ }}</td> --}}
                                                <td class="font-14 text-center">{{$saving->empno}}</td>
                                                <td class="font-14 text-center">{{$saving->employee->name}}</td>
                                                <td class="font-14 text-center">
                                                    {{\Carbon\Carbon::parse($saving->datePremium)->format('Y/m/d')}}
                                                    {{-- {{$saving->datePremium}} --}}
                                                </td>
                                                <td class="font-14 text-center">{{number_format($saving->employee->salary,2)}}</td>
                                                <td class="font-14 text-center">{{number_format($saving->premium,2)}}</td>
                                                <td class="font-14 text-center">{{number_format($saving->contribute,2)}}</td>
                                                <td class="font-14 text-center">
                                                    <button type="button" class="btn btn-success btn-sm "
                                                            data-bs-toggle="modal" data-bs-target="#updatecontribute"
                                                            data-empno="{{ $saving->empno }}" data-name="{{$saving->employee->name}}"
                                                            data-contribute="{{ $saving->contribute }}">
                                                            <i class="fa fa-edit"></i>
                                                            تعديل المساهمة
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
                                <h1 class="text-center mt-5">عفواً لا يوجد مساهمين</h1>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- ===============================UpdateContribute==========================================-->
<div class="modal fade" id="updatecontribute">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h3 class="card-title hedr-font">تعديل مبلغ المساهمة</h3>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate action="{{route('savings.update',2)}}" method="POST">
                    {{ csrf_field() }}
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="empno" class="font-16">الرقم</label>
                        <input type="text" class="form-control @error('empno') is-invalid @enderror" id="empno" name="empno" readonly>
                        @error('id')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="name" class="font-16">الاسم</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" readonly>
                        @error('name')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="contribute" class="font-16">مبلغ المساهمة</label>
                        <input type="text" class="form-control @error('contribute') is-invalid @enderror" id="contribute" name="contribute">
                        @error('contribute')
                            <div class="alert alert-danger" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- <div class="mb-3" id="reasonrefusediv">
                        <label for="reasonrefuse" class="control-label font-14">سبب الرفض</label>
                        <input type="text" class="form-control data-font" id="reasonrefuse" name="reasonrefuse">
                    </div> --}}
                    <br>
                    <div class="modal-footer">
                        <button class="btn btn-primary font-16" type="submit">تعديل</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $('#updatecontribute').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var empno = button.data('empno')
        var name = button.data('name')
        var contribute = button.data('contribute')
        /* var approvalstsid = button.data('approvalstsid') */
        var modal = $(this)

        modal.find('.modal-body #empno').val(empno);
        modal.find('.modal-body #name').val(name);
        modal.find('.modal-body #contribute').val(contribute);
    })
</script>
@endsection


