@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('admin.include.sidebar')
            </div>
            <div class="col-md-9">
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
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="subject">عنوان</label>
                                    <input type="text" class="form-control" id="subject" name="subject">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="text">متن نوشته</label>
                                <textarea type="content" class="form-control" id="textcontent" name="text">

                                </textarea>
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
                                    <label for="tags"> برچسب ها : <span
                                            class="nokteh">کلمات را با - از هم جدا کنید</span></label>
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
    <script type="application/javascript">
/*
        ClassicEditor
            .create( document.querySelector( '#textcontent' ), {
                toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote' ],
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
                    ]
                }
            } )
            .catch( error => {
                console.error( error );
            } );*/
    </script>
@endsection

