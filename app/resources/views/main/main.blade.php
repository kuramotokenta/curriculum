@extends('view.main_layout')

@section('content')
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
            <div class="post_button">
                <button onclick="like({{$alls->id}})">いいね!</button>
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
        </div>
    </div>
    </div>
    @endforeach
@endsection
<!-- <?php echo('<pre>'); ?>
<?php var_dump($all); ?>
<?php echo('</pre>'); ?> -->