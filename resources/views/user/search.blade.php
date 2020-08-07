@extends('layouts.app')
@section('content')
    <h3 class="font-weight-bolder">Поиск Email адресов </h3>
    @include('messages')


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    <form method="post" action="{{route('email.search')}}">
        @csrf
        <div class="form-group">
            <label>Начальная дата:</label>
            <input type="date" name="start_date" max="2020-06-30"
                   min="2020-01-01" class="form-control">
        </div>
        <div class="form-group">
            <label> API ключ:
                <span class="required" style="color:red" >*</span>
            </label>
            <input class="form-control" id="api_key" name="api_key"
                   type="text" placeholder="Введите api ключ">
        </div>
        <button type="submit" class="btn btn-primary">Получить список</button>
    </form>

@endsection
