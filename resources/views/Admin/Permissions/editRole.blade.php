@extends('layouts.wamy.wamy')
@section('css')
@endsection
@section('title')
    <title>تعديل دور - الندوة العالمية للشباب الإسلامي</title>
@endsection
@section('content')
<div class="mb-5"></div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-lg-11">
                        <h3 class="card-title hedr-font">تعديل دور</h3>
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
                            <div class="card">
                                <div class="card-body">
                                    <form  action="{{ route('admin.roles.update',$role->id) }}"
                                        method="post" enctype="multipart/form-data" autocomplete="off" onsubmit="return validateForm()">
                                        {{ csrf_field() }}
                                        @method('PUT')
                                            <div class="row">
                                                <div class="col">
                                                    <label for="name" class="control-label"> الدور </label>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        value="{{ $role->name }}">
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="row">
                                                <div class="d-flex justify-content-center">
                                                    <button type="submit" class="btn btn-primary"> تعديل الدور </button>
                                                </div>
                                            </div>
                                    </form>
                                </div>
                            </div>
                            {{-- <div style="margin-bottom: 180px"></div> --}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title hedr-font">Role Permission</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="d-flex flex-wrap justify-content-center">
                                            @if ($role->permissions)
                                                @foreach ($role->permissions as $role_permission)
                                                    <div class="p-2">
                                                        <form  action="{{ route('admin.roles.permissions.revoke',[$role->id,$role_permission->id]) }}"
                                                            method="post" enctype="multipart/form-data"  onsubmit="return confirm('هل تريد سحب الصلاحية');">
                                                            {{ csrf_field() }}
                                                            @method('DELETE')
                                                                <button type="submit" class="tag tag-rounded tag-icon tag-{{ $role_permission->id % 2 == 0 ? 'cyan':'teal'}} border-0">
                                                                        {{ $role_permission->desc }}
                                                                        <i class="fe fe-x text-white m-1"></i>
                                                                </button>&nbsp;&nbsp;&nbsp;
                                                        </form>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <form  action="{{ route('admin.roles.permissions',$role->id) }}"
                                                method="post" enctype="multipart/form-data" autocomplete="off" onsubmit="return validateForm()">
                                                {{ csrf_field() }}
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="permission" class="control-label"> الصلاحية </label>
                                                        <select multiple="multiple" class="multi-select" id="permission" name="permission[]">
                                                            @foreach ($permissions as $permission)
                                                                <option value="{{ $permission->name }}">{{ $permission->desc }}  /  {{ $permission->name }}</option>
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
                                    <br>
                                </div>
                            </div>
                            <div style="margin-bottom: 180px"></div>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title hedr-font">Role Permission</h3>
                                </div>
                                <div class="card-body">
                                    <form  action="{{ route('admin.roles.update',$role->id) }}"
                                        method="post" enctype="multipart/form-data" autocomplete="off" onsubmit="return validateForm()">
                                        {{ csrf_field() }}
                                        @method('PUT')
                                            <div class="row">
                                                <div class="col">
                                                    <label for="permission" class="control-label"> الدور </label>
                                                    <select class="form-control select2-show-search form-select" id="permission" name="permission">
                                                        <option value="0" >الرجاء إختيار الكافل</option>
                                                        @foreach ($permissions as $permission)
                                                            <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="row">
                                                <div class="d-flex justify-content-center">
                                                    <button type="submit" class="btn btn-primary"> تعديل الدور </button>
                                                </div>
                                            </div>
                                    </form>
                                </div>
                            </div>
                            <div style="margin-bottom: 180px"></div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    {{-- <script src="{{asset('public/assets/js/Saving/orders.js') }}"></script> --}}
    <script src="{{asset('public/assets/plugins/multi/multi.min.js')}}"></script>
    <!-- MULTI SELECT JS-->
    <script src="{{asset('public/assets/plugins/multipleselect/multiple-select.js')}}"></script>
    <script src="{{asset('public/assets/plugins/multipleselect/multi-select.js')}}"></script>
@endsection


