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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Froome - Admin</title>
    <link rel="stylesheet" href="/css/app.css"/>
    <script src="https://kit.fontawesome.com/79d95132b9.js" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;700&display=swap" rel="stylesheet">
</head>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->last_name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        
    </div>
    <div id="main">
        <div id="left">
            <div id="logo">
                <img src="{{ URL::to('/images/jobseeker.png') }}"/>
            </div>
            @if( Auth::user()->role == "1" )
            <a href="{{ route('user.index') }}">
                <div id="admin-profile">
                    <img class="admin-avatar" src="/images/avatar.png"/>
                    <h2 class="admin-name">Admin</h2>
                </div>
            </a>
            @endif
            @if( Auth::user()->role == "2" || Auth::user()->role == "1" )
            <a href="{{ route('employer.index') }}">
                <div id="users" class="item ">
                    <img class="item-icon" src="/images/employers.png"/>
                    <h2 class="item-title">Employer</h2>
                </div>
            </a>
           @endif
           @if( Auth::user()->role ==  "3" || Auth::user()->role == "1")
            <a href="{{ route('employees.index')}}">
                <div id="materials" class="item ">
                    <img class="item-icon" src="/images/users.png"/>
                    <h2 class="item-title">Employees</h2>
                </div>
            </a>
            @endif
            @if( Auth::user()->role == "2" || Auth::user()->role == "1")
            <a href="{{ route('post_job.index')}}">
                <div id="classes" class="item ">
                    <img class="item-icon" src="/images/class.png"/>
                    <h2 class="item-title">Post Job</h2>
                </div>
            </a>
            @endif
            @if( Auth::user()->role == "3" || Auth::user()->role == "1")
            <a href="{{ route('post_cv.index')}}">
                <div id="messages" class="item ">
                    <img class="item-icon" src="/images/cv.png"/>
                    <h2 class="item-title">Post CV</h2>
                </div>
            </a>
            @endif
        </div>
        <div id="right">
            <div id="topbar">
                <form method="GET" action="/search">
                    <input id="searchbar" type="text" placeholder="&#xF002; Search" style="font-family:Arial, FontAwesome"/>
                </form>
                <img id="dotdotdot" src="/images/dotdotdot.png">
            </div>
            <main class="py-4">
            @yield('content')
        </main>
 </form>
    <div>

</body>
</html>
