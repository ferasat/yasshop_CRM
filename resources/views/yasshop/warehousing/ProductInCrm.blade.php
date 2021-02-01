@extends('layouts.app')
@section('title' , 'لیست محصولات')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ asset(route('productInCrm')) }}">محصولات در سی ار ام</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ asset('/dashboard/product/new') }}">محصول جدید</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="desktop">
                                <form action="{{ asset('') }}" method="post" class="searchProduct">
                                    <div class="form-group row">

                                        <div class="col-md-8">
                                            <input id="email" type="email" class="form-control " name="word">
                                        </div>
                                        <button class="col-md-3 col-form-label btn btn-info">جستجو</button>
                                    </div>
                                </form>
                            <form action="{{ asset('/dashboard/product/adddell') }}" method="post">@csrf
                                <table class="table ">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">نام محصول</th>
                                        <th scope="col"> ق فروش</th>
                                        <th scope="col">ق عمده </th>
                                        <th scope="col">ق خرید</th>
                                        <th scope="col">موجودی</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allProducts as $product)

                                        <tr>

                                            <td>{{ $product -> cat_zivar }}:{{ $product -> name }} (کد:{{ $product -> sku }})</td>
                                            <td>
                                                    <input type="number" class="yasinput" name="price"
                                                       value="{{  $product-> price }}"> </td>
                                            <td>
                                                    <input type="number" class="yasinput" name="priceom"
                                                       value="{{  $product-> priceom }}">
                                            </td>
                                            <td >
                                                <input type="number" class="yasinput" name="pricekharid"
                                                       value="{{  $product-> pricekharid }}">
                                            </td>
                                            <td>
                                                    <input type="number" class="yasinput" name="mojodi"
                                                           value="{{ $product -> mojodi }}">
                                                    <input type="hidden" name="id" value="{{ $product -> id }}">
                                                    <input type="submit" class="btn btn-dark" value="بروزرسانی">

                                            </td>

                                        </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </form>
                            </div>

                            <div class="mobail">
                                <div class="products-mobail">
                                    <div class="head-mobail">محصولات</div><br>
                                    @foreach ($allProducts as $product)
                                    <div class="product-mobail">
                                        <div class="name-cat">{{ $product -> cat_zivar }}:</div>
                                        <div class="name-mobail">{{ $product -> name }} (کد:{{ $product-> sku }})</div>

                                        <div class="name-pic">
                                            @if( $product-> product_pic == null )
                                                عکس ندارد
                                            @else
                                                <img src="{{  $product-> pic }}" alt="{{ '' }}"
                                                     class="w100" style="width: 100px;height: 100px">
                                            @endif
                                        </div>
                                        <div class="name-price">
                                            <form action="{{ asset('/dashboard/product/adddell') }}" method="post">
                                                @csrf
                                                <div class="row-input">
                                                    <span>قیمت فروش</span>
                                                    <input type="number" class="yasinput" name="price"
                                                       value="{{  $product-> price }}">
                                                </div>
                                                <div class="row-input">
                                                    <span>قیمت عمده</span>
                                                    <input type="number" class="yasinput" name="priceom"
                                                       value="{{  $product-> priceom }}">
                                                </div>

                                                <div class="row-input">
                                                    <span>قیمت خرید</span>
                                                    <input type="number" class="yasinput" name="pricekharid"
                                                       value="{{  $product-> pricekharid }}">
                                                </div>

                                                <div class="row-input">
                                                    <span>موجودی </span>
                                                    <input type="number" class="yasinput" name="mojodi"
                                                       value="{{  $product-> mojodi }}">
                                                </div>
                                                <input type="hidden" name="id" value="{{  $product-> id }}">
                                                <input type="submit" class="btn btn-dark" value="بروزرسانی">
                                            </form>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
