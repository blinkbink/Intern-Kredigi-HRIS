<?php 
get_template('header');
?>
<!--tambahkan custom css disini-->
<style>
    .grupGajiPaper {
    background: #F0F0F0;
    padding-top: 10px;
    padding-bottom:  10px;
    margin-bottom:  15px;
    margin-top: 20px;
}
.line-t-b {
    border-bottom: 1px solid #9E9E9E;
    padding-bottom: 3px;
}
.karirTitle {
    background: #00a65a;
    width: auto!important;
    margin-top: -25px;
    padding: 10px;
    color: #fff;
}
.control-title {
    padding-top: 7px;
    margin-bottom: 0;
}

</style>

<?php
get_template('topbar');
get_template('sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Data Karyawan
        <small>Karir & Remunerasi</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Karyawan</a></li>
        <li class="active">Karir & Remunerasi</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
<div class="box">
        <?php get_template('header_detail')?>
    <div class="row">
                                        <div class="col-md-12">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Karir & Remunerasi</h3>
            <div class="box-tools pull-right">
                <?php if(($karir->stat_efektif)=='1') {?>
                <a href="<?=site_url('karyawan/karir/tambah/'.$karyawan->karyawan_ID)?>" class="btn btn-sm btn-success"  data-toggle="tooltip" title="Ubah Data Karyawan"><i class="fa fa-plus"></i>  Tambah Karir Baru</a>
            <?php } else {?>
                <a href="<?=site_url('karyawan/karir/view/'.$this->Karyawan_model->get_karir($karyawan->karyawan_ID)->karir_ID)?>" class="btn btn-sm btn-success"  data-toggle="tooltip" title="Lihat Karir Terbaru "><i class="fa fa-file"></i> Lihat Karir Terbaru</a>
             <?php } ?>
            </div>
        </div>
        <div class="box-body">
           <div class="row">
              <div class="col-xs-12">
                <div id="grupGajiContainer">
                
                <div class="table-responsive">
                  <table class="table table-hover table-striped">
                      <tbody>
                          <tr>
                              <td  width="40%">Status Karyawan</td>
                              <td>: <?= get_karir_status($karir->status_ID,'nama_master')?></td>
                          </tr>
                          <tr>
                              <td >Tipe</td>
                              <td>: <?= get_karir_status($karir->tipe_ID,'nama_master')?></td>
                          </tr>
                          <tr>
                              <td >Pekerjaan / Jabatan</td>
                              <td>: <?=get_data($karir->jabatan_ID)?></td>
                          </tr>
                          <tr>
                              <td  width="40%">Divisi / Bagian</td>
                              <td>: <?=get_data($karir->divisi_ID)?></td>
                          </tr>
                          <tr>
                              <td >Golongan / Grade</td>
                              <td>: <?=$karir->grade?></td>
                          </tr>
                          <tr>
                              <td >Tanggal Efektif</td>
                              <td>: <?=tgl_indo($karir->tgl_efektif)?></td>
                          </tr>
                          <tr>
                              <td ></td>
                              <td></td>
                          </tr>
                      </tbody>
                  </table>
              </div>
                
                <div class="row">
                  <div class="col-md-4 col-md-offset-4 col-xs-12 m-b-md text-center">
                    <h4 class="grupGajiTitle">Grup Gaji </h4>
                  </div>
                </div>
                <div id="pilihanGrupGajiContainer">
                <?php 
                  $gaji=json_decode($karir->group_gaji);
                      $arrlength = count($gaji);
                      
                      for($x=0; $x < $arrlength; $x++) {
                        $gaji_json=$this->Karir_model->get($karir->karir_ID)->gaji_detail;
                       $gaji_detail=json_decode($gaji_json);
                        echo '
                         <div class="form-horizontal row pilihanGrupGaji">
                    <div class="col-xs-12">
                      <div class="row">
                        <div class="col-xs-12 grupGajiPaper m-b-md">
                          <div class="row">
                            <div class="col-xs-12">
                              <p class="karirTitle">'.$this->Slip_gaji_model->get($gaji[$x])->master_gaji_nama.'</p>
                            </div>
                          </div>
                          <div class="row">

                             
         <div class="col-md-6">
            <h4 class="line-t-b">Income</h4>';

            $pendapatan= $this->Slip_gaji_model->get_data_detail($gaji[$x],'pendapatan');
            //print_r($pendapatan);
            foreach ($pendapatan as $key => $value) { 
              if($value->option_data=='Tergantung Kehadiran') $rate='Rate'; else $rate='';
             $data_ID=$value->data_ID;
              echo '
                <div class="form-group">
                  <label class="control-title col-md-4 col-xs-12">'.$value->nama_data.'</label>
                  <label class="control-title col-md-2 col-xs-6">'.$rate.'</label>';
                     if($value->option_data=='Manual'){
                        echo ' <div class="col-md-6 col-xs-6 text-right"><label class="control-label"><em>Nilai dimasukkan di slip gaji</em></label></div>';
                     }
                     else{
                      echo ' <div class="col-md-6 col-xs-6 text-right"><label class="control-label"> '.rupiah($gaji_detail->$gaji[$x]->$data_ID).'</label></div>';
                  }
                   echo'
                 
                </div>
              ';
            
           }
           echo'
          </div>
          <div class="col-md-6">
            <h4 class="line-t-b">Deduction</h4>';
            $potongan= $this->Slip_gaji_model->get_data_detail($gaji[$x],'potongan');
            //print_r($pendapatan);
            foreach ($potongan as $key => $value) { 
            
              echo'
                <div class="form-group">
                  <label class="control-title col-md-4 col-xs-12 ">'.$value->nama_data.'</label>
                  <label class="control-title col-md-2 col-xs-6">Nilai</label>
                  <div class="col-md-6 col-xs-6 text-right"><label class="control-label"><em>Nilai dimasukkan di slip gaji</em></label></div>
                </div>
              ';

              
           }
        echo'</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                        ';
                      }

                ?>
                
                                  </div>
              </div>
                                <br>
                                
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
$this->load->view('template/footer');
?>

</body>
</html>
