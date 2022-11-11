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
        <li class="active">Detail Pengumuman</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Detail Pengumuman</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
        <center>
	<?php foreach($pengumuman as $u){ ?>
		<table style="margin:20px auto;">
			<tr>
                                <td>Waktu</td>
                                <td><input type="text" name="waktu" id="waktu" value="<?=$u->waktu?>" disabled></td>
                        </tr>
			<tr>
				<td>Judul</td>
				<td>
				   <input type="text" name="judul" id="judul" value="<?=$u->judul?>" disabled>
				   <input type="hidden" name="id" id="id" value="<?=$u->idpengumuman?>" disabled>
				</td>
			</tr>
			<tr>
				<td>Pesan</td>
				<td><textarea name="pesan" id="pesan" cols="30" rows="10" disabled><?=$u->pesan_pengumuman?></textarea></td>
			</tr>
			<tr>
                                <td>Oleh</td>
                                <td><input type="text" name="oleh" id="oleh" value="<?=$u->oleh?>" disabled></td>
                        </tr>
		</table>
	<?php } ?>
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
        CKEDITOR.replace('pesan');
</script>

</body>
</html>
