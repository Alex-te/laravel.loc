@extends('layouts.main')

@section('title')
    @parent | Источники новостей@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h2>{{ __('Источники новостей') }}</h2></div>
                    <div class="card-body">
                        @include('inc.message')
                        <div class="row mb-3">
                            <div class="form-group">
                                <a href="{{route('admin.news_sources.create')}}" class="btn btn-primary" > Добавить</a>
                            </div>
                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Название</th>
                                <th scope="col">URL</th>
                                <th scope="col">Описание</th>
                                <th scope="col">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($news_sources as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->url}}</td>
                                <td>{{substr($item->description,0, 50)}}...</td>
                                <td><a href="{{route('admin.news_sources.show', ['news_source' => $item->id])}}">Ред.</a>
                                    <form action="{{ route('admin.news_sources.destroy', ['news_source' => $item->id]) }}" method="post">
                                        <button type="submit" style="border: 0; background: none; margin: 0; padding: 0">Удал.</button>
                                        @method('DELETE')
                                        @csrf
                                    </form></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>

    @include('back')
@endsection
