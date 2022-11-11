<?php
get_template('header');
?>
<!--tambahkan custom css disini-->
<style>
body {
	font-size: 12px;
}
</style>

<?php
//$this->Slip_gaji_model->get_gaji_available($jenis,$bulan,$tahun);

function getNamaBulan($bulan){
  switch ($bulan) {
    case '1': $bulan = 'Jan'; break;
    case '2': $bulan = 'Feb'; break;
    case '3': $bulan = 'Mar'; break;
    case '4': $bulan = 'Apr'; break;
    case '5': $bulan = 'Mei'; break;
    case '6': $bulan = 'Jun'; break;
    case '7': $bulan = 'Jul'; break;
    case '8': $bulan = 'Agu'; break;
    case '9': $bulan = 'Sep'; break;
    case '10': $bulan = 'Okt'; break;
    case '11': $bulan = 'Nov'; break;
    case '12': $bulan = 'Des'; break;
    default: break;
  }
  return $bulan;
}

/*
$masterGajiID = $this->uri->segment('3');
$karyawanID = $this->uri->segment('4');
$periodeAwalDate = $this->uri->segment('5');
$periodeAkhirDate = $this->uri->segment('6');
//*/

$masterGajiID = $this->input->get('idmaster');
$karyawanID = $this->input->get('idkaryawan');
$periodeAwalDate = $this->input->get('dateawal');
$periodeAkhirDate = $this->input->get('dateakhir');

//echo $masterGajiID.'/'.$karyawanID.'/'.$periodeAwalDate.'-'.$periodeAkhirDate;

$tglAwalPisah = explode("-", $periodeAwalDate);
$tgl_awal = $tglAwalPisah[2];
$bln_awal = $tglAwalPisah[1];
$thn_awal = $tglAwalPisah[0];

$tglAkhirPisah = explode("-", $periodeAkhirDate);
$tgl_akhir = $tglAkhirPisah[2];
$bln_akhir = $tglAkhirPisah[1];
$thn_akhir = $tglAkhirPisah[0];

$bln_awal = getNamaBulan($bln_awal);
$bln_akhir = getNamaBulan($bln_akhir);

$tanggal_awal = $tgl_awal.' '.$bln_awal.' '.$thn_awal;
$tanggal_akhir = $tgl_akhir.' '.$bln_akhir.' '.$thn_akhir;
//*/
?>

<!-- kop perusahaan -->
<div class="user-panel">
<?php
$perusahaan=$this->Perusahaan_model->get(get_user_info('perusahaan_ID'));
if(!empty($perusahaan->logo_perusahaan)){ ?>
  <img src=<?=base_url($perusahaan->logo_perusahaan)?> alt="" id="gambar" width="30" height="50">
<?php } else { ?>
  <img src=<?=base_url('assets/AdminLTE-2.3.11/dist/img/avatar5.png')?> alt="" id="gambar" width="30" height="50">
<?php } ?>
  <p><?=$perusahaan->nama_perusahaan?></p>
  <hr>
</div>

<div class="col-md-6">
<div class="col-xs-12">
  <div class="table-responsive">
    <table>
      <tbody>
        <tr>
          <td class="text-right"><?=$karyawan->nama_lengkap?> (<?=$karyawan->karyawan_ID?>)</td>
        </tr>
        <tr>
          <td class="text-right"><?=$karyawan->rumah_karyawan.' '.get_kecamatan($karyawan->kecamatan_karyawan).' '.get_kota($karyawan->kota_karyawan).' '.get_provinsi($karyawan->provinsi_karyawan).' '.$karyawan->kodepos_karyawan?></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
</div>

<div class="col-md-6">
<table>
<thead>
<tr class="success">
 <th colspan="2" class='text-center'>Payroll Slip - Information</th>
</tr>
</thead>
<tr>
<td>Bulan : </td>
<td><?=$tanggal_akhir?></td>
</tr>
<tr>
<td>Kantor : </td>
<td><?=$perusahaan->nama_perusahaan?></td>
</tr>
<tr>
<td>Pekerjaan : </td>
<td><?=$karir->jabatan_ID?></td>
</tr>
<tr>
<td>Divisi : </td>
<td><?=$karir->divisi_ID?></td>
</tr>
<tr>
<td>Status/Periode : </td>
<td><?=$karir->tipe_ID?></td>
</tr>
<tr>
<td>Grade : </td>
<td><?=$karir->grade?></td>
</tr>
</table>
</div>
<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Slip Gaji</h3>
    </div>
    <div class="box-body">
      <div class="panel-body rad-b-n single_panel">
        <div id="pilihanGrupGajiContainer">
<?php
$totalIncome = 0;
$pendapatan = 0;
$karir= $this->Slip_gaji_model->get_periodegaji_detail($masterGajiID, $periodeAkhirDate, $karyawanID);

echo '<h2>'.$karir[0]['nama_lengkap'].'('.$karir[0]['id_karyawan'].')</h2>';
echo '<p>'.$karir[0]['nama'].' Periode '.$tanggal_awal.' - '.$tanggal_akhir.'</p>';
?>
          <div class="col-md-6">
            <h4 class="line-t-b">Pendapatan</h4>
