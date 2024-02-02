@extends('view.main_layout')
@section('content')
<div class="d-flex align-items-center p-3">
    @if($profile['images'] == null)
        <div class="user-profile">
            <img class="user-img" src="{{asset('storage/image/default.png')}}" alt="" width="100" height="100">
        </div>
    @else
        <div class="user_img">
            <img src="{{asset('storage/image/'.$profile['images'])}}" alt="" width="100" height="100">
        </div>
    @endif
    <div class="m-3">
        <div class="">
            <h2>{{$profile->name}}</h2>
        </div>
        <div class="">
            <p>{{$profile->profile}}</p>
        </div>
    </div>
</div>
<div class="ml-3">
    <a href="{{ route('profile.detail')}}" class=" btn btn-primary">プロフィールを編集する</a></button>
</div>
@foreach($all as $alls)
    <div class="">
        <div class="post_box">
            <div class="card-header">
                <h4>{{$alls['title']}}</h4>
            </div>
            <div class="">
                <div class="">
                    <img src="{{asset('storage/image/'.$alls->post_img)}}" alt="" width="100%">
                </div>
                <div class="post_content">
                    <div class="post_time ml-2">
                        <p class="">{{$alls->created_at}}</a>
                        /
                        <p class="">{{$alls->prefecture->name}}</p>
                        /
                        <p class="">{{$alls->category->category}}</p>
                    </div>
                    <div class="ml-2">
                        <p class="">{{$alls->text}}</p>
                    </div>
                </div>
                <div class="text-right">
                    <a href="{{ route('post.comment', ['id'=>$alls['id']])}}" class="btn btn-info">コメントを見る</a>
                </div>
            </div>
        </div>
        <div class="card-footer d-flex flex-wrap justify-content-around align-items-center px-0 pt-0 pb-3">
            <div class="">
                <a href="{{ route('edit.post', ['id'=>$alls['id']])}}" class="btn btn-secondary">投稿を編集する</a>
            </div>
            <div class="">
                <a href="{{ route('delete', ['id'=>$alls['id']])}}" class="btn btn-danger" onclick="return confirm('削除しますか？')">投稿を削除する</a>
            </div>
            <div class="">
                <a href="{{ route('delflg', ['id'=>$alls['id']])}}" class="btn btn-warning" onclick="return confirm('論理削除しますか？')">投稿を論理削除する</a>
            </div>
        </div>
    </div>
@endforeach
@endsection
<!-- <?php echo('<pre>'); ?>
<?php var_dump($all); ?>
<?php echo('</pre>'); ?> -->