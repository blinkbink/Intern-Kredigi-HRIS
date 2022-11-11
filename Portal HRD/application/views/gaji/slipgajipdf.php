<?php
/*
sterGajiID'  => $masterGajiID,
                                'karyawanID' => $idKaryawan,
                                'periodeAwalDate' => $periodeAwalDate,
                                'periodeAkhirDate' => $periodeAkhirDate
//*/
foreach($var as $u){
        $masterGajiID = $u->masterGajiID;
        $karyawanID = $u->karyawanID;
        $periodeAwalDate = $u->periodeAwalDate;
        $periodeAkhirDate = $u->periodeAkhirDate;
}

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
ob_end_clean();
//$html = $this->load->view('gaji/lamanpdf');
//$html = 'http://dev.kredigi.co.id/~yusuf/index.php/gaji/lamanpdf/9/2/2017-07-23/2017-08-23';
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('gaji_bulanan_tglakhirperiode_kodeidkaryawan_nama.pdf', 'D');
//gaji_bulanan_26-25_Juli_2017-2831-Denny_Hermawan
?>
