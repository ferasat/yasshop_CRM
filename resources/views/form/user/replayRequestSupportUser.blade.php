@extends('layouts.app')
@section('title' , 'پاسخ به درخواست ها')
@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-9">
                <form id="newSupport" class="newSupport" method="post" action="{{ asset('/support/new') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group input-group-lg">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="subject">عنوان :</span>
                        </div>
                        <input type="text" name="subject" class="form-control" aria-label="Sizing example input"
                               aria-describedby="inputGroup-sizing-lg">
                    </div><br>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <div class="input-group ">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="department">دپارتمان</label>
                                </div>
                                <select class="custom-select" id="department" name="department">
                                    <option value="پیگیری خرید">پیگیری خرید</option>
                                    <option value="کنسلی بلیط">کنسلی بلیط</option>
                                    <option value="مشکل در سایت">مشکل در سایت</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <div class="input-group ">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="priority">اولویت </label>
                                </div>
                                <select class="custom-select" id="priority" name="priority" >
                                    <option value="normal"> عادی</option>
                                    <option value="important">مهم</option>
                                    <option value="force">فوری</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-3">
                            <div class="input-group ">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="status">وضعیت درخواست</label>
                                </div>
                                <select class="custom-select" id="status" name="status" disabled>
                                    <option value="open">باز </option>
                                    <option value="forcheck">در حال بررسی</option>
                                    <option value="solid">حل شده</option>
                                    <option value="close">بسته شده</option>
                                </select>
                            </div>
                        </div>



                        <div class="form-group col-md-3">
                            <div class="input-group ">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">آخرین پاسخ </label>
                                </div>
                                <input type="text" class="form-control" aria-label="Sizing example input" disabled name="warrantor">
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">متن درخواست</span>
                                </div>
                                <textarea class="form-control" aria-label="With textarea" name="text"></textarea>
                            </div>
                            <br>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="validatedCustomFile" >
                                <label class="custom-file-label" for="validatedCustomFile">بارگزاری فایل ...</label>
                                <div class="invalid-feedback">فایل نا معتبر هست</div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">ارسال ..</button>
                    </div>
                </form>
            </div>
            <div class="col-md-3">
                @include('form.sidebarSupport')
            </div>
        </div>
    </div>
@endsection
