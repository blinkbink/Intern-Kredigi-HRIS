<?php
$this->load->view('template/header');
?>

<!--tambahkan custom css disini-->


<link href="<?php echo base_url('assets/AdminLTE-2.3.11/plugins/jQueryUI/jquery-ui.min.css') ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/css/libnas.css') ?>" rel="stylesheet" type="text/css" />

<style type="text/css">
  .ui-datepicker {
    width: 100%;
    padding: .2em .2em 0;
}
.ui-datepicker td span, .ui-datepicker td a {
    display: block;
    padding: .8em;
    text-align: center;
    text-decoration: none;
    font-size: 1.2em;
}
.ui-datepicker th {
    padding: .8em;
    text-align: center;
    font-weight: bold;
    border: 0;
    font-size: 1.2em;
}
.ui-datepicker .ui-datepicker-title {
    margin: 0 2.3em;
    line-height: 1.8em;
    text-align: center;
    font-size: 1.5em
}
table.ui-datepicker-calendar tbody tr td.ui-datepicker-other-month {
    opacity: .35;
    filter: Alpha(Opacity=35);
    background-image: none;
}
.ui-datepicker .ui-datepicker-prev, .ui-datepicker .ui-datepicker-next {
    position: absolute;
    top: 0;
    width: 3em;
    height: 3em;
}
.ui-datepicker-next {
  display:block;
}

.ui-datepicker-prev {
  display:block;
}
#userMenuHome .statistikAkun{
          padding-bottom:20px;
        }
        .legendContainer{
          text-align:center;
          padding-top:20px;
        }
        #js-legend{
          display:inline-block;
          margin:auto !important;
        }

#adminMenu a,
#js-legend ul,
#userMenuHome a,
.p-l-sm {
    padding-left: 10px
}

.chart-legend li,
.table_display {
    display: table!important
}

.chart-legend li span,
.table_cell {
    display: table-cell
}
.chart-legend li .warna {
    margin-right: 5px;
}

#summaryAbsensi .warna, .chart-legend li .warna {
    width: 12px;
    height: 12px;
    display: inline-block;
}
.navWeekRange {
    width: 185px !important;
}
.center-block {
    display: block;
    margin-left: auto;
    margin-right: auto;
}
</style>

<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');

$hari_ini = "30-05-2017";
$hari_sebelumnya = DateTime::createFromFormat('d-m-Y', $hari_ini);
$hari_sebelumnya->modify('-1 week');
//$hari_sebelumnya->modify('-3 days');
//echo $hari_sebelumnya->format('d-m-Y');

$dateAwal = $this->uri->segment('3');
$dateAkhir = $this->uri->segment('4');
if(empty($dateAwal)){
        $dateAwal = $hari_sebelumnya->format('Y-m-d');
}
if(empty($dateAkhir)){
        $dateAkhir = DateTime::createFromFormat('d-m-Y', $hari_ini)->format('Y-m-d');
        //$dateAkhir = $hari_ini;
}

?>
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>150</h3>

              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>

              <p>Bounce Rate</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>44</h3>

              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>65</h3>

              <p>Unique Visitors</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
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
                                <span class="textXs"><span id="tglMulaiNav"><?=$dateAwal?></span> s.d. <span id="tglSelesaiNav"><?=$dateAkhir?></span></span>
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
              
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="position: relative; height: 300px;">
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

              <h3 class="box-title">Libur Nasional</h3>
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
 <?php
$this->load->view('template/footer')
 ?>

