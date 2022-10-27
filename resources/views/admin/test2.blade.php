@extends('layouts.main')

@section('title')
    @parent | Скачать изображение@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h2>{{ __('Скачать новость') }}</h2></div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.test2') }}">
                            @csrf
                            <div class="row mb-3">
                                <div class="form-group">
                                    <label for="newsCategory" class="form-label">Категория новости</label>

                                    <select name="category_id" id="newsCategory" class="form-control">
                                        @forelse ($categories as $item)
                                            <option @if (old('category_id') == $item->id) selected
                                                    @endif value="{{$item->id}}">{{$item->title}}</option>
                                        @empty
                                            <option value="0" selected>Нет категорий</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Скачать</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    @include('back')
@endsection
