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
                Form Ubah Kata Sandi
                <small></small><br>
                <div class="col-xs-1 p-h-sm">
                    <a href="<?php echo base_url()."karyawan"?>"><h6>Kembali</h6></a>
                </div>
            </h1>
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
                                                    foreach($data as $d) {
                                                        ?>

                                                            <div class="col-md-12 col-sm-6 col-xs-12">
                                                                <div class="x_panel">
                                                                    <div class="x_title">
                                                                        <div align="center" class="col-md-3">
                                                                            <img src="<?php echo base_url() . "image/karyawan/" . $d['profil_picture'] . ".jpg" ?>"
                                                                                 class="img-thumbnail"
                                                                                 width="150" height="216">
                                                                            <p style="color: black; font-size: 15px"><?php echo $d['nama_lengkap'] ?></p>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <table class="table">
                                                                                <tbody>
                                                                                <tr>
                                                                                    <th>Pekerjaan</th>
                                                                                    <td><?php echo $d['pekerjaan'] ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Bagian</th>
                                                                                    <td><?php echo $d['bagian'] ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Jenis Kelamin</th>
                                                                                    <td><?php echo $d['jenis_kelamin'] ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Email</th>
                                                                                    <td><?php echo $d['email_karyawan'] ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Agama</th>
                                                                                    <td><?php echo $d['opt_agama'] ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Golongan Darah</th>
                                                                                    <td><?php echo $d['golongan_darah'] ?></td>
                                                                                </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>

                                                                        <div class="col-md-5">
                                                                            <table class="table">
                                                                                <tbody>
                                                                                <tr>
                                                                                    <th>Status Perkawinan</th>
                                                                                    <td><?php echo $d['status_perkawinan'] ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>No. KTP</th>
                                                                                    <td><?php echo $d['nomor_ktp'] ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>No. HP</th>
                                                                                    <td><?php echo $d['hp_karyawan'] ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Tanggal Mulai Kerja</th>
                                                                                    <td>
                                                                                        <?php
                                                                                        $convert = date( 'j F o', strtotime( $d['mulai_kerja'] ) );
                                                                                        echo $convert
                                                                                        ?>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Pendidikan Terakhir</th>
                                                                                    <td><?php echo $d['pend_terakhir'] ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Institusi Pendidikan</th>
                                                                                    <td><?php echo $d['institusi_pend'] ?></td>
                                                                                </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <div class="clearfix"></div>

                                                                    </div>
                                                                    <?php
                                                                    foreach ($perubahan as $p)
                                                                        if ($p['status'] == "Menunggu")
                                                                        {
                                                                            ?>
                                                                            <button class="btn display-block font-normal btn-warning" disabled>Perubahan Data Sedang Di Proses</button>
                                                                            <?php
                                                                        }
                                                                    if($p['status'] == "Di Setujui" || $p['status'] == "Tidak Di Setujui" || $p['status'] == "Di Batalkan" || $p['status'] == null)
                                                                    {
                                                                        ?>
                                                                        <button onclick="location.href='<?php echo base_url(). "karyawan/edit"?>'" class="btn display-block font-normal btn-warning">Pengajuan Perubahan Data</button>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>


                                                            <div class="clearfix"></div>

                                                            <div class="col-md-10">
                                                                <div class="x_panel">
                                                                    <div class="x_title">
                                                                        <h3 align="left">Informasi Kontak</h3>
                                                                    </div>
                                                                    <div class="x_content">

                                                                        <table class="table">
                                                                            <tbody>
                                                                            <tr>
                                                                                <th>No. HP</th>
                                                                                <td><?php echo $d['hp_karyawan'] ?></td>
                                                                            </tr>

                                                                            <tr>
                                                                                <th>Email</th>
                                                                                <td><?php echo $d['email_karyawan'] ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Alamat Rumah</th>
                                                                                <td><?php echo $d['rumah_karyawan'] ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Kota</th>
                                                                                <td><?php echo $d['kota_karyawan'] ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Kecataman</th>
                                                                                <td><?php echo $d['kecamatan_karyawan'] ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Provinsi</th>
                                                                                <td><?php echo $d['provinsi_karyawan'] ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Kode Pos</th>
                                                                                <td><?php echo $d['kodepos_karyawan'] ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Nama Kontak Darurat</th>
                                                                                <td><?php echo $d['nama_kontak_darurat'] ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Status Hubungan Kontak</th>
                                                                                <td><?php echo $d['status_hubungan'] ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>No. Kontak Darurat</th>
                                                                                <td><?php echo $d['kontak_darurat'] ?></td>
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="clearfix"></div>

                                                            <div class="col-md-10">
                                                                <div class="x_panel">
                                                                    <div class="x_title">
                                                                        <h3 align="left">Lampiran</h3>
                                                                    </div>
                                                                    <div class="x_content">

                                                                        <table class="table table-bordered">
                                                                            <tr>
                                                                                <th>Curriculum Vitae</th>
                                                                                <td >
                                                                                    <?php
                                                                                    if($d['cv'] != "")
                                                                                    {
                                                                                        ?>
                                                                                        <a href="<?php echo base_url()."lampiran/".$d['cv'].".pdf"?>"><img src="<?php echo base_url()."assets/icon/pdf.png"?>" width="30"></a>
                                                                                        <?php
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                        echo "<i>File Ini Tidak Tersedia</i>";
                                                                                    }
                                                                                    ?>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Transkrip Nilai</th>
                                                                                <td >
                                                                                    <?php
                                                                                    if($d['transkrip_nilai'] != "")
                                                                                    {
                                                                                        ?>
                                                                                        <a href="<?php echo base_url()."lampiran/".$d['transkrip_nilai'].".pdf"?>"><img src="<?php echo base_url()."assets/icon/pdf.png"?>" width="30"></a>
                                                                                        <?php
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                        echo "<i>File Ini Tidak Tersedia</i>";
                                                                                    }
                                                                                    ?>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>KTP</th>
                                                                                <td >
                                                                                    <?php
                                                                                    if($d['KTP'] != "")
                                                                                    {
                                                                                        ?>
                                                                                        <a href="<?php echo base_url()."lampiran/".$d['KTP'].".jpg"?>"><img src="<?php echo base_url()."assets/icon/jpg.png"?>" width="30"></a>
                                                                                        <?php
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                        echo "<i>File Ini Tidak Tersedia</i>";
                                                                                    }
                                                                                    ?>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>File-file Lain</th>
                                                                                <td >
                                                                                    <?php
                                                                                    if($d['lainnya'] != "")
                                                                                    {
                                                                                        ?>
                                                                                        <a href="<?php echo base_url()."lampiran/".$d['lainnya'].".pdf"?>"><img src="<?php echo base_url()."assets/icon/jpg.png"?>" width="30"></a>
                                                                                        <?php
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                        echo "<i>File Ini Tidak Tersedia</i>";
                                                                                    }
                                                                                    ?>
                                                                                </td>
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
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
