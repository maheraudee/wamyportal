@extends('layouts.wamy.wamy')
@section('css')
@endsection
@section('title')
    <title>الصلاحيات - الندوة العالمية للشباب الإسلامي</title>
@endsection
@section('content')
<div class="mb-5"></div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-lg-11">
                        <h3 class="card-title hedr-font">الصلاحيات</h3>
                    </div>
                    <div class="col-lg-1">
                        <a href="{{ URL::previous() }}" class="btn  btn-indigo">رجوع</a>
                    </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        @include('alert.errors')
                    @endif

                    <div class="row">
                        <div class="col-lg-3">
                            <button type="submit" class="btn btn-primary me-3  mt-2 hedr-font"
                                data-bs-toggle="modal" data-bs-target="#AddPermission">
                                <i class="fe fe-user-plus me-2"></i>
                                إضافة صلاحية
                            </button>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        @if (count($permissions) > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                                    <thead class="border-top">
                                        <tr>
                                            <th class="hedr-font text-center">#</th>
                                            <th class="hedr-font text-center">إسم الصلاحية</th>
                                            <th class="hedr-font text-center">وصف الصلاحية</th>
                                            <th class="hedr-font text-center">العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permissions as $permission)
                                            <tr class="border-bottom font-center">
                                                <td class="font-14 text-center">{{$loop->iteration }}</td>
                                                <td class="font-14 text-center">{{ $permission->name }}</td>
                                                <td class="font-14 text-center">{{ $permission->desc }}</td>
                                                <td class="font-14 text-center">
                                                    <a class="btn btn-secondary" href="{{ route('admin.permissions.edit',$permission->id) }}">
                                                        <i class="fe fe-git-merge"></i>
                                                    </a>
                                                    |
                                                    <button class="btn btn-danger" >
                                                        <i class="fe fe-trash"></i>
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
                                <h1 class="text-center mt-5">عفواً لا يوجد صلاحيات</h1>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="AddPermission">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h3 class="card-title hedr-font">إضافة صلاحية</h3>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate action="{{ route('admin.permissions.store') }}" method="POST">
                        @csrf
                        {{-- @method('PATCH') --}}
                        <div class="mb-3">
                            <label for="name">الصلاحية</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <br>
                        <div class="mb-3">
                            <label for="desc">وصف الصلاحية</label>
                            <input type="text" class="form-control" id="desc" name="desc">
                        </div>
                        <br>
                        <div class="modal-footer">
                            <button class="btn btn-info font-16" type="submit">حفظ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('#AddPermission').on('show.bs.modal', function(event) {
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


