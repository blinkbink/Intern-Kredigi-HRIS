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
                Cuti Tahunan
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-tag"></i> Cuti Tahunan</a></li>

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
                                                    <br>
                                                    <?php
                                                    $tanggal_mulai_kerja = null;
                                                    $tanggal_hari_ini = null;
                                                    $tahun = null;
                                                    if($dataCuti != null) {
                                                        foreach ($dataCuti as $k) {
                                                            $tanggal_mulai_kerja = new DateTime($k['tanggal_mulai_kerja']);
                                                            $tanggal_hari_ini = new DateTime(date("Y-m-d"));
                                                            $tahun = $tanggal_hari_ini->diff($tanggal_mulai_kerja)->format("%a");
                                                        }
                                                    }

                                                    if($tahun == null)
                                                    {
                                                        ?>
                                                        <div align="left" class="col-md-7">
                                                            <button onclick="location.href='<?php echo base_url() . "cuti/form_cuti" ?>'" class="btn display-block font-normal btn-success">+ Pengajuan Cuti Tahunan</button>
                                                        </div>
                                                        <br><br><br><br>
                                                        <h1 align="center">Belum Ada Data</h1>
                                                        <?php
                                                    }

                                                    else if($tahun < 365)
                                                    {
                                                        ?>
                                                        <h1 align="center">Anda belum memiliki jatah pengajuan cuti tahunan</h1>
                                                        <?php
                                                    }

                                                    else
                                                    {
                                                        ?>
                                                        <div align="center" class="col-md-5">
                                                            <?php
                                                            foreach ($hitungCuti as $st)
                                                            {
                                                                foreach ($status as $s)
                                                                    $status_terakhir = $s['status'];
                                                                $tahun_cuti = date('Y', strtotime($s['tanggal_cuti']));
                                                                $tahun_sekarang = date('Y');
                                                                $tanggal_cuti = date('m-d-Y', strtotime($s['tanggal_cuti']));
                                                                $tanggal_sekarang = date('m-d-Y');

                                                                if ($st['total'] >= 1) {
                                                                    ?>
                                                                    <div align="center" class="col-md-7">
                                                                        <button onclick="location.href='<?php echo base_url() . "cuti/form_cuti" ?>'" class="btn display-block font-normal btn-success" disabled>+ Pengajuan Cuti Tahunan</button>
                                                                    </div>
                                                                    <br><br><br>
                                                                    <p><font color="red">*</font> Pengajuan Cuti anda sedang di proses</p>
                                                                    <?php
                                                                } else if($status_terakhir == "Di Setujui" && $tahun_cuti == $tahun_sekarang)
                                                                {
                                                                    ?>
                                                                    <div align="center" class="col-md-7">
                                                                        <button onclick="location.href='<?php echo base_url() . "cuti/form_cuti" ?>'" class="btn display-block font-normal btn-success" disabled>+ Pengajuan Cuti Tahunan</button>
                                                                    </div>
                                                                    <br><br><br>
                                                                    <p><font color="red">*</font> Kamu tidak Bisa Mengajukan Cuti Tahunan Lebih dari 1 kali dalam setahun</p>
                                                                    <?php
                                                                }
                                                                else if($status_terakhir == "Batal" || $status_terakhir == "Tidak Di Setujui")
                                                                {
                                                                    ?>
                                                                    <div align="center" class="col-md-7">
                                                                        <button onclick="location.href='<?php echo base_url() . "cuti/form_cuti" ?>'" class="btn display-block font-normal btn-success">+ Pengajuan Cuti Tahunan</button>
                                                                    </div>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </div>

                                                        <br><br><br><br><br><br><br>
                                                        <div class="table-responsive">
                                                            <table class="table table-striped jambo_table bulk_action">
                                                                <thead>
                                                                <tr class="success">
                                                                    <th class="column-title">Nama Karyawan</th>
                                                                    <th class="column-title">Tanggal </th>
                                                                    <th class="column-title">Lama Cuti </th>
                                                                    <th class="column-title">Status </th>
                                                                    <th class="column-title">Aksi </th>
                                                                </tr>

                                                                </thead>
                                                                <tbody>
                                                                <?php
                                                                foreach ($dataCuti as $d) {
                                                                    ?>
                                                                    <tr class="even pointer">
                                                                        <td class=" "><?php echo $d['nama'] ?></td>
                                                                        <td class=" ">
                                                                            <?php
                                                                            $convert = date('j F o', strtotime($d['tanggal_cuti']));
                                                                            echo $convert
                                                                            ?>
                                                                        </td>
                                                                        <td class=" "><?php echo $d['lama_cuti'] ?> Hari</td>
                                                                        <td class=" ">
                                                                            <?php
                                                                            if ($d['status'] == "Batal" || $d['status'] == "Tidak Di Setujui") {
                                                                                ?>
                                                                                <p><font color="red"><?php echo $d['status'] ?></font></p>
                                                                                <?php
                                                                            } else if ($d['status'] == "Di Setujui") {
                                                                                ?>
                                                                                <p><font color="green"><?php echo $d['status'] ?></font></p>
                                                                                <?php
                                                                            } else {
                                                                                ?>
                                                                                <p><?php echo $d['status'] ?></p>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </td>
                                                                        <td class=" ">
                                                                            <?php
                                                                            if ($d['status'] == "Pending") {
                                                                                ?>
                                                                                <a href="cuti/detail_cuti/<?php echo $d['id_cuti'] ?>">Lihat</a>
                                                                                <a href="cuti/batal_cuti/<?php echo $d['id_cuti'] ?>"
                                                                                   onclick="return confirm('Apakah anda yakin akan membatalkan pengajuan izin ini ?')">Batal</a>
                                                                                <a href="cuti/edit_cuti/<?php echo $d['id_cuti'] ?>">Edit</a>
                                                                                <?php
                                                                            } else if ($d['status'] == "Batal" || $d['status'] == "Tidak Di Setujui") {
                                                                                ?>
                                                                                <a href="cuti/detail_cuti/<?php echo $d['id_cuti'] ?>">Lihat</a>
                                                                                <?php
                                                                            } else if ($d['status'] == "Di Setujui") {
                                                                                ?>
                                                                                <a href="cuti/detail_cuti/<?php echo $d['id_cuti'] ?>">Lihat</a>
                                                                                <a href="cuti/batal_cuti/<?php echo $d['id_cuti'] ?>"
                                                                                   onclick="return confirm('Apakah anda yakin akan membatalkan pengajuan izin ini ?')">Batal</a>
                                                                                <?php
                                                                            } else if ($tanggal_cuti >= $tanggal_sekarang && $d['status'] == "Di Setujui") {
                                                                                ?>
                                                                                <a href="cuti/detail_cuti/<?php echo $d['id_cuti'] ?>">Lihat</a>
                                                                                <?php
                                                                            } else {
                                                                                ?>
                                                                                <p>-</p>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                                ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
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

