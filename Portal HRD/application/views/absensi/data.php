<?php 
$this->load->view('template/header');
?>
<!--tambahkan custom css disini-->
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?=base_url();?>/assets/AdminLTE-2.3.11/plugins/datepicker/datepicker3.css">
<link rel="stylesheet" href="<?=base_url('assets/AdminLTE-2.3.11/plugins/timepicker/bootstrap-timepicker.min.css') ?>">
<style>
.inputfile {
	width: 0.1px;
	height: 0.1px;
	opacity: 0;
	overflow: hidden;
	position: absolute;
	z-index: -1;
}

.inputfile + label {
    font-size: 1.25em;
    font-weight: 700;
    color: white;
    border-radius: .10em;
    background-color: red;
    display: inline-block;
    cursor: pointer; /* "hand" cursor */
}

.inputfile:focus + label,
.inputfile + label:hover {
    background-color: green;
}

.inputfile:focus + label {
	outline: 1px dotted #000;
	outline: -webkit-focus-ring-color auto 5px;
}

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

$hari_ini=(!empty($hari_ini)) ? $hari_ini :  date('Y-m-d');

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
               <!-- <button class="btn btn-md btn-warning m-b-sm" type="button" id="uploadData" data-toggle="tooltip" data-placement="top" title="" data-original-title="Upload template absensi (.xls)"><i class="fa fa-upload"></i> Upload</button> -->
 		  <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                 <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
               </div> 
	</div>
<div class="center">
<?php 
if(!empty($error)){echo $error;}
if(!empty($success)){echo $success;}
echo form_open_multipart('absensi/upload');
?>
<div>
<input id="file" type="file" name="myfile" class="inputfile" data-multiple-caption="{count} files selected" multiple />
<label for="file">Unggah file absensi</label>
<input type="submit" value="Unggah" />
</div>
</form>
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
                                        Ringkasan Absensi <?=tgl_indo($hari_ini)?>                                </h4>
                                </div>
                            </div>
                                        <div class="row" id="t4_summary">
                                            <div class="col-md-6">
						<?php 
						    $date=date('Y-m-d',strtotime($hari_ini));						   
                                                    $absensi=$this->Absensi_model->getDataAbsensiHarian($date, $hari_ini);
			      			    //var_dump($absensi);
                                                    foreach ($absensi as $key => $value) { ?>
                                                <table class="table table-hover table-striped m-b-n-md" id="dataTable">
                                                    <tbody>
                                                        <tr>
                                                            <td><span class="colorPresence1 m-r-sm warna"></span> Belum Ada Status </td>
                                                              <td width="10%"><?=$value['nostatus']?></td>
                                                            <td width="10%"><?=$value['persennostatus']?>%</td>
                                                        </tr>
                                                        <tr>
                                                            <td><span class="colorPresence2 m-r-sm warna"></span>
                                                            Hadir Hari Kerja 
                                                            </td>
                                                            <td class="jumlahPresentase"><?=$value['kerjaKerja']?></td>
                                                            <td class="presentase"><?=$value['persenKerjaKerja']?>%</td>
                                                        </tr>
                                                        <tr>
                                                            <td><span class="colorPresence3 m-r-sm warna"></span>
                                                            Sakit 
                                                            </td>
                                                            <td><?=$value['sakit']?></td>
                                                            <td class="presentase"><?=$value['persenSakit']?>%</td>
                                                        </tr>
                                                        <tr>
                                                            <td><span class="colorPresence4 m-r-sm warna"></span>
                                                            Izin 
                                                            </td>
                                                            <td><?=$value['izin']?></td>
                                                            <td class="presentase"><?=$value['persenIzin']?>%</td>
                                                        </tr>
                                                        <tr>
                                                            <td><span class="colorPresence5 m-r-sm warna"></span>
                                                            Cuti 
                                                            </td>
                                                            <td><?=$value['cuti']?></td>
                                                            <td class="presentase"><?=$value['persenCuti']?>%</td>
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
                                                            <td width="10%"><?=$value['mangkir']?></td>
                                                            <td width="10%"><?=$value['persenMangkir']?>%</td>
                                                        </tr>
                                                        <tr>
                                                            <td><span class="colorPresence8 m-r-sm warna"></span>
                                                            Bukan Hari Kerja 
                                                            </td>
                                                            <td><?=$value['bukanHariKerja']?></td>
                                                            <td class="presentase"><?=$value['persenBukanHariKerja']?>%</td>
                                                        </tr>
                                                        <tr>
                                                            <td><span class="colorPresence9 m-r-sm warna"></span>
                                                            Tugas Luar 
                                                            </td>
                                                            <td><?=$value['tugas']?></td>
                                                            <td class="presentase"><?=$value['persenTugas']?>%</td>
                                                        </tr>
                                                        <tr>
                                                            <td><span class="colorPresence10 m-r-sm warna"></span> 
                                                            Hadir Bukan Hari Kerja 
                                                            </td>
                                                            <td><?=$value['kerjaLibur']?></td>
                                                            <td class="presentase"><?=$value['persenKerjaLibur']?>%</td> 
                                                        </tr>
                                                        <tr>
                                                            <td><span class="colorPresence11 m-r-sm warna"></span> 
                                                            Terlambat 
                                                            </td>
                                                            <td><?=$value['telat']?></td>
                                                            <td class="presentase"><?=$value['persenTelat']?>%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
						<?php } ?>
                                            </div>
                                        </div>
                                                                <div class="row">
                                <!-- <div class="col-xs-12">
                                    <p>Tanggal  : <?=tgl_indo($hari_ini)?> </p>
                                </div> -->
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
                                    <form action="<?php //site_url('absensi/rekap')?>" method="post" class="form-horizontal">
                                    <?php 
                                        $karyawan=get_data_db_by('karyawan',array('perusahaan_ID'=>get_user_info('perusahaan_ID')));
                                        foreach ($karyawan as $key => $value) {
                                        ?>
                                        <tr>
                                            <td>
                                                <div class="checkbox checkFollow">
                                                    <label><input type="checkbox" value="2674"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="<?=site_url('absensi/personal/'.$value->karyawan_ID)?>" name="namaPersonalia[]" class="namaPersonalia textSuccess"><?=$value->nama_lengkap?></a>
                                                <input type="hidden" name="karyawan_ID[]" id="karyawan_ID" value="<?=$value->karyawan_ID?>" />
                                            </td>
                                            <?php
                                            $arr = $this->Absensi_model->getKodeAbsensi($value->karyawan_ID);
                                            $kodeAbsensi = $arr['kode_absensi'];
                                            ?>
                                            <input type="hidden" name="kode_absensi[]" id="kode_absensi" value="<?=$arr['kode_absensi']?>" />
                                            <?php
                                            $rowena = $this->Absensi_model->getDataAbsensiHarianPersonal($date, $value->karyawan_ID, $kodeAbsensi);
                                            $idStatus = $rowena['status_kehadiran'];
                                            ?>
                                            <td>
                                                <select name="status_kehadiran[]" class="form-control pull-left status-kehadiran">
                                                <?php
                                                $list = $this->Absensi_model->getListStatusKehadiran()->result();
                                                foreach ($list as $val) {
                                                    if($val->id_status_kehadiran == $idStatus){
                                                        $selected = 'selected="selected"';
                                                    } else {
                                                        $selected = '';
                                                    }
                                                ?>
                                                    <option value="<?=$val->id_status_kehadiran?>" <?=$selected?>><?=$val->nama_status?></option>
                                                <?php
                                                }
                                                ?>
                                                    <!-- <option value="Hadir Hari Kerja">Hadir Hari Kerja</option>
                                                    <option value="Sakit">Sakit</option>
                                                    <option value="Izin">Izin</option>
                                                    <option value="Cuti">Cuti</option>
                                                    <option value="Unpaid Leave">Unpaid Leave</option>
                                                    <option value="Mangkir">Mangkir</option>
                                                    <option value="Bukan Hari Kerja">Bukan Hari Kerja</option>
                                                    <option value="Tugas Luar">Tugas Luar</option>
                                                    <option value="Hadir Bukan Hari Kerja">Hadir Bukan Hari Kerja</option>
                                                    -->
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control timepicker" name="clock_in[]" value="<?=$rowena['clock_in']?>">
                                            </td>
                                            <td>
                                               <input type="text" class="form-control timepicker" name="clock_out[]" value="<?=$rowena['clock_out']?>">
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
                                            </form>
                                            <td class="noteAction">
                                                <div class="btnActionTerlambat titleTelat" title="<?php echo $rowena['late']; if(!empty($rowena['alasan_telat'])){ echo ". Alasan: ".$rowena['alasan_telat']; }?>">
                                                    <button class="btn btn-sm btnCheck inActive alasan" data-id="<?=$value->karyawan_ID?>" alasan_telat="<?=$rowena['alasan_telat']?>" id_absensi="<?=$rowena['id_absensi']?>">
                                                        <i class="fa fa-clock-o fa-2x"></i>
                                                    </button>
                                                    <button class="btn note hide" data-toggle="modal" data-target="#noteModal">Note</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php  
                                        }
                                        //} 
                                        ?>
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
                            <textarea name="alasan" class="form-control input-block-level" id='alsTL' value="" /></textarea>
                            <div class="fileUploadWrapper" data-text="Pilih berkas...">
                                <input type="file" name="file"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 text-center">
                            <input type="hidden" name="user_id" id='karID' value="" >
                            <input type="hidden" name="id_absensi" id='absID' value="" >
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
<script src="<?=base_url('/assets/js/dropzone.js')?>"></script>
<script src="<?=base_url('assets/AdminLTE-2.3.11/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?=base_url('assets/AdminLTE-2.3.11/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#myTable').DataTable();
});
</script>
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
    var absID=$(this).attr('id_absensi');
    var alsTL=$(this).attr('alasan_telat');
    $("#myModal").modal("show");
    $('#myModal .modal-body #karID').val(karID);
    $('#myModal .modal-body #absID').val(absID);
    $('#myModal .modal-body #alsTL').val(alsTL);
    $('#myModal .modal-body .fileUploadWrapper').hide();    
    $('#myModal .modal-body textarea').show();
     $('#myModal #myModalLabel').text('Alasan Terlambat');
      $('#myModal #myModalForm').attr('action', '<?=site_url('absensi/update_alasan')?>'); 
  });
  
 $("#uploadData").click(function(){
    
    $("#myModal").modal("show");
    $('#myModal .modal-body #karID').val();
    $('#myModal .modal-body textarea').hide();
    $('#myModal .modal-body .fileUploadWrapper').show();
     $('#myModal #myModalLabel').text('Silahkan Upload File Anda');     
      $('#myModal #myModalForm').attr('action', '<?=site_url('absensi/upload')?>'); 
    
  });

var inputs = document.querySelectorAll( '.inputfile' );
Array.prototype.forEach.call( inputs, function( input )
{
	var label	 = input.nextElementSibling,
		labelVal = label.innerHTML;

	input.addEventListener( 'change', function( e )
	{
		var fileName = '';
		if( this.files && this.files.length > 1 )
			fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
		else
			fileName = e.target.value.split( '\\' ).pop();

		if( fileName )
			label.querySelector( 'span' ).innerHTML = fileName;
		else
			label.innerHTML = labelVal;
	});
});
</script>
</body>
</html>
