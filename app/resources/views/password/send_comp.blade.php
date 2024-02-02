@extends('view.login_layout')

@section('content')
  <div class="">
    <div class="row justify-content-center">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="card mt-5">
          <div class="card-header">パスワードリセットメール送信完了</div>
          <div class="card-body">
            <div class="text-center">
                <p>パスワードリセットメールを送信しました！</p>
                <p>送信されたメールにあるURLよりパスワードを変更してください。</p>
            </div>
            <div class="text-center">
                <a href="{{ route('login') }}" class="btn btn-secondary">ログイン画面へ</a>
            </div>
            </form>
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection