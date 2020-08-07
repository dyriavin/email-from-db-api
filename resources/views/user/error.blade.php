@extends('layouts.app')
@section('content')
    @if($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                    <h3 class="text-center text-uppercase font-weight-bolder"> {{$error}}</h3>
                @endforeach
            </ul>

        </div>
        <div class="justify-content-center">
            <a href="{{route('email.index')}}"
               class="btn btn-warningtext-center align-items-center">
                Назад
            </a>
        </div>
    @endif


@endsection
