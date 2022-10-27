@extends('layouts.main')

@section('title')
    @parent | Новость - "{{ $news->title }}"@endsection


@section('menu')
    @include('menu')
@endsection
@section('content')
    @include('inc.message')
    <h2><small><a href="{{ route('news.catsOne', $category->slug)}}">{{ $category->title }} </a></small> | {{ $news->title }}</h2>
<p> {{ $news->text }}</p>

@include('back')
@endsection


