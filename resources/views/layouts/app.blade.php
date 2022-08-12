<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600|Open+Sans:400,600,700" rel="stylesheet">
    <title>{{ config('app.name', 'Recipe') }}</title>
    <link rel="stylesheet" href="{{ asset('/themes/css/spur.css') }}">
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('custom/custom.css?'. time()) }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/font-awesome.min.css?'. time()) }}" rel="stylesheet">
    @yield('css')
</head>
<body>
<div class="dash">
    <div class="dash-nav dash-nav-dark">
        <header>
            <a href="#!" class="menu-toggle">
                <i class="fa fa-bars"></i>
            </a>
            <a href="{{ url('/') }}" class="spur-logo"><i class="fa fa-bolt"></i> <span>{{ config('app.name', 'Laravel') }}</span></a>
        </header>
        <nav class="dash-nav-list">
            <a href="{{ url('/') }}" class="dash-nav-item"><i class="fa fa-home"></i> Dashboard </a>
            <a href="{{ route('orders') }}" class="dash-nav-item"><i class="fa fa-cart-plus"></i> Orders </a>
            <a href="{{ route('recipe') }}" class="dash-nav-item"><i class="fa fa-star"></i> Recipes </a>
            <a href="{{ route('items') }}" class="dash-nav-item"><i class="fa fa-clipboard"></i> Item Prices </a>
            <a href="{{ route('customers') }}" class="dash-nav-item"><i class="fa fa-users"></i> Customers </a>
        </nav>
    </div>
    <div class="dash-app">
        <header class="dash-toolbar">
            <a href="#!" class="menu-toggle">
                <i class="fa fa-bars"></i>
            </a>
            <a href="#!" class="searchbox-toggle">
                <i class="fa fa-search"></i>
            </a>
            <form class="searchbox" action="#!">
                <a href="#!" class="searchbox-toggle"> <i class="fa fa-arrow-left"></i> </a>
                <button type="submit" class="searchbox-submit"> <i class="fa fa-search"></i> </button>
                <input type="text" class="searchbox-input" placeholder="type to search">
            </form>
            <div class="tools">
              
               
                <div class="dropdown tools-item">
                    <a href="#" class="" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </header>
        <main class="dash-content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </main>
    </div>
</div>
   
</body>
<script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="{{ asset('bootstrap/js/bootstrap.js') }}"></script>
<script src="{{ asset('/themes/js/spur.js') }}"></script>
@yield('script')
</html>
