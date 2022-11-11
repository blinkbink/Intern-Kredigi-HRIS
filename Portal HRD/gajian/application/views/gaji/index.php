<?php 
get_template('header');
?>
<!--tambahkan custom css disini-->

<?php
get_template('topbar');
get_template('sidebar');
$bulan= isset($bulan) ? $bulan : date('m');
$tahun= isset($tahun) ? $tahun : date('Y');
$jenis= isset($jenis) ? $jenis : '';
$backBulan= ($bulan!=1) ? ($bulan-1) : '12';
$backTahun= ($bulan!=1) ? ($tahun) : ($tahun-1);
$nextBulan= ($bulan!=12) ? ($bulan+1) : '1';
$nextTahun= ($bulan!=12) ? ($tahun) : ($tahun+1);
$this->Slip_gaji_model->get_gaji_available($jenis,$bulan,$tahun);
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Blank page
        <small>it all starts here</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
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
           <div class="panel-body rad-b-n single_panel">
                        <h4 class="m-b-sm m-t-n">Grup Gaji </h4>
                        <div class="row">
                            <div class="col-md-9">
                                <form class="form-inline" action="<?=site_url('gaji/option/')?>" method="GET" id="opsi_gaji">
                                    <div class="form-group">
                                        <select name="jenis" class="form-control gaji_option" onchange="this.form.submit()">
                                            <option value=""> = Semua = </option>
                                            <?php
                                                $gaji=get_data_db_by('Slip_gaji',array('perusahaan_ID'=>get_user_info('perusahaan_ID')));
                                                foreach ($gaji as $key => $value) {
                                                    echo '<option '.is_selected($jenis,$value->master_gaji_ID).' value="'.$value->master_gaji_ID.'">'. $value->master_gaji_nama.'</option>';
                                                }
                                            ?>                                     
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <button type="button" class="btn btn-default form-control gaji_option" onclick="document.location='<?=site_url('gaji/option/?jenis='.$jenis.'&bulan='.$backBulan.'&tahun='.$backTahun)?>'" title="Go To <?= bulan($backBulan).' '.$backTahun?>"><i class="fa fa-chevron-left"></i></button>
                                    </div>
                                    <div class="form-group">
                                        <select name="bulan" class="form-control gaji_option" onchange="this.form.submit()">
                                            <?php
                                            for ($i=1; $i <= 12; $i++) { 
                                                echo '<option '.is_selected($i,$bulan).' value="'.$i.'">'.bulan($i).'</option>';
                                            }
                                            ?>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                        <select name="tahun" class="form-control gaji_option" onchange="this.form.submit()">
                                            <?php
                                            for ($i=$tahun; $i <= date('Y'); $i++) { 
                                                echo '<option '.is_selected($i,$tahun).' value="'.$i.'">'.$i.'</option>';
                                            }
                                            ?>   
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-default form-control gaji_option" onclick="document.location='<?=site_url('gaji/option/?jenis='.$jenis.'&bulan='.$nextBulan.'&tahun='.$nextTahun)?>'" title="Go To <?= bulan($nextBulan).' '.$nextTahun?>"><i class="fa fa-chevron-right"></i></button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-sm btn-success pull-right m-b-sm" id="buatSlipGaji">Generate Slip Tidak Tetap </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <table class="table table-hover table-striped" >
                                    <thead>
                                    <tr class="success">
                                      <th class='text-center'>Group Gaji</th>
                                      <th class='text-center'>Periode</th>
                                      <th class='text-center'>Jumlah Personil</th>
                                      <th class='text-center'>Status Kelengkapan</th>   
                                      <th class='text-center'>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $gajiAvailable=$this->Slip_gaji_model->get_gaji_available_test($jenis,$bulan,$tahun);
                                        foreach ($gajiAvailable as $key => $value) { ?>
                                    <tr>
                                      <td class='text-center'><?=$value['nama']?></td>
                                      <td class='text-center'><?=$value['periode_awal']." - ".$value['periode_akhir']?></td>
                                      <td class='text-center'><?=$value['jumlah']?></td>
                                      <td class='text-center'>Belum Lengkap</td>   
                                      <td class='text-center'>
                                        <div class="btn-group">
                                         
                                          <button type="button" class="btn btn-sm btn-info hapus-karyawan" >
                                            Lihat Daftar Slip HAHAHAHAHAH
                                          </button>
                                        </div>
                                      </td>
                                    </tr>
                                    <?php } ?>

                
                
                </tbody>
              </table>
                            </div>
                        </div>
                    </div>
        </div><!-- /.box-body -->
        <div class="box-footer">
            Footer
        </div><!-- /.box-footer-->
    </div><!-- /.box -->

</section><!-- /.content -->

<?php 
get_template('footer');
?>
<!--tambahkan custom js disini-->
</script>
</body>
</html>
