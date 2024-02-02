@extends('view.main_layout')

@section('content')
<div class="card mt-5">
<h3 class="card-header text-center mt-1">ユーザー一覧<br></h3>
<div class="card-body">
    <table class="m-auto">
    @foreach($user as $users)
        <tr>
            <td class="p-1">
            @if($users['images'] == null)
                <div class="user-profile">
                    <img class="user-img" src="{{asset('storage/image/default.png')}}" alt="" width="50" height="50">
                </div>
            @else
                <div class="user_img">
                    <img src="{{asset('storage/image/'.$users['images'])}}" alt="" width="50" height="50">
                </div>
            @endif
            </td>
            <td class="p-1">{{ $users->name }}</td>
            @auth
                @if(Auth::user()->role  == '1')
                    <td class="p-4"><a href="{{ route('user.delete',['id'=>$users['id']])}}" class="btn btn-danger" onclick="return confirm('削除しますか？')">削除</a></td>
                @endif
            @endauth
        </tr>
    @endforeach
    </table>
</div>
</div>
@endsection