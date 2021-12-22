<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>
          
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/post">User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/post">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/post">Cashier</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/post">Report</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/post">Transactions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/post">Suppliers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/post">Customers</a>
                </li><li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/post">Incoome</a>
                </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav"  style="margin-left:150px;">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a style="text-decoration:none;font-size:23px;"id="navbarDropdown" class="text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                            </li>
                            <li class="nav-item" style="margin-left:50px;">
                                <button class="btn btn-dark"><a style="text-decoration:none;color:white;"href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                </a></button>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                            </form>
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
