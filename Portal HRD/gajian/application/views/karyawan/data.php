<?php 
get_template('header');
?>
<!--tambahkan custom css disini-->
<link rel="stylesheet" href="<?=base_url('assets/AdminLTE-2.3.11/plugins/datatables/dataTables.bootstrap.css') ?>">
<?php
get_template('topbar');
get_template('sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
       Data Karyawan
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Karyawan</a></li>
        <li class="active">Data </li>
    </ol>
</section> 

<!-- Main content -->
<section class="content"> 

    <!-- Default box -->
    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Karyawan </h3>
            <a href='<?php echo site_url("karyawan/tambah");?>' class="btn  btn-md btn-success  pull-right" ><i class="fa fa-plus"></i> Tambah Karyawan</a>
            </div>
            <!-- /.box-header -->
            
            <div class="box-body">
              <table class="table table-hover table-striped" id="datatable">
                <thead>
                <tr class="success">
                  <th>Nama</th>
                  <th>Jabatan</th>
                  <th>Lama Bekerja</th>
                  <th>HP</th>
                  <th>Email</th>                  
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($karyawan as $key => $value) { 
                  $karir    = count(get_data_db_by('Karir',array('karyawan_ID' => $value->karyawan_ID)));
                  $jabatan  = $this->Karyawan_model->get_karir($value->karyawan_ID,'jabatan_ID');
                  $jobtitle = $jabatan ? $jabatan : '- No Jobtitle - '?>
                <tr>
                  <td><?=$value->nama_lengkap?></td>
                  <td><?=$jobtitle?></td>
                  <td><?=durasi(strtotime($value->mulai_kerja))?></td>
                  <td><?=$value->hp_karyawan;?></td>
                  <td><?=$value->email_karyawan;?></td>
                  <td>
                    <div class="btn-group">
                      <a href="<?=site_url('karyawan/detail/'.$value->karyawan_ID)?>" type="button" class="btn btn-sm btn-info" >
                        <i class="fa fa-file" data-toggle="tooltip" data-placement="bottom" role="presentation" title="Detail"></i>
                      </a>
                      <a href="<?=site_url('karyawan/edit/'.$value->karyawan_ID)?>" type="button" class="btn btn-sm btn-warning" >
                        <i class="fa fa-pencil" data-toggle="tooltip" data-placement="bottom" role="presentation" title="Ubah"></i>
                      </a>
                      <button type="button" class="btn btn-sm btn-danger hapus-karyawan" data-id="<?=$value->karyawan_ID?>" data-karir="<?=$karir?>">
                        <i class="fa fa-trash" data-toggle="tooltip" data-placement="bottom" role="presentation" title="Hapus"></i>
                      </button>
                    </div>
                  </td>
                </tr>

                  <?php } ?>
                
                </tbody>
              </table>
               <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <form id="myModalForm" action="" role="form" class="form-horizontal" method="post">
                          <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Hapus Data Karyawan</h4>
                          </div>
                          <div class="modal-body">
                            
                          
                            <input type="hidden" name="id_data" id="id_data" value="">
                          </div>
                        
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary" id="myModalSubmit">Ya, Hapus Saja!</button>
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
<script src="<?=base_url('assets/AdminLTE-2.3.11/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?=base_url('assets/AdminLTE-2.3.11/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
<script>
  $(function () {
    $('#datatable').DataTable();

    $(".hapus-karyawan").click(function(){
        var divID = $(this).attr('data-id');  
        var divKarir = $(this).attr('data-karir');  
        $("#myModal").modal("show");
        
        if(divKarir == '0'){
          $('#myModal .modal-body #id_data').val(divID);          
          $('#myModal .modal-footer #myModalSubmit').show(); 
          $('#myModal #myModalForm').attr('action', '<?php echo site_url("karyawan/action/hapus") ?>'); 
          $('#myModal .modal-header #myModalLabel').text('Hapus Data Karyawan');
          $('#myModal .modal-body').prepend('<p id="hapus-notif">Apakah Anda yakin akan menghapus Data Karyawan ini ???</p>');
        } else {
          $('#myModal .modal-header #myModalLabel').text('Data Karyawan Tidak Dapat Dihapus');
          $('#myModal').addClass('modal-danger'); 
          $('#myModal .modal-body').prepend('<p id="hapus-notif">Karyawan Sudah memiliki karir</p>');
          $('#myModal .modal-footer #myModalSubmit').hide();
        }
    });

    $('#myModal').on('hidden.bs.modal', function(){
        $('#myModal .modal-body #id_data').val('');
        $('#myModal .modal-body p').remove();
        $('#myModal').removeClass('modal-danger');
    });
});
</script>
</body>
</html>