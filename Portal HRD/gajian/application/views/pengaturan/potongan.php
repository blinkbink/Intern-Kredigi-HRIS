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
        <small>Komponen Potongan</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Pengaturan</a></li>
        <li class="active">Komponen Potongan</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Daftar Komponen Potongan Karyawan </h3>
            <button class="btn  btn-md btn-success  pull-right" id="tambahPotongan"><i class="fa fa-plus"></i> Tambah Potongan</button>
            </div>
            <!-- /.box-header -->
            
            <div class="box-body">
              <?php echo validation_errors(); ?>
              <?php echo $error; ?>
              <table class="table table-hover table-striped">
                <thead>
                <tr class="success">
                  <th>Nama Potongan</th>
                  <th>Tipe</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($potongan as $key => $value) { ?>

                <tr>
                  <td><?=$value->nama_data; ?></td>
                  <td><?=$value->option_data; ?></td>
                  <td><?= tombol_aktivasi($value->status_data, site_url('pengaturan/komponen/potongan/stat/'.$value->data_ID));?></td>
                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-warning ubah-potongan"  data-id="<?=$value->data_ID; ?>" data-option="<?=$value->option_data; ?>"  data-name="<?=$value->nama_data; ?>">
                        <i class="fa fa-pencil" data-toggle="tooltip" data-placement="bottom" role="presentation" title="Ubah Komponen Potongan"></i>
                      </button>
                      <button type="button" class="btn btn-sm btn-danger hapus-potongan"  data-id="<?=$value->data_ID; ?>"  data-name="<?=$value->nama_data; ?>">
                        <i class="fa fa-trash" data-toggle="tooltip" data-placement="bottom" role="presentation" title="Hapus Komponene Potongan"></i>
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
                              <h4 class="modal-title" id="myModalLabel">Form Ubah Komponen Potongan</h4>
                            </div>
                            <div class="modal-body">
                              <label>Komponen Potongan</label>
                              <input class="form-control" type="text" name="nama_data" id="namaPotongan" value="">
                            
                              <label>tipe</label>
                             <select name="option_data" id="optionData" class="form-control" required="">
                                <option value="Manual">Manual</option>
                                </select>
                            
                              <input type="hidden" name="id_data" id="idPotongan" value="">
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
  $(".ubah-potongan").click(function(){
    var divID = $(this).attr('data-id');    
    var divName = $(this).attr('data-name');   
    var divOption = $(this).attr('data-option');
    $("#myModal").modal("show");
    $('#myModal .modal-body #idPotongan').val(divID);
    $('#myModal .modal-body #namaPotongan').val(divName);
    $('#optionData option[value = "'+divOption+'" ]').prop('selected', true);
    $('#myModal .modal-header #myModalLabel').text('Form Ubah Potongan atau Bagian');
    $('#myModal .modal-footer #myModalSubmit').text('Ubah!');
    $('#myModal #myModalForm').attr('action', '<?php echo site_url("pengaturan/komponen/potongan/update") ?>'); 
  });

  $("#tambahPotongan").click(function(){
    $("#myModal").modal("show");
    $('#myModal .modal-header #myModalLabel').text('Form Tambah Potongan atau Bagian');
    $('#myModal .modal-footer #myModalSubmit').text('Tambah!');
    $('#myModal #myModalForm').attr('action', '<?php echo site_url("pengaturan/komponen/potongan/tambah") ?>'); 
  });

  $(".hapus-potongan").click(function(){
    var divID = $(this).attr('data-id');  
    var divName = $(this).attr('data-name');  
    $("#myModal").modal("show");
    $('#myModal .modal-body #namaPotongan').hide();
    $('#myModal .modal-body #optionData').hide();    
    $('#myModal .modal-body label').hide();
    $('#myModal .modal-body #idPotongan').val(divID);
    $('#myModal .modal-header #myModalLabel').text('Hapus Potongan atau Bagian');
    $('#myModal .modal-footer #myModalSubmit').text('Ya, Hapus Saja!');
    $('#myModal #myModalForm').attr('action', '<?php echo site_url("pengaturan/komponen/potongan/hapus") ?>'); 
    $('#myModal .modal-body').prepend('<p id="hapus-notif">Apakah Anda yakin akan menghapus Komponen potongan '+ divName +'???</p>');
  });

  $('#myModal').on('hidden.bs.modal', function(){
    $('#myModal .modal-body #idPotongan').val('');
    $('#myModal .modal-body #namaPotongan').val('');
    $('#myModal .modal-body #namaPotongan').show();
    $('#myModal .modal-body p').remove();
});
          
});
</script>
</body>
</html>