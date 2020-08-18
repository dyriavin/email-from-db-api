<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .lds-dual-ring {
            display: inline-block;
            width: 180px;
            height: 170px;
        }

        .lds-dual-ring:after {
            content: " ";
            display: block;
            width: 100%;
            height: 100%;
            margin: 8px;
            border-radius: 50%;
            border: 6px solid #fff;
            border-color: #0069d9 transparent #fff transparent;
            animation: lds-dual-ring 1.2s linear infinite;
        }

        @keyframes lds-dual-ring {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

    </style>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand text-center" href="{{ url('/') }}">Email</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->

                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret">
                                    </span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>
</div>
<script
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(()=> {
                $('#key_kegenerate').click(function (event){
                    event.preventDefault()
                    const senderEmail = $("#sender_email").val()
                    const userId = $("#user_id").val()
                    const mailingId = $("#mailing_id").val()


                    if (senderEmail.length > 0 || userId.length > 0 || mailingId.length > 0) {
                        getApiKey(senderEmail,userId,mailingId)
                    }

                })
            })
            function getApiKey(senderEmail,userId,mailingId){
                $.ajax({
                    type: 'POST',
                    url: "{{route('api.key')}}",
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'email': senderEmail,
                        'userId': userId,
                        'mailingId': mailingId
                    },
                    success:  function (data) {
                        // $("#key").val(data)
                        $('input[name=key]').attr('value', data);
                        $("#search").removeClass('d-none').prop('disabled',false)
                        $("#key_kegenerate").remove()
                    },
                });
            }

        </script>
@if(Request::is('email-search'))
    <script>
        function exportTasks(_this) {
            window.location.href = $(_this).data('href');
        }

        $(document).ready(function () {
            setTimeout(function () {
                $('#result').removeClass('d-none')
                $('#loader').addClass('d-none')
            }, {{ rand(40000 , 60000 )}} );
        })

    </script>
@endif
</body>
</html>
