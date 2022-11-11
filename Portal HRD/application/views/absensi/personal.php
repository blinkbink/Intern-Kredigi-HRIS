<?php 
get_template('header');
?>
<!--tambahkan custom css disini-->
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?=base_url();?>/assets/AdminLTE-2.3.11/plugins/datepicker/datepicker3.css">
<?php
get_template('topbar');
get_template('sidebar');

//$hari_ini=(!empty($hari_ini)) ? $hari_ini :  date('Y-m-d');
$hari_ini = "30-05-2017";
$hari_sebelumnya = DateTime::createFromFormat('d-m-Y', $hari_ini);
$hari_sebelumnya->modify('-1 month');
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
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Data Karyawan
        <small>Kehadiran</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Karyawan</a></li>
        <li class="active">Kehadiran</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
<div class="box">
        <?php get_template('header_detail')?>
    <div class="row">
    <div class="col-md-12">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Kehadiran</h3>
        </div>
        <div class="box-body">
            <div class="panel-body single_panel pd-t-1">
          <div class="col-xs-12">
            <div class="row">
              <form class="form-horizontal" method="post" action="<?=site_url('absensi/personal/'.$karyawan->karyawan_ID)?>">
                <div class="row">
                  <div class="col-xs-12 m-b">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group m-b-1">
                            <label class="control-label col-md-4">Dari</label>
                          <div class="col-md-8">
                              <div data-date-format="yyyy-mm-dd" data-date="" class="input-group date datepicker">
                              <input type="text" readonly="" value="" aria-describedby="basic-addon2" placeholder="" class="form-control" name="start_date">
                              <span id="basic-addon2" class="input-group-addon add-on"><i class="fa fa-calendar"></i></span>
                              </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group m-b-1">
                          <label class="control-label col-md-4">Sampai</label>
                          <div class="col-md-8">
                              <div data-date-format="yyyy-mm-dd" data-date="" class="input-group date datepicker">
                              <input type="text" readonly="" value="" aria-describedby="basic-addon2" placeholder="" class="form-control" name="end_date">
                              <span id="basic-addon2" class="input-group-addon add-on"><i class="fa fa-calendar"></i></span>
                              </div>
                          </div>
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group m-b-1">
                          <div class="col-md-9 col-md-offset-3">
                            <input type="hidden" value="2674" name="idk">
                              <button class="btn btn-sm btn-warning pull-left" type="submit">Tampilkan</button><p>&nbsp;&nbsp;</p>
                              <!-- <button class="btn btn-sm btn-warning pull-left"> 
                                 <a class="btn btn-sm btn-warning pull-left" href="#" style="color:black;">
                                <i class="fa fa-file-pdf-o m-r-xs" data-toggle="tooltip" data-placement="bottom" title="" role="presentation" data-original-title="Detail pengajuan cuti ini"></i>
                                Unduh PDF
                              </a>
                            </button> -->
                          </div>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="row m-b-md" id="summaryAbsensi">
            <div class="col-xs-12">
              <div class="row">
                <div class="col-xs-12">
                  <h4 class="mg-b-1">
                    Ringkasan Absensi  1 Maret 2017 - 31 Maret 2017                 </h4>
                </div>
              </div>
              
             <div class="row" id="t4_summary">
                                            <div class="col-md-6">
                                                <table class="table table-hover table-striped m-b-n-md">
                                                    <tbody>
                                                        <tr>
                                                            <td><span class="colorPresence1 m-r-sm warna"></span> Belum Ada Status </td>
                                                              <td width="10%">0</td>
                                                            <td width="10%">0%</td>
                                                        </tr>
                                                        <tr>
                                                            <td><span class="colorPresence2 m-r-sm warna"></span>
                                                            Hadir Hari Kerja 
                                                            </td>
                                                            <td class="jumlahPresentase">0</td>
                                                            <td class="presentase">0%</td>
                                                        </tr>
                                                        <tr>
                                                            <td><span class="colorPresence3 m-r-sm warna"></span>
                                                            Sakit 
                                                            </td>
                                                            <td>0</td>
                                                            <td class="presentase">0%</td>
                                                        </tr>
                                                        <tr>
                                                            <td><span class="colorPresence4 m-r-sm warna"></span>
                                                            Izin 
                                                            </td>
                                                            <td>0</td>
                                                            <td class="presentase">0%</td>
                                                        </tr>
                                                        <tr>
                                                            <td><span class="colorPresence5 m-r-sm warna"></span>
                                                            Cuti 
                                                            </td>
                                                            <td>0</td>
                                                            <td class="presentase">0%</td>
                                                        </tr>
                                                        <tr>
                                                            <td><span class="colorPresence6 m-r-sm warna"></span> Unpaid Leave</td>
                                                            <td>0</td>
                                                            <td class="presentase">0%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-6">
                                                <table class="table table-hover table-striped ">
                                                    <tbody>
                                                        <tr>
                                                            <td><span class="colorPresence7 m-r-sm warna"></span> 
                                                            Mangkir 
                                                            </td>
                                                            <td width="10%">0</td>
                                                            <td width="10%">0%</td>
                                                        </tr>
                                                        <tr>
                                                            <td><span class="colorPresence8 m-r-sm warna"></span>
                                                            Bukan Hari Kerja 
                                                            </td>
                                                            <td>0</td>
                                                            <td class="presentase">0%</td>
                                                        </tr>
                                                        <tr>
                                                            <td><span class="colorPresence9 m-r-sm warna"></span>
                                                            Tugas Luar 
                                                            </td>
                                                            <td>0</td>
                                                            <td class="presentase">0%</td>
                                                        </tr>
                                                        <tr>
                                                            <td><span class="colorPresence10 m-r-sm warna"></span> 
                                                            Hadir Bukan Hari Kerja 
                                                            </td>
                                                            <td>0</td>
                                                            <td class="presentase">0%</td> 
                                                        </tr>
                                                        <tr>
                                                            <td><span class="colorPresence11 m-r-sm warna"></span> 
                                                            Terlambat 
                                                            </td>
                                                            <td>0</td>
                                                            <td class="presentase">0%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                          </div>
          </div>
          <div class="row" id="summaryAbsensi">
            <div class="col-xs-12 table-responsive">
              <table class="table table-hover table-striped">
                <thead>
                <tr class="success">
                  <th class="text-right" style="min-width: 200px; display: table-cell;">
                      Tanggal 
                    </th><th class="text-center" style="min-width: 150px; display: table-cell;">
                      Status Kehadiran 
                    </th><th data-breakpoints="xs sm" class="text-center" style="display: table-cell;">
                      Jam Masuk 
                    </th><th data-breakpoints="xs sm" class="text-center" style="display: table-cell;">
                      Jam Keluar 
                    </th><th data-breakpoints="xs sm" class="text-center" style="display: table-cell;">
                      Lama Lembur 
                    </th><th data-breakpoints="xs sm" class="text-center" style="display: table-cell;">
                      Tipe Lembur 
                    </th><th data-breakpoints="xs sm" class="text-center" style="display: table-cell;">
                      Terlambat 
                    </th><th data-breakpoints="xs sm" class="text-center" style="display: table-cell;">
                      Jam Aktual Lembur 
                    </th><th data-breakpoints="xs sm" class="text-center" style="display: table-cell;">
                      Jam Lembur Konversi 
                    </th><th data-breakpoints="xs sm" class="text-center" style="display: table-cell;">
                      Jumlah Jam Kerja 
                    </th></tr>
                </thead>
                <tbody>
                <?php 
                $jumHari = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
                for ($i=1; $i < $jumHari; $i++) { ?>
                   <tr>
                  <td class="text-left" style="display: table-cell;">Rabu, <?=tgl_indo(date('Y-m-d',strtotime(date('Y').'-'.date('m').'-'.$i)))?></td><td class="text-left" style="display: table-cell;">
                                                                  Belum Ada Status                    </td><td class="text-center" style="display: table-cell;">-</td><td class="text-center" style="display: table-cell;">-</td><td class="text-center" style="display: table-cell;">-</td><td class="text-center" style="display: table-cell;">-</td><td class="text-center" style="display: table-cell;">
                    Tidak                   </td><td class="text-center" style="display: table-cell;">-</td><td class="text-center" style="display: table-cell;">-</td><td class="text-center" style="display: table-cell;">-</td></tr><tr>
                 
                 </tr>
                <?php } ?>

                 

                 </tbody>
              </table>
            </div>
          </div>








        </div>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div>

</div>
 </div><!-- /.box-body -->
    </div><!-- /.box -->
</div>
</div>

</section><!-- /.content -->

<?php 
get_template('footer');
?>
<!--tambahkan custom js disini-->
<script src="<?=base_url();?>/assets/AdminLTE-2.3.11/plugins/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript">
  
   $(function () {
 $('.datepicker').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy'
    });
});
  $("#berhentikan").click(function(){
    $("#myModal").modal("show");
  });
</script>>

</body>
</html>
