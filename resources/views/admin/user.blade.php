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
                    <div class="card-header"><h2>Пользователи</h2>
                    </div>
                    <div class="card-body">
                        @include('inc.message')
                        <form method="POST" action="{{ route('admin.users.update', ['user'=> $user->id])}}">
                            @method('PUT')
                            @csrf
                            <div class="row mb-3">
                                <div class="form-group">
                                    <label for="name" class="form-label">Имя </label>
                                    <input type="text" class="form-control" name="name" id="name"
                                           value="{{$user->name}}{{old('name')}}">
                                    @error('name')<span style="color:red">{{$message}}</span>@enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email </label>
                                    <input type="text" class="form-control" name="email" id="email"
                                           value="{{$user->email}}{{old('email')}}">
                                    @error('email')<span style="color:red">{{$message}}</span>@enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-group">
                                    <input @if($user && $user->is_admin) checked @endif
                                    @if(old('is_admin') === 'on') checked @endif class="form-check-input"
                                           name="is_admin" id="is_sadmin" type="checkbox">
                                    <label class="form-check-label" for="is_sadmin"> Администратор</label>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Редактировать</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
