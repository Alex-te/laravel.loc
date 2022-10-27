@extends('layouts.main')

@section('title')
    @parent | @if(isset($news_sources))Редактировать @else Добавить @endifисточник новостей@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h2>@if(isset($news_sources))Редактировать @else Добавить @endifисточник
                            новостей</h2></div>
                    <div class="card-body">
                        @include('inc.message')
                        <form method="POST"
                              action="@if(isset($news_sources)){{ route('admin.news_sources.update', ['news_source' => $news_sources->id]) }}
                              @else
                              {{ route('admin.news_sources.store')}}
                              @endif">
                            @if($news_sources)
                                @method('PUT')
                            @endif
                                @csrf
                            @if(isset($news_sources))<input type="hidden" name="id" value="{{$news_sources->id}}">@endif
                            <div class="row mb-3">
                                <div class="form-group">
                                    <label for="name" class="form-label">Заголовок источника новостей</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                           value="{{old('name')}} @if(isset($news_sources)){{$news_sources->name}}@endif">
                                    @error('name')<span style="color:red">{{$message}}</span>@enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-group">
                                    <label for="url" class="form-label">URL источник</label>
                                    <input type="text" class="form-control" name="url" id="url"
                                           value="{{old('url')}}@if(isset($news_sources)){{$news_sources->url}}@endif">
                                    @error('url')<span style="color:red">{{$message}}</span>@enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-group">
                                    <label class="form-check-label" for="description">Описание</label>
                                    <textarea name="description" class="form-control"
                                              id="description">{{old('description')}} @if(isset($news_sources)){{$news_sources->description}}@endif</textarea>
                                    @error('description')<span style="color:red">{{$message}}</span>@enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">@if(isset($news_sources))
                                            Редактировать @else
                                            Добавить@endif</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    @include('back')
@endsection
