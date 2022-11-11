<?php 
get_template('header');
?>
<!--tambahkan custom css disini-->
<?php
get_template('topbar');
get_template('sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Data Karyawan
        <small>Detail</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
<div class="box">
        <?php get_template('header_detail')?>
    <div class="row">
    <div class="col-md-6">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Informasi Kontak</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
           <div class="row">
                                        <div class="col-xs-12">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-striped">
                                                    <tbody>
                                                        <tr>
                                                             <td class="text-right" width="40%">Alamat rumah :</td>
                                                            <td><?=$karyawan->rumah_karyawan?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-right">Kecamatan :</td>
                                                            <td><?=get_kecamatan($karyawan->kecamatan_karyawan)?></td>
                                                        </tr>  
                                                        <tr>
                                                            <td class="text-right">Kabupaten / Kota :</td>
                                                            <td><?=get_kota($karyawan->kota_karyawan)?></td>
                                                        </tr>                                                        
                                                        <tr>
                                                            <td class="text-right">Provinsi :</td>
                                                            <td><?=get_provinsi($karyawan->provinsi_karyawan)?></td>
                                                        </tr>                                                       
                                                        <tr>
                                                            <td class="text-right">Kode Pos :</td>
                                                            <td> <?=$karyawan->kodepos_karyawan?> </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-right">Nama kontak darurat :</td>
                                                            <td><?=$karyawan->kontak_darurat?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-right">No. kontak darurat :</td>
                                                            <td><?=$karyawan->telp_darurat?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div>
<div class="col-md-6">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Rekening Bank, NPWP & BPJS</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
          <div class="row">
                                        <div class="col-xs-12">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-striped">
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-right" width="40%">Nama Bank :</td>
                                                            <td><?=get_bank($karyawan->nama_bank)?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-right">Nama Pemegang Rekening :</td>
                                                            <td><?=$karyawan->nama_rekening?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-right">No. Rekening :</td>
                                                            <td><?=$karyawan->nomor_rekening?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-right">NPWP :</td>
                                                            <td><?=$karyawan->nomor_npwp?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-right">Jenis Pajak :</td>
                                                            <td><?=$karyawan->status_wp?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-right">NPP BPJS Ketenagakerjaan :</td>
                                                            <td><?=$karyawan->bpjs_ketenagakerjaan?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-right">NPP BPJS Kesehatan :</td>
                                                            <td><?=$karyawan->bpjs_kesehatan?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
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

</body>
</html>