@extends('layouts.app')
@section('title' , 'تعریف محصول جدید')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link " href="{{ asset('/dashboard/product/') }}">محصولات</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ asset('/dashboard/product/new') }}">محصول جدید</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <form method="post" action="{{ asset('/dashboard/product/new') }}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="col-12 ">
                                    <label class="sr-only" for="inlineFormInputGroup">Username</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">نام محصول</div>
                                        </div>
                                        <input type="text" class="form-control" name="name"
                                               placeholder="نام محصول را وارد کنید" required>
                                    </div>
                                </div>


                                <div class="col-md-12 col-sm-12">
                                    <label class="sr-only" for="code">کد محصول</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">کد محصول</div>
                                        </div>
                                        <input type="text" class="form-control" name="sku" placeholder="کد محصول">
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <label class="sr-only" for="price">قیمت محصول</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">قیمت محصول</div>
                                        </div>
                                        <input type="number" class="form-control" name="price" required>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <label class="sr-only" for="priceom">قیمت عمده</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">قیمت عمده</div>
                                        </div>
                                        <input type="number" class="form-control" name="priceom">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <label class="sr-only" for="pricekharid">قیمت خرید</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">قیمت خرید</div>
                                        </div>
                                        <input type="number" class="form-control" name="pricekharid">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <label class="sr-only" for="priceom">تصویر محصول </label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">تصویر محصول</div>
                                        </div>
                                        <input type="file" class="form-control" name="pic">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <label class="sr-only" for="pricekharid">دستبندی </label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"> دستبندی زیورآلات</div>
                                        </div>
                                        <select id="category" class="form-control" name="cat_zivar">
                                                <option value="دستبند">دستبند</option>
                                                <option value="انگشتر">انگشتر</option>
                                                <option value="گوشواره">گوشواره</option>
                                                <option value="گردنبند">گردنبند</option>
                                                <option value="پابند">پابند</option>
                                                <option value="زنجیر">زنجیر</option>
                                                <option value="نیم ست">نیم ست</option>
                                                <option value="ست">ست</option>
                                                <option value="ست کامل">ست کامل</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <label class="sr-only" for="mojodi">موجودی </label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">موجودی </div>
                                        </div>
                                        <input type="text" class="form-control" name="mojodi">
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <label class="sr-only" for="tolidi">تولیدی </label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">تولیدی </div>
                                        </div>
                                        <input type="text" class="form-control" name="tolidi">
                                    </div>
                                </div>


                                <div class="col-12">
                                    <input type="submit" class="btn btn-dark btn-w100" value="ذخیره">
                                </div>
                            </div>  {{--End form-row--}}

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
