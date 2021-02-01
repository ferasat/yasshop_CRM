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
                                <a class="nav-link active" href="{{ asset('/dashboard/post') }}">همه نوشته ها</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="{{ asset('/dashboard/post/new') }}">نوشته جدید</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ asset('/dashboard/post/cat') }}">دستبندی نوشته ها </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">همه نوشته های شما</h5>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">عنوان</th>
                                <th scope="col">دستبندی</th>
                                <th scope="col">تاریخ انتشار</th>
                                <th scope="col">id</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($myPosts as $Post)
                            <tr>
                                <td>{{ $Post -> subject }}</td>
                                <td>{{ $Post -> category }}</td>
                                <td>{{ $Post -> created_at }}</td>
                                <th scope="row">{{ $Post -> id }}</th>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

