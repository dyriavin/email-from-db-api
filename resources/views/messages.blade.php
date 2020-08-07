@if($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>

    </div>
@endif
@if(session('success'))
    <div class="alert alert-success" role="alert">
        <h5 class="font-weight-bolder text-center">
           {{session('success')}}
        </h5>
    </div>
@endif