<!-- datepicker -->
<script src="<?php echo base_url('assets/AdminLTE-2.3.11/plugins/jQueryUI/jquery-ui.js') ?>"></script>
<script src="<?php echo base_url('assets/AdminLTE-2.3.11/plugins/chartjs/Chart.min.js') ?>"></script>
<script src="<?php echo base_url('assets/AdminLTE-2.3.11/plugins/chartjs/Chart.StackedBar.js') ?>"></script>
<script type="text/javascript">

  var barSakit = [1,3,4,3,1,0,0];
              var barIzin = [2,0,0,3,0,0,0];
              var barCuti = [0,0,1,2,1,0,2];
              var barUL = [0,0,0,0,0,0,0];
              var barMangkir = [0,0,0,0,0,5,0];

              function barChart(){

                $('#canvas').remove();
                $('#cnvsContainer').append('<canvas id="canvas"><canvas>');

                // Kostumisasi Bar Chart
                  var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
                  var barChartData = {
                    labels : ["S","S","R","K","J","S","M"],
                    datasets : [
                      { // Sakit
                        fillColor : "rgb(32,189,194)",
                        strokeColor : "rgb(32,189,194)",
                        data : barSakit
                      },
                      { // Izin
                        fillColor : "rgb(22,142,140)",
                        strokeColor : "rgb(22,142,140)",
                        data : barIzin
                      },
                      { // Cuti
                        fillColor : "rgb(186,180,174)",
                        strokeColor : "rgb(186,180,174)",
                        data : barCuti
                      },
                      { // Unpaid Leave
                        fillColor : "rgb(140,140,140)",
                        strokeColor : "rgb(140,140,140)",
                        data : barUL
                      },
                      { // Mangkir
                        fillColor : "rgb(92,85,84)",
                        strokeColor : "rgb(92,85,84)",
                        data : barMangkir
                      }
                    ]
                  }

                // Pendeklarasian Bar Chart
                  var ctx2 = document.getElementById("canvas").getContext("2d");
                  window.myBar = new Chart(ctx2).StackedBar(barChartData, {
                    stacked: true, // Agar tampilan bar chartnya bisa multi nilai di satu batang
                    responsive : true,
                    scaleShowLabels: false,
                    scaleShowGridLines : false,
                    multiTooltipTemplate: "<%= value %> Orang",
                    tooltipFontSize: 12
                    // scaleOverride: true, // Meniban / override nilai y-axis yang sudah ada
                   //    scaleSteps: 4, // Membagi nilai y-axis menjadi 4 step
                   //    scaleStepWidth: 25, // Range nilai dari tiap2 step y-axis tadi
                   //    scaleStartValue: 0 // Nilai awal dari y-axis
                  });
              }
