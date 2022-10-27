@extends('layouts.main')

@section('title')
    @parent | Новости@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h2>{{ __('Новостей') }}</h2></div>
                    <div class="card-body">
                        @include('inc.message')
                        <div class="row mb-3">
                            <div class="form-group">
                                <a href="{{route('admin.news.create')}}" class="btn btn-primary" > Добавить</a>
                            </div>
                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Название</th>
                                <th scope="col">Текст</th>
                                <th scope="col">Приватная</th>
                                <th scope="col">Категория</th>
                                <th scope="col">Источник</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($news as $item)
                            <tr>
                                <td>{{$item->title}}</td>
                                <td>{{substr($item->text,0, 50)}}...</td>
                                <td>{{$item->is_private}}</td>
                                <td>{{isset($categories[$item->category_id])? $categories[$item->category_id]->title : ''}}</td>
                                <td>{{isset($newsSources[$item->news_source_id]) ? $newsSources[$item->news_source_id]->name : ''}}</td>
                                <td><a href="{{route('admin.news.show', ['news' => $item->id])}}">Ред.</a>
                                   <form action="{{ route('admin.news.destroy', ['news' => $item->id]) }}" method="post">
                                       <button type="submit" style="border: 0; background: none; margin: 0; padding: 0">Удал.</button>
                                       @method('DELETE')
                                       @csrf
                                   </form>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $news->links()}}
                    </div>
                </div>
            </div>
        </div>

    @include('back')
@endsection
