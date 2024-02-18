<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="robots" content="noindex" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SWP DDD<?php if (isset($page_title)) { echo(" | " . $page_title); } ?></title>
    <!-- Bootstrap 3 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
    <!-- W3CSS -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url(); ?>/public/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css" />
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url(); ?>/public/plugins/icheck-bootstrap/icheck-bootstrap.min.css" />
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= base_url(); ?>/public/plugins/jqvmap/jqvmap.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>/public/dist/css/adminlte.min.css" />
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url(); ?>/public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css" />
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url(); ?>/public/plugins/daterangepicker/daterangepicker.css" />
    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url(); ?>/public/plugins/summernote/summernote-bs4.min.css" />
    <!-- custom css -->
    <style type="text/css">
        input[type="radio"] {
            margin: 0;
            appearance: none;
            border: 1px solid #FD7E14;
            width: 15px;
            height: 15px;
            content: none;
            outline: none;
        }
        
        input[type="radio"]:checked {
            appearance: none;
            outline: none;
            padding: 0;
            content: none;
            border: none;
        }
        
        input[type="radio"]:checked::before {
            position: absolute;
            color: green !important;
            content: "\00A0\2713\00A0" !important;
            border: 1px solid #FD7E14;
            font-weight: 900;
            font-size: 11px;
        }
        
        input[type="checkbox"] {
            margin: 0;
            appearance: none;
            border: 1px solid #FD7E14;
            width: 15px;
            height: 15px;
            content: none;
            outline: none;
        }
        
        input[type="checkbox"]:checked {
            appearance: none;
            outline: none;
            padding: 0;
            content: none;
            border: none;
        }
        
        input[type="checkbox"]:checked::before {
            position: absolute;
            color: green !important;
            content: "\00A0\2713\00A0" !important;
            border: 1px solid #FD7E14;
            font-weight: 900;
            font-size: 11px;
        }
    </style>
    <!-- jQuery -->
    <script src="<?= base_url(); ?>/public/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?= base_url(); ?>/public/plugins/jquery-ui/jquery-ui.min.js"></script>
</head>
<body class="hold-transition text-sm layout-footer-fixed accent-olive sidebar-collapse layout-navbar-fixed sidebar-mini sidebar-mini-md sidebar-mini-xs layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?= base_url(); ?>/public/dist/img/emblem.png" alt="emblem" height="129px" />
        </div>
        <!-- Navbar -->
            <?= $this->include('layout/top-menu'); ?>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <!-- Sidebar Menu -->
            <?= $this->include('layout/left-menu'); ?>
        <!-- /.sidebar-menu -->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?= $this->renderSection("content"); ?>
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer text-sm">
            <strong>Copyright &copy; 2022 <a href="<?= base_url(); ?>/"><span class="w3-text-orange">Swrv</span><span class="w3-text-indigo">WebWorks</span><span class="w3-text-teal">PvtLtd</span></a></strong> All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.1.SWP
            </div>
        </footer>
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <!-- Bootstrap 3 Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url(); ?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="<?= base_url(); ?>/public/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="<?= base_url(); ?>/public/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="<?= base_url(); ?>/public/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="<?= base_url(); ?>/public/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?= base_url(); ?>/public/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="<?= base_url(); ?>/public/plugins/moment/moment.min.js"></script>
    <script src="<?= base_url(); ?>/public/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?= base_url(); ?>/public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="<?= base_url(); ?>/public/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?= base_url(); ?>/public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url(); ?>/public/dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url(); ?>/public/dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?= base_url(); ?>/public/dist/js/pages/dashboard.js"></script>
</body>
</html>