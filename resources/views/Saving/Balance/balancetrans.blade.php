@extends('layouts.wamy.wamy')
@section('css')
@endsection
@section('title')
    <title>أرصدة المشتركين - الندوة العالمية للشباب الإسلامي</title>
@endsection
@section('content')
<div class="mb-5"></div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    @foreach ($boxbalancestrans as $balance)
                        @if($loop->first)
                            <h3 class="card-title hedr-font">حركات رصيد الموظف / {{ $balance->employee->name }}</h3>
                        @endif
                    @endforeach
                    
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        @include('alert.errors')
                    @endif

                    <div class="row">
                        @if (count($boxbalancestrans) > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                                    <thead class="border-top">
                                        <tr>
                                            <th class="hedr-font text-center">تاريخ الحركة</th>
                                            <th class="hedr-font text-center">نوع الحركة</th>
                                            <th class="hedr-font text-center">مبلغ القسط</th>
                                            <th class="hedr-font text-center">الرصيد</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($boxbalancestrans as $balance)
                                            <tr class="border-bottom font-center">
                                                <td class="font-14 text-center">{{\Carbon\Carbon::parse($balance->datePremium)->format('Y/m/d')}}</td>
                                                <td class="font-14 text-center">{{ $balance->typetran }}</td>
                                                <td class="font-14 text-center">{{number_format($balance->premium,2)}}</td>
                                                <td class="font-14 text-center">{{number_format($balance->balance,2)}}</td>
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
                                <h1 class="text-center mt-5">عفواً لا يوجد مشتركين</h1>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="Accept">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h3 class="card-title hedr-font">تعديل الرصيد</h3>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate action="{{ route('boxbalances.update',1) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <input type="hidden" class="form-control" id="id" name="id">
                            <label for="">الرقم الوظيفي</label>
                            <input type="text" class="form-control" id="empno" name="empno" readonly>
                            <br>
                            <label for="">الاسم</label>
                            <input type="text" class="form-control" id="empname" name="empname" readonly>
                            <br>
                            <label for="">الرصيد</label>
                            <input type="text" class="form-control" id="balance" name="balance">
                        </div>
                        <br>
                        <div class="modal-footer">
                            <button class="btn btn-info font-16" type="submit">تعديل</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('#Accept').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var empno = button.data('empno')
            var empname = button.data('empname')
            var balance = button.data('balance')
            var modal = $(this)

            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #empno').val(empno);
            modal.find('.modal-body #empname').val(empname);
            modal.find('.modal-body #balance').val(balance);
        })
        /* $("#balanceval").on("focusout", function(){
            console.log("Hi Form");
            document.getElementById("myForm").submit();
        }); */

    </script>
@endsection


