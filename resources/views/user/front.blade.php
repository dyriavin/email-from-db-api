@extends('layouts.app')
@section('content')
    <div class="container h-100 d-flex justify-content-center">
        <div id="loader" class="lds-dual-ring">
            <h5 class="text-center mb-5 ">Адреса загружаются </h5>

        </div>

    </div>
    <div id="result" class="my-container d-none">
    @if(sizeof($emails) <=0)
        <div class="alert alert-danger">
            <h3 class="font-weight-bolder text-uppercase text-center">
                Неверный ключ
            </h3>

        </div>
        <div class="justify-content-center">
            <a href="{{route('email.index')}}" class="btn btn-warning text-center align-items-center">
                Назад
            </a>
        </div>

    @else
        <h1> Нажми на кнопку для того что бы скачать email  </h1>
            <span data-href="{{route('email.index')}}"
                  id="back" class="btn btn-primary btn mb-2 "
                  onclick="exportTasks(event.target);">
                  Назад
            </span>
        <span data-href="{{route('csv-export')}}/{{$hash}}/"
              @if(!is_null($from))
              data-date-start="{{$from}}"
              data-date-end="{{$to}}"
              @endif
              id="export" class="btn btn-success btn mb-2 " onclick="exportTasks(event.target);">
            Скачать файл
            </span>
{{--        <table class="table table-hover">--}}
{{--            <thead>--}}
{{--            <tr>--}}
{{--                <th scope="col">Email</th>--}}
{{--                <th scope="col">Email отправителя</th>--}}
{{--                <th scope="col">User ID</th>--}}
{{--                <th scope="col">Mailing ID</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody>--}}
{{--            @foreach($emails as $email)--}}
{{--                <tr>--}}
{{--                    <td>{{$email->email}}</td>--}}
{{--                    <td>{{$email->sender_email}}</td>--}}
{{--                    <td class="font-weight-light text-muted">{{$email->user_id}}</td>--}}
{{--                    <td class="font-weight-light text-muted">{{$email->mailing_id}}</td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}


{{--            </tbody>--}}
{{--        </table>--}}
    @endif

    </div>


@endsection
