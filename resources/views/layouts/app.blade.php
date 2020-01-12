<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    {{--<link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
    {{--<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">--}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{--<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">--}}
{{--    <link href="{{ asset('css/fonts.css') }}" rel="stylesheet">--}}
    {{--<link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet">--}}
    <!-- Styles -->
    <!-- Font Awesome -->


{{--    <link href="{{ asset('css/style.css') }}" rel="stylesheet">--}}
    {{--<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"></head>--}}
<body>
    <div id="app">
        <home :user="{{Auth::user()}}"></home>


        <div class="col-10 a-min-w" dir="rtl">
            @yield('content')
        </div>
    </div>


    {{--<script type="text/javascript" src="js/mdb.min.js"></script>--}}

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script>

        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        })
    </script>
    </body>
</html>
