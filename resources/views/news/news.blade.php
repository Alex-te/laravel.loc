@extends('layouts.main')

@section('title')
    @parent | Новости@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
    <h2>Новости</h2>
    @foreach ($news as $item)
        <a href="{{ route('news.show', $item->id)}}">{{$item->title}}</a> </br>
    @endforeach

    @include('back')
@endsection
