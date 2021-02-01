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
                                <a class="nav-link active" href="">سفارش جدید : انتخاب کالا</a>
                            </li>
                        </ul>
                    </div>


                    <div class="card-body">

                        <div class="row">
                            <div class="form-row">
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

                    </div>


                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3>جستجوی در بین محصولات </h3>
                                    </div>
                                    <br>
                                    <div class="table-responsive">
                                        <div class="input-group mb-2">
                                        <div class="form-group">
                                            <label class="sr-only"  for="search">نام محصول را جستجو کنید</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">نام محصول را وارد کنید:</div>
                                                </div>

                                            <input type="text" class="form-control" onchange="onChengInput()"
                                                                               id="search" name="search">
                                            </div>
                                        </div>
                                        </div>
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>کد محصول</th>
                                                <th>نام محصول</th>
                                                <th>قیمت</th>
                                                <th>تصویر</th>
                                                <th>اضافه کردن</th>
                                            </tr>
                                            </thead>
                                            <tbody id="reAjax">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <label>محصولات در سبد خرید </label>
                                        <div class="float-left">
                                            <button onclick="updateCart()" class="btn btn-primary"> بروزرسانی سبد خرید
                                            </button>
                                        </div>
                                    </div>

                                    <form action="{{ asset(route('saveProductToCart')) }}" method="post">
                                        @csrf
                                        <div class="table-responsive">

                                            <table class="table table-bordered table-hover ">
                                                <thead>
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
                                                <tbody id="cart">

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-12">
                                            <input type="submit" class="btn btn-dark btn-w100"
                                                   value="اضافه کردن کالا ها">
                                        </div>
                                        <input type="hidden" id="cart_id" name="cart_id" value="{{ $id -> id }}">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                        var baseUrl = window.location.origin ;
                        function onChengInput() {
                            var request = new XMLHttpRequest();
                            var wordSearch = document.getElementById('search').value;
                            request.open('get', baseUrl+'/dashboard/search/ajax/?word=' + wordSearch);
                            console.log(request);
                            request.onreadystatechange = function () {
                                if ((request.readyState === 4) && (request.status === 200)) {
                                    console.log(request);
                                    var reAjax = document.getElementById('reAjax');
                                    reAjax.innerHTML = request.responseText;
                                    // reAjax.innerHTML = '<strong>Big</strong> big';
                                    console.log(request.responseText);
                                } else {
                                    console.log('Error');
                                }
                            }

                            request.send();
                        }

                        function addToCart(id) {
                            var cart_id = document.getElementById('cart_id').value;
                            var request = new XMLHttpRequest();
                            console.log(cart_id + '--' + id);
                            request.open('get', 'http://127.0.0.1:8000/dashboard/orders/cart/' + cart_id + '/add/?ID=' + id);
                            console.log(request);
                            console.log(request.onreadystatechange);
                            request.onreadystatechange = function () {
                                if ((request.readyState === 4) && (request.status === 200)) {
                                    console.log(request);
                                    var cart = document.getElementById('cart');
                                    cart.innerHTML = request.responseText;
                                } else {
                                    console.log(request);
                                    var cart = document.getElementById('cart');
                                    cart.innerHTML = 'مشکلی پیش آمده';
                                }
                            }
                            request.send();
                        }

                        function deleteRow(id) {
                            var cart_id = document.getElementById('cart_id').value;
                            var request = new XMLHttpRequest();
                            request.open('get', 'http://127.0.0.1:8000/dashboard/orders/cart/deleteFromCart/?cart_id=' + cart_id + '&&ID=' + id);
                            request.onreadystatechange = function () {
                                if ((request.status === 200) && (request.readyState === 4)) {
                                    console.log(request);
                                    var cart = document.getElementById('cart');
                                    cart.innerHTML = request.responseText;
                                } else {
                                    console.log(request);
                                    var cart = document.getElementById('cart');
                                    cart.innerHTML = 'مشکلی پیش آمده';
                                }
                            }
                            request.send();
                        }

                        function updateCart() {
                            var cart_id = document.getElementById('cart_id').value;
                            var request = new XMLHttpRequest();
                            request.open('get', 'http://127.0.0.1:8000/dashboard/orders/cart/update/?cart_id=' + cart_id);
                            request.onreadystatechange = function () {
                                if ((request.status === 200) && (request.readyState === 4)){
                                    console.log(request);
                                    var cart = document.getElementById('cart');
                                    cart.innerHTML = request.responseText;
                                } else {
                                    console.log(request);
                                    var cart = document.getElementById('cart');
                                    cart.innerHTML = 'مشکلی پیش آمده';
                                }
                            };
                            request.send();
                        }

                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection
