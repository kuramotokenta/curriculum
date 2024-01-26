@extends('view.main_layout')

@section('content')
ユーザー一覧<br>
    <table>
    @foreach($user as $users)
        <tr>
            <td>{{ $users->name }}</td>
            @auth
                @if(Auth::user()->role  == '1')
                    <td><a href="{{ route('user.delete',['user'=>$users['id']])}}">削除</a></td>
                    <td><a href="{{ route('user.delflg',['user'=>$users['id']])}}">論理削除</a></td>
                @endif
            @endauth
        </tr>
    @endforeach
    </table>
@endsection