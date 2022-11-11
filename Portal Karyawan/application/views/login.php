<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Selamat Datang di aplikasi cloud UmrohGo! HRM </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1 user-scalable=yes" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?=base_url('assets/AdminLTE-2.3.11/bootstrap/css/bootstrap.min.css') ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=base_url('assets/font-awesome-4.7.0/css/font-awesome.min.css') ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?=base_url('assets/ionicons-2.0.1/css/ionicons.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url('assets/AdminLTE-2.3.11/dist/css/AdminLTE.min.css') ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?=base_url('assets/AdminLTE-2.3.11/plugins/iCheck/square/blue.css') ?>">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>ALIA</b>group</a>
    </div>
    <!-- /.login-logo -->
    <div>
        <h3 align="center">Karyawan</h3>
        <p class="login-box-msg">Sistem Informasi Human Resource Management</p>
        <form action="<?php echo base_url(). "index.php/Login/validasi"?>" method="post">
            <div class="form-group has-feedback">
                <input type="text" value="iqbalc09" class="form-control" placeholder="Username" name="username">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" value="kaskus" class="form-control" placeholder="Password" name="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <?php
            if(isset($result))
            {
                echo $result;
            }
            ?>
            <div class="row">
                <div class="col-xs-4">
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button name="submit" type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?=base_url('assets/AdminLTE-2.3.11/plugins/jQuery/jquery-2.2.3.min.js') ?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?=base_url('assets/AdminLTE-2.3.11/bootstrap/js/bootstrap.min.js') ?>"></script>
<!-- iCheck -->
<script src="<?=base_url('assets/AdminLTE-2.3.11/plugins/iCheck/icheck.min.js') ?>"></script>
</body>
</html>
