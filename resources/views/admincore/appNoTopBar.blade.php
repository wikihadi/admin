<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>




    <link rel="icon" href="/img/logo.png">
    <meta name="theme-color" content="#2B2A2E" />

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @if(isset($titleOfPage)){{$titleOfPage}} |@endif{{ config('app.name', 'Laravel') }} : {{date("Y-m-d H:i:s")}}</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/admin-core/font-awesome/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/admin-core/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- bootstrap rtl -->
    <link rel="stylesheet" href="/admin-core/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="/admin-core/css/hover.css">
    <link rel="stylesheet" href="/css/animate.min.css">

{{--    <link rel="stylesheet" href="/admin-core/css/animate.css">--}}
<!-- template rtl version -->
    <link rel="stylesheet" href="/admin-core/css/custom-style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />

    @yield('css')
    <style>
        .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
            color: #fff;
            background-color: #000000!important;
        }
        .nav-sidebar {
            overflow: visible!important;
        }
        .modal-dialog {
            z-index: 100000000;
        }
        body{
            padding-right: 0!important;
        }

    </style>


</head>
<body class="hold-transition sidebar-mini" onload="window.print()">

@yield('afterBody')

<div class="wrapper">
{{--@include('admincore.topbar.index')--}}
<!-- Main Sidebar Container -->
{{--@include('admincore.sidebar.right')--}}

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    {{-- @include('admincore.breadcrump')--}}




    <!-- Main content -->
        <div class="content mt-5">

            <div class="container-fluid">
                <div class="row" id="app">

                    @yield('content')
                </div>
            </div>
        </div>





        @include('admincore.sidebar.left')
    </div>




    @include('admincore.footer')

</div>

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
{{--<script src="/js/app.js"></script>--}}
<script src="{{ asset('js/app.js') }}"></script>
{{--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>--}}
{{--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>--}}
{{--<script src="/admin-core/jquery/jquery.min.js"></script>--}}
<!-- Bootstrap 4 -->
{{--<script src="/admin-core/bootstrap/js/bootstrap.bundle.min.js"></script>--}}
<!-- AdminLTE App -->
<script src="/admin-core/js/adminlte.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script src="/js/tooltip.js"></script>.

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



    $('.statusSmile').click(function(){
        $('.InputToFocus').focus();
    });
    $(function () {
        setTimeout(function() {
            $('.timeout').fadeOut('fast');
        }, 3000);
    })


    $(".playTask").click(function(){
        var $selectUserStatus = $('.selectUserStatus');
        var $inputUserStatus = $('.inputUserStatus');
        var $statusStatus = $('.statusStatus');

        $('.lableUserStatus').toggle();

        if ($inputUserStatus.attr('readonly')) {
            $inputUserStatus.removeAttr('readonly');
            $inputUserStatus.removeAttr('value', '');

        } else {
            $inputUserStatus.attr('readonly', 'readonly');
            $inputUserStatus.attr('value', 'شروع به کار');
        }
        if ($selectUserStatus.attr('disabled')) {
            $selectUserStatus.removeAttr('disabled');
        } else {
            $selectUserStatus.attr('disabled', 'disabled');
        }
        if ($statusStatus.attr('value') == 'status') {
            $statusStatus.attr('value','start');
        } else {
            $statusStatus.attr('value', 'status');
        }

    });

    $(".endTask").click(function () {
        var $selectUserStatus = $('.selectUserStatus');
        var $inputUserStatus = $('.inputUserStatus');
        var $statusStatus = $('.statusStatus');
        var $selectTaskStatus = $('.selectTaskStatus');
        var $endTaskId = $('.endTaskId');

        $('.lableUserStatusEnd').toggle();

        if ($inputUserStatus.attr('readonly')) {
            $inputUserStatus.removeAttr('readonly');
            $inputUserStatus.removeAttr('value', '');

        } else {
            $inputUserStatus.attr('readonly', 'readonly');
            $inputUserStatus.attr('value', 'پایان کار');
        }

        if ($selectTaskStatus.attr('disabled')) {
            $selectTaskStatus.removeAttr('disabled');
        } else {
            $selectTaskStatus.attr('disabled', 'disabled');
        }
        if ($endTaskId.attr('disabled')) {
            $endTaskId.removeAttr('disabled');
        } else {
            $endTaskId.attr('disabled', 'disabled');
        }
        if ($selectUserStatus.attr('disabled')) {
            $selectUserStatus.removeAttr('disabled');
        } else {
            $selectUserStatus.attr('disabled', 'disabled');
        }
        if ($statusStatus.attr('value') == 'status') {
            $statusStatus.attr('value', 'end');
        } else {
            $statusStatus.attr('value', 'status');
        }

    });

</script>
@yield('JS')

</body>
</html>
