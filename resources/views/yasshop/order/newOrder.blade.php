@extends('layouts.app')
@section('title' , 'ساخت سفارش مشتری')
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
                                <a class="nav-link active" href="{{ asset('/dashboard/orders/new') }}">سفارش جدید</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="newCustomer">
                                <form action="{{ asset('/dashboard/orders/new') }}" method="post">
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-12">
                                            <label class="sr-only" for="inlineFormInputGroup">نام خریدار</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">نام خریدار</div>
                                                </div>
                                                <input type="text" class="form-control" name="customer"
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
                                                       placeholder="آدرس پستی" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="sr-only" for="inlineFormInputGroup">نوع خرید</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">نوع خرید</div>
                                                </div>
                                                <select name="opt1"  class="form-control">
                                                    <option selected value="تک فروشی">تک فروشی</option>
                                                    <option value="عمده">عمده</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <input type="submit" class="btn btn-dark btn-w100" value="ساخت سبد خرید">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
