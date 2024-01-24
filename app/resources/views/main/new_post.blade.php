@extends('view.main_layout')

@section('content')
    <main class="py-4">
        <div class="col-md-5 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class='text-center'>新規登録</h1>
                </div>
                    <div class="card-body">
                        <form action="{{ route('new_post')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <label for='title'>タイトルを入力する</label>
                                <input type='text' class='form-control' name='title' value=''/>
                            <label for='post_img' class='mt-2'>画像を選択する</label>
                                <input type='file' class='form-control' name='post_img' id='file' value=''/>
                            <label for='type_id' class='mt-2'>カテゴリを入力する</label>
                            <select name='type_id' class='form-control'>
                                <option value='' hidden>カテゴリ</option>
                                @foreach($params as $param)
                                <option value="{{ $param['id']}}">{{ $param['category'] }}</option>
                                @endforeach
                            </select>
                            <label for='text' class='mt-2'>エピソード</label>
                                <textarea class='form-control' name='text'></textarea>
                            <div class='row justify-content-center'>
                                <button type='submit' class='btn btn-primary w-25 mt-3'>シェア</button>
                            </div> 
                        </form>
                    </div>
            </div>
        </div>
    </main>
@endsection