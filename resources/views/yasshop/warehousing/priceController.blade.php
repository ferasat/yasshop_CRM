@extends('layouts.app')
@section('title' , 'بررسی قیمت و موجودی کالا ها')
@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ asset(route('dashboard')) }}">پیشخوان</a></li>
                <li class="breadcrumb-item"><a href="{{ asset(route('warehousing')) }}">انبار</a></li>
                <li class="breadcrumb-item active" aria-current="page">بررسی قیمت و موجودی کالا ها</li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <div class="row">

            <div class="col-md-9">

                <div class="card">
                    <h5 class="card-header">بررسی قیمت و موجودی کالا ها </h5>
                    <div id="card-body" class="card-body">
                        {!! $result !!}
                    </div>
                </div>


            </div>
            <div class="col-md-3">
                @include('admin.include.sidebar')
            </div>
        </div>

    </div>
@endsection
