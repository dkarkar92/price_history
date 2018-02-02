<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Price History') }}</title>

    <!-- Styles -->
    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}

    <!-- Required meta tags -->


    <!-- External CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link href="{!! asset('packages/pickadate.js-3.5.6/lib/themes/default.css') !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset('packages/pickadate.js-3.5.6/lib/themes/default.date.css') !!}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.16/datatables.min.css"/>

    <link rel="stylesheet" type="text/css" href="{!! asset('css/global.css') !!}"/>

    @yield('custom-css')
</head>
<body>

<?php
if (Auth::check()) {
    $user_role = Auth::user()->roles()->first()->name;
} else {
    $user_role = false;
}
?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ url('/') }}">Price History</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link {{ is_null(Request::segment(1)) ? 'active' : '' }}" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
                </li>

                @if ($user_role !== false && in_array($user_role, array("admin")))
                    <li class="nav-item">
                        <a class="nav-link {{ Request::segment(1) === 'users' ? 'active' : '' }}" href="{{ url('/users') }}">Users <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::segment(1) === 'summary' ? 'active' : '' }}" href="{{ url('/summary') }}">Summary <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::segment(1) === 'stores' ? 'active' : '' }}" href="{{ url('/stores') }}">Stores <span class="sr-only">(current)</span></a>
                    </li>
                @endif

                @if ($user_role !== false && in_array($user_role, array("admin", "manager")))
                    <li class="nav-item">
                        <a class="nav-link {{ Request::segment(1) === 'employees' ? 'active' : '' }}" href="{{ url('/employees') }}">Employees <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::segment(1) === 'hours' ? 'active' : '' }}" href="{{ url('/hours') }}">Employee Hours <span class="sr-only">(current)</span></a>
                    </li>
                @endif
            </ul>
            <ul class="navbar-nav navbar-right">
                @guest
                    <li class="nav-item {{ Request::segment(1) === 'login' ? 'active' : '' }}"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                    <li class="nav-item {{ Request::segment(1) === 'register' ? 'active' : '' }}"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
                @else
                    <li class="nav-item dropdown">
                        <a href="#" id="login_stuff" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="login_stuff">

                            <a href="{{ route('logout') }}" class="dropdown-item"
                               onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>

    @yield('content')

    <footer>
        <div class="container">
                <p class="text-center">Created By Darshan Karkar</p>
                <p class="text-center">v {{ config('app.version_number') }}</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- External JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script type="text/javascript" src="{!! asset('packages/pickadate.js-3.5.6/lib/picker.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('packages/pickadate.js-3.5.6/lib/picker.date.js') !!}"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.16/datatables.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>

    @yield('custom-js')
</body>
</html>
