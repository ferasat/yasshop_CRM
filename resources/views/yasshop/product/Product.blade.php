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
                                <a class="nav-link active" href="{{ asset('/dashboard/product/') }}">محصولات</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ asset('/dashboard/product/new') }}">محصول جدید</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="desktop">
                                <table class="table ">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">نام محصول</th>
                                        <th scope="col"> کد محصول</th>
                                        <th scope="col">دسته بندی</th>
                                        <th scope="col">تصویر</th>
                                        <th scope="col">موجودی</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @for($x = 1 ; $x < $count  ; $x++)
                                        {{--در تبدیل آریه به اطلاعات نمایشی گیرم چون نمیشناسهدش--}}
                                        {{--@dd($count -1 )
                                        @dd($allProducts[$x]['product_name'])--}}
                                        <tr>
                                            <td>{{ $allProducts[$x]['product_name'] }}</td>
                                            <td>{{ $allProducts[$x]['sku'] }} </td>
                                            <td> .. </td>
                                            <td style="padding: 0px;">
                                                <img src="{{ $allProducts[$x]['product_pic']  }}" alt="{{ $allProducts[$x]['product_name'] }}"
                                                         class="w100" style="width: 100px;height: 100px">

                                            </td>
                                            <td>
                                                <form action="{{ asset('/dashboard/product/adddell') }}" method="post">
                                                    @csrf
                                                    <input type="number" class="yasinput" name="mojodi"
                                                           value="{{ $allProducts[$x]['value_real'] }}">
                                                    <input type="hidden" name="id" value="{{ $allProducts[$x]['value_real'] }}">
                                                    <input type="submit" class="btn btn-dark" value="بروزرسانی">
                                                </form>
                                            </td>
                                        </tr>
                                    @endfor
                                    </tbody>
                                </table>
                            </div>
                            <div class="mobail">
                                <div class="products-mobail">
                                    <div class="head-mobail">محصولات</div>
                                    @for($x = 1 ; $x < $count  ; $x++)
                                    <div class="product-mobail">
                                        <div class="name-mobail">{{ $allProducts[$x]['product_name'] }} :</div>
                                        <div class="name-cat">{{ $allProducts[$x]['sku'] }}</div>
                                        <div class="name-cat">{{ $allProducts[$x]['sku'] }}</div>
                                        <div class="name-pic">
                                            @if( $allProducts[$x]['product_pic'] == null )
                                                ندارد
                                            @else
                                                <img src="{{ $allProducts[$x]['product_pic'] }}" alt="{{ '' }}"
                                                     class="w100" style="width: 100px;height: 100px">
                                            @endif
                                        </div>
                                        <div class="name-price">
                                            <form action="{{ asset('/dashboard/product/adddell') }}" method="post">
                                                @csrf
                                                <input type="number" class="yasinput" name="mojodi"
                                                       value="{{ $allProducts[$x]['value_real'] }}">
                                                <input type="hidden" name="id" value="{{ $allProducts[$x]['value_real'] }}">
                                                <input type="submit" class="btn btn-dark" value="بروزرسانی">
                                            </form>
                                        </div>
                                    </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
