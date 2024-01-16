@extends('layouts.wamy.wamy')
@section('css')
@endsection
@section('title')
    <title>تعديل الصلاحية - الندوة العالمية للشباب الإسلامي</title>
@endsection
@section('content')
<div class="mb-5"></div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-lg-11">
                        <h3 class="card-title hedr-font">تعديل الصلاحية</h3>
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
                        <div class="col-lg-12 col-md-12">
                            <div class="card ">
                                <div class="card-body">
                                    <form  action="{{ route('admin.permissions.update',$permission) }}"
                                        method="post" enctype="multipart/form-data" autocomplete="off" onsubmit="return validateForm()">
                                        {{ csrf_field() }}
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col">
                                                <label for="name" class="control-label"> الصلاحية </label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ $permission->name }}">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="d-flex justify-content-center">
                                                <button type="submit" class="btn btn-primary"> تعديل الصلاحية </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div style="margin-bottom: 180px"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title hedr-font">Permission Role</h3>

                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        @if ($permission->roles)
                                            @foreach ($permission->roles as $permission_role)
                                                <form  action="{{ route('admin.permissions.roles.remove',[$permission->id,$permission_role->id]) }}"
                                                    method="post" enctype="multipart/form-data"  onsubmit="return confirm('هل تريد سحب الدور ؟');">
                                                    {{ csrf_field() }}
                                                    @method('DELETE')
                                                        <button type="submit" class="tag tag-rounded tag-icon tag-{{ $permission_role->id % 2 == 0 ? 'cyan':'teal'}} border-0">
                                                                {{ $permission_role->name }}
                                                                <i class="fe fe-x text-white m-1"></i>
                                                        </button>&nbsp;&nbsp;&nbsp;
                                                </form>
                                            @endforeach
                                        @endif
                                    </div>
                                    <br><br>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <form  action="{{ route('admin.permissions.roles',$permission->id) }}"
                                                method="post" enctype="multipart/form-data" autocomplete="off" onsubmit="return validateForm()">
                                                {{ csrf_field() }}
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="role" class="control-label"> الأدوار </label>
                                                        {{-- <input type="text" class="form-control" id="name" name="name"
                                                            value="{{ $role->name }}"> --}}
                                                        <select class="form-control select2-show-search form-select" id="role" name="role">
                                                            <option value="0" >الرجاء إختيار الدور</option>
                                                            @foreach ($roles as $role)
                                                                <option value="{{ $role->name }}">  {{ $role->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <br>
                                                <br>
                                                <div class="row">
                                                    <div class="d-flex justify-content-center">
                                                        <button type="submit" class="btn btn-primary"> Assign </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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


