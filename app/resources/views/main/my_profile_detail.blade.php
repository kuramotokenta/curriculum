@extends('view.main_layout')

@section('content')
<div class="card">
    <div class="post_box">
        <div class="card-header">
            <h4>プロフィール編集</h4></a>
        </div>
        <div class="">
            <form action="{{ route('profile.detail')}}" method="post" enctype="multipart/form-data">
                @csrf
                <label for='name'>名前を変更する</label>
                    <input type='text' class='form-control' name='name' value='<?php echo $profile['name'] ?>'/>
                <label for='images' class='mt-2'>画像を変更する</label>
                    <input type='file' class='form-control' name='images' id='file' value='<?php echo $profile['images'] ?>'/>
                <label for='profile' class='mt-2'>プロフィールを編集する</label>
                    <textarea class='form-control' name='profile'><?php echo $profile['profile'] ?></textarea>
                <div class='row justify-content-center'>
                    <button type='submit' class='btn btn-primary w-25 mt-3'>変更する</button>
                </div> 
            </form>
        </div>
    </div>
</div>
@endsection