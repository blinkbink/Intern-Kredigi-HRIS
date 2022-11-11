<?php 
$this->load->view('template/header');
?>
<!--tambahkan custom css disini-->
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
  	Buat Pengumuman
        <small>it all starts here</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Pengumuman</a></li>
        <li class="active">Tambah Pengumuman</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Title</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
        <center>
	<form action='<?=site_url().'/pengumuman/tambah_aksi';?>' method="post">
		<table style="margin:20px auto;">
			<tr>
				<td>Judul</td>
				<td><input type="text" name="judul" id="judul"></td>
			</tr>
			<tr>
				<td>Pesan</td>
				<td><textarea name="pesan" id="pesan" cols="30" rows="10"></textarea></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="Tambah"></td>
			</tr>
		</table>
	</form>
	</center>
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
<script src="<?=base_url();?>/assets/AdminLTE-2.3.11/plugins/ckeditor/ckeditor.js"></script>
<script>
	CKEDITOR.replace( 'pesan');
</script>
</body>
</html>
