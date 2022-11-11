<?php 
get_template('header');
?>
<!--tambahkan custom css disini-->
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
    <h1>
       Pengaturan
        <small>Slip Gaji</small>
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
              <h3 class="box-title">Daftar Slip Gaji yang digunakan di Perusahaan  </h3>
            <button class="btn  btn-md btn-success  pull-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Tambah Slip Gaji</button>
            </div>
            <!-- /.box-header -->
            
            <div class="box-body">
              <?php echo validation_errors(); ?>
              <?php echo $error; ?>
              <table class="table table-hover table-striped">
                <thead>
                <tr class="success">
                  <th>Nama Slip GAji</th>
                  <th>Periode</th>
                  <th>Lama Periode</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php  foreach ($slip as $key => $value) { ?>

                <tr>
                  <td><?=$value->master_gaji_nama?></td>
                  <td><?=$value->master_gaji_tipe?></td>
                  <td><?=get_data_periode($value->master_gaji_jangka,'',$value->master_gaji_tipe)?></td>
                  <td>
                    <div class="btn-group">
                      <a href="<?=site_url('pengaturan/gaji/slip/detail/'.$value->master_gaji_ID)?>" type="button" class="btn btn-sm btn-info" >
                        <i class="fa fa-file" data-toggle="tooltip" data-placement="bottom" role="presentation" title="Detail Slip Gaji"></i>
                      </a>
                      <a href="<?=site_url('pengaturan/gaji/slip/edit/'.$value->master_gaji_ID)?>" type="button" class="btn btn-sm btn-warning" >
                        <i class="fa fa-pencil" data-toggle="tooltip" data-placement="bottom" role="presentation" title="Ubah Slip Gaji"></i>
                      </a>
                      <button type="button" class="btn btn-sm btn-danger hapus-slip" data-id="<?=$value->master_gaji_ID?>" >
                        <i class="fa fa-trash" data-toggle="tooltip" data-placement="bottom" role="presentation" title="Hapus Slip Gaji"></i>
                      </button>
                    </div>
                  </td>
                </tr>

                  <?php } ?>
                
                </tbody>
              </table>
              
                    <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <form id="myModalForm" action="<?=site_url('pengaturan/gaji/slip/tambah')?>" class="form-horizontal" method="post">
                            <div class="modal-header">
                              <h4 class="modal-title" id="myModalLabel">Form Tambah Pengaturan Gaji</h4>
                            </div>
                            <div class="modal-body">
                              
                                  <h4>Masukkan informasi umum mengenai Slip Gaji ini:                                    </h4>
                               
                                <div class="form-horizontal"> 
                                  <div class="form-group">
                                    <label for="" class="col-sm-3 control-label">Nama Slip Gaji</label>
                                    <div class="col-sm-9">
                                      <input name="nama" type="text" class="form-control" id="grupSlipGaji">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="" class="col-sm-3 control-label">Periode</label>
                                    <div class="col-sm-9">
                                      <select name="tipe" id="tipeWaktu" class="form-control">
                                        <option value="Tetap">Tetap</option>
                                        <option value="Tidak Tetap">Tidak Tetap (THR atau bonus lebih dari 31 hari)</option>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="form-group" id="munculJangkaTetap">
                                    <label for="" class="col-sm-3 control-label">Lama Periode</label>
                                    <div class="col-sm-9">
                                      <select name="jangka" id="rentangWaktuPenggajian" class="form-control">
                                        <option value="Bulanan">1 Bulanan</option>
                                        <option value="Mingguan">1 Mingguan</option>
                                        <option value="Harianex">N Harian</option>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="form-group" id="munculBulanan">
                                    <label for="" class="col-sm-3 control-label">Tanggal Awal Periode</label>
                                    <div class="col-sm-9">
                                    <select name="tglCutOff1" id="" class="form-control">
                                      <?php
                                            for($n=1;$n<=28;$n++){
                                              echo ' <option value="'.$n.'">'.$n.'</option>';
                                            }

                                          ?>
                                    </select>
                                    </div>
                                  </div>
                                  <div class="form-group rentangJangkaWaktu" id="munculMingguan" style="display: none;">
                                    <label for="" class="col-sm-3 control-label">Hari Awal Periode</label>
                                    <div class="col-sm-9">
                                      <select name="hariCutOff" id="" class="form-control">
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
                                    <input name="jumlahHari" type="text" class="form-control hanyaAngka jmlHari" placeholder="Harus lebih dari 31 hari" data-toggle="tooltip" data-placement="top" title="" data-original-title="Harus lebih dari 31 hari">
                                    </div>
                                  </div>
                                  <div class="form-group rentangJangkaWaktu munculHarian" id="munculJangkaTidakTetap" style="display: none;">
                                    <label for="" class="col-sm-3 control-label">Tanggal Slip Sebelumnya</label>
                                    <div class="col-sm-9">
                                      <div id="tglSlipSebelumnya" class="input-group date " data-date="14-03-2017" data-date-format="dd-mm-yyyy">
                                      <input name="tglCutOff2" type="text" class="form-control  datepicker" placeholder="..." aria-describedby="basic-addon2" readonly="">
                                      <span class="input-group-addon add-on" id="basic-addon2"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                  <label for="" class="col-sm-3 control-label">
                                    Untuk komponen pendapatan tergantung kehadiran, tentukan hari absensi terakhir yang masuk hitungan gaji:                                    </label>
                                    <div class="col-sm-9">
                                      <select name="tglAbsensi" id="" class="form-control">
                                         <?php
                                            for($n=1;$n<=10;$n++){
                                              echo ' <option value="'.$n.'">'.$n.' hari sebelum akhir periode</option>';
                                            }

                                          ?>
                                      </select>
                                    </div>
                                  </div>

                               
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                              <button type="submit" class="btn btn-primary" id="myModalSubmit">Tambah</button>
                            </div>
                              </div>
                          </form>
                        </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

                     <div class="modal fade" tabindex="-1" role="dialog" id="hapus-slip">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">Hapus Slip Gaji</h4>
                            </div>
                            <div class="modal-body">
                              <p>Apakah Anda yakin akan menghapus Slip Gaji ini???</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                              <a href="" type="button" class="btn btn-primary" >Ya, Hapus Saja !</a>
                            </div>
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

  

$(document).ready(function(){
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
    else if($(this).val() == "Harian"){
      $(".munculHarian,#munculBulanan,#munculMingguan").hide();
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
        autoclose:true
    });

   $(".hapus-slip").click(function(){
    var divID = $(this).attr('data-id'); 
    $("#hapus-slip").modal("show");
    $('#hapus-slip .modal-footer a').attr('href', '<?php echo site_url()?>/pengaturan/gaji/slip/hapus/'+divID+''); 
  });
});
</script>
</body>
</html>