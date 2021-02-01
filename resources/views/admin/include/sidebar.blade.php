<div class="card text-white bg-dark mb-3">
    <div class="card-header"><a style="color: white" href="{{ asset(route('dashboard')) }}">پیشخوان</a></div>
</div>
<div class="card">
    <div class="card-header">
        دسترسی ها
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <a href="{{ asset(route('newOrder')) }}">ثبت سفارش</a>
        </li>
        <li class="list-group-item">
            <a href="{{ asset(route('orders')) }}"> همه سفارشات</a>
        </li>
        <li class="list-group-item">
            <a href="{{ asset(route('forBoxing')) }}"> برای بستبندی </a>
        </li>
        <li class="list-group-item">
            <a href="{{ asset(route('checkForPost')) }}">چک و آماده به ارسال </a>
        </li>
        <li class="list-group-item">
            <a href="{{ asset(route('posted')) }}">ارسال شده ها </a>
        </li>
        <li class="list-group-item">
            <a href="{{ asset(route('notShipped')) }}">ارسال نشده ها</a>
        </li>
        <li class="list-group-item">
            <a href="{{ asset(route('deficit')) }}">کسری دار</a>
        </li>
        <li class="list-group-item">
            <a href="{{ asset(route('outStock')) }}">عدم موجودی</a>
        </li>
    </ul>
</div>

<div class="card">
    <div class="card-header">
        برگه ها
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <a href="{{ asset('dashboard/page') }}">همه نوشته ها</a>
        </li>
        <li class="list-group-item">
            <a href="{{ asset('dashboard/page/new') }}">نوشته جدید</a>
        </li>
    </ul>
</div>
