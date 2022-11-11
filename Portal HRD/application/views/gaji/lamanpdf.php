<?php
$this->load->library('Pdf');
$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$width = $pdf->pixelsToUnits(812.598425197); //width F4
$height = $pdf->pixelsToUnits(1227.244094488); //heightF4
$resolution = array($width, $height);
$pdf->SetDisplayMode('fullpage', 'SinglePage', 'UseNone');
$pdf->SetFont('times', '', 10); //font-family, 'color', 'size'
$pdf->setFooterMargin(20); //sesuaikan SetAutoPageBreak
$pdf->SetMargins(40, 30, 13, 20, true); //left, top, right, bottom
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(true);
$pdf->SetAutoPageBreak(true, 20); //sesuaikan setFooterMargin
$pdf->SetAuthor('Parvatil Patil');
$pdf->AddPage('L', $resolution); //L, Pob_start();
//$html = '<table><thead>Bahahaha<tr>ran<td>jaaa</td>waw</tr></thead><tbody>';
//foreach(){}
$html = '$masterGajiID='.$masterGajiID.'/'.$periodeAkhirDate;
//$html.='</tbody></table>';
//echo $html;
//ob_start();
//ob_end_clean();
//$html = $this->load->view('gaji/lamanpdf');
//$html = 'http://dev.kredigi.co.id/~yusuf/index.php/gaji/lamanpdf/9/2/2017-07-23/2017-08-23';
//$pdf->writeHTML($html, true, false, true, false, '');
//$pdf->Output('gaji_bulanan_tglakhirperiode_kodeidkaryawan_nama.pdf', 'D');

get_template('header');
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
foreach($var as $u){
	$masterGajiID = $u->masterGajiID;
	$karyawanID = $u->karyawanID;
	$periodeAwalDate = $u->periodeAwalDate;
	$periodeAkhirDate = $u->periodeAkhirDate;
}
//*/
$masterGajiID = $this->uri->segment('3');
$karyawanID = $this->uri->segment('4');
$periodeAwalDate = $this->uri->segment('5');
$periodeAkhirDate = $this->uri->segment('6');
//*/
//*
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

$perusahaanID = $this->session->userdata('perusahaan_ID');

//*/
?>
<?php
$html = '      <div class="user-panel">
        <div class="pull-left image">';
          
         $perusahaan=$this->Perusahaan_model->get(get_user_info('perusahaan_ID'));
              if(!empty($perusahaan->logo_perusahaan)){
                  $html .= '<img src="'.base_url($perusahaan->logo_perusahaan).'" alt="" id="gambar" width="30" height="50">';
              }
              else{
                  $html .= '<img src="'.base_url('assets/AdminLTE-2.3.11/dist/img/avatar5.png').'" alt="" id="gambar" width="30" height="50">';
              }
$html .='          
        </div>
        <div class="pull-left info">
          <p>'.$perusahaan->nama_perusahaan.'</p>
        </div>';
$html .= '
<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-body">
           <div class="panel-body rad-b-n single_panel">

<div id="pilihanGrupGajiContainer">';

//    <?php
    $karir= $this->Slip_gaji_model->get_periodegaji_detail($masterGajiID, $periodeAkhirDate, $karyawanID);
    foreach($karir as $u => $value){
        $gaji=json_decode($value['json_gaji'], TRUE);
        //$arrlength = count($gaji);
        //var_dump($gaji);
        $html .= '<h2>'.$value['nama_lengkap'].' ('.$value['id_karyawan'].')</h2>';
        $html .= '<p>'.$value['nama'].' Periode '.$tanggal_awal.' - '.$tanggal_akhir.'</p>';
        //echo 'gaji json'.$gaji['22'];
    }
$html .= '
    <div class="col-md-6">
        <h4 class="line-t-b">Pendapatan</h4>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-12">
                    <table class="table table-hover table-striped" >
                        <thead>
                         <tr class="success">
                          <th class="text-center">Income</th>
                          <th class="text-center">Unit</th>
                          <th class="text-center">Rate</th>
                          <th class="text-center">Amount</th>
                         </tr>
                        </thead>';
            
            $itemGaji = $this->Slip_gaji_model->getItemGaji($masterGajiID);
            $totalIncome = 0;
            foreach($itemGaji as $gg => $key){
                if($key['kategori_data']=='pendapatan'){
                    if($key['option_data']=='Tergantung Kehadiran' || $key['option_data']=='Uang Lembur'){
                         $rate = $gaji[$key['data_ID']];
                         $income = 0;
                    } else {
                         $rate = '';
                         $income = $gaji[$key['data_ID']];
                    }
            $html .= '
                         <tr>
                          <td>'.$key['nama_data'].'</td>
                          <td class="text-right">0</td>
                          <td class="text-right">';
                               
                                 if(!empty($rate)){
                                         $html .= rupiah($rate);
                                 } 
                $html .= '          </td>
                          <td class="text-right">';
                                
                                if(empty($rate)){
                                       $html .= rupiah($income);
                                } 
$html .= '                          </td>
                     </tr>';
            
                }
                $totalIncome = $income + $totalIncome;
            }
            $html .= '
                        <thead>
                         <tr class="success">
                          <td>Total Income </td>
                          <td></td>
                          <td></td>
                          <td class="text-right">'.rupiah($totalIncome).'</td>
                         </tr>
                        </thead>
                    </table>
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
                          <th class="text-center">Deduction</th>
                          <th></th>
                          <th></th>
                          <th class="text-center">Amount</th>
                         </tr>
                        </thead>';
           
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
           $html .= '
                         <tr>
                          <td class="text-left">'.$nama.'</td>
                          <td></td>
                          <td></td>
                          <td class="text-right">'.rupiah($potong).'></td>
                         </tr>';
            
                //}
            }
            $totalPotongan = $totalPotongan + $potong;
            $thp = $totalIncome - $totalPotongan;
            $html .= '
                         <thead>
                          <tr class="success">
                           <td class="text-left">Total Deduction </td>                                                                        
                           <td></td>
                           <td></td>
                           <td class="text-right">'.rupiah($totalPotongan).'</td>
                          </tr>
                         </thead>
                         <thead>
                          <tr class="success">
                           <td class="text-left">Take Home Pay </td>
                           <td></td>
                           <td></td>
                           <td class="text-right">'.rupiah($thp).'</td>
                          </tr>
                         </thead>
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
    </div><!-- /.box -->

</section><!-- /.content -->';

ob_end_clean();
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('gaji_bulanan_tglakhirperiode_kodeidkaryawan_nama.pdf', 'D');
?>
