<?php 
$this->load->view('template/header');
?>
<!--tambahkan custom css disini-->
<link rel="stylesheet" href="<?=base_url('assets/AdminLTE-2.3.11/plugins/datatables/dataTables.bootstrap.css') ?>">
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Karir & Remunerasi
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Karyawan</a></li>
        <li class="active">Karir & Remunerasi</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-body">
            <table class="table table-hover table-striped" id="datatable">
                <thead>
                <tr class="success">
                  <th>Nama Karyawan</th>
                  <th>Status Karyawan<br>(Grade)</th>
                   <th>Divisi<br>(Jabatan)</th>
                  <th>Tanggal Efektif</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($karir as $key => $value) { ?>

                <tr>
                  <td>  
<div class="pull-left image">
          <img src="http://localhost/gajian/assets/AdminLTE-2.3.11/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" width="40px">
        </div>
                  <a href="<?=site_url('karyawan/detail/'.$key)?>" ><?=$this->Karyawan_model->get_karyawan_detail($key,'nama_lengkap')?></a>
                  <br>Mulai dari 
                  <?php
                  if(!empty($this->Karyawan_model->get_karyawan_detail($key,'mulai_kerja'))){
                    $tglKerja = tgl_indo($this->Karyawan_model->get_karyawan_detail($key,'mulai_kerja'));
                  } else {
                    $tglKerja = '';  
                  }
                  echo $tglKerja;
                  ?></td>
                  <?php if(!empty($value)) {?>
                  <td><?=get_karir_status($value->status_ID)?><br>(<?=$value->grade?>)</td>
                  <td><?=get_data($value->divisi_ID)?><br>(<?=get_data($value->jabatan_ID)?>)</td>
                  <td><?=tgl_indo($value->tgl_efektif)?><br>(<?=get_karir_status($value->tipe_ID)?>)</td>
                  <td>
                    <a href="<?=site_url('karyawan/karir/detail/'.$key)?>" class="btn btn-success btn-sm"  data-toggle="tooltip" title="Lihat Karir">Lihat Karir</a>
                  </td>
                  <?php }
                  else{ ?>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>
                     <a href="<?=site_url('karyawan/karir/tambah/'.$key)?>" class="btn btn-success btn-sm"  data-toggle="tooltip" title="Tambah Karir"></i> Tambah Karir</a>
                  </td>
                  <?php } ?>
                </tr>

                  <?php } ?>
                
                </tbody>
              </table>
        </div><!-- /.box-body -->
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
  });
  </script>

</body>
</html>