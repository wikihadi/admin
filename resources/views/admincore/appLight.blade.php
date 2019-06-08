<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="/img/logo.png">
    <meta name="theme-color" content="#2B2A2E" />

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @if(isset($titleOfPage)){{$titleOfPage}} |@endif{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="/admin-core/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/admin-core/css/adminlte.min.css">
    <!-- bootstrap rtl -->
    <link rel="stylesheet" href="/admin-core/css/bootstrap-rtl.min.css">

    <link rel="stylesheet" href="/admin-core/css/hover.css">
    <link rel="stylesheet" href="/css/animate.min.css">

    <link rel="stylesheet" href="/admin-core/css/custom-style.css">
    <link href="/admin-core/css/select2.min.css" rel="stylesheet" />

    @yield('css')

</head>
<body class="hold-transition sidebar-mini">
@yield('afterBody')

             <div class="row" id="app">

                @yield('content')
             </div>

<script src="{{ asset('js/app.js') }}"></script>
<script src="/admin-core/js/adminlte.min.js"></script>
@yield('JS')

</body>
</html>
