<?php
get_template('header');
?>
<!--tambahkan custom css disini-->

<?php
get_template('topbar');
get_template('sidebar');
?>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Detail Pola Kerja</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="panel-body rad-b-n single_panel">
                <div id="pilihanGrupGajiContainer">
<table>
   <tr><td>Nama Pola Kerja</td><td>&nbsp;:&nbsp;</td><td><?=$pola_kerja[0]['nama_polker']?></td></tr>
   <tr><td>Lama Pola</td><td>&nbsp;:&nbsp;</td><td><?=$pola_kerja[0]['totalHari']?> hari</td></tr>
   <tr><td>Toleransi Keterlambatan</td><td>&nbsp;:&nbsp;</td><td><?=$pola_kerja[0]['toleransi']?> menit</td></tr>
</table>
                    <div style="float: right; width: 25%;">
                    </div>
                    <div class="col-md-6">
                        <h4 class="line-t-b">Pendapatan</h4>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-12">
                                    <table class="table table-hover table-striped" >
                                        <thead>
                                         <tr class="success">
                                          <th class='text-center'>Hari Ke-</th>
                                          <th class='text-center'>Status Kerja</th>
                                          <th class='text-center'>Jam Masuk</th>
                                          <th class='text-center'>Jam Keluar</th>
                                         </tr>
                                        </thead>
                                         
<?php
foreach($pola_kerja_hari as $u => $value){
?>
					<tr>
                                          <td class='text-center'><?=$value['hari_ke']?> </td>
                                          <td class='text-center'><?=$value['jenis_hari']?></td>
                                          <td class='text-center'><?=$value['jam_mulai']?></td>
                                          <td class='text-center'><?=$value['jam_selesai']?></td>
					</tr>
<?php } ?>
                                         
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.panel-body -->
    </div><!-- /.box-body -->
    <div class="box-footer">

    </div><!-- /.box-footer-->
</section><!-- /.content -->

<?php
get_template('footer');
?>
