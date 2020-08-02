@extends('layouts.app')
@section('content')
<div class="jumbotron">
    <h1 class="display-4">Email getter</h1>
    <p class="lead">
        Get emails via this APP.
    </p>
    <hr class="my-4">
    <div class="row">
        <div class="col-md-3">
            <a class="btn btn-primary btn-lg" href="/register" role="button">Register</a>
        </div>
        <div class="col-md-3">
            <a class="btn btn-primary btn-lg" href="/login" role="button">Login</a>
        </div>
    </div>
</div>
@endsection
