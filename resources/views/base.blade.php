<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/slate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/main.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="{{route('main') }}">Home</a>
</nav>

<div class="container">
    @yield('content')
</div>

<script type="text/javascript" src="{{ URL::to('js/jquery.min.js') }}"></script>
</body>
</html>