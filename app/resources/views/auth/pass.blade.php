@extends('view.login_layout')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="card mt-5">
          <div class="card-header">パスワード再設定</div>
          <div class="card-body">
            <form action="{{ route('password_reset.email.send') }}" method="POST">
              @csrf
              <div class="text-center">
                <p>メールアドレスを入力してください</p>
              </div>
              <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" />
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary">次へ</button>
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