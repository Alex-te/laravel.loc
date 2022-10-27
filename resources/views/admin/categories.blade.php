@extends('layouts.main')

@section('title')
    @parent | Категории@endsection

@section('menu')
    @include('admin.menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h2>{{ __('Категории') }}</h2></div>
                    <div class="card-body">
                        @include('inc.message')
                        <div class="row mb-3">
                            <div class="form-group">
                                <a href="{{route('admin.categories.create')}}" class="btn btn-primary" > Добавить</a>
                            </div>
                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Название</th>
                                <th scope="col">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $item)
                            <tr>
                                <td>{{$item->title}}</td>
                                <td><a href="{{route('admin.categories.show', ['category' => $item->id])}}">Ред.</a>
                                    <form action="{{ route('admin.categories.destroy', ['category' => $item->id]) }}" method="post">
                                        <button type="submit" style="border: 0; background: none; margin: 0; padding: 0">Удал.</button>
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                </td>
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
