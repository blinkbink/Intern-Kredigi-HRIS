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
                Form Pengajuan Izin
                <small></small><br>
                <div class="col-xs-1 p-h-sm">
                    <a href="<?php echo base_url()."index.php/izin"?>"><h6>Kembali</h6></a>
                </div>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-tint"></i> Pengajuan Izin</a></li>
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

                                                    <?php
                                                    foreach ($data as $d) {
                                                    ?>
                                                    <?php echo form_open_multipart('izin/edit_izin/'.$d['id_izin']);?>
                                                    <div align="center" class="col-md-10">

                                                        <table class="table">
                                                            <tr>
                                                                <td>Tanggal Pengajuan</td>
                                                                <td><?php
                                                                    $hari = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
                                                                    $bulan = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

                                                                    $convert = strtotime($d['tanggal_pengajuan']);
                                                                    echo $hari[date("w", $convert)].", ".date("j", $convert)." ".$bulan[date("n", $convert)]." ".date("Y", $convert);

                                                                    ?></td>
                                                                <td><input name="tanggal_pengajuan" type="hidden" value="<?php echo date("Y-m-d", strtotime($d['tanggal_pengajuan']));?>" class="form-control" ></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Tanggal Izin</td>
                                                                <td>
                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <div class="input-group date datepicker" >
                                                                                <input value="<?php echo date("d-m-Y", strtotime($d['tanggal_izin']))?>" name="tanggal_izin" class="form-control" placeholder="" aria-describedby="basic-addon2" value="" readonly="" type="text">
                                                                                <span class="input-group-addon add-on" id="basic-addon2"><i class="fa fa-calendar"></i></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Jenis Izin</td>
                                                                <td>
                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <select name="jenis_izin" class="form-control"
                                                                                    required oninvalid="this.setCustomValidity('Jenis Izin Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                                                                                <option value="">-- Pilih Jenis Izin --
                                                                                </option>
                                                                                <option value="Izin Menikah" <?php if ($d['jenis'] == "Izin Menikah") echo 'selected="selected"' ?>>
                                                                                    Izin Menikah
                                                                                </option>
                                                                                <option value="Izin Menikahkan Anak" <?php if ($d['jenis'] == "Izin Menikahkan Anak") echo 'selected="selected"' ?>>
                                                                                    Izin Menikahkan Anak
                                                                                </option>
                                                                                <option value="Izin Mengkhitankan Anak" <?php if ($d['jenis'] == "Izin Mengkhitankan Anak") echo 'selected="selected"' ?>>
                                                                                    Izin Mengkhitankan Anak
                                                                                </option>
                                                                                <option value="Izin Melahirkan" <?php if ($d['jenis'] == "Izin Melahirkan") echo 'selected="selected"' ?>>
                                                                                    Izin Melahirkan
                                                                                </option>
                                                                                <option value="Izin Istri Melahirkan" <?php if ($d['jenis'] == "Izin Istri Melahirkan") echo 'selected="selected"' ?>>
                                                                                    Izin Istri Melahirkan
                                                                                </option>
                                                                                <option value="Izin Anak Sakit" <?php if ($d['jenis'] == "Izin Anak Sakit") echo 'selected="selected"' ?>>
                                                                                    Izin Anak Sakit
                                                                                </option>
                                                                                <option value="Izin Duka" <?php if ($d['jenis'] == "Izin Duka") echo 'selected="selected"' ?>>
                                                                                    Izin Duka
                                                                                </option>
                                                                                <option value="Izin Main Game" <?php if ($d['jenis'] == "Izin Main Game") echo 'selected="selected"' ?>>
                                                                                    Izin Main Game
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Jumlah Hari Izin</td>
                                                                <td>
                                                                    <div class="row">
                                                                        <div class="col-lg-5">
                                                                            <input value="<?php echo $d['jumlah_hari']?>" name="jumlah_hari" type="number" max="4" min="1" class="form-control" required oninvalid="this.setCustomValidity('Jumlah Hari Tidak Boleh Kosong')" oninput="setCustomValidity('')"><font color="red">*</font> Maksimal 4 hari
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Keterangan</td>
                                                                <td><textarea value="<?php echo $d['keterangan']?>" name="keterangan" style="overflow:auto;resize:none" rows="6" cols="80" required oninvalid="this.setCustomValidity('Keterangan Tidak Boleh Kosong')" oninput="setCustomValidity('')"><?php echo $d['keterangan']?></textarea></td>
                                                            </tr>
                                                        </table>

                                                        <br>
                                                        <div align="right" class="col-md-7">
                                                            <input name="submit" type="submit" class="btn display-block font-normal btn-success" value="Simpan">
                                                        </div>

                                                        <div class="col-md-1">
                                                            <button class="btn display-block font-normal btn-default"
                                                                    onclick="window.history.go(-1); return false;">Batal
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    echo form_close();
                                                    ?>
                                                    <!-- </form>-->

                                                </div>
                                                <?php
                                                }
                                                ?>
                                                <br>
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
        $(".datepicker").datepicker({
            startDate: new Date(),
            todayHighlight: true,
            orientation: "top",
            autoclose:true,
            format: 'dd-mm-yyyy'
        })
    });
</script>
</body>
</html>