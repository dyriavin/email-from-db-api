@extends('layouts.admin')

@section('content')
    <h1 class="font-weight-bolder text-uppercase mt-2 text-center">Admin Area</h1>

    <div class="row">
        <!--total used db -->
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
    </div>
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
