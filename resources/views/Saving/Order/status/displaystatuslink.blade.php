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
        {{-- @if (EmpNo() == 11829 || EmpNo() ==  11402) --}}
        @can('acn-analyService')
            <a href="{{ route('boanalyses.show',$orderid) }}">
                <span class="tag tag-rounded tag-azure">موافقة الكافل</span>
            </a>
        @else
            <span class="tag tag-rounded tag-azure">موافقة الكافل</span>
        @endcan
        @break
    @case(3)
        <span class="tag tag-rounded tag-orange">رفض الكافل</span>
        @break
    @case(4)
        {{-- @if (EmpNo() == 11829 || EmpNo() ==  11402) --}}
        @can('acn-analyService')
            <a href="{{ route('boanalyses.edit',$orderid) }}">
                <span class="tag tag-rounded tag-lime">معتمد مالياً</span>
            </a>
        @elsecan('acn-comitService')
            <a href="{{ route('contractOrder',[$orderid,1,1]) }}">
                <span class="tag tag-rounded tag-lime">معتمد مالياً</span>
            </a>
        @else
            <span class="tag tag-rounded tag-lime">معتمد مالياً</span>
        @endif

        @break
        @case(5)
        <span class="tag tag-rounded tag-pink">رفض الطلب مالياً</span>
        @break
    @case(6)
        @if (OrderColumn($orderid,'empno') == EmpNo())
            <a href="{{ route('contractOrder',[$orderid,3,3]) }}">
                <span class="tag tag-rounded tag-indigo">الموظف</span>
            </a>
        @else
            <span class="tag tag-rounded tag-indigo">الموظف</span>
        @endif
        @break
    @case(7)
        {{-- @if (EmpNo() == 11829 || EmpNo() ==  11402) --}}
        @can('acn-accntService')
            <a href="{{ route('contractOrder',[$orderid,3,4]) }}">
                <span class="tag tag-rounded tag-secondary">المحاسب</span>
            </a>
        @else
            <span class="tag tag-rounded tag-secondary">المحاسب</span>
        @endcan
        @break
    @case(8)
        {{-- @if (EmpNo() == 11829 || EmpNo() ==  11547) --}}
        @can('acn-mangService')
            <a href="{{ route('contractOrder',[$orderid,3,5]) }}">
                <span class="tag tag-rounded tag-yellow">الرئيس</span>
            </a>
        @else
            <span class="tag tag-rounded tag-yellow">الرئيس</span>
        @endcan
        @break
    @case(9)
        @foreach (owner('Saving\Orders\Boxorder',$orderid) as $ownr)
            @if ($ownr->empno == EmpNo() || $ownr->userEntry == UserId())
                <a href="{{ route('printcontractOrder',$orderid) }}">
                    <span class="tag tag-rounded tag-icon tag-gray-dark">
                        <i class="fa fa-print"></i>
                        طباعة العقد
                    </span>
                </a>
            @else
                @can('acn-printcontract')
                    <a href="{{ route('printcontractOrder',$orderid) }}">
                        <span class="tag tag-rounded tag-icon tag-gray-dark">
                            <i class="fa fa-print"></i>
                            طباعة العقد
                        </span>
                    </a>
                @else
                    <span class="tag tag-rounded tag-gray-dark">العقد</span>
                @endcan
            @endif
        @endforeach
        @break
    @case(10)
        <span class="tag tag-rounded tag-red">رفض الطلب</span>
        @break
    @case(11)
        <span class="tag tag-rounded tag-green">مدفوع</span>
        @break
    @default
@endswitch
