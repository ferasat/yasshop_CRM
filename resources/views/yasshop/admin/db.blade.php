@extends('layouts.app')
@section('title' , 'دیتابیس')
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        Featured
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">بررسی و تعمییر جدول wp_postmeta</h5>

                        <a onclick="fixDB()" class="btn btn-primary">تعمییر کن</a>
                        <div id="result"></div>
                    </div>
                </div>

            </div>
            <div class="col-md-3">
                @include('admin.include.sidebar')
            </div>
        </div>

    </div>
@endsection

