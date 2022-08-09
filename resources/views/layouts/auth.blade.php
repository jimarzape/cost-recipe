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
</head>
<body>
    <div class="form-screen">
       @yield('content')
    </div>
</body>
<script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.js') }}"></script>
<script src="{{ asset('/themes/js/spur.js') }}"></script>
@yield('script')
</html>
