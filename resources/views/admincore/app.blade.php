<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>

    <meta name="theme-color" content="#2B2A2E" />

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
    {{--<link rel="stylesheet" href="/admin-core/pdate/persian-datepicker.min.css"/>--}}
    {{--<link rel="stylesheet" href="/admin-core/persiandatapicker/persianDatepicker-default.css"/>--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    @yield('css')


</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    @include('admincore.topbar.index')
    <!-- Main Sidebar Container -->
{{--@include('admincore.sidebar.right')--}}

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.2/js/umd/tooltip.js"></script>.
        @yield('JS')

    <script type="text/javascript">
        // $(document).ready(function() {
        //     $('.pdate').persianDatepicker({
        //    });                                    });





        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
            //Datemask2 mm/dd/yyyy
            $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
            //Money Euro
            $('[data-mask]').inputmask()

            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass   : 'iradio_minimal-blue'
            })
            //Red color scheme for iCheck
            $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                checkboxClass: 'icheckbox_minimal-red',
                radioClass   : 'iradio_minimal-red'
            })
            //Flat red color scheme for iCheck
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass   : 'iradio_flat-green'
            })

            //Colorpicker
            $('.my-colorpicker1').colorpicker()
            //color picker with addon
            $('.my-colorpicker2').colorpicker()


            $('.normal-example').persianDatepicker();



        })
        $('[data-toggle="tooltip"]').tooltip();

    </script>
</body>
</html>
