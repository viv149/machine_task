<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>My App - {{$title}}</title>

        <link rel="icon" type="image/x-icon" href="{{url('image/bird.jpg')}}">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <!-- Styles -->
        <style>
            body{
                background-image: url('image/background-img.jpg');
                background-position: center;
                background-size: cover;
                background-repeat: no-repeat
            }
            .profile-pic{
                width: 60px;
                border-radius: 50px;
            }
            .profile-img{
                margin: 10px 0;
                width: 100px;
                height: 100px;
            }
            input[type=number]::-webkit-inner-spin-button, 
            input[type=number]::-webkit-outer-spin-button { 
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
                margin: 0; 
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="{{url('image/bird.jpg')}}" alt="Logo" width="40" class="d-inline-block align-text-top">
                    My App
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link {{$active == 'data' ? 'active' : ''}}" aria-current="page" href="{{route('data.index')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{$active == 'audio' ? 'active' : ''}}" href="{{route('audio.index')}}">Audio Text</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{$active == 'location' ? 'active' : ''}}" href="{{route('location.index')}}">Location</a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </nav>
        
        @yield('content')

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        
    </body>
</html>
