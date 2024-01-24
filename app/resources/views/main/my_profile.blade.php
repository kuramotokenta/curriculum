@extends('view.main_layout')

@section('content')
<div class="">
    <h2><?php echo $profile['name']; ?></h2>
</div>
<div class="">
     <p><?php echo $profile['profile']; ?></p>
</div>
<div class="">
    <button type="submit" class="btn btn-primary"><a href="{{ route('profile.detail')}}">プロフィールを編集する</a></button>
</div>
@foreach($all as $alls)
<div class="">
    <div class="post_box">
        <div class="card-header">
            <h4>{{$alls['title']}}</h4>
        </div>
        <div class="">
            <div class="">
                <img src="{{asset('storage/image/'.$alls['post_img'])}}" alt="">
            </div>
            <div class="post_content">
                <div class="post_time">
                    <p class="">{{$alls['created_at']}}</a>
                    <p class="">{{$alls['type_id']}}</p>
                </div>
                <div class="">
                    <p class="">{{$alls['text']}}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <button type="submit" class="btn btn-secondary"><a href="{{ route('edit.post', ['id' => $alls['id']])}}">投稿を編集する</a></button>
    </div>
    <div class="">
        <button type="submit" class="btn btn-secondary"><a href="{{ route('delete', ['id' => $alls['id']])}}">投稿を削除する</a></button>
    </div>
    <div class="">
        <button type="submit" class="btn btn-secondary"><a href="{{ route('delflg', ['id' => $alls['id']])}}">投稿を論理削除する</a></button>
    </div>
</div>
@endforeach
<!-- <?php echo('<pre>'); ?>
<?php var_dump($profile); ?>
<?php echo('</pre>'); ?> -->
@endsection