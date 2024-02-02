@extends('view.main_layout')

@section('serch')
<p class="pt-4">検索</p>
    <form action="{{ route('main')}}" method="post" class="justify-content-around text-center">
        @csrf
        <div class="form-group">
            <input type='date' class='form-control' name='first' id='date' value="<?php echo $first ?>"/>
        </div>
        <div class="form-group">
            <p>~</p>
        </div>
        <div class="form-group">
            <input type='date' class='form-control' name='end' id='date' value="<?php echo $end ?>"/>
        </div>
        <div class="form-group">
            <label for='prefecture_id' class='mt-2'>都道府県を入力する</label>
            <select name='prefecture_id' class='form-control'>
        <option value='' hidden>都道府県</option>
            @foreach($prefectures as $prefecture)
                <option value="{{ $prefecture['id']}}">{{ $prefecture['name'] }}</option>
            @endforeach
            </select>
        </div> 
        <div class="form-group">
            <label for='category_id' class='mt-2'>カテゴリを入力する</label>
            <select name='category_id' class='form-control'>
        <option value='' hidden>カテゴリ</option>
            @foreach($params as $param)
                <option value="{{ $param['id']}}">{{ $param['category'] }}</option>
            @endforeach
            </select>
        </div>        
        <div class="form-group">
            <button type='submit' class='btn btn-primary'>検索</button>
        </div> 
    </form>
@endsection

@section('content')
    @foreach($all as $alls)
    <div class="">
    <div class="post_box">
        <div class="card-header">
            <h4>{{$alls->title}}</h4>
        </div>
        <div class="">
            <div class="">
                <img src="{{asset('storage/image/'.$alls->post_img)}}" alt="" width='100%'>
            </div>
            <div class="post_content">
                <div class="post_time ml-2">
                    <p class="">{{$alls->created_at}}</p>
                    /
                    <p class="">{{$alls->prefecture->name}}</p>
                    /
                    <p class="">{{$alls->category->category}}</p>
                </div>
                <div class="ml-2">
                    <p class="">{{$alls->text}}</p>
                </div>
            </div>
            @auth
                @if(empty(Auth::user()->islike($alls->id)))
                    <div class="post_button">
                        <button onclick="like({{$alls->id}})" class="btn btn-secondary">いいね!</button>
                    </div>
                    <script>
                        function like(postId) {
                            $.ajax({
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                            },
                            url: `/like/${postId}`,
                            type: "POST",
                            })
                            .done(function (data, status, xhr) {
                                console.log(data);
                            })
                            .fail(function (xhr, status, error) {
                                console.log();
                            });
                        }
                    </script>
                @else
                    <div class="post_button">
                        <button onclick="unlike({{$alls->id}})" class="btn btn-primary">いいね!</button>
                    </div>
                    <script>
                        function unlike(postId) {
                            $.ajax({
                                headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                                },
                                url: `/unlike/${postId}`,
                                type: "POST",
                            })
                                .done(function (data, status, xhr) {
                                console.log(data);
                                })
                                .fail(function (xhr, status, error) {
                                console.log();
                            });
                        }
                    </script>
                @endif
            @endauth
            <div class="card-footer d-flex flex-wrap justify-content-between align-items-center px-0 pt-0 pb-3">
                <div class="px-4 pt-3">
                    @if($alls->comment->count())
                    <span>
                        返信{{$alls->comment->count()}}件
                    </span>
                    @else
                    <span>コメントはまだありません</span>
                    @endif
                </div>
                <div class="px-4 pt-3">
                    <form method="post" action="{{route('comment.store')}}" class="form-inline">
                        @csrf
                        <input type="hidden" name="post_id" value="{{$alls->id}}">
                        <div class="form-group pr-3">
                            <textarea name="comment" class="form-control" id="comment" placeholder="コメントを入力する">{{old('comment')}}</textarea>
                        </div>
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">コメントする</button>
                        </div>
                    </form> 
                </div>
            </div>
            @auth
                @if(Auth::user()->role  == '1')
                    <div class="card-footer d-flex flex-wrap justify-content-around align-items-center px-0 pt-0 pb-3">
                        <div class="">
                            <a href="{{ route('delete', ['id'=>$alls['id']])}}" class="btn btn-danger" onclick="return confirm('削除しますか？')">投稿を削除する</a>
                        </div>
                        <div class="">
                            <a href="{{ route('delflg', ['id'=>$alls['id']])}}" class="btn btn-warning" onclick="return confirm('論理削除しますか？')">投稿を論理削除する</a>
                        </div>
                    </div>
                @endif
            @endauth
        </div>
    </div>
    </div>
    @endforeach
@endsection