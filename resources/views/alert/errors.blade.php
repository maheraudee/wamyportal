<div class="alert alert-danger rounded-pill" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>
    <i class="fa fa-frown-o me-2" style="font-size: 25px" aria-hidden="true"></i>
    <h3 class="mylable">عفواً هنالك خطأ</h3>
    <ul>
        @foreach ($errors->all() as $key => $error)
            <li class="mylable-form">{{$key+1}} - {{ $error }}</li>
        @endforeach
    </ul>
</div>
