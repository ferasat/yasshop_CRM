@extends('layouts.app')
@section('title' , 'درخواست های پشتیبانی')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                @include('form.sidebarSupport')
            </div>
            <div class="col-md-9">

                <table class="table">
                    <thead class="thead-dark">
                    <tr class="text-center">
                        <th scope="col">موضوع</th>
                        <th scope="col">الویت</th>
                        <th scope="col">دپارتمان</th>
                        <th scope="col">آخرین پاسخ</th>
                        <th scope="col">وضعیت</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($allSupports as $Support )
                    <tr>
                        <th >{{ $Support -> subject }}</th>
                        <td>{{ $Support -> subject }}</td>
                        <td>{{ $Support -> department }}</td>
                        <td>{{ $Support -> warrantor }}</td>
                        <td>{{ $Support -> status }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
