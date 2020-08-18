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
            <label for="key">Ключ</label>
            <input type="text" name="key" class="form-control"  id="key" disabled>
        </div>
        <div class="form-group">
            <label for="sender_email">Email</label>
            <input type="email" class="form-control" name="sender_email" id="sender_email">
        </div>
        <div class="form-row mb-2">
            <div class="col-7">
                <label for="user_id">User ID</label>
                <input type="number" class="form-control" name="user_id" id="user_id">
            </div>
            <div class="col">
                <label for="mailing_id">Mailing ID</label>
                <input type="number" class="form-control" name="mailing_id" id="mailing_id">
            </div>
            <div class="col">
                <label for="client_ip">Client IP</label>
                <input type="text" class="form-control" name="client_ip" id="client_ip">
            </div>
        </div>

        <a href="#" id="key_kegenerate" class="btn btn-warning font-weight-bolder"
           role="button"
           aria-disabled="true">Сгенерировать ключ</a>
        <button type="submit" id="search" class="btn btn-success font-weight-bolder d-none" disabled>Получить Email </button>
    </form>

@endsection