function grafik(){
                  // Kostumisasi Pie Chart
                    var pieData = [
                      { // Belum Ada Status
                        value: 5,
                        color: "rgb(238,234,223)",
                        label: "Belum Ada Status",
                        presentase : 25                      },
                      { // Hadir Hari Kerja
                        value: 2,
                        color:"rgb(215,236,231)",
                        label: "Hadir Hari Kerja",
                        presentase : 10 // Presentase ini harus didefinisikan terlebiuh dahulu di file chartJs. Jadi ngerombak file asli dari chartJs. Itu satu2nya cara. Baru kemudian didefinisiin nilainya di sini.
                      },
                      { // Sakit
                        value: 3,
                        color: "rgb(32,189,194)",
                        label: "Sakit",
                        presentase : 15                      },
                      { // Izin
                        value: 1,
                        color: "rgb(22,142,140)",
                        label: "Izin",
                        presentase : 5                      },
                      { // Cuti
                        value: 3,
                        color: "rgb(186,180,174)",
                        label: "Cuti",
                        presentase : 15                      },
                      { // Unpaid Leave
                        value: 0,
                        color: "rgb(140,140,140)",
                        label: "Unpaid Leave",
                        presentase : 0                      },
                      { // Mangkir
                        value: 0,
                        color: "rgb(92,85,84)",
                        label: "Mangkir",
                        presentase : 0                      },
                      { // Bukan Hari Kerja
                        value: 0,
                        color: "rgb(246,136,46)",
                        label: "Libur",
                        presentase : 0                      },
                      { // Tugas Luar
                        value: 2,
                        color: "rgb(249,173,111)",
                        label: "Tugas Luar",
                        presentase : 10                      },
                      { // Hadir Bukan Hari Kerja
                        value: 0,
                        color: "rgb(252,213,181)",
                        label: "Hadir Bukan Hari Kerja",
                        presentase : 0                      }
                    ];



                  // Kostumisasi Bar Chart
                    var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
                    var barChartData = {
                      labels : ["S","S","R","K","J","S","M"],
                      datasets : [
                        { // Sakit
                          fillColor : "rgb(32,189,194)",
                          strokeColor : "rgb(32,189,194)",
                          data : barSakit
                        },
                        { // Izin
                          fillColor : "rgb(22,142,140)",
                          strokeColor : "rgb(22,142,140)",
                          data : barIzin
                        },
                        { // Cuti
                          fillColor : "rgb(186,180,174)",
                          strokeColor : "rgb(186,180,174)",
                          data : barCuti
                        },
                        { // Unpaid Leave
                          fillColor : "rgb(140,140,140)",
                          strokeColor : "rgb(140,140,140)",
                          data : barUL
                        },
                        { // Mangkir
                          fillColor : "rgb(92,85,84)",
                          strokeColor : "rgb(92,85,84)",
                          data : barMangkir
                        }
                      ]
                    }

                  window.onload = function(){

                    // Pendeklarasian Pie Chart
                      var ctx = document.getElementById("chart-area").getContext("2d");
                      window.myPie = new Chart(ctx).Pie(pieData,{
                        responsive:true,
                        segmentShowStroke : false, // Menghilangkan border antar warna2nya (segmen)
                        tooltipCaretSize: 0, // Menghilangkan panah pada tooltip
                        tooltipTemplate: "<%if (label){%><%}%><%= value %> Orang (<%= presentase %> %)", // Memodifikasi tooltip agar yang hanya tampil adalah value (nilai) saja. Tanpa label.
                        tooltipFontSize: 12
                      });

                     // $("#js-legend").html(myPie.generateLegend()); // Agar Legend muncul pada id js-legend dengan bersumber pada Pie Chart

                    // Pendeklarasian Bar Chart
                      var ctx2 = document.getElementById("canvas").getContext("2d");
                      window.myBar = new Chart(ctx2).StackedBar(barChartData, {
                        stacked: true, // Agar tampilan bar chartnya bisa multi nilai di satu batang
                        responsive : true,
                        scaleShowLabels: false,
                        scaleShowGridLines : false,
                        multiTooltipTemplate: "<%= value %> Orang",
                        tooltipFontSize: 12
                        // scaleOverride: true, // Meniban / override nilai y-axis yang sudah ada
                       //    scaleSteps: 4, // Membagi nilai y-axis menjadi 4 step
                       //    scaleStepWidth: 25, // Range nilai dari tiap2 step y-axis tadi
                       //    scaleStartValue: 0 // Nilai awal dari y-axis
                      });
                  }
                }
                grafik();
                

                       

         
$(function () {
    //  $("#calendar").datepicker();  
    var events = [ 
          { Title: "Tahun Baru Masehi", Date: new Date("2017/01/01") }, 
          { Title: "Cuti Bersama", Date: new Date("2017/01/02") }, 
          { Title: "Tahun Baru Imlek", Date: new Date("2017/01/28") }, 
          { Title: "Pilkada", Date: new Date("2017/02/15") }, 
          { Title: "Hari Raya Nyepi", Date: new Date("2017/03/28") }, 
          { Title: "Jum'at Agung", Date: new Date("2017/04/14") }, 
          { Title: "Isra Miraj", Date: new Date("2017/04/24") }, 
          { Title: "Hari Buruh", Date: new Date("2017/05/01") }, 
          { Title: "Hari Raya Waisak", Date: new Date("2017/05/11") }, 
          { Title: "Kenaikan Isa Almasih", Date: new Date("2017/05/25") }, 
          { Title: "Hari Lahir Pancasila", Date: new Date("2017/06/01") }, 
          { Title: "Idul Fitri", Date: new Date("2017/06/25") }, 
          { Title: "Idul Fitri", Date: new Date("2017/06/26") }, 
          { Title: "Cuti Bersama", Date: new Date("2017/06/27") }, 
          { Title: "Cuti Bersama", Date: new Date("2017/06/28") }, 
          { Title: "Hari Kemerdekaan RI", Date: new Date("2017/08/17") }, 
          { Title: "Idul Adha", Date: new Date("2017/09/01") }, 
          { Title: "Tahun Baru Hijriyah", Date: new Date("2017/09/21") }, 
          { Title: "Maulid Nabi", Date: new Date("2017/12/01") }, 
          { Title: "Hari Natal", Date: new Date("2017/12/25") }, 
          { Title: "Cuti Bersama", Date: new Date("2017/12/26") }
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
