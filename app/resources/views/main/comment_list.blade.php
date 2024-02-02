@extends('view.main_layout')

@section('content')
    <div class="text-center">
        <h1>コメント一覧</h1>
    </div>
    @if($comment->count())
    @foreach($comment as $comments)
        <div class="card">
            <div class="ml-2">
                <p class="">{{$comments->created_at}}</p>
            </div>
            <div class="ml-2">
                <p class="">{{$comments->comment}}</p>
            </div>
        </div>
    @endforeach
    @else
        <div class="text-center pt-3">
            <h3>コメントはありません</h3>
        </div>
    @endif
@endsection
