@extends('layouts.app')
@section('content')
    <h3 class="font-weight-bolder">Поиск Email адресов </h3>
    @include('messages')


    <form method="post" action="{{route('email.search')}}">
        @csrf

        <div class="form-group d-none">
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
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="user_id">User ID</label>
                <input type="number" class="form-control" id="user_id" name="user_id">
            </div>
            <div class="form-group col-md-4">
                <label for="mailing_id">Mailing List ID</label>
                <input type="number" class="form-control" id="mailing_id" name="mailing_id">
            </div>
            <div class="form-group col-md-4">
                <label for="client_ip">Client IP</label>
                <input type="text" class="form-control" id="client_ip" name="client_ip">
            </div>

        </div>
        <button type="submit" id="search" class="btn btn-primary">Получить список</button>
    </form>

@endsection
