@extends('layouts.app')
@section('title' , 'دستبندی های نوشته ها')
@section('content')
	<div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('admin.include.sidebar')
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link " href="{{ asset('/dashboard/post') }}">همه نوشته ها</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="{{ asset('/dashboard/post/new') }}">نوشته جدید</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ asset('/dashboard/post/cat') }}">دستبندی نوشته ها </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="row">
                        <div class="col-md-4">
                            <div class="card pading6">
                                <form action="{{ asset('/dashboard/post/cat/') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">عنوان دسته</label>
                                        <input type="text" class="form-control" name="word" id="word"
                                               placeholder="نام دسته را وارد کنید" required>

                                    </div>
                                    <div class="form-group">
                                        <label for="subcat">زیر دسته</label>
                                        <small id="maincatHelp" class="form-text text-muted">آیا این مورد خود سر دسته هست و یا زیر
                                            دسته ، دسته دیگری هست ؟.
                                        </small>
                                        <select class="form-control" aria-describedby="maincatlHelp" name="subcat" id="subcat">
                                            @foreach($allCats as $cat)
                                                <option value="سردسته" selected>سردسته</option>
                                                <option value="{{ $cat -> id }}">{{ $cat -> word }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">توضیحات</label>
                                        <input type="text" name="shortDescription" id="description" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="icon">آیکون دسته</label>
                                        <input type="text" name="icon" id="icon" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="metadiscription">توضیخات سئو</label>
                                        <input type="text" name="metaDescription" id="metadiscription" class="form-control">
                                    </div>

                                    <button type="submit" class="btn btn-primary">ذخیره</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card">

                                <div class="card-body">
                                    @foreach($allCats as $cats)
                                        @if($cats-> subcat == 'سردسته')
                                            <a class="subcat" href="{{ asset('/cat/'.$cats -> id) }}">{{ $maincat = $cats -> word }}</a>
                                            <ul class="subcatul">
                                                @foreach($allCats as $cats)
                                                    @if( $cats -> subcat == $maincat )
                                                        <li class="subcatli">
                                                            <a href="">{{ $cats -> word }}</a>
                                                        </li>
                                                    @endif

                                                @endforeach
                                            </ul>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

