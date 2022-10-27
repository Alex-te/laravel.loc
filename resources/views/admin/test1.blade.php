@extends('layouts.main')

@section('title')
    @parent | Скачать изображение@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <h2>Скачать изображение</h2>

    @include('back')
@endsection
