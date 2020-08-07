@extends('layouts.app')
@section('content')
    <div class="card text-center">

        <div class="card-body">
            <p class="card-text">Перейдите по ссылке что бы получить email адреса </p>
            <a href="{{route('search.index')}}" class="btn btn-primary">Email </a>
        </div>
    </div>
@endsection
