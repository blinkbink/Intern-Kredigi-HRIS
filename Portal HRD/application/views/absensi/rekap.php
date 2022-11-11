<?php 
$this->load->view('template/header');
?>
<!--tambahkan custom css disini-->
<link rel="stylesheet" href="<?=base_url();?>/assets/AdminLTE-2.3.11/plugins/datepicker/datepicker3.css">
<!-- <link type="text/css" rel="stylesheet" href="/assets/js/bootstrap-datepicker-master/dist/css/bootstrap-datepicker.min.css"> -->

<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');

//$dateAwal = $this->uri->segment('3');
//$dateAkhir = $this->uri->segment('4');

$dateAwal = $this->input->post('dateAwal');
$dateAkhir = $this->input->post('dateAkhir');

$hari_ini=(!empty($hari_ini)) ? $hari_ini :  date('d-m-Y');
//$hari_ini=(!empty($dateAkhir)) ? $hari_ini :  date('d-m-Y'); $dateAkhir = $hari_ini;


//$hari_ini = "30-05-2017";
$hari_sebelumnya = DateTime::createFromFormat('d-m-Y', $hari_ini);
$hari_sebelumnya->modify('-1 week');
//$hari_sebelumnya->modify('-3 days');
//echo $hari_sebelumnya->format('d-m-Y');

//$dateAwal = $this->uri->segment('3');
//$dateAkhir = $this->uri->segment('4');
//echo $dateAwal."/".$dateAkhir;
if(empty($dateAwal)){
	//$dateAwal = $this->uri->segment('3');
	$dateAwal = $hari_sebelumnya->format('d-m-Y');
}else {
	//$dateAwal = $this->uri->segment('3');
	$dateAwal = $_POST['dateAwal'];
}
if(empty($dateAkhir)){
	//$dateAkhir = $this->uri->segment('4');
	//$dateAkhir = DateTime::createFromFormat('d-m-Y', $hari_ini)->format('Y-m-d');
	$dateAkhir = $hari_ini;
}else {
	//$dateAkhir = $this->uri->segment('4');
	$dateAkhir = $_POST['dateAkhir'];
}
//echo "|| ".$dateAwal."dan".$dateAkhir;
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Rekap Absensi
        <small>berisi data lengkap absensi para karyawan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="#">Absensi</a></li>
        <li class="active">Rekap Absensi</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Rekap Absensi</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
           <div class="panel-body single_panel p-t-3">
                        <div class="row m-b-1">
                          <div class="col-xs-12">
                            <div class="pull-right">
                              <button onclick="window.location.href='<?=site_url('absensi/ekspor_excel/'.$dateAwal.'/'.$dateAkhir)?>'" class="btn btn-warning"><i class="fa fa-download"></i> Download Excel</button>
                              <!-- <button class="btn btn-warning"><i class="fa fa-print"></i></button> -->
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-xs-12 advanceSearch p-t-1 m-b-1">
                            <!-- <form action="<?=site_url('absensi/rekap/'.$dateAwal.'/'.$dateAkhir)?>" method="post" class="form-horizontal">-->
			    <form action="<?=site_url('absensi/rekap/?dateAwal='.$dateAwal.'&dateAkhir='.$dateAkhir)?>" method="post" class="form-horizontal">
                              <div class="row">
                                <div class="col-xs-12">
                                  <div class="row">
                                    <!-- <div class="col-md-4">
                                      <div class="form-group m-b-1">
                                        <label for="" class="control-label col-md-4">Search</label>
                                        <div class="col-md-8">
                                          <input type="text" name="keyword" class="form-control" placeholder="Cari Personalia" value="">
                                        </div>
                                      </div> 
                                    </div> -->
                                    <div class="col-md-4">
                                      <div class="form-group m-b-1">
                                         <label class="control-label col-md-4">Dari </label>
                                        <div class="col-md-8">
                                          <div class="input-group date datepicker" data-date="" data-date-format="dd-mm-yyyy">
                                            <input type="text" name="dateAwal" class="form-control" placeholder="" aria-describedby="basic-addon2" value="<?=$dateAwal?>" readonly="">
                                            <span class="input-group-addon add-on" id="basic-addon2"><i class="fa fa-calendar"></i></span>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group m-b-1">
                                        <label class="control-label col-md-4">Sampai </label>
                                        <div class="col-md-8">
                                          <div class="input-group date datepicker" data-date="" data-date-format="dd-mm-yyyy">
                                            <input type="text" name="dateAkhir" class="form-control" placeholder="" aria-describedby="basic-addon2" value="<?=$dateAkhir?>" readonly="">
                                            <span class="input-group-addon add-on" id="basic-addon2"><i class="fa fa-calendar"></i></span>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group m-b-1">
                                        <div class="col-md-7">
                                          <button type="submit" class="btn btn-sm btn-warning">Tampilkan</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                
     <!--   <form method="post" action="/pp" class="form-horizontal">
            <div class="row paginationInfo m-b-sm">
                <label class="col-md-4 col-xs-12 control-label text-left-i">
                    Menampilkan 1 - 2 dari total 2              </label>
                <div class="col-md-4 text-center p-t-xs">
                                    </div>
                <div class="col-md-4">
                    <div class="row">
                        <label class="col-md-7  col-xs-6 control-label">Data Per Halaman</label>
                        <div class="col-md-5 col-xs-6 ">
                            <select name="per_page" id="per_page" class="form-control" onchange="this.form.submit()">
                                <option value="5">5</option>
                                <option value="10" selected="">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </form> -->
        <div style="height: 5px;"></div>
    
                                    <!-- <div class="table-responsive"> -->
                                    <table class="table tabel-sortir footableTable footable footable-1 breakpoint-lg" style="display: table;" id="myTable">
                                        <thead>
                                            <tr class="footable-header">       
                                           <th data-type="html" width="200" style="display: table-cell;">
                                                    Nama Personalia 
                                                </th><th data-breakpoints="xs sm" style="display: table-cell;">
                                                    Status Data 
                                                </th><th data-breakpoints="xs sm" class="text-center" style="display: table-cell;">
                                                    Total Jumlah Hari 
                                                </th><th data-breakpoints="xs sm" class="text-center" style="display: table-cell;">
                                                    Total Jumlah Hari Kerja
                                                </th><th data-breakpoints="xs sm" class="text-center" style="display: table-cell;">
                                                    Total Jumlah Hari Sabtu
                                                </th><th data-breakpoints="xs sm" class="text-center" style="display: table-cell;">
                                                    Hadir Hari Kerja                                                </th><th data-breakpoints="xs sm" class="text-center" style="display: table-cell;">
                                                    Hadir Hari Sabtu                                                </th><th data-breakpoints="xs sm" class="text-center" style="display: table-cell;">
                                                    Tugas Luar 
                                                </th><th data-breakpoints="xs sm" class="text-center" style="display: table-cell;">
                                                   Sakit 
                                               </th><th data-breakpoints="xs sm" class="text-center" style="display: table-cell;">
                                                 Izin 
                                               </th><th data-breakpoints="xs sm" class="text-center" style="display: table-cell;">
                                                   Cuti 
                                               </th><th data-breakpoints="xs sm" class="text-center" style="display: table-cell;">
                                                  Mangkir 
                                               </th><th data-breakpoints="xs sm" class="text-center" style="display: table-cell;">
                                                  Terlambat 
                                               </th><th data-breakpoints="all" style="display: none;">
                                                  Jumlah Jam Kerja 
                                               </th><th data-breakpoints="all" style="display: none;">
                                                  Jam Aktual Lembur 
                                               </th><th data-breakpoints="all" style="display: none;">
                                                  Jam Lembur Konversi 
                                               </th><th data-type="html" style="display: table-cell;">
                                                 Aksi 
                                               </th></tr>
                                </thead>
                                <tbody>
                                      
<?php
//foreach($absensi as $k){
$dateAwal = DateTime::createFromFormat('d-m-Y', $dateAwal)->format('Y-m-d');
$dateAkhir = DateTime::createFromFormat('d-m-Y', $dateAkhir)->format('Y-m-d');
foreach($karyawan as $k){
//var_dump($k);
$kode_absensi = $k->kode_absensi;
//$absensi = $this->Absensi_model->getListAbsensi($kode_absensi, $dateAwal, $dateAkhir);
$absensi = $this->Absensi_model->getDataAbsensiRekap($kode_absensi, $dateAwal, $dateAkhir);
//var_dump($absensi);
foreach($absensi as $a){
?>
                                                                                                    
                                             <tr>                               
                                                 <!-- <td class="text-center"></td> -->    
                                                    <td style="display: table-cell;"><span class="footable-toggle fooicon fooicon-plus"></span>
                                                            <div class="media">
                                                                <div class="media-left">
                                                                    <img src="/static/images/t_personnel_boy.png" alt="" class="fotoAbsensi img-rounded">
                                                                </div>
                                                                <div class="media-body media-middle"><?=$k->nama_lengkap?></div>
                                                            </div>
                                                        </td><td style="display: table-cell;">Belum Lengkap</td>
							<td class="text-center" style="display: table-cell;"><?=$a['totalHari']?></td>
                                                        <td class="text-center" style="display: table-cell;"><?=$a['totalHariKerja']?></td>
                                                        <td class="text-center" style="display: table-cell;"><?=$a['totalHariSabtu']?></td>
							<td class="text-center" style="display: table-cell;"><?=$a['totalAbsensi']?></td>
                                                        <td class="text-center" style="display: table-cell;"><?=$a['kerjaSabtu']?></td>
							<td class="text-center" style="display: table-cell;"><?=$a['totalTugas']?></td>
							<td class="text-center" style="display: table-cell;"><?=$a['totalSakit']?></td>
							<td class="text-center" style="display: table-cell;"><?=$a['totalIzin']?></td>
							<td class="text-center" style="display: table-cell;"><?=$a['totalCuti']?></td>
							<td class="text-center" style="display: table-cell;"><?=$a['totalMangkir']?></td>
							<td class="text-center" style="display: table-cell;"><?=$a['totalTelat']?></td>
							<td style="display: none;">12</td>
							<td style="display: none;">7</td>
							<td style="display: none;">10.5</td>
							<td class="tableAction" style="display: table-cell;">
                                                            <div class="link-group">
                                                                <a href="<?=site_url('absensi/personal/'.$k->karyawan_ID)?>">
                                                                    <i class="fa fa-file" data-toggle="tooltip" data-placement="bottom" title="" role="presentation" data-original-title="Lihat "></i>
                                                                </a>
                                                                 <a href="/absensi/unduhPDF/2674/2017-03-15/2017-03-22">
                                                                  <i class="fa fa-file-pdf-o m-r-xs" data-toggle="tooltip" data-placement="bottom" title="" role="presentation" data-original-title="Unduh"></i>
                                                              </a>
                                                            </div>
                                                        </td>
						</tr>
                                                        
                                                        
<?php }} ?>                                                      
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        <!-- <td class="text-center"></td> --></tbody>
                           </table>
                            <!-- </div> -->
                                                      </div>
                        </div>
                      </div>
        </div><!-- /.box-body -->
        <div class="box-footer">
            
        </div><!-- /.box-footer-->
    </div><!-- /.box -->

</section><!-- /.content -->

<?php 
$this->load->view('template/footer');
?>
<!--tambahkan custom js disini-->
<!-- <script src="/assets/js/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.js" type="text/javascript"></script> -->
<script src="<?=base_url();?>/assets/AdminLTE-2.3.11/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?=base_url('assets/AdminLTE-2.3.11/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?=base_url('assets/AdminLTE-2.3.11/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
<script type="text/javascript">
$(function () {
  $('.datepicker').datepicker({
    autoclose: true,
    format: 'dd-mm-yyyy'
  });
});

$(document).ready(function(){
    $('#myTable').DataTable();
});
</script>
<!-- <script>
      $(document).ready(function(){
        $('.datepicker').datepicker({
          autoclose: true,
          orientation: "top"
        });
      });
</script> -->
</body>
</html>
