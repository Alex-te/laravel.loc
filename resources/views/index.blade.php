@extends('layouts.main')

@section('title')
    @parent | Главная@endsection

@section('menu')
@include('menu')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Главная</div>

                    <div class="card-body">
                        Привет!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
