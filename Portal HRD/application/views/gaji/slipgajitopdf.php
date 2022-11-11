<!--tambahkan custom css disini-->

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
//*
$masterGajiID = $this->uri->segment('3');
$karyawanID = $this->uri->segment('4');
$periodeAwalDate = $this->uri->segment('5');
$periodeAkhirDate = $this->uri->segment('6');
/*/
$masterGajiID = $this->input->get('idmaster');
$karyawanID = $this->input->get('idkaryawan');
$periodeAwalDate = $this->input->get('dateawal');
$periodeAkhirDate = $this->input->get('dateakhir');
//*/
//echo $masterGajiID.'/'.$karyawanID.'/'.$periodeAwalDate.'-'.$periodeAkhirDate;

$tglAwalPisah = explode("-", $periodeAwalDate);
$tgl_awal = $tglAwalPisah[2];
$bln_awal = $tglAwalPisah[1];
$thn_awal = $tglAwalPisah[0];

$tglAkhirPisah = explode("-", $periodeAkhirDate);
$tgl_akhir = $tglAkhirPisah[2];
$bln_akhir = $tglAkhirPisah[1];
$thn_akhir = $tglAkhirPisah[0];

//tanggal untuk perhitungan absensi
$dateAwal = $thn_awal.'-'.$bln_awal.'-'.$tgl_awal;
$dateAkhir = $thn_akhir.'-'.$bln_akhir.'-'.$tgl_akhir;

//echo "tglAwal: ".$dateAwal." sama tglakhir: ".$dateAkhir;

//tanggal untuk tampilan
$bln_awal = getNamaBulan($bln_awal);
$bln_akhir = getNamaBulan($bln_akhir);

$tanggal_awal = $tgl_awal.' '.$bln_awal.' '.$thn_awal;
$tanggal_akhir = $tgl_akhir.' '.$bln_akhir.' '.$thn_akhir;
//*/
?>
<!-- Content Header (Page header) -->
<section class="content-header">
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
</section>

<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Slip Gaji</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
      <div class="panel-body rad-b-n single_panel">
        <div id="pilihanGrupGajiContainer">
<?php
$totalIncome = 0;
$pendapatan = 0;
$karir= $this->Slip_gaji_model->get_periodegaji_detail($masterGajiID, $periodeAkhirDate, $karyawanID);
//var_dump($karir);
echo '<h2>'.$karir[0]['nama_lengkap'].' ('.$karir[0]['id_karyawan'].')</h2>';
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
//echo $key['option_data']." and ".$key['kategori_data'];
//var_dump($gaji);
//echo "nilai pendapatan ".$gaji[$key['data_ID']];
//Menghitung nilai pendapatan 
    if($key['kategori_data']=='pendapatan'){
      if($key['option_data']=='Tergantung Kehadiran' || $key['option_data']=='Uang Lembur'){
        $rate = $gaji[$key['data_ID']];
        $namaItem = $key['nama_data'];
	/*
        echo '<br> id_periode : '.$value['periode_gaji_id'];
        echo ' data_id : '.$key['data_ID'].'<br>';
	echo 'rate duit: '.$rate;
	echo 'namaduit: '.$namaItem.'<br>';
	//*/

	//Menghitung unit pendapatan tergantung kehadiran/lembur
        $unitQ = $this->Slip_gaji_model->getUnit($value['periode_gaji_id'], $key['data_ID']);
        //echo "unitQ: ".var_dump($unitQ)."end. ";
	//echo "jumlah Row: ".$unitQ[0]['jumlahRow'];
        //if(!empty($unitQ[0]['jumlahRow'])){
	if(!empty($unitQ)){
          $unit = $unitQ[0]['unit'];
        } else { //jika tidak ada hasilnya di tabel unit_gaji, cek absensi
	  $absensi = $this->Absensi_model->getDataAbsensiRekap($karir[0]['kode_absensi'],$dateAwal, $dateAkhir);
	  if($key['option_data']=='Tergantung Kehadiran'){
	     $unit = $absensi[0]['totalAbsensi'] + $absensi[0]['kerjaSabtu'];
	  } elseif($key['option_data']=='Uang Lembur'){
	     $unit = $absensi[0]['totalLembur'] + $absensi[0]['lemburSabtu'];
	  } else {
             $unit = 0;
	  }//*/
		//$unit = 0;
        }
        $income = $unit * $rate;
        //$pendapatan = $income + $pendapatan;
      } else {
	//$rate = $gaji[$key['data_ID']];
        //$namaItem = $key['nama_data'];
        $rate = '';
        $income = $gaji[$key['data_ID']];
//echo "<br>waaa incom: ".$income;
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
    //} //close IF kategori_data PENDAPATAN
    $totalIncome = $income + $totalIncome;
    }
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
      //if(!empty()){
      //if(!empty($key['nama_data'])){
      	$nama = $key['nama_data'];
	if($key['option_data']=='Manual'){
	   if(!empty($gaji[$key['data_ID']])){
                $potong = $gaji[$key['data_ID']];
           } else {
                $potong = 0;
           }
	} else {
	   $potong = $gaji[$key['data_ID']];
	}
     /* } else {
        $nama = 'Potongan';
        $potong = 0;
      }//*/
    //}
  ?>
                        <tr>
                          <td class='text-left'><?=$nama?> </td>
                          <td></td>
                          <td></td>
                          <td class='text-right'><?=rupiah($potong)?></td>
                        </tr>
  <?php
  $totalPotongan = $totalPotongan + $potong;
  } /*else {
        $potong = 0;
  }*/
  //$totalPotongan = $totalPotongan + $potong;
  }
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
