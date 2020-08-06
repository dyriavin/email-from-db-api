@extends('layouts.app')
@section('content')
    <h1>FRONT PAGE USER</h1>
    <form method="get" action="{{route('email-form.index')}}">
        <div class="form-group">
            <label >Начальная дата:</label>
            <input type="date" name="start_date" max="2020-06-30"
                   min="2020-01-01" class="form-control">
        </div>
        <div class="form-group">
            <label >Конечная дата:</label>
            <input type="date" name="end_date" min="2020-01-01"
                   max="2020-06-30" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Получить список</button>
    </form>

@endsection
