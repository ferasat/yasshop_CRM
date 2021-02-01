<!doctype html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="_token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    @if(!isset($search))
        <script src="{{ asset('js/app.js') }}" defer></script>
    @endif
    <script src="{{ asset('js/boxing.js') }}" ></script>

<!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mystyle.css') }}" rel="stylesheet">
    <script src="{{ asset('js/ckeditor.js') }}"></script>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/icon.png') }}">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ $appName }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('ورود') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('ثبت نام') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                انبار <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ asset(route('warehousing')) }}">
                                     انبار وردپرس
                                </a>

                                <a class="dropdown-item" href="{{ asset(route('priceControl')) }}">
                                    چک کردن قیمت ها و موجودی
                                </a>

                                <a class="dropdown-item" href="{{ asset(route('productInCrm')) }}">
                                     انبار سی ار ام
                                </a>

                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                سفارشات <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ asset(route('orders')) }}">
                                    سفارشات
                                </a>
                                <a class="dropdown-item" href="{{ asset(route('newOrder')) }}">
                                    ثبت سفارش جدید
                                </a>
                                <a class="dropdown-item" href="{{ asset(route('newOrder')) }}">
                                    ثبت سفارش جدید
                                </a>
                                <a class="dropdown-item" href="{{ asset(route('forBoxing')) }}"> برای بستبندی </a>
                                <a class="dropdown-item" href="{{ asset(route('checkForPost')) }}">چک برای آماده به ارسال </a>
                                <a class="dropdown-item" href="{{ asset(route('posted')) }}">ارسال شده ها </a>
                                <a class="dropdown-item" href="{{ asset(route('notShipped')) }}">ارسال نشده ها</a>
                                <a class="dropdown-item" href="{{ asset(route('deficit')) }}">کسری دار</a>
                                <a class="dropdown-item" href="{{ asset(route('outStock')) }}">عدم موجودی</a>

                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('dashboard') }}" >
                                    پیشخوان
                                </a>
                                <span class="caret"></span>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('خروج') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>

                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>
