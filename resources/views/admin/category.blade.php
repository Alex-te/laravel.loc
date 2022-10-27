@extends('layouts.main')

@section('title')
    @parent | @if($category)Редактировать категорию @elseДобавить категорию@endif @endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h2> @if($category)Редактировать категорию @else Добавить категорию@endif</h2>
                    </div>
                    <div class="card-body">
                        @include('inc.message')
                        <form method="POST"
                              action="@if($category){{ route('admin.categories.update', ['category'=> $category->id])}}@else{{ route('admin.categories.store')}}@endif">
                            @if($category)
                                @method('PUT')
                            @endif
                            @csrf

                            <div class="row mb-3">
                                <div class="form-group">
                                    <label for="title" class="form-label">Категория </label>
                                    <input type="text" class="form-control" name="title" id="title"
                                           value="@if($category){{$category->title}}@endif{{old('title')}}">
                                    @error('title')<span style="color:red">{{$message}}</span>@enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">@if($category)Редактировать @else Добавить @endif</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    @include('back')
@endsection
