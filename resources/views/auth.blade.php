@extends('layouts.main')

@section('title')
    @parent | Авторизация@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
<form action="post">
    <div class="mb-3">
        <label class="form-label" for="login">Логин</label>
        <input class="form-control"  type="text" name="login" id="login">
    </div>
    <div class="mb-3">
        <label class="form-label" for="password">Пароль</label>
        <input class="form-control"  type="text" name="password" id="password">
    </div>
    <div class="mb-3  form-check">
        <label   class="form-check-label"  for="remember_me">Запомнить меня</label>
        <input  class="form-check-input" type="checkbox" name="remember_me" id="remember_me">
    </div>
    <button class="btn btn-primary" type="submit">Отправить</button>
</form>
@endsection
