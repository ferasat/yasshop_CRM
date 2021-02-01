@extends('layouts.app')
@section('title' , 'انبار')
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-9">

                <div class="card" style="">
                    <h5 class="card-header">موجودی انبار </h5>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong> موجودی واقعی کل محصولات : </strong>{{ $total_inventory }}
                        </li>
                        <li class="list-group-item">
                            <strong> ارزش مالی کالا ها (قیمت خرید) : </strong> {{ $financial_cost_of_products }} تومان
                        </li>
                        <li class="list-group-item">
                            <strong> ارزش تک فروشی محصولات (موجود در انبار) : </strong> {{ $sales_value_of_products }} تومان
                        </li>
                        <li class="list-group-item">
                            <strong> سود احتمالی تک فروشی محصولات (موجود در انبار) : </strong> {{ $sales_value_of_products - $financial_cost_of_products }} تومان
                        </li>

                    </ul>
                    <div class="card-body">

                    </div>
                </div>

                <div class="card" style="top:10px;">
                    <h5 class="card-header"> کسری های انبار </h5>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">تعداد کسری انبار : {{$numberP}} عدد</li>
                    </ul>
                    <div class="card-body">
                        <table class="table table-bordered table-hover table-responsive">
                            <thead>
                            <tr>
                                <th>تصویر</th>
                                <th>کد محصول</th>
                                <th>نام محصول</th>
                                <th>موجودی</th>
                                <th>آینده تامین</th>
                            </tr>
                            </thead>
                            <tbody >
                            {!! $lessProducts !!}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                @include('admin.include.sidebar')
            </div>
        </div>

    </div>
@endsection

