<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>UmrohGo! HRM</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="<?=base_url('assets/AdminLTE-2.3.11/bootstrap/css/bootstrap.min.css') ?>">

    <link rel="stylesheet" href="<?=base_url('assets/font-awesome-4.7.0/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?=base_url('assets/ionicons-2.0.1/css/ionicons.min.css') ?>">
    <link rel="stylesheet" href="<?=base_url('assets/css/custom.css') ?>">
    <link rel="stylesheet" href="<?=base_url('assets/css/calendar.css') ?>">
    <link rel="stylesheet" href="<?=base_url('assets/css/kalender.css') ?>">

    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>

    <link href="<?php echo base_url(). "assets/AdminLTE-2.3.11/plugins/jQueryUI/jquery-ui.min.css"?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(). "assets/css/libnas.css"?>" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="<?php echo base_url(). "assets/AdminLTE-2.3.11/dist/css/AdminLTE.min.css"?>">

    <link href="<?php echo base_url(). "assets/AdminLTE-2.3.11/dist/css/skins/_all-skins.min.css"?>" rel="stylesheet" type="text/css" />
</head>
<body class="sidebar-mini wysihtml5-supported skin-green-light">
<div class="wrapper">
    <header class="main-header">
        <?php
        $this->load->view("header");
        ?>
    </header>
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <!-- search form -->
            <?php
            $this->load->view("sidebar");
            ?>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- =============================================== -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Anggota Tim
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-group"></i> Tim</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">

                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">

                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">

                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-xs-12 p-h-sm">
                    <div class="box box-success ">
                        <div class="box-header with-border">
                            <h3 class="box-title" >Tim Saya</h3>
                        </div>
                        <div class="box-body p-med">
                            <div class="col-md-5 col-xs-12">
                                <?php
                                foreach ($data as $d) {
                                    ?>
                                            <div class="col-sm-19">
                                                <div class="right col-xs-5 text-center">
                                                    <img src="<?php echo base_url() . "image/karyawan/".$d['img'].".jpg" ?>" width="75" alt="" class="img-circle img-responsive">
                                                </div>
                                                <div class="left col-xs-7">
                                                    <h3><?php echo $d['nama']?></h3>
                                                    <h5 class="brief"><i><?php echo $d['pekerjaan']?></i></h5>
                                                    <p><strong><?php echo $d['bagian']?></strong></p>
                                                    <ul class="list-unstyled">
                                                        <li><i class="fa fa-building"></i><?php echo $d['email']?></li>
                                                        <li><i class="fa fa-phone"></i><?php echo $d['nomor_hp']?></li>
                                                    </ul>
                                                </div><hr>

                                            </div>
                                    <?php
                                }
                                ?>
                                <div id="cnvsContainer">
                                    <canvas id="canvas" width="422" height="168" style="width: 338px; height: 250px;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main row -->
        </section>
        <!-- /.content -->
    </div><!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="sesi-bawah pull-right hidden-xs">
            <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2017 <a href="http://kredigi.co.id">Kredigi</a>.</strong> All rights reserved.
    </footer>
</div><!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url(). "assets/AdminLTE-2.3.11/plugins/jQuery/jquery-2.2.3.min.js"?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url(). "assets/js/jquery-ui.min.js"?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url(). "assets/AdminLTE-2.3.11/bootstrap/js/bootstrap.min.js"?>"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url(). "assets/AdminLTE-2.3.11/plugins/slimScroll/jquery.slimscroll.min.js"?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url(). "assets/AdminLTE-2.3.11/plugins/fastclick/fastclick.js"?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(). "assets/AdminLTE-2.3.11/dist/js/app.min.js"?>"></script>
<script type="text/javascript">
    function checkSession() {
        $.ajax({
            url: 'http://dev.kredigi.co.id/~yusuf/index.php/json/session',
            type: 'post',
            dataType: 'json',
            data: {},
            success: function(data){
                var minute = data.status > 1 ? "menit" : "menit";
                if(!$.isNumeric(data.status)){
                    window.location.reload();
                }else
                    $(".sesi-bawah").html('<b class="text-danger">'+data.status+' '+minute+' </b> Menuju logout otomatis');
            },
            error: function(){

            }
        });
    }

    checkSession();

    // Fungsi ajax untuk cek waktu server
    function checkWaktu() {
        $.ajax({
            url: 'http://dev.kredigi.co.id/~yusuf/index.php/json/waktu',
            type: 'post',
            dataType: 'json',
            data: {},
            success: function(data){
                //console.log(data.waktu);
                $(".waktu-atas").html(data.waktu);
            },
            error: function(){

            }
        });
    }

    checkWaktu();

    // Ajax untuk mengecek timer di backend apakah udah saatnya logout otomatis atau belum
    setInterval(function(){
        checkSession();
        checkWaktu();
    }, 60000);


</script>
<!-- datepicker -->
<script src="<?php echo base_url(). "assets/AdminLTE-2.3.11/plugins/jQueryUI/jquery-ui.js"?>"></script>
<script src="<?php echo base_url(). "assets/AdminLTE-2.3.11/plugins/chartjs/Chart.min.js"?>"></script>
<script src="<?php echo base_url(). "assets/AdminLTE-2.3.11/plugins/chartjs/Chart.StackedBar.js"?>"></script>
<script type="text/javascript">

</script>
</body>
</html>