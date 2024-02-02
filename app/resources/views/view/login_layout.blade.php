<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Episord Shere</title>

    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}" defer></script>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    @yield('stylesheet')
</head>
<body>
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm d-flex justify-content-between align-items-center">
      <div class="">
        <h3 class="ml-2">Episord Shere</h3>
      </div>
      <div class="my-navbar-control">
          <a class="my-navbar-item" href="{{ route('login') }}">ログイン</a>
            /
          <a class="my-navbar-item" href="{{ route('register') }}">会員登録</a>
      </div>
    </nav>
    @yield('content')
</body>
</html>