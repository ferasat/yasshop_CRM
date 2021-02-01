@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                @include('admin.include.sidebar')
            </div>
            <div class="col-md-8">
                <div class="card ">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link " href="{{ asset('/dashboard/post') }}">همه نوشته ها</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ asset('/dashboard/post/new') }}">نوشته جدید</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ asset('/dashboard/post/cat') }}">دستبندی نوشته ها </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">تعریف نوشته جدید</h5>
                        <form method="post" action="{{ asset('/dashboard/post/new') }}" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="subject">عنوان</label>
                                    <input type="text" class="form-control" id="subject" name="subject">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="text">متن نوشته</label>
                                <textarea type="text" class="form-control" id="text" name="text"></textarea>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="category">دستبندی</label>
                                    <select id="category" class="form-control" name="category">
                                        <option selected>دستبندی نشده</option>
                                        @foreach($allcats as $allcat)
                                        <option>{{ $allcat -> word }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="tags">برچسب ها</label>
                                    <textarea type="text" class="form-control" id="tags" name="tags"></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">انتشار...</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

