@extends('layouts.app')
@section('content')
    <h1> Список email  </h1>
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
        @foreach($emails as $email)
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

    {{ $emails }}
@endsection
