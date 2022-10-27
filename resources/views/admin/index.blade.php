@extends('layouts.main')

@section('title')
    @parent | Главная@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
<h2>Административная панель</h2>
<div>

</div>
    @include('back')
@endsection
