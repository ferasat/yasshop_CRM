@extends('layouts.app')
@section('title' , $title)
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">


                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    دسترسی سریع
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <a class="dropdown-item" href="{{ asset(route('orders')) }}"> همه سفارشات</a>
                                    <a class="dropdown-item" href="{{ asset(route('forBoxing')) }}"> برای بستبندی </a>
                                    <a class="dropdown-item" href="{{ asset(route('checkForPost')) }}">چک و آماده به ارسال </a>
                                    <a class="dropdown-item" href="{{ asset(route('posted')) }}">ارسال شده ها </a>
                                    <a class="dropdown-item" href="{{ asset(route('deficit')) }}">کسری دار</a>
                                </div>
                            </div>
                        </div>
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
                                            <th scope="col">یاداشت</th>
                                            <th scope="col">تایید</th>
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
                                                <td>{{ $order -> note }}</td>
                                                <td id="td-{{$order -> id}}">
                                                    <button id="sta-{{$order -> id}}" onclick="status(id='{{$order -> id}}',s=3)" type="button" class="btn btn-secondary btn-{{$order -> id}}" >تایید؟</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
