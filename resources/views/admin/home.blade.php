@extends('layouts.admin')

@section('content')
    <h4 class="font-weight-bolder text-uppercase mt-5 text-center">Автоматические пополнения баланса</h4>
{{--    {{dd($jobs)}}--}}
    <table class="table table-striped table-dark">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Тип</th>
            <th scope="col">Будет доступно</th>
            <th scope="col">Добавлено </th>
            <th scope="col">Попыток </th>
        </tr>
        </thead>

        <tbody>
        @foreach($jobs as $job)
        <tr>
            <th scope="row">{{$job->id}}</th>
            <td>{{$job->queue}}</td>
            <td>{{ date("Y-m-d H:i:s", substr($job->available_at, 0, 10)) }}</td>
            <td>{{ date("Y-m-d H:i:s", substr($job->created_at, 0, 10))  }}</td>
            <td>{{$job->attempts}}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <h3 class="font-weight-bolder text-uppercase mt-5 text-center">List of active users</h3>
    @include('messages')
    <table class="table table-hover alert-info">
        <thead>
        <tr class="font-weight-bolder text-uppercase">
            <th scope="col">ID</th>
            <th scope="col">User Email</th>
            <th scope="col">User Name</th>
            <th scope="col">User Credit</th>
            <th scope="col">Add credit</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr class="font-weight-lighter">
            <th scope="row">{{$user->id}}</th>
            <td>{{$user->email}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->credit->credit}}</td>
            <td>
                <form action="{{route('update.balance')}}" method="post">
                    @csrf
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="text" name="credit" id="credit" value="20000">
                        <input type="hidden" name="user_id" value="{{$user->id}}">
                        <button type="submit" class="btn btn-success btn-sm">+</button>
                    </div>

                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection
