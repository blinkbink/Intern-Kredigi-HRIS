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


    <link rel="stylesheet" href="<?php echo base_url(). "assets/AdminLTE-2.3.11/plugins/datepicker/datepicker3.css"?>">
    <link rel="stylesheet" href="<?php echo base_url(). "http://dev.kredigi.co.id/~yusuf/assets/AdminLTE-2.3.11/plugins/timepicker/bootstrap-timepicker.min.css"?>">

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
                Catatan Kehadiran
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-file"></i> Catatan Kehadiran</a></li>
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
                                            <div align="center" class="col-md-14">
                                                <div class="table-responsive">

                                                    <form action="<?php base_url()."karyawan/kehadiran"?>" method="post">
                                                        <div class="col-md-3">Dari
                                                            <div class="input-group date datepicker" >
                                                                <input name="dari" class="form-control" placeholder="" aria-describedby="basic-addon2" value="" readonly="" type="text" onchange="this.form.submit()">
                                                                <span class="input-group-addon add-on" id="basic-addon2"><i class="fa fa-calendar"></i></span>
                                                            </div>

                                                        </div>

                                                        <div class="col-md-3">Sampai
                                                            <div class="input-group date datepicker" >
                                                                <input name="sampai" class="form-control" placeholder="" aria-describedby="basic-addon2" value="" readonly="" type="text" onchange="this.form.submit()">
                                                                <span class="input-group-addon add-on" id="basic-addon2"><i class="fa fa-calendar"></i></span>
                                                            </div>
                                                        </div>

                                                        <div align="center" class="col-md-3">
                                                            <input type="submit" name="submit" class="btn display-block font-normal btn-success" value="Tampilkan">
                                                        </div>
                                                    </form>

                                                    <br><br><br><br><br><br>
                                                    <div align="center" class="col-md-5">
                                                        <table class="table stripped" style="color: black">
                                                            <?php
                                                            foreach($count as $c)
                                                            {
                                                                $total = $c['total_kehadiran'];
                                                            }
                                                            if($group != null)
                                                                foreach ($group as $group)
                                                                {
                                                                    $nama_status = $group['nama_status'];
                                                                    $hitung_jumlah = $group['hitung_status'];
                                                                    $persentase = ($hitung_jumlah/$total)*100;
                                                                    ?>
                                                                    <tr class="success">
                                                                        <td><?php echo $nama_status ?></td>
                                                                        <td><?php echo $hitung_jumlah ?></td>
                                                                        <td><?php echo $persentase ?>%</td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </table>
                                                    </div>
                                                    <br>
                                                    <div align="center" class="col-md-12">
                                                    <table class="table table-striped jambo_table bulk_action">
                                                        <thead>
                                                        <tr class="success">
                                                            <th class="column-title">Tanggal</th>
                                                            <th class="column-title">Status Kehadiran </th>
                                                            <th class="column-title">Jam Masuk </th>
                                                            <th class="column-title">Jam Keluar </th>
                                                            <th class="column-title">Lama Lembur </th>
                                                            <th class="column-title">Tipe Lembur </th>
                                                            <th class="column-title">Terlambat </th>
                                                        </tr>
                                                        </thead>
                                                        <br><br>
                                                        <tbody>
                                                        <?php
                                                        if($absensi != null)
                                                        {
                                                            foreach ($absensi as $d) {
                                                                ?>
                                                                <tr class="even pointer">
                                                                    <td class=" "><?php echo $d['tanggal'] ?></td>
                                                                    <td class=" "><?php echo $d['status_kehadiran'] ?></td>
                                                                    <td class=" "><?php echo $d['jam_masuk'] ?></td>
                                                                    <td class=" "><?php echo $d['jam_keluar'] ?></td>
                                                                    <td class=" "><?php echo $d['lama_lembur'] ?></td>
                                                                    <td class=" "><?php echo $d['tipe_lembur'] ?></td>
                                                                    <td class=" "><?php echo $d['terlambat'] ?></td>
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

<script src="<?php echo base_url(). "assets/AdminLTE-2.3.11/plugins/datepicker/bootstrap-datepicker.js"?>"></script>
<script src="<?php echo base_url(). "assets/AdminLTE-2.3.11/plugins/timepicker/bootstrap-timepicker.min.js"?>"></script>

<script type="text/javascript">
    $(function(){
        $(".timepicker").timepicker({
            showMeridian: false,
            defaultTime: false
        });
        $(".datepicker").datepicker({
            orientation: "top",
            autoclose:true,
            format: 'dd-mm-yyyy'
        })
    });
</script>