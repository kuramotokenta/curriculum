@extends('view.login_layout')

@section('content')
  <div class="">
    <div class="row justify-content-center">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="card mt-5">
          <div class="card-header">パスワード再設定完了</div>
          <div class="card-body">
              <div class="text-center">
                <p>新しいパスワードを登録しました！</p>
              </div>
              <div class="text-center">
                <a href="{{ route('login') }}" class="btn btn-primary">ログイン画面へ</a>
              </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection