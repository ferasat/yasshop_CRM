@extends('layouts.app')
@section('title' , 'لیست همه سفارشات')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" style="padding: 0;">
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ asset('/dashboard/orders/') }}">سفارشات</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ asset('/dashboard/orders/new') }}">سفارش جدید</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">بیشتر</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ asset('/dashboard/orders/new') }}">سفارش جدید</a>
                                    <a class="dropdown-item" href="{{ asset(route('notShipped')) }}">ارسال نشده</a>
                                    <a class="dropdown-item" href="{{ asset(route('posted')) }}">ارسال شده</a>
                                    <a class="dropdown-item" href="{{ asset(route('deficit')) }}">کسری دار</a>
                                    <a class="dropdown-item" href="{{ asset(route('outStock')) }}">عدم موجودی</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ asset(route('dashboard')) }}">پیشخوان</a>
                                    <a class="dropdown-item" href="{{ asset(route('warehousing')) }}">انبار</a>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="table-responsive">
                                <div class="col-12">
                                    <table class="table ">
                                        <thead class="thead-dark ">
                                        <tr>
                                            <th scope="col">نام مشتری</th>
                                            <th scope="col"> کد سفارش</th>
                                            <th scope="col">نوع پرداخت</th>
                                            <th scope="col">مبلغ</th>
                                            <th scope="col">محل سفارش</th>
                                            <th scope="col">وضعیت</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($allOders as $order)
                                            <tr>
                                                <td><a href="{{ asset('dashboard/orders/cart/'.$order -> id) }}">{{ $order -> customer }}</a></td>
                                                <td>{{ $order -> id }}</td>
                                                <td>{{ $order -> typeprice }}</td>
                                                <td>{{ $order -> price }}</td>
                                                <td>{{ $order -> srcsale }}</td>
                                                <td>{{ $order -> status }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{--<div class="mobail">
                                <div class="products-mobail">
                                    <div class="head-mobail">محصولات</div>
                                    @foreach($allProducts as $product)
                                    <div class="product-mobail">
                                        <div class="name-mobail">{{ $product -> name }} :</div>
                                        <div class="name-cat">{{ $product -> category }}</div>
                                        <div class="name-pic">
                                            @if( $product -> pic == null )
                                                ندارد
                                            @else
                                                <img src="{{ asset($product -> pic) }}" alt="{{ $product -> name }}"
                                                     class="w100" style="width: 100px;height: 100px">
                                            @endif
                                        </div>
                                        <div class="name-price">
                                            <form action="{{ asset('/dashboard/product/adddell') }}" method="post">
                                                @csrf
                                                <input type="number" class="yasinput"
                                                       value="{{ $product -> mojodi }}" name="mojodi">
                                                <input type="hidden" name="id" class="btn btn-dark" value="{{ $product -> id }}">
                                                <input type="submit" class="btn btn-dark" value="بروزرسانی">
                                            </form>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
