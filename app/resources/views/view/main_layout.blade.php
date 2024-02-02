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
    <div class="header p-2 shadow-sm">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="ml-2">Episord Shere</h3>
            <div class="">
                <ul class="list-unstyled d-flex m-auto">
                    <li><a href="{{ route('main')}}" class="btn">ホーム</a></li>
                    <li><a href="{{ route('myprofile')}}" class="btn">プロフィール</a></li>
                    <li><a href="{{ route('new_post')}}" class="btn">作成</a></li>
                    @auth
                        @if(Auth::user()->role  == '1')
                            <li><a href="{{ route('user.list')}}" class="btn">ユーザー一覧</a></li>
                        @endif
                    @endauth
                </ul>
            </div>
            <div class="d-flex justify-content-around text-center">
                @auth
                @if(Auth::user()->images == null)
                    <div class="user-profile px-1">
                        <img class="user-img" src="{{asset('storage/image/default.png')}}" alt="" width="50" height="50">
                    </div>
                @else
                    <div class="user_img px-1">
                        <img src="{{asset('storage/image/'.Auth::user()->images)}}" alt="" width="50" height="50">
                    </div>
                @endif
                @endauth
                <div class="m-auto px-2 text-center">
                    <p class="my-navbar-item">{{ Auth::user()->name }}</p>
                </div>
                <div class="m-auto px-2">
                    <a href="#" id="logout" class="btn btn-danger my-navbar-item mr-1">ログアウト</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">
                        @csrf
                    </form>
                </div>
                <script>
                    document.getElementById('logout').addEventListener('click', function(event) {
                    event.preventDefault();
                    document.getElementById('logout-form').submit();
                    });
                </script>
            </div>
        </div>
    </div>
    <div class="container pt-5">
        <div class="sidebar d-flex flex-column align-items-center"> 
        @yield('serch')
        </div>
        <div class="main-content pt-5">
            @yield('content')
        </div>
    </div>
</body>