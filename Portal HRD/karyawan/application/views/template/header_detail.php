
<div class="box-header">
            <div class="row">
                <div class="col-xs-12">
                    <div class="btn-group" role="group" aria-label="">
                        <button type="button" onclick="location.href='<?=site_url('karyawan/detail/'.$karyawan->karyawan_ID)?>'" class="btn btn-success btn-lg">Data Personal</button>
                        <button type="button" onclick="location.href='<?=site_url('karyawan/karir/detail/'.$karyawan->karyawan_ID)?>'" class="btn btn-warning btn-lg">Karir &amp; Remunerasi</button>
                        <button type="button" onclick="location.href='<?=site_url('absensi/personal/'.$karyawan->karyawan_ID)?>'" class="btn btn-warning btn-lg">Kehadiran</button>
                        <button type="button" onclick="location.href='<?=site_url('gaji/personal/'.$karyawan->karyawan_ID)?>'" class="btn btn-warning btn-lg">Slip Gaji &amp; THR</button>
                        <button type="button" class="btn btn-warning btn-lg">Cuti Tahunan</button>
                        <button type="button" class="btn btn-warning btn-lg">Unpaidleave</button>
                        <button type="button" class="btn btn-warning btn-lg">Sakit</button>
                        <button type="button" class="btn btn-warning btn-lg">Izin</button>
                        <button type="button" class="btn btn-warning btn-lg">Kasbon</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-body">

    <!-- Default box -->
    <div class="box <?php if(get_segment(2)!='detail') echo 'collapsed-box"'?>">
        <div class="box-header with-border">
            <h3 class="box-title"><?=$karyawan->nama_lengkap?><br><small><?=$karyawan->nomor_induk?></small></h3>
            <div class="box-tools pull-right">
                <?php if(get_segment(2)=='detail') {?>
                <a href="<?=site_url('karyawan/edit/'.$karyawan->karyawan_ID)?>" class="btn btn-sm btn-success"  data-toggle="tooltip" title="Ubah Data Karyawan"><i class="fa fa-pencil"></i>  Ubah Data Karyawan</a>
            <?php } else {?>
                 <button class="btn btn-sm btn-success" data-widget="collapse" data-toggle="tooltip" title="Lihat Data Karyawan"><i class="fa fa-plus"></i> Lihat Data Karyawan</button>
             <?php } ?>
            </div>
        </div>
        <div class="box-body" <?php if(get_segment(2)!='detail') echo 'style="display: none;"'?>>
           <div class="row">
                                        <div class="col-xs-12">
                                            
                                            <div class="row" id="person_basic_detail_explanation">
                                                <div class="col-lg-3 col-xs-12">
                                                <?php
                                                    if(!empty($karyawan->profil_picture)){
                                                        echo '<img src="'.base_url('uploads/'.get_user_info('perusahaan_ID').'/'.$karyawan->profil_picture.'').'" alt="" id="gambar" class="foto-personalia pull-right">';
                                                    }
                                                    else{
                                                        echo '<img src="'.base_url('assets/AdminLTE-2.3.11/dist/img/avatar5.png').'" alt="" id="gambar" class="foto-personalia pull-right">';
                                                    }
                                                ?>
                                                    
                                                </div>
                                                <div class="col-lg-4 col-xs-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="text-right" width="40%">Pekerjaan :</td>
                                                                    <td><?= $this->Karyawan_model->get_karir($karyawan->karyawan_ID,'jabatan_ID')?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-right">Bagian :</td>
                                                                    <td><?= $this->Karyawan_model->get_karir($karyawan->karyawan_ID,'divisi_ID')?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-right">Jenis Kelamin :</td>
                                                                    <td><?=get_JK($karyawan->jenis_kelamin)?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-right">Status Perkawinan :</td>
                                                                    <td><?=ucfirst($karyawan->status_perkawinan)?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-right">Email :</td>
                                                                    <td><?=$karyawan->email_karyawan?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-right">No. Hp :</td>
                                                                    <td><?=$karyawan->hp_karyawan?></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class=" col-lg-5 col-xs-12 table_continue">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="text-right" width="40%">Golongan Darah :</td>
                                                                    <td><?=$karyawan->golongan_darah?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-right">Agama :</td>
                                                                    <td><?=ucfirst($karyawan->opt_agama)?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-right"> No. KTP  </td><td><?=$karyawan->nomor_ktp?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-right">Tgl. mulai kerja :</td>
                                                                    <td><?=tgl_indo($karyawan->mulai_kerja)?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-right">Pendidikan Terakhir :</td>
                                                                    <td><?=$karyawan->pend_terakhir?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-right">Institusi Pendidikan :</td>
                                                                    <td><?=$karyawan->institusi_pend?></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
        </div><!-- /.box-body -->
    </div><!-- /.box -->