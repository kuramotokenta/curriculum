@extends('view.main_layout')

@section('content')
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
<form action="{{ route('category')}}" method="post">
    @csrf
    <label for='category'>追加するカテゴリー名</label>
        <input type='text' class='form-control' name='category' value="{{ old('category') }}"/>
    <div class='row justify-content-center'>
        <button type='submit' class='btn btn-primary w-25 mt-3'>登録</button>
    </div> 
</form>
@endsection