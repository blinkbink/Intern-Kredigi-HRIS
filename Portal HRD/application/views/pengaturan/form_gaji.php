<?php 
get_template('header');
?>
<!--tambahkan custom css disini--> 
<!-- Select2 -->
  <link rel="stylesheet" href="<?=base_url();?>/assets/AdminLTE-2.3.11/plugins/select2/select2.min.css">
<link rel="stylesheet" href="<?=base_url('assets/AdminLTE-2.3.11/plugins/datatables/dataTables.bootstrap.css') ?>">
<!-- daterange picker -->
  <link rel="stylesheet" href="<?=base_url();?>/assets/AdminLTE-2.3.11/plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?=base_url();?>/assets/AdminLTE-2.3.11/plugins/datepicker/datepicker3.css">
<?php
get_template('topbar');
get_template('sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Pengaturan<small>Slip Gaji</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Pengaturan</a></li>
        <li class="active">Slip Gaji</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
            <div class="box-header">
              <h3 class="box-title"> Form Ubah Pengaturan Penggajian  </h3>
            </div>
            <!-- /.box-header -->
            
            <div class="box-body">
              <div class="row">
                      <div class="col-xs-12">
                        
                          <div class="row">
                            <div class="col-xs-12">
                              <div class="pertanyaanContainer">
                              <div class="row judulWizard">
                                <div class="col-md-10 padding-leftRight">
                                  <h4>
                                    Masukkan informasi umum mengenai Slip Gaji ini:                                    </h4>
                                </div>
                              </div>

                                
                                <form class="form-horizontal" method="post" action="<?=site_url('pengaturan/gaji/slip/update')?>" >
                                <input type="hidden" name="id_data" value="<?=$slip->master_gaji_ID?>">
                                  <div class="form-group">
                                    <label for="" class="col-sm-3 control-label">Nama Slip Gaj</label>
                                    <div class="col-sm-9">
                                      <input name="nama" type="text" class="form-control pilihanModul inptKomponen" id="grupSlipGaji" value="<?=$slip->master_gaji_nama?>">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="" class="col-sm-3 control-label">Periode</label>
                                    <div class="col-sm-9">
                                      <select name="tipe" id="tipeWaktu" class="form-control pilihanModul inptKomponen">
                                        <option <?= is_selected('Tetap',$slip->master_gaji_tipe);?> value="Tetap">Tetap</option>
                                        <option <?= is_selected('Tidak Tetap',$slip->master_gaji_tipe);?> value="Tidak Tetap">Tidak Tetap (THR atau bonus lebih dari 31 hari)</option>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="form-group" id="munculJangkaTetap">
                                    <label for="" class="col-sm-3 control-label">Lama Periode</label>
                                    <div class="col-sm-9">
                                      <select name="jangka" id="rentangWaktuPenggajian" class="form-control pilihanModul inptKomponen">
                                        <option <?= is_selected('Bulanan',$slip->master_gaji_jangka);?> value="Bulanan">1 Bulanan</option>
                                        <option <?= is_selected('Mingguan',$slip->master_gaji_jangka);?> value="Mingguan">1 Mingguan</option>
                                        <option <?= is_selected('Harianex',$slip->master_gaji_jangka);?> value="Harianex">N Harian</option>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="form-group" id="munculBulanan">
                                    <label for="" class="col-sm-3 control-label">Tanggal Awal Periode</label>
                                    <div class="col-sm-9">
                                      <div class="pilihanModul inptKomponen">
                                        <select name="tglCutOff1" id="tglCutOff1" class="form-control select2">
                                          <option value="<?=$slip->master_gaji_tglCutOff1?>"><?=$slip->master_gaji_tglCutOff1?></option> 
                                          <?php
                                            for($n=1;$n<=28;$n++){
                                              echo ' <option value="'.$n.'">'.$n.'</option>';
                                            }

                                          ?>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group rentangJangkaWaktu" id="munculMingguan" style="display: none;">
                                    <label for="" class="col-sm-3 control-label">Hari Awal Periode</label>
                                    <div class="col-sm-9">
                                        <select name="hariCutOff" id="" class="form-control select2">
                                        <option value="<?=$slip->master_gaji_hariCutOff?>"><?= hari($slip->master_gaji_hariCutOff)?></option> 
                                         <option value=""></option>
                                          <?php
                                            for($n=1;$n<=7;$n++){
                                              echo ' <option value="'.$n.'">'.hari($n).'</option>';
                                            }

                                          ?>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="form-group rentangJangkaWaktu munculHarian" style="display: none;">
                                    <label for="" class="col-sm-3 control-label">Jumlah Hari dalam Periode</label>
                                    <div class="col-sm-9">
                                    <input name="jumlahHari" type="text" class="form-control hanyaAngka pilihanModul jmlHari inptKomponen" value="" placeholder="Harus lebih dari 31 hari" data-toggle="tooltip" data-placement="top" title="" data-original-title="Harus lebih dari 31 hari">
                                    </div>
                                  </div>
                                  <div class="form-group rentangJangkaWaktu munculHarian" id="munculJangkaTidakTetap" style="display: none;">
                                    <label for="" class="col-sm-3 control-label">Tanggal Slip Sebelumnya</label>
                                    <div class="col-sm-9">
                                      <div class="pilihanModul inptKomponen">
                                        <div id="tglSlipSebelumnya" class="input-group date" data-date="" data-date-format="dd-mm-yyyy">
                                        <input type="text" name="tglCutOff2" class="form-control datepicker" aria-describedby="basic-addon2" value="<?=date('d-m-Y',strtotime($slip->master_gaji_tglCutOff2))?>" readonly="">
                                        <span class="input-group-addon add-on" id="basic-addon2"><i class="fa fa-calendar"></i></span>
                                      </div>
                                    </div>
                                    </div>
                                  </div>
                                <div class="form-group">
                                  <label for="" class="col-sm-3 control-label">
                                    Untuk komponen pendapatan tergantung kehadiran, tentukan hari absensi terakhir yang masuk hitungan gaji:                                    </label>
                                    <div class="col-sm-9">
                                      <select name="tglAbsensi" id="lastAbsen" class="form-control pilihanModul inptKomponen">
                                     
                                       
                                        <option value="<?=$slip->master_gaji_tglAbsensi?>"><?=$slip->master_gaji_tglAbsensi?> hari sebelum akhir periode</option> 
                                         <option value=""></option>
                                          <?php
                                            for($n=1;$n<=10;$n++){
                                              echo ' <option value="'.$n.'">'.$n.' hari sebelum akhir periode</option>';
                                            }
                                          ?>
                                      </select>
                                    </div>
                                  </div>

                                  
                                  <div class="form-group pilihanModul inptKomponen">
                                    <div class="col-xs-12">
                                      <div class="pull-right">
                                        <button id="simpanGrupSlipGaji" class="btn btn-warning btn-gadjian btn-sm aksiInputPenggajian" type="submit">
                                          Simpan                                        </button>
                                        <button id="batalGrupSlipGaji" class="btn btn-danger btn-gadjian btn-sm aksiInputPenggajian aksiModul" type="button">
                                          Batal                                       </button>
                                      </div>
                                    </div>
                                  </div>
                                </form>
                              </div>
                              <br>
                                <div class="row">
                                  <div class="col-md-10">
                                    <h4> Daftar Komponen pendapatan dalam Slip Gaji ini </h4>
                                  </div>
                                  <div class="col-md-2">
                                    <button class="btn btn-success btn-sm pull-right" id="tambahKomponenPendapatan" type="button">
                                    <i class="fa fa-plus"></i> Komponen Pendapatan </button>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-xs-12">
                                    <table  id="tabelNamaPendapatan" id="tabelNamaPotongan"  class="table table-hover table-striped">
                                      <thead>
                                      <tr class="success">
                                        <th>Nama Pendapatan</th>
                                       <th width="30%">Tipe</th>
                                        <th width="10%">Aksi</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php foreach ($item_pendapatan as $key => $value) { ?>

                                      <tr>
                                       <td><?=$value->nama_data?></td>
                                        <td><?=$value->option_data?></td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-danger hapus-data"  data-id="<?=$value->data_ID?>" data-name="<?=$value->nama_data?>">
                                              <i class="fa fa-trash" data-toggle="tooltip" data-placement="bottom" role="presentation" title="Hapus Komponene Pendapatan"></i>
                                            </button>
                                        </td>
                                      </tr>

                                        <?php } ?>
                                      
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                                <br>
                               <div class="row">
                                          <div class="col-md-10">
                                            <h4>Daftar Komponen potongan dalam Slip Gaji ini</h4>
                                          </div>
                                          <div class="col-md-2">
                                            <button class="btn btn-success  btn-sm pull-right" id="tambahKomponenPotongan" type="button">
                                        <i class="fa fa-plus"></i> Komponen Potongan</button>
                                          </div>
                                        </div>
                                <div class="row">
                                  <div class="col-xs-12">
                                    <table id="tabelNamaPotongan"  class="table table-hover table-striped">
                                      <thead>
                                      <tr class="success">
                                        <th>Nama Potongan</th>
                                        <th width="30%">Tipe</th>
                                        <th width="10%">Aksi</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php foreach ($item_potongan as $key => $value) { ?>

                                      <tr>
                                        <td><?=$value->nama_data?></td>
                                        <td><?=$value->option_data?></td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-danger hapus-data"  data-id="<?=$value->data_ID?>" data-name="<?=$value->nama_data?>">
                                              <i class="fa fa-trash" data-toggle="tooltip" data-placement="bottom" role="presentation" title="Hapus Komponen Potongan"></i>
                                            </button>
                                        </td>
                                      </tr>

                                        <?php } ?>
                                      
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                                <div class="col-xs-12 text-center">
                                  <a class="btn btn-danger btn-gadjian btn-sm aksiInputPenggajian" role="button" href="<?=site_url('pengaturan/gaji/slip')?>">Kembali ke Daftar Slip Gaji </a>
                                </div>
                              </div>

                            </div>
                          </div>
</div>
                    </div>
<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <form id="myModalForm" action="" role="form" class="form-horizontal" method="post">
                            <div class="modal-header">
                              <h4 class="modal-title" id="myModalTitle"></h4>
                            </div>
                            <div class="modal-body">
                              <label id=myModalLabel></label>
                              <?=get_data_param('pendapatan',get_segment(5));?>
                              <?=get_data_param('potongan',get_segment(5));?>
                              <input type="hidden" name="id_data" id="id_data" value="">
                              <input type="hidden" name="id_slip"  value="<?=get_segment(5)?>">
                            </div>
                          
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                              <button type="submit" class="btn btn-primary" id="myModalSubmit">Tambah !</button>
                            </div>
                          </form>
                        </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

</section><!-- /.content -->

<?php 
get_template('footer');
?>
<!--tambahkan custom js disini-->

<!-- Select2 -->
<script src="<?=base_url();?>/assets/AdminLTE-2.3.11/plugins/select2/select2.full.min.js"></script>
<script src="<?=base_url('assets/AdminLTE-2.3.11/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?=base_url('assets/AdminLTE-2.3.11/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?=base_url();?>/assets/AdminLTE-2.3.11/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="<?=base_url();?>/assets/AdminLTE-2.3.11/plugins/datepicker/bootstrap-datepicker.js"></script>
<script>
  $(function () {
    $('#example2').DataTable();
});

 $(".select2").select2({
    width: '100%'
  });  

$(document).ready(function(){
  if($("#tipeWaktu").val() == "Tetap"){
      $("#munculJangkaTetap,#munculBulanan").show();
      $("#munculJangkaTidakTetap").hide();

      // Validasi saat Load untuk Pilihan Rentang Waktu Penggajian
        if($("#rentangWaktuPenggajian").val() == "Bulanan"){
          // console.log("bulanan");
          // alert("Bulanan");
          $("#munculBulanan").show();
          $("#munculHarian,#munculMingguan,.munculHarian").hide();
          $("#simpanGrupSlipGaji").prop("disabled",false);
        }
        else if($("#rentangWaktuPenggajian").val() == "Mingguan"){
          // console.log("mingguan");
          // alert("Mingguan");
          $("#munculMingguan").show();
          $("#munculHarian,#munculBulanan,.munculHarian").hide();
          $("#simpanGrupSlipGaji").prop("disabled",false);
        }
        else if($("#rentangWaktuPenggajian").val() == "Harianex"){
          // console.log("harian");
          // alert("Harian");
          $(".munculHarian").show();
          $("#munculBulanan,#munculMingguan").hide();

          if($(".jmlHari").val() <= 31){
            $("#simpanGrupSlipGaji").prop("disabled",true);
          }
          else{
            $("#simpanGrupSlipGaji").prop("disabled",false);
          }

          $(".jmlHari").bind('keyup change input',function() {
            if($(this).val() <= 31){
              $("#simpanGrupSlipGaji").prop("disabled",true);
            }
            else{
              $("#simpanGrupSlipGaji").prop("disabled",false);
            }
          });
        }

    }
    else{
      $("#munculJangkaTetap,#munculBulanan,#munculMingguan,.munculHarian").hide();
      $("#munculJangkaTidakTetap").show();
    }
  $("#tipeWaktu").change(function(){
    if($(this).val() == "Tetap"){
      $("#rentangWaktuPenggajian").val("Bulanan");
      $("#munculJangkaTetap,#munculBulanan").show();
      $("#munculJangkaTidakTetap").hide();
    }
    else{
      $("#munculJangkaTetap,#munculBulanan,#munculMingguan,.munculHarian").hide();
      $("#munculJangkaTidakTetap").show();
    }
  });
  $("#rentangWaktuPenggajian").change(function(){

    if($(this).val() == "Bulanan"){
      // console.log("bulanan");
      $("#munculBulanan").show();
      $("#munculHarian,#munculMingguan,.munculHarian").hide();
      $("#simpanGrupSlipGaji").prop("disabled",false);
    }
    else if($(this).val() == "Mingguan"){
      // console.log("mingguan");
      $("#munculMingguan").show();
      $("#munculHarian,#munculBulanan,.munculHarian").hide();
      $("#simpanGrupSlipGaji").prop("disabled",false);
    }
    else if($(this).val() == "Harianex"){
      // console.log("harian");
      $(".munculHarian").show();
      $("#munculBulanan,#munculMingguan").hide();

      if($(".jmlHari").val() <= 31){
        $("#simpanGrupSlipGaji").prop("disabled",true);
      }
      else{
        $("#simpanGrupSlipGaji").prop("disabled",false);
      }

      $(".jmlHari").bind('keyup change input',function(){
        if($(this).val() <= 31){
          $("#simpanGrupSlipGaji").prop("disabled",true);
        }
        else{
          $("#simpanGrupSlipGaji").prop("disabled",false);
        }
      });

    }
  });
  $('.datepicker').datepicker({
      orientation: "top",
        autoclose:true,
        format: 'dd-mm-yyyy'
    });
    $('#myModal .modal-body #option_potongan').hide();
    $('#myModal .modal-body #option_pendapatan').hide();
  $("#tambahKomponenPotongan").click(function(){
    $("#myModal").modal("show");
    $('#myModal .modal-header #myModalTitle').text('Form Tambah Komponen Potongan');
    $('#myModal .modal-body #myModalLabel').text('Komponen Potongan');
    $('#myModal .modal-body #option_pendapatan').hide();    
    $('#myModal .modal-body #option_potongan').show();
    $('#myModal #myModalForm').attr('action', '<?php echo site_url("pengaturan/gaji/item/potongan") ?>'); 
  });
  $("#tambahKomponenPendapatan").click(function(){
    $("#myModal").modal("show");
    $('#myModal .modal-header #myModalTitle').text('Form Tambah Komponen Pendapatan');
    $('#myModal .modal-body #myModalLabel').text('Komponen Pendapatan');
    $('#myModal .modal-body #option_potongan').hide();
    $('#myModal .modal-body #option_pendapatan').show();
    $('#myModal #myModalForm').attr('action', '<?php echo site_url("pengaturan/gaji/item/pendapatan") ?>'); 
  });
  $(".hapus-data").click(function(){
    var divID = $(this).attr('data-id');  
    var divName = $(this).attr('data-name');  
    $("#myModal").modal("show");
    $('#myModal .modal-body #namaPotongan').hide();
    $('#myModal .modal-body #optionData').hide();    
    $('#myModal .modal-body label').hide();
    $('#myModal .modal-body #id_data').val(divID);
    $('#myModal .modal-header #myModalTitle').text('Hapus Item Komponen');
    $('#myModal .modal-footer #myModalSubmit').text('Ya, Hapus Saja!');
    $('#myModal #myModalForm').attr('action', '<?php echo site_url("pengaturan/gaji/item/hapus") ?>'); 
    $('#myModal .modal-body').prepend('<p id="hapus-notif">Apakah Anda yakin akan menghapus Komponen '+ divName +'???</p>');
  });

  $('#myModal').on('hidden.bs.modal', function(){
    $('#myModal .modal-body #option_potongan').hide();
    $('#myModal .modal-body #option_pendapatan').hide();
    $('#myModal .modal-body label').show(); 
    $('#myModal .modal-body p').remove();
});
});
</script>
</body>
</html>