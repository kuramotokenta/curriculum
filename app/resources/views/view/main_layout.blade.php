<?php header('X-Frame-Options: DENY');?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Episord Shere</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    @yield('stylesheet')
</head>
<body>
  <div class="container">
    <div class="sidebar">
        <h3>Episord Shere</h3>
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="my-navbar-control">
                @if(Auth::check())
                <span class="my-navbar-item">{{ Auth::user()->name }}</span>
                /
                <a href="#" id="logout" class="my-navbar-item">ログアウト</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">
                    @csrf
                </form>
                <script>
                    document.getElementById('logout').addEventListener('click', function(event) {
                    event.preventDefault();
                    document.getElementById('logout-form').submit();
                    });
                </script>
                @else
                <a class="my-navbar-item" href="{{ route('login') }}">ログイン</a>
                    /
                <a class="my-navbar-item" href="{{ route('register') }}">会員登録</a>
                @endif
            </div>
        </nav>
        <ul>
            <li><a href="{{ route('main')}}">ホーム</a></li>
            <li><a href="{{ route('myprofile')}}">プロフィール</a></li>
            <li><a href="{{ route('new_post')}}">作成</a></li>
            @auth
                @if(Auth::user()->role  == '1')
                    <li><a href="{{ route('user.list')}}">ユーザー一覧</a></li>
                @endif
            @endauth
            <li><p>検索</p>
            @yield('serch')
            </li>
        </ul>
    </div>
    <div class="main-content">
        @yield('content')
    </div>
  </div>
</body>