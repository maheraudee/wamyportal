@switch($statusid)
    @case(1)
        @if (!OrderColumn($orderid,'sponsor'))
            @foreach (owner('Saving\Orders\Boxorder',$orderid) as $ownr)
                @if ($ownr->empno == EmpNo() || $ownr->userEntry == UserId())
                    <a href="{{ route('orders.edit',$orderid) }}">
                        <span class="tag tag-rounded tag-blue">جديد</span>
                    </a>
                @else
                @can('acn-analyService')
                    <a href="{{ route('boanalyses.show',$orderid) }}">
                        <span class="tag tag-rounded tag-blue">جديد</span>
                    </a>
                @else
                    <span class="tag tag-rounded tag-blue">جديد</span>
                @endcan

                @endif
            @endforeach
        @else
            @if (OrderColumn($orderid,'sponsor') == EmpNo())
                <a href="{{ route('orders.create') }}">
                    <span class="tag tag-teal">إنتظار موافقة الكافل</span>
                </a>
            @elseif (OrderColumn($orderid,'empno') == EmpNo())
                <a href="{{ route('orders.edit',$orderid) }}">
                    <span class="tag tag-teal">إنتظار موافقة الكافل</span>
                </a>

            @else
                <span class="tag tag-teal">إنتظار موافقة الكافل</span>
            @endif

        @endif
        @break
    @case(2)
        <span class="tag tag-rounded tag-azure">موافقة الكافل</span>
        @break
    @case(3)
        <span class="tag tag-rounded tag-orange">رفض الكافل</span>
        @break
    @case(4)
        <span class="tag tag-rounded tag-lime">معتمد مالياً</span>
        @break
    @case(5)
        <span class="tag tag-rounded tag-pink">رفض الطلب مالياً</span>
        @break
    @case(6)
        <span class="tag tag-rounded tag-indigo">الموظف</span>
        @break
    @case(7)
        <span class="tag tag-rounded tag-secondary">المحاسب</span>
        @break
    @case(8)
            <span class="tag tag-rounded tag-yellow">الرئيس</span>
        @break
    @case(9)
        <span class="tag tag-rounded tag-gray-dark">العقد</span>
        @break
    @case(10)
        <span class="tag tag-rounded tag-red">رفض الطلب</span>
        @break
    @case(11)
        <span class="tag tag-rounded tag-green">مدفوع</span>
        @break
    @default
@endswitch

{{-- @switch($statusid)
    @case(1)
        @if (!OrderColumn($orderid,'sponsor'))
            <span class="tag tag-rounded tag-blue">جديد</span>
        @else
            <span class="tag tag-blue">إنتظار موافقة الكافل</span>
        @endif
        @break
    @case(2)
        <span class="tag tag-rounded tag-cyan">موافقة الكافل</span>
        @break
    @case(3)
        <span class="tag tag-rounded tag-orange">رفض الكافل</span>
        @break
    @case(4)
        <span class="tag tag-rounded tag-lime">معتمد مالياً</span>
        @break
    @case(5)
        <span class="tag tag-rounded tag-red">رفض الطلب مالياً</span>
        @break
    @case(6)
        <span class="tag tag-rounded tag-green">الموظف</span>
        @break
    @case(7)
        <span class="tag tag-rounded tag-green">المحاسب</span>
        @break
    @case(8)
        <span class="tag tag-rounded tag-green">الرئيس</span>
        @break
    @case(9)
        <span class="tag tag-rounded tag-icon tag-gray-dark">
            <i class="fa fa-print"></i>
            طباعة العقد
        </span>
        @break
    @case(10)
        <span class="tag tag-rounded tag-red">رفض الطلب</span>
        @break
    @case(11)
        <span class="tag tag-rounded tag-red">مدفوع</span>
        @break
    @default
@endswitch --}}
{{-- @switch($statusid)
    @case(1)
        @if (!$order->sponsor)
            @foreach (owner('Saving\Orders\Boxorder',$orderid) as $ownr)
                @if ($ownr->empno == EmpNo() || $ownr->userEntry == UserId())
                    <a href="{{ route('orders.edit',$orderid) }}">
                        <span class="tag tag-rounded tag-blue">جديد</span>
                    </a>
                @else
                    <a href="{{ route('boanalyses.show',$orderid) }}">
                        <span class="tag tag-rounded tag-blue">جديد</span>
                    </a>
                @endif
            @endforeach
        @else
            @if ($order->sponsor == EmpNo())
                <a href="{{ route('orders.create') }}">
                    <span class="tag tag-blue">إنتظار موافقة الكافل</span>
                </a>
            @else
                <span class="tag tag-blue">إنتظار موافقة الكافل</span>
            @endif

        @endif
        @break
    @case(2)
        <span class="tag tag-rounded tag-cyan">موافقة الكافل</span>
        @break
    @case(3)
        <span class="tag tag-rounded tag-orange">رفض الكافل</span>
        @break
    @case(4)
        <span class="tag tag-rounded tag-lime">معتمد مالياً</span>
        @break
    @case(5)
        <span class="tag tag-rounded tag-red">رفض الطلب مالياً</span>
        @break
    @case(6)
        @foreach (owner('Saving\Orders\Boxorder',$orderid) as $key => $value)
            @if ($value->userEntry ==  UserId() && $value->empno == EmpNo())
                <a href="{{ route('contractOrder',[$orderid,3,3]) }}">
                    <span class="tag tag-rounded tag-green">الموظف</span>
                </a>
            @else
                <span class="tag tag-rounded tag-green">الموظف</span>
            @endif
        @endforeach

        @break
    @case(7)
        <span class="tag tag-rounded tag-green">المحاسب</span>
        @break
    @case(8)
        <span class="tag tag-rounded tag-green">الرئيس</span>
        @break
    @case(9)
        <a href="{{ route('printcontractOrder',$orderid) }}">
            <span class="tag tag-rounded tag-icon tag-gray-dark">
                <i class="fa fa-print"></i>
                طباعة العقد
            </span>
        </a>
        @break
    @case(10)
        <span class="tag tag-rounded tag-red">رفض الطلب</span>
        @break
    @case(11)
        <span class="tag tag-rounded tag-red">ملغي</span>
        @break
    @default
@endswitch --}}

{{-- @switch($statusid)
    @case(1)
        <span class="tag tag-rounded tag-blue">جديد</span>
        @break
    @case(2)
        <span class="tag tag-rounded tag-cyan">موافقة الكافل</span>
        @break
    @case(3)
        <span class="tag tag-rounded tag-orange">رفض الكافل</span>
        @break
    @case(4)
        <span class="tag tag-rounded tag-lime">معتمد مالياً</span>
        @break
    @case(5)
        <span class="tag tag-rounded tag-red">رفض الطلب</span>
        @break
    @case(6)
        <span class="tag tag-rounded tag-green">معتمد</span>
        @break
    @case(7)
        <a href="{{ route('printcontractOrder',$orderid) }}">
            <span class="tag tag-rounded tag-icon tag-gray-dark">
                <i class="fa fa-print"></i>
                طباعة العقد
            </span>
        </a>
        @break
    @default
@endswitch --}}
