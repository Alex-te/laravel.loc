@extends('layouts.main')

@section('title')
    @parent | Категории@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
    <h2>Категории</h2>

    @if($categories)
        <ul class="list-group">
            @foreach ($categories as $item)
                <li class="list-group-item"><a href="{{route('news.catsOne', $item->slug)}}">{{$item->title}}</a>
                </li>
            @endforeach
        </ul>
    @else
        Нет категорий
    @endif
    @include('back')
@endsection

