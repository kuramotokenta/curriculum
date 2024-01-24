@extends('view.login_layout')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="card mt-5">
          <div class="card-header">パスワード入力</div>
          <div class="card-body">
            <form action="{{ route('password_reset.update') }}" method="POST">
              @csrf
              <div class="text-center">
                <p>新しいパスワードを入力してください</p>
              </div>
              <div class="form-group">
                <label for="password">新しいパスワード</label>
                <input type="password" class="form-control" id="password" name="password" />
              </div>
              <div class="form-group">
                <label for="password">確認用</label>
                <input type="password" class="form-control" id="password" name="password" />
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary">登録</button>
              </div>
            </form>
          </div>
        </nav>
        <div class="text-center">
            <button type="submit" class="btn btn-primary"><a href="{{ route('login') }}">戻る</a></button>
        </div>
      </div>
    </div>
  </div>
@endsection