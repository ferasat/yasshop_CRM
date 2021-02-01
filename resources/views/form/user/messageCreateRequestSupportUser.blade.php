@extends('layouts.app')
@section('title' , '')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                @include('form.sidebarSupport')
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        درخواست ایجاد شد
                    </div>
                    <div class="card-body">
                        {{ $message }} . <a href="{{ asset('/support/update/'.$support_id) }}">{{$support_id}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
