<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>To Do List</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <style>
            .vertical-center {
                min-height: 100%;  /* Fallback for browsers do NOT support vh unit */
                min-height: 100vh; /* These two lines are counted as one :-)       */

                display: flex;
                align-items: center;
            }
        </style>

    </head>
    <body>


        <div class="container text-center vertical-center">
            {{--@if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ route('list_items') }}">My List</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif--}}

            <div class="content h-100">
                <div class="row h-100 justify-content-center align-items-center">
                    <div class="col col-md-8">
                        <div class="display-3">
                            Create your own marvelous
                            @auth
                                <a href="{{ route('list_items') }}" class="link">To Do List</a>
                            @else
                                To Do List
                            @endauth
                        </div>

                        @auth()
                        @else
                            <div class="btn-group">
                                <a href="{{ route('login') }}" class="btn btn-secondary">Login</a>
                            </div>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
