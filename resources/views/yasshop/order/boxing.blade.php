@extends('layouts.app')
@section('title' , $title)
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ asset('/dashboard/orders/') }}"> کل سفارشات</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ asset('/dashboard/orders/new') }}">سفارش جدید</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ asset(route('notShipped')) }}">ارسال نشده</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ asset(route('posted')) }}">ارسال شده</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ asset(route('deficit')) }}">کسری دار</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ asset(route('outStock')) }}">عدم موجودی</a>
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
                                            <th scope="col">نوع پرداخت</th>
                                            <th scope="col">مبلغ</th>
                                            <th scope="col">محل سفارش</th>
                                            <th scope="col">وضعیت</th>
                                            <th scope="col">یاداشت</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orders as $order)
                                            <tr>
                                                <td>
                                                    <a href="{{ asset('dashboard/orders/cart/'.$order -> id) }}">{{ $order -> customer }}</a>
                                                </td>
                                                <td>{{ $order -> typeprice }}</td>
                                                <td>{{ $order -> price }}</td>
                                                <td>{{ $order -> srcsale }}</td>
                                                <td>{{ $order -> status }}</td>
                                                <td>{{ $order -> note }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div id="card">
                                        {!! $result !!}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
