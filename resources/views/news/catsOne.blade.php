@extends('layouts.main')

@section('title')
    @parent | Категория - "{{ !empty($category_name->title) ? : 'Нет новостей' }}"@endsection

@section('menu')
    @include('menu')
@endsection

@section('content')
    <h2> {{ $category_name->title }}</h2>

    @if($categories)
        <ul class="list-group">
            @foreach ($categories as $item)
                <li class="list-group-item">
                    <a href="{{ route('news.show', [$category_name->slug, $item->id]) }}">{{ $item->title }}</a>
                </li>
            @endforeach
        </ul>
    @else
        нет новостей
    @endif

    @include('back')
@endsection