<?php
foreach($karir as $u => $value){
?>
            <div class="form-group">
              <div class="row">
                <div class="col-xs-12">
                  <table class="table table-hover table-striped" >
                    <thead>
                      <tr class="success">                        
                      <?php if ($value['jumlahRow']>1){ ?>
                        <th class='text-center'>Income (<?=$value['tglEfektif']?>)</th>
                      <?php } else { ?>
                        <th class='text-center'>Income</th>
                      <?php } ?>
                        <th class='text-center'>Unit</th>
                        <th class='text-center'>Rate</th>
                        <th class='text-center'>Amount</th>
                      </tr>
                    </thead>
<?php
  $gaji=json_decode($value['json_gaji'], TRUE);
  $itemGaji = $this->Slip_gaji_model->getItemGaji($masterGajiID);
  //$totalIncome = 0;
  //$pendapatan = 0;
  foreach($itemGaji as $gg => $key){
    if($key['kategori_data']=='pendapatan'){
      if($key['option_data']=='Tergantung Kehadiran' || $key['option_data']=='Uang Lembur'){
        $rate = $gaji[$key['data_ID']];
        $namaItem = $key['nama_data'];
        //echo 'id_periode : '.$value['periode_gaji_id'];
        //echo ' data_id : '.$key['data_ID'].'<br>';

        $unitQ = $this->Slip_gaji_model->getUnit($value['periode_gaji_id'], $key['data_ID']);
        //var_dump($unitQ);
        if(!empty($unitQ[0]['jumlahRow'])){
          $unit = $unitQ[0]['unit'];
        } else {
          $unit = 0;
        }
        $income = $unit * $rate;
        //$pendapatan = $income + $pendapatan;
      } else {
        $rate = '';
        $income = $gaji[$key['data_ID']];
        $unit = '';
        if($value['jumlahRow']>1){
          $namaItem = $key['nama_data'].' ('.$value['tglEfektif'].')';
        } else {
          $namaItem = $key['nama_data'];
        }
        $pendapatan = $income + $pendapatan;
      }
      //$totalIncome = $income + $totalIncome;
?>
                      <tr>
                        <td><?=$namaItem?> </td>
                        <td class='text-right'><?=$unit?></td>
                        <td class='text-right'>
                        <?php
                         if(!empty($rate)){
                                 echo rupiah($rate);
                        } ?>
                        </td>
                        <td class='text-right'>
                              <?php echo rupiah($income);?>
                        </td>
                      </tr>
<?php
    } //close IF kategori_data PENDAPATAN
    $totalIncome = $income + $totalIncome;
  }//close foreach $itemGaji
}//close foreach karir
?>
                    <thead>
                      <tr class="success">
                        <td>Total Income </td>
                        <td></td>
                        <td></td>
                        <td class='text-right'><?=rupiah($totalIncome)?></td>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <h4 class="line-t-b">Potongan</h4>
            <div class="form-group">
              <div class="row">
                <div class="col-xs-12">
                  <table style="width: 430px;" class="table table-hover table-striped" >
                    <thead>
                      <tr class="success">
                        <th class='text-center'>Deduction</th>
                        <th></th>
                        <th></th>
                        <th class='text-center'>Amount</th>
                      </tr>
                    </thead>
  <?php
  $itemGaji = $this->Slip_gaji_model->getItemGaji($masterGajiID);
  $totalPotongan = 0;
  foreach($itemGaji as $gg => $key){
    if($key['kategori_data']=='potongan'){
      $nama = $key['nama_data'];
      $potong = $gaji[$key['data_ID']];
    } else {
      $nama = 'Potongan';
      $potong = 0;
    }
  ?>
                        <tr>
                          <td class='text-left'><?=$nama?> </td>
                          <td></td>
                          <td></td>
                          <td class='text-right'><?=rupiah($potong)?></td>
                        </tr>
  <?php
  }
  $totalPotongan = $totalPotongan + $potong;
  $thp = $totalIncome - $totalPotongan;
?>
                    <thead>
                      <tr class="success">
                        <td class="text-left">Total Deduction </td>
                        <td></td>
                        <td></td>
                        <td class='text-right'><?=rupiah($totalPotongan)?></td>
                      </tr>
                    </thead>
                    <thead>
                      <tr class="success">
                        <td class="text-left">Take Home Pay </td>
                        <td></td>
                        <td></td>
                        <td class='text-right'><?=rupiah($thp)?></td>
                      </tr>
                    </thead>
                  </table>
                  <table frame="box">
                    <tr>
                      <td colspan= 2>&nbsp;Tanggal :</td>
                    </tr>
                    <tr>
                      <td height="15%">&nbsp;Mengetahui/Menyetujui&nbsp;</td>
                    </tr>
                    <tr>
                      <td><pre class="nostyle">(                 )</pre></td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- pilihanGrupGajiContainer -->
      </div> <!-- close panel body -->
    </div><!-- /.box-body -->
  </div><!-- /.box -->
  <div class="box-footer">

  </div><!-- /.box-footer-->
</section><!-- /.content -->
