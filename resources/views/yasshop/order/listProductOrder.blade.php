@extends('layouts.app')
@section('title' , 'لیست محصولات')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ asset('/dashboard/orders/') }}">سفارشات</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ asset('/dashboard/orders/new') }}">سفارش جدید</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="row">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
