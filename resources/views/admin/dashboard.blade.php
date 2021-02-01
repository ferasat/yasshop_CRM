@extends('layouts.app')
@section('title' , 'پیشخوان')
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        خلاصه وضعیت فروشگاه
                    </div>

                    <div class="card-body">
                        <div class="row row-cols-1 row-cols-md-3">
                            <div class="col mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <button type="button" class="btn btn-primary">
                                                کسری انبار  <span class="badge badge-light">{{ $numberP }}</span>
                                            </button>

                                        </h5>
                                        <ul class="list-group list-group-flush">
                                            {!! $lessProducts !!}
                                        </ul>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                @include('admin.include.sidebar')
            </div>
        </div>

    </div>
@endsection

