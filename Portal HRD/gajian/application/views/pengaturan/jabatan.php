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
       Pengaturan
        <small>Data Jabatan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Pengaturan</a></li>
        <li class="active">Data Jabatan</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Daftar Jabatan di Perusahaan  </h3>
            <button class="btn  btn-md btn-success  pull-right" id="tambahJabatan"><i class="fa fa-plus"></i> Tambah Jabatan</button>
            </div>
            <!-- /.box-header -->
            
            <div class="box-body">
              <?php echo validation_errors(); ?>
              <?php echo $error; ?>
              <table class="table table-hover table-striped">
                <thead>
                <tr class="success">
                  <th>Nama Jabatan</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($jabatan as $key => $value) { ?>

                <tr>
                  <td><?=$value->nama_data; ?></td>
                  <td><?= tombol_aktivasi($value->status_data, site_url('pengaturan/data/jabatan/stat/'.$value->data_ID));?></td>
                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-warning ubah-jabatan"  data-id="<?=$value->data_ID; ?>"  data-name="<?=$value->nama_data; ?>">
                        <i class="fa fa-pencil" data-toggle="tooltip" data-placement="bottom" role="presentation" title="Ubah Nama Jabatan"></i>
                      </button>
                      <button type="button" class="btn btn-sm btn-danger hapus-jabatan"  data-id="<?=$value->data_ID; ?>"  data-name="<?=$value->nama_data; ?>">
                        <i class="fa fa-trash" data-toggle="tooltip" data-placement="bottom" role="presentation" title="Hapus Nama Jabatan"></i>
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
                          <form id="myModalForm" action="" class="form-horizontal" method="post">
                            <div class="modal-header">
                              <h4 class="modal-title" id="myModalLabel">Form Ubah Nama Jabatan</h4>
                            </div>
                            <div class="modal-body">
                              <input class="form-control" type="text" name="nama_data" id="namaJabatan" value="">
                              <input type="hidden" name="id_data" id="idJabatan" value="">
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                              <button type="submit" class="btn btn-primary" id="myModalSubmit">Ubah !</button>
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
    $('#example2').DataTable();
});

  

$(document).ready(function(){
  var path = window.location.pathname;
  var host = window.location.hostname;
  $(".ubah-jabatan").click(function(){
    var divID = $(this).attr('data-id');    
    var divName = $(this).attr('data-name');
    $("#myModal").modal("show");
    $('#myModal .modal-body #idJabatan').val(divID);
    $('#myModal .modal-body #namaJabatan').val(divName);
    $('#myModal .modal-header #myModalLabel').text('Form Ubah Data Jabatan');
    $('#myModal .modal-footer #myModalSubmit').text('Ubah!');
    $('#myModal #myModalForm').attr('action', '<?php echo site_url("pengaturan/data/jabatan/update") ?>'); 
  });

  $("#tambahJabatan").click(function(){
    $("#myModal").modal("show");
    $('#myModal .modal-header #myModalLabel').text('Form Tambah Data Jabatan');
    $('#myModal .modal-footer #myModalSubmit').text('Tambah!');
    $('#myModal #myModalForm').attr('action', '<?php echo site_url("pengaturan/data/jabatan/tambah") ?>'); 
  });

  $(".hapus-jabatan").click(function(){
    var divID = $(this).attr('data-id');  
    var divName = $(this).attr('data-name');  
    $("#myModal").modal("show");
    $('#myModal .modal-body #namaJabatan').hide();
    $('#myModal .modal-body #idJabatan').val(divID);
    $('#myModal .modal-header #myModalLabel').text('Hapus Data Jabatan');
    $('#myModal .modal-footer #myModalSubmit').text('Ya, Hapus Saja!');
    $('#myModal #myModalForm').attr('action', '<?php echo site_url("pengaturan/data/jabatan/hapus") ?>'); 
    $('#myModal .modal-body').prepend('<p id="hapus-notif">Apakah Anda yakin akan menghapus Jabatan '+ divName +'???</p>');
  });

  $('#myModal').on('hidden.bs.modal', function(){
    $('#myModal .modal-body #idJabatan').val('');
    $('#myModal .modal-body #namaJabatan').val('');
    $('#myModal .modal-body #namaJabatan').show();
    $('#myModal .modal-body p').remove();
});
          
});
</script>
</body>
</html>