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
            //include ".../sidebar.php";
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
                Pengumuman
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-bullhorn"></i> Pengumuman</a></li>

            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <!-- /.row -->
            <div class="row">
                <div class="col-xs-12 p-h-sm">
                    <div class="box box-success ">

                        <div class="">
                            <div class="page-title">
                                <div class="title_left">
                                    <h3></h3>
                                </div>
                            </div>

                            <div class="clearfix"></div>

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel">
                                        <div class="x_content">
                                            <div align="center" class="col-md-12">
                                                <div class="table-responsive">
                                                    <form action="<?php base_url()."index.php/karyawan/pengumuman"?>" method="post">
                                                        <div align="center" class="col-md-2">
                                                            <h4>Cari Judul</h4>
                                                        </div>
                                                        <div align="center" class="col-md-3">
                                                            <input name="search" type="text" class="form-control" placeholder="contoh : Libur lebaran">
                                                        </div>
                                                        <div align="center" class="col-md-1">
                                                            <input name="submit" type="submit" class="btn display-block font-normal btn-success" value="Tampilkan">
                                                        </div>
                                                    </form>
                                                    <br>
                                                    <table class="table table-striped">
                                                        <thead>
                                                        <tr class="success">
                                                            <th>Waktu</th>
                                                            <th class="column-title">Judul</th>
                                                            <th class="column-title">Aksi</th>
                                                        </tr>
                                                        </thead>
                                                        <br><br>
                                                        <tbody>
                                                        <?php
                                                        if($data != null)
                                                        {
                                                            foreach ($data as $d) {
                                                                ?>
                                                                <tr class="even pointer">
                                                                    <td>
                                                                        <?php
                                                                        $hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
                                                                        $bulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

                                                                        $convert = strtotime($d['waktu']);
                                                                        echo $hari[date("w", $convert)].", ".date("j", $convert)." ".$bulan[date("n", $convert)]." ".date("Y", $convert);

                                                                        ?>
                                                                    </td>
                                                                    <td><?php echo $d['judul'] ?></td>
                                                                    <td><a href="<?php echo base_url(). "index.php/pengumuman/pesan_pengumuman/".$d['idpengumuman']?>">Baca</a></td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
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

</body>
</html>
