@extends('layouts.wamy.wamy')
@section('css')
    <style>
        .file-upload {
            display: none;
            
        }
        .p-image {
            position: absolute;
            top: 90px;
            right: 50px;
            color: #0095ff;
         transition: all .3s cubic-bezier(.175, .885, .32, 1.275);
        }
        .p-image:hover {
            transition: all .3s cubic-bezier(.175, .885, .32, 1.275);
        }
        .upload-button {
            font-size: 1.2em;
        }

        .upload-button:hover {
            transition: all .3s cubic-bezier(.175, .885, .32, 1.275);
            color: #999;
        }
    </style>
@endsection
@section('title')
    <title>الملف الشخصي - الندوة العالمية للشباب الإسلامي</title>
@endsection
@section('content')
<div class="mb-5"></div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title hedr-font">الملف الشخصي للموظف -  {{$employee->name}}</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        @include('alert.errors')
                    @endif

                    <div class="row">
                    <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form id="addSavings" action="{{ route('employees.update',$employee->empno) }}"
                                        method="post" enctype="multipart/form-data" autocomplete="off">
                                        {{ csrf_field() }}
                                        @method('PATCH')
                                        <div class="row">
                                            <div class="col">
                                                <label for="empno" class="control-label"> الرقم الوظيفي </label>
                                                <input type="text" class="form-control" id="empno" name="empno"  value="{{$employee->empno}}" readonly>
                                            </div>
                                            <div class="col-sm col-md">
                                                <label for="name" class="control-label">الإسم</label>
                                                <input type="text" class="form-control border-warning" id="name" name="name"  value="{{$employee->name}}">
                                            </div>
                                            <div class="col-sm col-md">
                                                <label for="department" class="control-label">الإدارة</label>
                                                <input type="text" class="form-control" id="department" name="department" value="{{$employee->department}}" disabled>
                                            </div>
                                            <div class="col-sm col-md">
                                                <label for="section" class="control-label">القسم</label>
                                                <input type="text" class="form-control" id="section" name="section" value="{{$employee->section}}" disabled>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm col-md">
                                                <label for="mobile" class="control-label">جوال</label>
                                                <input type="text" class="form-control border-warning" id="mobile" name="mobile" value="{{$employee->mobile}}"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                            </div>
                                            <div class="col-sm col-md">
                                                <label for="nationality" class="control-label">الجنسية</label>
                                                <input type="text" class="form-control" id="nationality" name="nationality" value="{{$employee->nationality}}" disabled>
                                            </div>
                                            <div class="col-sm col-md">
                                                <label for="cardid" class="control-label"> رقم بطاقة الأحوال/الإقامة </label>
                                                <input type="text" class="form-control" id="cardid" name="cardid" value="{{$employee->cardid}}" disabled
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                            </div>
                                            <div class="col-sm col-md">
                                                <label for="salary" class="control-label">الراتب</label>
                                                <input type="text" class="form-control" id="salary" name="salary" value="{{number_format($employee->salary,2)}}" disabled
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-3 col-md-3">
                                                <label for="" class="control-label">البريد الإلكتروني</label>
                                                <input type="text" class="form-control" id="section" name="section" value="{{$employee->email}}" disabled>
                                                
                                            </div>
                                            <div class="col-sm-3 col-md-3">
                                                <label for="" class="control-label">صندوق الإدخار</label>
                                                <input type="text" class="form-control" id="section" name="section" value="{{$employee->Savings ? 'مشترك':'غير مشترك'}}" disabled>
                                                
                                            </div>
                                        </div>
                                        <br><br>
                                        <div class="row">
                                            <div class="col-sm-3 col-md-3">
                                                <label for="" class="control-label">الصورة الشخصية</label>
                                                <br>
                                                <div class="row">
                                                    <div class="small-12 medium-2 large-2 columns">
                                                        <img class="profile-pic avatar avatar-xxl profile-user brround cover-image"
                                                            src="{{ $employee->user[0]->avatar ? getImage('Users/'.$employee->user[0]->avatar) : getImage('Users/profile.jpg') }}">
                                                        <div class="p-image">
                                                        <i class="fa fa-camera upload-button" id="profilebtn"></i>
                                                            <input class="file-upload" id="profile" name="profile" type="file" accept="image/*"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-md-3">
                                                <label for="" class="control-label">التوقيع</label>
                                                <br>
                                                <div class="row">
                                                    <div class="small-12 medium-2 large-2 columns">
                                                        <img class="signature-pic avatar avatar-xxl profile-user brround cover-image" 
                                                            src="{{ $employee->user[0]->signature ? getImage('Signature/'.$employee->user[0]->signature) : getImage('no-image.jpg') }}">
                                                        <div class="p-image">
                                                        <i class="fa fa-camera upload-button" id="signaturebtn"></i>
                                                            <input class="file-upload" id="signature" name="signature" type="file" accept="image/*"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        <br><br><br>
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary">تحديث الملف</button>
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
    <script>
        $(document).ready(function() {
            var inptprofile = document.getElementById("profile"),
            inptsignature = document.getElementById("signature");

            var readURLProf = function(inptprofile) {
                if (inptprofile.files && inptprofile.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('.profile-pic').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(inptprofile.files[0]);
                }
            }

            var readURLSign = function(inptsignature) {
                if (inptsignature.files && inptsignature.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('.signature-pic').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(inptsignature.files[0]);
                }
            }
            $("#profile").on('change', function(){
                readURLProf(this);
            });
            
            $("#profilebtn").on('click', function() {
                $("#profile").click();
            });

            

            $("#signature").on('change', function(){
                readURLSign(this);
            });
            
            $("#signaturebtn").on('click', function() {
                $("#signature").click();
            });
        });
    </script>
@endsection