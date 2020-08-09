@extends('layouts.app')
@section('content')
    <h3 class="font-weight-bolder">Поиск Email адресов </h3>
    @include('messages')


    <form method="post" action="{{route('email.search')}}">
        @csrf
        <div class="form-group">
            <label>Начальная дата:</label>
            <input type="date" name="start_date" max="2020-06-30"
                   min="2020-01-01" class="form-control">
        </div>
        <div class="form-group">
            <label> Ключ:
                <span class="required" style="color:red" >*</span>
            </label>
            <input class="form-control" id="key" name="key"
                   type="text" placeholder="ключ">
        </div>
        <button type="submit" id="search" class="btn btn-primary">Получить список</button>
    </form>
    <div class="lds-dual-ring mt-5">

    </div>
@endsection
