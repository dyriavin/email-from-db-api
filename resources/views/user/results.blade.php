@extends('layouts.app')
@section('content')
    <h3 class="font-weight-bolder">Поиск Email адресов </h3>
    <form method="get" action="{{route('email-form.index')}}">
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
                   type="text" placeholder="Введите api ваш ключ" required>
        </div>
        <button type="submit" class="btn btn-primary">Получить список</button>
    </form>

@endsection
