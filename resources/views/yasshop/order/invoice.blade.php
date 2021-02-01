@extends('layouts.app')
@section('title' , 'رسید خرید : '.$id -> customer)
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header ">
                        <ul class="nav nav-tabs card-header-tabs" style="padding: 0;">
                            <li class="nav-item">
                                <a class="nav-link " href="{{ asset('/dashboard/orders/') }}">سفارشات</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active"> رسید خرید</a>
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
                            <div class="form-row">
                                <div class="col-12">
                                    <div class="panel-heading">
                                        <label>اطلاعات مشتری : </label>
                                        <div class="float-left">
                                            شماره سفارش :{{ $id -> id }}
                                        </div>

                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="sr-only" for="inlineFormInputGroup">نام خریدار</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">نام خریدار</div>
                                        </div>
                                        <input type="text" class="form-control" name="customer"
                                               value="{{ $id -> customer }}" disabled>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="sr-only" for="inlineFormInputGroup">شماره تماس خریدار</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">شماره تماس خریدار</div>
                                        </div>
                                        <input type="text" class="form-control" name="customer_cellphone"
                                               value="{{ $id -> customer_cellphone }}" disabled>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="sr-only" for="inlineFormInputGroup">کد پستی</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">کد پستی</div>
                                        </div>
                                        <input type="text" class="form-control" name="customer_zipcode"
                                               value="{{ $id -> customer_zipcode }}" disabled>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="sr-only" for="inlineFormInputGroup">آدرس پستی </label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">آدرس پستی</div>
                                        </div>
                                        <input type="text" class="form-control" name="customer_address"
                                               value="{{ $id -> customer_address }}" disabled>
                                    </div>
                                </div>

                            </div>{{--اطلاعت مشتری--}}
                            <hr>
                            <div class="form-row">
                                <div class="col-12">
                                    <label class="sr-only" for="inlineFormInputGroup"> نوع پرداخت</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">نوع پرداخت</div>
                                        </div>
                                        <input type="text" class="form-control" name="customer_address"
                                               value="{{ $id -> typeprice }}" disabled>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="sr-only" for="inlineFormInputGroup"> محل سفارش</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">محل سفارش</div>
                                        </div>
                                        <input type="text" class="form-control" name="customer_address"
                                               value="{{ $id -> srcsale }}" disabled>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="sr-only" for="inlineFormInputGroup">نوع پست </label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">نوع پست</div>
                                        </div>
                                        <input type="text" class="form-control" name="customer_address"
                                               value="{{ $id -> typepost }}" disabled>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="sr-only" for="inlineFormInputGroup">توصیه های مشتری</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">توصیه های مشتری</div>
                                        </div>
                                        <input type="text" class="form-control" name="details"
                                               value="{{ $id -> details }}" disabled>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="sr-only" for="inlineFormInputGroup">یادداشت های ادمین</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">یادداشت های ادمین</div>
                                        </div>
                                        <input type="text" class="form-control" name="description"
                                               value="{{ $id -> description }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-row w-100">
                                <div class="col-12">
                                    <div class="panel-heading">
                                        <label>محصولات در سبد خرید </label>

                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th>ID</th>
                                                <th>کد محصول</th>
                                                <th>نام محصول</th>
                                                <th> قیمت تک</th>
                                                <th>تعداد</th>
                                                <th>قیمت</th>
                                                <th>تصویر</th>
                                            </tr>
                                            </thead>
                                            <tbody id="resultFinal">
                                            {!! $result !!}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6">
                                            مبلغ کل خرید : {{ $id -> price }} تومان
                                        </div>
                                        <div class="col-6">
                                            سود این فاکتور : {{ $id -> profit_sales }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="center">
                                    <div class="btn btn-success" ><a style="color: white"  href="{{asset('dashboard/orders')}}">رفتن به سفارشات</a></div>
                                    <div class="btn btn-primary" ><a style="color: white"  href="{{asset('dashboard/orders/new')}}">ثبت سفارش جدید</a></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
