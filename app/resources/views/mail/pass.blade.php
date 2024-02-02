@extends('view.login_layout')

@section('content')
  <div class="">
    <div class="row justify-content-center">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="card mt-5">
          <div class="card-header">パスワード再設定</div>
          <div class="card-body">
            <form action="{{ route('reset.send') }}" method="POST">
              @csrf
              <div class="text-center">
                <p>メールアドレスを入力してください</p>
              </div>
              <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" />
              </div>
              <div class="panel-body">
                @if($errors->any())
                <div class="alert-danger">
                  <ul>
                    @foreach($errors->all() as $message)
                    <li>{{$message}}</li>
                    @endforeach
                  </ul>
                </div>
                @endif
              </div>
              <div class="d-flex justify-content-around">
                <div class="">
                  <a href="{{ route('login') }}" class="btn btn-secondary">戻る</a>
                </div>
                <div class="">
                  <button type="submit" class="btn btn-primary">次へ</button>
                </div>
              </div>
            </form>
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection