@extends('layouts.app')
@section('title' , 'سبد خرید : '.$id -> customer)
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link " href="{{ asset('/dashboard/orders/') }}">سفارشات</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="">سفارش جدید : ثبت نهایی</a>
                            </li>
                        </ul>
                    </div>


                    <div class="card-body">
                        <form action="{{ asset('dashboard/orders/cart/saveInfoCart/'.$id -> id) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <h4>اطلاعات زیر را تکمیل کنید :</h4>
                                    </div>
                                    <div class="col-12">
                                        <label class="sr-only" for="inlineFormInputGroup"> نوع پرداخت</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">نوع پرداخت</div>
                                            </div>
                                            <select name="typeprice" class="form-control" required>
                                                <option value="آنلاین">آنلاین</option>
                                                <option selected value="درمحل">درمحل</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="sr-only" for="inlineFormInputGroup"> محل سفارش</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">محل سفارش</div>
                                            </div>
                                            <select name="srcsale" class="form-control" required>
                                                <option selected value="تلگرام">تلگرام</option>
                                                <option value="اینستاگرام">اینستاگرام</option>
                                                <option value="سایت">سایت</option>
                                                <option value="واتس آپ">واتس آپ</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="sr-only" for="inlineFormInputGroup"> محل سفارش</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">محل سفارش</div>
                                            </div>
                                            <select name="typepost" class="form-control" required>
                                                <option selected value="سفارشی">سفارشی</option>
                                                <option value="پیشتاز">پیشتاز</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="sr-only" for="inlineFormInputGroup">توصیه های مشتری</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">توصیه های مشتری</div>
                                            </div>
                                            <input type="text" class="form-control" name="details">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="sr-only" for="inlineFormInputGroup">یادداشت های ادمین</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">یادداشت های ادمین</div>
                                            </div>
                                            <input type="text" class="form-control" name="description">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <h4 style="color: orangered">اطلاعات زیر را بررسی کنید :</h4>
                                    </div>
                                    <div class="col-12">
                                        <div class="panel-heading">
                                            <label>اطلاعات مشتری : </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="sr-only" for="inlineFormInputGroup">نام خریدار</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">نام خریدار</div>
                                            </div>
                                            <input type="text" class="form-control" name="customer"
                                                   value="{{ $id -> customer }}"
                                                   placeholder="نام خریدار را وارد کنید" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="sr-only" for="inlineFormInputGroup">شماره تماس خریدار</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">شماره تماس خریدار</div>
                                            </div>
                                            <input type="text" class="form-control" name="customer_cellphone"
                                                   value="{{ $id -> customer_cellphone }}"
                                                   placeholder="شماره تماس" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="sr-only" for="inlineFormInputGroup">کد پستی</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">کد پستی</div>
                                            </div>
                                            <input type="text" class="form-control" name="customer_zipcode"
                                                   value="{{ $id -> customer_zipcode }}"
                                                   placeholder="کد پستی" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="sr-only" for="inlineFormInputGroup">آدرس پستی </label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">آدرس پستی</div>
                                            </div>
                                            <input type="text" class="form-control" name="customer_address"
                                                   value="{{ $id -> customer_address }}"
                                                   placeholder="آدرس پستی" required>
                                        </div>
                                    </div>

                                </div>
                            </div> {{--اطلاعت مشتری--}}
                            <hr>
                            <div class="row">
                                <div class="form-row">
                                    <div class="col-12">
                                        <div class="panel-heading">
                                            <label>محصولات در سبد خرید </label>
                                            <div class="float-left">
                                                <button onclick="updateCart()" class="btn btn-primary"> بروزرسانی سبد
                                                    خرید
                                                </button>
                                            </div>
                                        </div>

                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover">
                                                <thead class="thead-dark">
                                                <tr>
                                                    <th>ID</th>
                                                    <th>کد محصول</th>
                                                    <th>نام محصول</th>
                                                    <th>قیمت</th>
                                                    <th>تصویر</th>
                                                    <th>تعداد</th>
                                                    <th>حذف</th>
                                                </tr>
                                                </thead>
                                                <tbody id="resultFinal">
                                                {!! $result !!}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-row">
                                    <button type="submit" class="btn btn-w100 btn-success btn-lg">ذخیره فاکتور</button>
                                </div>
                            </div>
                        </form>

                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
