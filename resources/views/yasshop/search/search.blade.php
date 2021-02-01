@extends('layouts.app')
@section('title' , 'جستجوی زنده')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ asset('/dashboard/orders/') }}">سفارشات</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ asset('/dashboard/orders/new') }}">سفارش جدید</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    @php
                                    $cart_id = 1 ;
                                    $numberSessionCart = 'cart_'.$cart_id ;
                                            if (session()->has($numberSessionCart))
                                            {
                                                print_r(session($numberSessionCart)) ;
                                            }
                                    @endphp
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3>محصولات در سبد خرید </h3>
                                        </div>
                                        <input type="hidden" id="cart_id" name="cart_id" value="1">
                                        <div class="panel-body">

                                            <table class="table table-bordered table-hover table-responsive">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>کد محصول</th>
                                                    <th>نام محصول</th>
                                                    <th>قیمت</th>
                                                    <th>تصویر</th>
                                                    <th>تعداد</th>
                                                </tr>
                                                </thead>
                                                <tbody id="cart">

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
                                            <h3>جستجوی در بین محصولات </h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <input type="text" class="form-controller" onchange="onChengInput()"
                                                       id="search" name="search">
                                            </div>
                                            <table class="table table-bordered table-hover table-responsive">
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
                        <script type="text/javascript">
                            function onChengInput() {
                                var request = new XMLHttpRequest();
                                var wordSearch = document.getElementById('search').value;
                                request.open('get', 'http://127.0.0.1:8000/dashboard/search/ajax/?word=' + wordSearch);
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
                                var cart_id = document.getElementById('cart_id').value ;
                                var request = new XMLHttpRequest();
                                console.log(cart_id + '--' + id);
                                request.open('get', 'http://127.0.0.1:8000/dashboard/orders/cart/'+cart_id+'/add/?ID='+id);
                                console.log(request);
                                console.log(request.onreadystatechange);
                                request.onreadystatechange = function () {
                                    if ( (request.readyState === 4 ) && (request.status === 200 )){
                                        console.log(request);
                                        var cart = document.getElementById('cart');
                                        cart.innerHTML = request.responseText ;
                                    } else {
                                        console.log(request);
                                        var cart = document.getElementById('cart');
                                        cart.innerHTML = 'مشکلی پیش آمده' ;
                                    }
                                }

                                request.send();
                            }

                        </script>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
