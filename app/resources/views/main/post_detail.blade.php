@extends('view.main_layout')

@section('content')
<div class="card">
    <div class="post_box">
        <div class="card-header">
            <h4>プロフィール編集</h4></a>
        </div>
        <div class="">
            <form action="{{ route('edit.post', ['id' => $result['id']])}}" method="post" enctype="multipart/form-data">
                @csrf
                <label for='title'>タイトルを変更する</label>
                    <input type='text' class='form-control' name='title' value='<?php echo $result['title'] ?>'/>
                <label for='post_img' class='mt-2'>画像を変更する</label>
                    <input type='file' class='form-control' name='post_img' id='file' value='<?php echo $result['post_img'] ?>'/>
                <label for='type_id' class='mt-2'>カテゴリを変更する</label>
                <select name='type_id' class='form-control'>
                    <option value='<?php echo $result['category'] ?>' hidden>カテゴリ</option>
                    @foreach($params as $param)
                    <option value="{{ $param['id']}}">{{ $param['category'] }}</option>
                    @endforeach
                </select>
                <label for='text' class='mt-2'>エピソードを編集する</label>
                    <textarea class='form-control' name='text'><?php echo $result['text'] ?></textarea>
                <div class='row justify-content-center'>
                    <button type='submit' class='btn btn-primary w-25 mt-3'>変更</button>
                </div> 
            </form>
        </div>
    </div>
</div>
@endsection