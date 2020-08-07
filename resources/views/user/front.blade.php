@extends('layouts.app')
@section('content')

    <h1> Предпросмотр списка email  </h1>
    <span data-href="{{route('csv-export')}}/"
          @if(!is_null($from))
          data-date-start="{{$from}}"
          data-date-end="{{$to}}"
          @endif
          id="export" class="btn btn-success btn mb-2 " onclick="exportTasks(event.target);">
        Скачать файл
    </span>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Email</th>
            <th scope="col">Email отправителя</th>
            <th scope="col">Статус доставки </th>
            <th scope="col">Дата отправки</th>
        </tr>
        </thead>
        <tbody>
        @foreach($emails['preview'] as $email)
            <tr>
                <th scope="row">{{$email->id}}</th>
                <td>{{$email->email}}</td>
                <td>{{$email->sender_email}}</td>
                <td>
                    @if($email->delivery_status == 'delivered')
                        <span class="badge badge-success badge-pill font-weight-bold">
                        {{ucfirst($email->delivery_status)}}
                    </span>
                    @else
                        <span class="badge badge-danger badge-pill">
                        {{ucfirst($email->delivery_status)}}
                    </span>
                    @endif
                </td>
                <td>{{$email->send_date}}</td>
            </tr>
        @endforeach


        </tbody>
    </table>

@endsection
