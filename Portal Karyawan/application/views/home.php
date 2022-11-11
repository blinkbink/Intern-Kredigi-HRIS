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
    <link rel="stylesheet" href="<?php echo base_url(). "assets/css/kalender.css"?>">

    <link href="<?php echo base_url(). "assets/AdminLTE-2.3.11/dist/css/skins/_all-skins.min.css"?>" rel="stylesheet" type="text/css" />
</head>
<body class="sidebar-mini wysihtml5-supported skin-green-light">
<div class="wrapper">
    <header class="main-header">
        <?php
        $this->load->view('header');
        ?>
    </header>
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <!-- search form -->
            <?php
            $this->load->view('sidebar');
            ?>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- =============================================== -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Halaman Utama
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->

            <!-- /.row -->
            <div class="row">
                <div class="col-xs-12 p-h-sm">
                    <div class="box box-success ">
                        <div class="box-header with-border">
                            <h3 class="box-title" >Rekap Absensi                                                 </h3>
                        </div>
                        <div class="box-body p-med">
                            <div class="col-md-5 col-xs-12">
                                <p class="text-center m-b-sm">Data Ketidakhadiran Mingguan</p>
                                <div id="cnvsContainer">
                                    <canvas id="canvas" width="422" height="168" style="width: 338px; height: 135px;"></canvas>
                                </div>
                                <div class="navWeekRange center-block textWarmDark">
                                    <div class="maheOption pull-left moLeft">
                                        <i class="fa fa-caret-left fa-2x"></i>
                                    </div>
                                    <div class="rangeDescription text-center pull-left m-h-sm m-v-xs">
                                        <span class="textXs"><span id="tglMulaiNav">13 Mar 17</span> s.d. <span id="tglSelesaiNav">19 Mar 17</span></span>
                                    </div>
                                    <div class="maheOption pull-left moRight">
                                        <i class="fa fa-caret-right fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12" id="hadirHariIni">
                                <p class="text-center m-b-md">Data Kehadiran Hari Ini</p>
                                <div id="canvas-holder">
                                    <canvas id="chart-area" width="330" height="187" style="width: 264px; height: 150px;">
                                    </canvas></div>
                            </div>
                            <div class="col-md-3 col-xs-12 legendContainer">
                                <div id="js-legend" class="chart-legend"><ul class="pie-legend"><li><span class="warna" style="background-color:rgb(238,234,223)"></span><span class="deskripsi">Belum Ada Status</span></li><li><span class="warna" style="background-color:rgb(215,236,231)"></span><span class="deskripsi">Hadir Hari Kerja</span></li><li><span class="warna" style="background-color:rgb(32,189,194)"></span><span class="deskripsi">Sakit</span></li><li><span class="warna" style="background-color:rgb(22,142,140)"></span><span class="deskripsi">Izin</span></li><li><span class="warna" style="background-color:rgb(186,180,174)"></span><span class="deskripsi">Cuti</span></li><li><span class="warna" style="background-color:rgb(140,140,140)"></span><span class="deskripsi">Unpaid Leave</span></li><li><span class="warna" style="background-color:rgb(92,85,84)"></span><span class="deskripsi">Mangkir</span></li><li><span class="warna" style="background-color:rgb(246,136,46)"></span><span class="deskripsi">Libur</span></li><li><span class="warna" style="background-color:rgb(249,173,111)"></span><span class="deskripsi">Tugas Luar</span></li><li><span class="warna" style="background-color:rgb(252,213,181)"></span><span class="deskripsi">Hadir Bukan Hari Kerja</span></li></ul></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-7 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->

                    <div class="box box-warning ">
                        <div class="box-header">
                        <!-- /.box-header -->
                        <div class="box-body" style="position: relative; height: 100px;">
                            <!--The calendar -->
                        </div>
                        <!-- /.box-body -->
                    </div>
                </section>
                <!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <section class="col-lg-5 connectedSortable">
                    <!-- Calendar -->
                    <div class="box box-primary ">
                        <div class="box-header">
                            <i class="fa fa-calendar"></i>

                            <h3 class="box-title">Kalender</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <!--The calendar -->
                            <div id="calendar" style="width: 100%"></div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                </section>
                <!-- right col -->
            </div>
            <!-- /.row (main row) -->

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

<script>
    $(function () {
        //  $("#calendar").datepicker();
        var events = [
            <?php
            foreach ($kalender as $event)
            {
            ?>
            { Title: "<?php echo $event['Keterangan'] ?>", Date: new Date("<?php echo date("Y/m/d", strtotime($event['tanggalLibur']))?>")},
            <?php
            }
            ?>
        ];
        $('#calendar').datepicker({
            beforeShowDay: function( dateText ) {
                var date,
                    selectedDate = new Date(dateText),
                    i = 0,
                    event = null;

                while (i < events.length && !event) {
                    date = events[i].Date;
                    if (selectedDate.valueOf() === date.valueOf())
                        event = events[i];
                    i++;
                }
                if (event)
                    return [true, 'day-event', event.Title];
                else
                    return [false, 'day-normal', null];
            },
            inline: true,
            showOtherMonths: true,
            dayNamesMin: ['M','S','S','R','K','J','S'],
            stepMonths: 1,
            monthNames: ['JANUARI', 'FEBRUARI', 'MARET', 'APRIL', 'MEI', 'JUNI', 'JULI', 'AGUSTUS', 'SEPTEMBER', 'OKTOBER', 'NOVEMBER', 'DESEMBER']
        });

    });
</script>

</body>
</html>