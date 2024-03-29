<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap/dist/css/bootstrap.css')}}">
    {{--<link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">--}}
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
</head>
<body>
<script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<header>
    <h1>Welcome</h1>
    <hr>
</header>
<div class="main">
    <div class="content">
        @yield('content')
    </div>
</div>

@yield('scripts')
</body>
</html>
