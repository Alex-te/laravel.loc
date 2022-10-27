@extends('layouts.main')

@section('title')
    @parent | @if($news)Редактировать новость @elseДобавить новость@endif @endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h2> @if($news)Редактировать новость @else Добавить новость@endif</h2>
                    </div>
                    <div class="card-body">
                        @include('inc.message')
                        <form method="POST"
                              action="@if($news){{ route('admin.news.update', ['news'=> $news->id])}}@else{{ route('admin.news.store') }}@endif">
                            @if($news)
                                @method('PUT')
                            @endif
                            @csrf

                            <div class="row mb-3">
                                <div class="form-group">
                                    <label for="title" class="form-label">Заголовок новости</label>
                                    <input type="text" class="form-control" name="title" id="title"
                                           value="@if($news){{$news->title}}@endif{{old('title')}}">
                                    @error('title')<span style="color:red">{{$message}}</span>@enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-group">
                                    <label for="newsCategory" class="form-label">Категория новости</label>

                                    <select name="category_id" id="newsCategory" class="form-control">
                                        @forelse ($categories as $item)
                                            <option @if($news && $news->category_id == $item->id) selected @endif
                                            @if(old('category_id') == $item->id) selected @endif
                                                    value="{{$item->id}}">{{$item->title}}</option>
                                        @empty
                                            <option value="0" selected>Нет категорий</option>
                                        @endforelse
                                    </select>
                                    @error('category_id')<span style="color:red">{{$message}}</span>@enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-group">
                                    <label for="newsSource" class="form-label">Источник новости</label>

                                    <select name="news_source_id" id="newsSource" class="form-control">
                                        @forelse ($newsSource as $item)
                                            <option @if($news && $news->news_source_id == $item->id) selected @endif
                                            @if(old('news_source_id') == $item->id) selected @endif
                                                    value="{{$item->id}}">{{$item->name}}</option>
                                        @empty
                                            <option value="0" selected>Нет источника</option>
                                        @endforelse
                                    </select>
                                    @error('news_source_id')<span style="color:red">{{$message}}</span>@enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-group">
                                    <label class="form-check-label" for="newsText">Текст новости</label>
                                    <textarea name="text" class="form-control"
                                              id="newsText"> @if($news) {{$news->text}} @endif {{old('text')}} </textarea>
                                    @error('text')<span style="color:red">{{$message}}</span>@enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-group">
                                    <input @if($news && $news->is_private) checked @endif
                                    @if(old('is_private') === 'on') checked @endif class="form-check-input"
                                           name="is_private" id="newsPrivate" type="checkbox">
                                    <label class="form-check-label" for="newsPrivate"> Приватная</label>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">@if($news)Редактировать @else
                                            Добавить @endif</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

@include('back')
@endsection

        @push('js')
            <script src="https://cdn.ckeditor.com/ckeditor5/35.2.1/classic/ckeditor.js"></script>
            <script>
                ClassicEditor
                    .create(document.querySelector('#newsText'))
                    .catch(error => {
                        console.error(error);
                    });
            </script>
    @endpush
