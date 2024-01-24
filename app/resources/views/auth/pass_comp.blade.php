@extends('view.login_layout')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="card mt-5">
          <div class="card-header">パスワード再設定完了</div>
          <div class="card-body">
              <div class="text-center">
                <p>新しいパスワードを登録しました！</p>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary"><a href="{{ route('login') }}">ログイン画面へ</a></button>
              </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection