<?php 
$this->load->view('template/header');
?>
<!--tambahkan custom css disini-->
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?=base_url();?>/assets/AdminLTE-2.3.11/plugins/datepicker/datepicker3.css">
<link rel="stylesheet" href="<?=base_url('assets/AdminLTE-2.3.11/plugins/timepicker/bootstrap-timepicker.min.css') ?>">
<style>
    .fileUploadWrapper {
    position: relative;
    background: 0 0!important;
    width: 100%
}

.fileUploadWrapper:hover:before {
    background: #23C7C6!important;
    color: #F3F0E7!important
}

.fileUploadWrapper:after {
    content: attr(data-text);
    position: absolute;
    top: 0;
    right: 0;
    border: 1px solid #DEDEDE;
    padding: 0 12px;
    display: block;
    width: 100%;
    pointer-events: none;
    z-index: 20;
    height: 34px;
    line-height: 34px;
    font-size: 13px;
    color: #555;
}

.fileUploadWrapper:before {
    content: 'Upload';
    position: absolute;
    top: 0;
    right: 0;
    display: inline-block;
    height: 34px;
    background: #EBE4D4;
    color: #484848;
    font-weight: 500;
    z-index: 25;
    line-height: 34px;
    padding: 0 15px;
    pointer-events: none
}

.fileUploadWrapper input {
    opacity: 0;
    position: relative;
    z-index: 99;
    height: 34px;
    margin: 0;
    padding: 0;
    display: block;
    cursor: pointer;
    width: 100%
}

.daftarTanggal {
    margin-bottom: 32px;
    margin-right: 5px;
    margin-left: 5px;
}

.daftarTanggal .col-md-1,
.daftarTanggal .col-xs-1 {
    padding: 6px 0;
    cursor: pointer
}

.daftarTanggal .tanggal .col-xs-12 {
    padding: 18px 0;
    cursor: pointer
}

.daftarTanggal .tanggal .col-xs-1,
.daftarTanggal .tanggal .col-xs-12 {
    border: 1px solid #fff;
    border-right: none;
    height: 60px;
    background: #EBE4D4;
    line-height: 21px
}

.daftarTanggal .tanggal .col-xs-12,
.daftarTanggal .tanggal .col-xs-1:first-child {
    border-left: none
}

.navigasiTanggal {
    background: #EBE4D4;
    color: #000;
    font-size: 16px!important;
    border: 1px solid #fff;
    padding: 5px 0!important;
    height: 60px;
    line-height: 45px
}

.daftarTanggal .tanggal .col-xs-1:active,
.navigasiTanggal:active,
.today {
    box-shadow: 0 3px 5px rgba(0, 0, 0, .125) inset;
    background: #23C7C6;
    color: #fff
}

.daftarTanggal .tanggal .col-xs-1:hover,.daftarTanggal .tanggal .col-xs-12:hover,
.navigasiTanggal:hover {
    background: #23C7C6;
    color: #fff
}

.navigasiTanggal.disabled {
    background: #f0f0f0!important;
    cursor: default
}
.today {
    background: #1AC6C4 !important;
    color: white;
}
@media (max-width:440px){
.tabelAbsensiContainer{padding-bottom:250px}.daftarTanggal{margin-bottom:32px}.daftarTanggal .col-md-1,.daftarTanggal .col-xs-1{padding:6px 0;cursor:pointer}.daftarTanggal .tanggal .col-xs-1{border:1px solid #fff;border-right:none;height:60px;background:#EBE4D4;line-height:21px}.daftarTanggal .tanggal .col-xs-1:first-child{border-left:none}.navigasiTanggal{background:#EBE4D4;color:#000;font-size:16px!important;border:1px solid #fff;padding:5px 0!important;height:60px;line-height:45px}.daftarTanggal .tanggal .col-xs-1:active,.navigasiTanggal:active,.today{box-shadow:0 3px 5px rgba(0,0,0,.125) inset;background:#23C7C6;color:#fff}.daftarTanggal .tanggal .col-xs-1:hover,.navigasiTanggal:hover{background:#23C7C6;color:#fff}.navigasiTanggal.disabled{background:#f0f0f0!important;cursor:default}
}
@media screen and (min-width: 992px){
.daftarTanggal .tanggal .col-xs-1 {
    /* width: 9.09090909091% !important; */
    width: 11.10990909091% !important;
}
}
#summaryAbsensi .warna, .chart-legend li .warna {
    width: 12px;
    height: 12px;
    display: inline-block;
}
</style>
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');

$hari_ini=(!empty($hari_ini)) ? $hari_ini :  date('d/m/Y');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Absensi
        <small>Catatan Harian</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Absensi</a></li>
        <li class="active">Catatan Harian</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Catatan Kehadiran Harian</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-md btn-warning m-b-sm" type="button" id="uploadData" data-toggle="tooltip" data-placement="top" title="" data-original-title="Upload template absensi (.xls)"><i class="fa fa-upload"></i> Upload</button>
            </div>
        </div>
        <div class="box-body">
                   
                    <!-- <div class="row" data-spy="affix" data-offset-top="400" data-offset-bottom="-600" style="z-index: 999"> -->
                    <div class="row">
                        <div class="row text-center daftarTanggal">
                            <div class="col-xs-12"><?=menu_tgl($hari_ini)?></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <form class="form-inline" action="<?=site_url('absensi')?>" method="post">
                                <div class="form-group pull-right">
                                        <!-- <div class="col-md-6"></div> -->
                                        <label class="control-label">Lompat Tanggal </label>
                                        <div class="input-group date datepicker" >
                                            <input name="tanggal" class="form-control" placeholder="" aria-describedby="basic-addon2" value="" readonly="" type="text" onchange="this.form.submit()">
                                            <span class="input-group-addon add-on" id="basic-addon2"><i class="fa fa-calendar"></i></span>
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
                                        Ringkasan Absensi <?=tgl_indo($hari_ini) $hari_ini?>                                </h4>
                                </div>
                            </div>
                                        <div class="row" id="t4_summary">
                                            <div class="col-md-6">
						<?php 
                                                    $absensi=$this->Absensi_model->getDataAbsensiHarian($hari_ini);
                                                    foreach ($absensi as $key => $value) { ?>
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
                                                            <td width="10%"><?=$value['absen']?></td>
                                                            <td width="10%"><? echo $hari_ini; ?>0%</td>
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
						<?php } ?>
                                            </div>
                                        </div>
                                                                <div class="row">
                                <div class="col-xs-12">
                                    <p>Tanggal  : <?=tgl_indo($hari_ini)?> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="table-responsive tabelAbsensiContainer">

                                <table class="table table-hover" id="tabelAbsensi">
                                    <thead>
                                        <tr class="success">
                                            <th></th>
                                            <th class="absensiNama">Nama </th>
                                            <th>Status Kehadiran </th>
                                            <th>Jam Masuk </th>
                                            <th>Jam Keluar </th>
                                            <th>Lembur </th>
                                            <th>Terlambat </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $karyawan=get_data_db_by('karyawan',array('perusahaan_ID'=>get_user_info('perusahaan_ID')));
                                        foreach ($karyawan as $key => $value) { ?>
                                        <tr>
                                            <td>
                                                <div class="checkbox checkFollow">
                                                    <label><input type="checkbox" value="2674"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="<?=site_url('absensi/personal/'.$value->karyawan_ID)?>" class="namaPersonalia textSuccess"><?=$value->nama_lengkap?></a>
                                            </td>
                                            <td>
                                                <select name="" class="form-control pull-left status-kehadiran">
                                                    <option value="Belum Ada Status">Belum Ada Status</option>
                                                    <option value="Hadir Hari Kerja">Hadir Hari Kerja</option>
                                                    <option value="Sakit">Sakit</option>
                                                    <option value="Izin">Izin</option>
                                                    <option value="Cuti">Cuti</option>
                                                    <option value="Unpaid Leave">Unpaid Leave</option>
                                                    <option value="Mangkir">Mangkir</option>
                                                    <option value="Bukan Hari Kerja">Bukan Hari Kerja</option>
                                                    <option value="Tugas Luar">Tugas Luar</option>
                                                    <option value="Hadir Bukan Hari Kerja">Hadir Bukan Hari Kerja</option>
                                                </select>                                           
                                            </td>
                                            <td>
                                                <input type="text" class="form-control timepicker">
                                            </td>
                                            <td>
                                               <input type="text" class="form-control timepicker">
                                            </td>
                                            <td>
                                                <div class="tooltipWrapper" data-toggle="tooltip" data-placement="top" title="Hanya dapat dipilih ketika berstatus hadir">
                                                    <select id="" class="form-control lamaLembur">
                                                        <option value=""></option>
                                                        <option value="1">YES</option>
                                                        <option value="0">NO</option>
                                                    </select>
                                                </div>
                                            </td>                                           
                                            <td class="noteAction">
                                                <div class="btnActionTerlambat">
                                                    <button class="btn btn-sm btnCheck inActive alasan" data-id="<?=$value->karyawan_ID?>">
                                                        <i class="fa fa-clock-o fa-2x"></i>
                                                    </button>
                                                    <button class="btn note hide" data-toggle="modal" data-target="#noteModal">Note</button>
                                                    
                                                </div>
                                            </td>
                                        </tr>
                                        <?php  } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

        </div><!-- /.box-body -->
        <div class="box-footer">
         
        </div><!-- /.box-footer-->
    </div><!-- /.box -->
