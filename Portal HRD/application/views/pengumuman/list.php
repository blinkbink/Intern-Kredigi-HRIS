<?php 
$this->load->view('template/header');
?>
<!--tambahkan custom css disini-->
<link rel="stylesheet" href="<?=base_url('assets/AdminLTE-2.3.11/plugins/datatables/dataTables.bootstrap.css') ?>">
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
var_dump($_POST);
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Pengumuman
        <small>it all starts here</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Pengumuman</a></li>
        <li class="active">Pengumuman</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Pengumuman</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
	<div class="box-header box-tools pull-left">
                <a href='<?php echo site_url("pengumuman/tambah");?>' class="btn  btn-md btn-success  pull-right" ><i class="fa fa-plus"></i> Tambah Pengumuman</a>
        </div>
        <div class="box-body">
	      <table class="table table-hover table-striped" id="datatable">
                <thead>
                <tr class="success">
                  <th>Waktu</th>
                  <th>Judul</th>
		  <th>Oleh</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($user as $value) { ?>
                <tr>
                  <td><?=$value->waktu?></td>
                  <td><?=$value->judul?></td>
                  <td><?=$value->oleh?></td>
                  <td>
                    <div class="btn-group">
                      <a href="<?=site_url('pengumuman/detail/'.$value->idpengumuman)?>" type="button" class="btn btn-sm btn-info" >
                        <i class="fa fa-file" data-toggle="tooltip" data-placement="bottom" role="presentation" title="Detail"></i>
                      </a>
                      <a href="<?=site_url('pengumuman/edit/'.$value->idpengumuman)?>" type="button" class="btn btn-sm btn-warning" >
                        <i class="fa fa-pencil" data-toggle="tooltip" data-placement="bottom" role="presentation" title="Ubah"></i>
                      </a>
                      <button type="button" class="btn btn-sm btn-danger hapus-pengumuman" data-id="<?=$value->idpengumuman?>" data-karir="0" waktuj="<?=$value->waktu?>" judulj="<?=$value->judul?>" olehj="<?=$value->oleh?>">
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
                            <h4 class="modal-title" id="myModalLabel">Hapus Pengumuman</h4>
                          </div>
                          <div class="modal-body">
                            <input type="hidden" name="id_data" id="id_data" value="">
			    <tr>
				<td><input type="text" id="jwaktu" value="" disabled></td>
				<td><input type="text" id="jjudul" value="" disabled></td>
				<td><input type="text" id="joleh" value="" disabled></td>
			    </tr>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary" id="myModalSubmit">Ya, Hapus Saja!</button>
                          </div>
                        </form>
                      </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                  </div><!-- /.modal -->
        </div><!-- /.box-body -->
        <div class="box-footer">
            Footer
        </div><!-- /.box-footer-->
    </div><!-- /.box -->

</section><!-- /.content -->

<?php 
$this->load->view('template/footer');
?>
<!--tambahkan custom js disini-->
<script src="<?=base_url('assets/AdminLTE-2.3.11/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?=base_url('assets/AdminLTE-2.3.11/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
<script>
  $(function () {
    $('#datatable').DataTable();

    $(".hapus-pengumuman").click(function(){
        var divID = $(this).attr('data-id');  
        var divKarir = $(this).attr('data-karir');
	var divWaktu = $(this).attr('waktuj');
        var divJudul = $(this).attr('judulj');
        var divOleh = $(this).attr('olehj');
        $("#myModal").modal("show");
        
        if(divKarir == '0'){
          $('#myModal .modal-body #id_data').val(divID);
          $('#myModal .modal-body #jwaktu').val(divWaktu);
          $('#myModal .modal-body #jjudul').val(divJudul);
          $('#myModal .modal-body #joleh').val(divOleh);
          $('#myModal .modal-footer #myModalSubmit').show(); 
          $('#myModal #myModalForm').attr('action', '<?=site_url("/pengumuman/hapus/")?>'); 
          $('#myModal .modal-header #myModalLabel').text('Hapus Pengumuman');
          $('#myModal .modal-body').prepend('<p id="hapus-notif">Apakah Anda yakin akan menghapus Pengumuman ini ???</p>');
        } else {
          $('#myModal .modal-header #myModalLabel').text('Data Pengumuman gagal dihapus');
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
