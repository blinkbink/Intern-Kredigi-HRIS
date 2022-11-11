<?php 
get_template('header');
?>
<!--tambahkan custom css disini-->
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?=base_url();?>/assets/AdminLTE-2.3.11/plugins/datepicker/datepicker3.css">
<?php
get_template('topbar');
get_template('sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Data Karyawan
        <small>Slip Gaji & THR</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Karyawan</a></li>
        <li class="active">Karir & Remunerasi</li>
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
            <h3 class="box-title">Slip Gaji & THR</h3>
        </div>
        <div class="box-body">
            <table class="table table-hover table-striped">
                <thead>
                <tr class="success">
                  <th>Group Gaji</th>
                   <th>Bulan Tahun</th>
                  <th>Status Kelengkapan</th>
                  <th>Status Pembayaran</th>
                  <th>THP</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
               
                
                </tbody>
              </table>
              <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <form class="form-horizontal" method="post" action="<?=site_url('karyawan/karir/action/tambah')?>">
                           
                            <div class="modal-body">
                              <div class="form-group">
                                            <p class="col-md-12 text-center">
                                                Pilih alasan personalia berhenti
                                            </p>
                               <div class="col-md-12">
                              <select  name="tipe" class="form-control" required>
                                                    <option value=""></option>
                                                    <?php 
                                                        $statusKaryawan = get_data_db_by('Master',array('kategori_master'=>'tipe status','reff_ID'=>'0'));
                                                        foreach ($statusKaryawan as $key => $status) {
                                                            echo '<option value="'.$status->master_ID.'">'. $status->nama_master.'</option>';
                                                        }
                                                    ?>
                                                    </select>
                                                    </div>
                                                    </div>
                               <div class="form-group">
                                            <p class="col-md-12 text-center">
                                                Tanggal Berhenti
                                            </p>
                                           
                                            
                                            <div class="col-md-12">
                                                <div class="input-group">
                                                    <input type="text" name="tgl_efektif" class="form-control datepicker" value="" readonly="" required >
                                                    <span class="input-group-addon add-on" id="basic-addon2"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <div class="col-md-12 text-center">
                              <input type="hidden" name="id_karyawan" value="<?=$karyawan->karyawan_ID?>" >
                              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                              <button type="submit" class="btn btn-primary" id="myModalSubmit">Proses !</button>
                              </div>
                              </div>
                            </div>
                          
                           
                          </form>
                        </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
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