<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          
                          <form id="myModalForm" action="" role="form" class="form-horizontal" method="post" enctype="multipart/form-data">
                           
                            <div class="modal-body">
                              <div class="form-group">
                                            <p class="col-md-12 text-center" id="myModalLabel">
                                                Alasan
                                            </p>
                               <div class="col-md-12">
                              <textarea name="alasan"  class="form-control input-block-level"  /></textarea>
                               <div class="fileUploadWrapper" data-text="Pilih berkas...">
                                                             <input type="file" name="file"/>
                                                        </div>
                                                    </div>
                                                    </div>
                               
                                         <div class="form-group">
                                            <div class="col-md-12 text-center">
                              
                              <input type="hidden" name="user_id" id='karID' value="" >
                              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                              <button type="submit" class="btn btn-primary" id="myModalSubmit">Proses !</button>
                              </div>
                              </div>
                            </div>
                          
                           
                          </form>
                        </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

</section><!-- /.content -->

<?php 
$this->load->view('template/footer');
?>
<!--tambahkan custom js disini-->
<!-- bootstrap datepicker -->
<script src="<?=base_url();?>/assets/AdminLTE-2.3.11/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?=base_url('assets/AdminLTE-2.3.11/plugins/timepicker/bootstrap-timepicker.min.js')?>"></script>
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
 $(".alasan").click(function(){
    var karID=$(this).attr('data-id');  
    $("#myModal").modal("show");
    $('#myModal .modal-body #karID').val(karID);
    $('#myModal .modal-body .fileUploadWrapper').hide();    
    $('#myModal .modal-body textarea').show();
     $('#myModal #myModalLabel').text('Alasan Terlamabat');
      $('#myModal #myModalForm').attr('action', '<?=site_url('absensi/action/alasan')?>'); 
  });
 $("#uploadData").click(function(){
    
    $("#myModal").modal("show");
    $('#myModal .modal-body #karID').val();
    $('#myModal .modal-body textarea').hide();
    $('#myModal .modal-body .fileUploadWrapper').show();
     $('#myModal #myModalLabel').text('Silahkan Upload File Anda');     
      $('#myModal #myModalForm').attr('action', '<?=site_url('excel/upload')?>'); 
    
  });
</script>

</body>
</html>
