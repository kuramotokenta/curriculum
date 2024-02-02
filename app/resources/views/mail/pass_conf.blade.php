@extends('view.login_layout')

@section('content')
  <div class="">
    <div class="row justify-content-center">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="card mt-5">
          <div class="card-header">パスワード入力</div>
          <div class="card-body">
            <form action="{{ route('reset.password.update') }}" method="POST">
              @csrf
              <div class="text-center">
                <p>新しいパスワードを入力してください</p>
              </div>
                <input type="hidden" name="reset_token" value="{{ $userToken->rest_password_access_key }}">
              <div class="form-group">
                <label for="password">新しいパスワード</label>
                <input type="password" class="form-control" id="password" name="password"/>
                <span>{{ $errors->first('password') }}</span>
                <span>{{ $errors->first('reset_token') }}</span>
              </div>
              <div class="form-group">
                <div>
                    <label>新パスワード<span>確認</span></label>
                    <input type="password" class="form-control" name="password_confirmation" value=""/>
                </div>
              </div>
              <div class="d-flex justify-content-around">
                <div class="text-center">
                    <a href="{{ route('login') }}" class="btn btn-secondary">戻る</a>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">登録</button>
                </div>
              </div>
            </form>
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection