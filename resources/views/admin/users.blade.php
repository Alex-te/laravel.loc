@extends('layouts.main')

@section('title')
    @parent | Пользователи @endsection

@section('menu')
    @include('admin.menu')
@endsection


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h2>{{ __('Пользователи') }}</h2></div>
                    <div class="card-body">
                        @include('inc.message')
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Название</th>
                                <th scope="col">Email</th>
                                <th scope="col">Администратор</th>
                                <th scope="col">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $item)
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{($item->is_admin) ? 'да': 'нет'}}</td>
                                    <td><a href="{{route('admin.users.edit', ['user' => $item->id])}}">Ред.</a>
                                        <form action="{{ route('admin.users.destroy', ['user' => $item->id]) }}"
                                              method="post">
                                            <button type="submit"
                                                    style="border: 0; background: none; margin: 0; padding: 0">Удал.
                                            </button>
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
