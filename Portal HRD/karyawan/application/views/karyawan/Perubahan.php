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
                Form Pengajuan Perubahan Data
                <small></small><br>
                <div class="col-xs-1 p-h-sm">
                    <a href="<?php echo base_url()."izin"?>"><h6>Kembali</h6></a>
                </div>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-user"></i> Perubahan Data</a></li>
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
                                            <div align="center" class="col-md-12">
                                                <br>
                                                    <?php
                                                    foreach ($data as $d) {
                                                        ?>
                                                        <form action="<?php echo base_url() . "karyawan/save" ?>"
                                                              method="POST" data-parsley-validate
                                                              class="form-horizontal form-label-left">

                                                            <div class="form-group">
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                                       for="Email">Email <span class="required">*</span>
                                                                </label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    <input type="text" name="email"
                                                                           value="<?php echo $d['email'] ?>"
                                                                           class="form-control col-md-7 col-xs-12"
                                                                           required
                                                                           oninvalid="this.setCustomValidity('Email Tidak Boleh Kosong')"
                                                                           oninput="setCustomValidity('')">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                                       for="Agama">Agama <span class="required">*</span>
                                                                </label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    <select name="agama" class="form-control">
                                                                        <option value="Islam" <?php if ($d['agama'] == "Islam") echo 'selected="selected"' ?>>
                                                                            Islam
                                                                        </option>
                                                                        <option value="Katolik" <?php if ($d['agama'] == "Katolik") echo 'selected="selected"' ?>>
                                                                            Katolik
                                                                        </option>
                                                                        <option value="Protestan" <?php if ($d['agama'] == "Protestan") echo 'selected="selected"' ?>>
                                                                            Protestan
                                                                        </option>
                                                                        <option value="Hindu" <?php if ($d['agama'] == "Hindu") echo 'selected="selected"' ?>>
                                                                            Hindu
                                                                        </option>
                                                                        <option value="Buddha" <?php if ($d['agama'] == "Buddha") echo 'selected="selected"' ?>>
                                                                            Buddha
                                                                        </option>
                                                                        <option value="Kong Hu Cu" <?php if ($d['agama'] == "Kong Hu Cu") echo 'selected="selected"' ?>>
                                                                            Kong Hu Cu
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="Golongan-Darah"
                                                                       class="control-label col-md-3 col-sm-3 col-xs-12">Golongan
                                                                    Darah<span class="required">*</label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    <input name="golongan_darah"
                                                                           value="<?php echo $d['golongan_darah'] ?>"
                                                                           type="text"
                                                                           class="form-control col-md-7 col-xs-12"
                                                                           type="text" name="middle-name" required
                                                                           oninvalid="this.setCustomValidity('Email Tidak Boleh Kosong')"
                                                                           oninput="setCustomValidity('')">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="Status-Perkawinan"
                                                                       class="control-label col-md-3 col-sm-3 col-xs-12">Status
                                                                    Perkawinan<span class="required">*</label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    <select name="status_perkawinan"
                                                                            class="form-control">
                                                                        <option value="Belum Menikah" <?php if ($d['status_perkawinan'] == "Belum Menikah") echo 'selected="selected"' ?>>
                                                                            Belum Menikah
                                                                        </option>
                                                                        <option value="Menikah" <?php if ($d['status_perkawinan'] == "Menikah") echo 'selected="selected"' ?>>
                                                                            Menikah
                                                                        </option>
                                                                        <option value="Tinggal Cerai" <?php if ($d['status_perkawinan'] == "Tinggal Cerai") echo 'selected="selected"' ?>>
                                                                            Tinggal Cerai
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nomor
                                                                    KTP <span class="required">*</span>
                                                                </label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    <input name="ktp"
                                                                           value="<?php echo $d['nomor_ktp'] ?>"
                                                                           type="text"
                                                                           class="date-picker form-control col-md-7 col-xs-12"
                                                                           maxlength="16" required
                                                                           oninvalid="this.setCustomValidity('Nomor KTP Tidak Boleh Kosong')"
                                                                           oninput="setCustomValidity('')">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nomor
                                                                    HP <span class="required">*</span>
                                                                </label>
                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                    <input name="hp"
                                                                           value="<?php echo $d['nomor_hp'] ?>"
                                                                           type="text"
                                                                           class="date-picker form-control col-md-7 col-xs-12"
                                                                           maxlength="12" required
                                                                           oninvalid="this.setCustomValidity('Nomor HP Tidak Boleh Kosong')"
                                                                           oninput="setCustomValidity('')">
                                                                </div>
                                                            </div>
                                                            <div class="ln_solid"></div>
                                                            <div class="form-group">
                                                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                                    <button name="submit" type="submit" class="btn btn-success">
                                                                        Submit
                                                                    </button>
                                                                    <button onclick="location.href='<?php echo base_url()."karyawan/profile" ?>';" class="btn btn-primary" type="button">
                                                                        Batal
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
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

<script type="text/javascript">
    $(function(){
        $("#datepicker").datepicker({
            minDate: 0,
            orientation: "top",
            autoclose:true,
            format: 'dd-mm-yyyy',
            onClose: function (selectedDate) {
                $("#txtStartDate").datepicker("option", "dateFormat", "dd-mm-yy", selectedDate);
            }
        })
    });
</script>
</body>
</html>x