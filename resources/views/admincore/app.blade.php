<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/admin-core/font-awesome/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/admin-core/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- bootstrap rtl -->
    <link rel="stylesheet" href="/admin-core/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="/admin-core/css/hover.css">
    <link rel="stylesheet" href="/admin-core/css/animate.css">
    <!-- template rtl version -->
    <link rel="stylesheet" href="/admin-core/css/custom-style.css">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
@include('admincore.topbar.index')
    <!-- Main Sidebar Container -->
@include('admincore.sidebar.right')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
 {{--@include('admincore.breadcrump')--}}




 <!-- Main content -->
     <div class="content mt-5">
         <div class="container-fluid">
             <div class="row">
@yield('content')
             </div>
             </div>
             </div>





@include('admincore.sidebar.left')
    </div>




@include('admincore.footer')



<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="/admin-core/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/admin-core/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/admin-core/js/adminlte.min.js"></script>
</body>
</html>
