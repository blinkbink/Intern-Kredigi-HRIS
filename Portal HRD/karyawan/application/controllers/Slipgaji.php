<?php
/**
 * Created by PhpStorm.
 * User: asass
 * Date: 04/08/2017
 * Time: 16:35
 */

class slipgaji extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model("karyawan_model");
        $this->load->model("slipgaji_model");
        $this->load->library("Pdf_Library");
        if(!isset($_SESSION['username']))
        {
            redirect(base_url()."");
        }
    }

    public function index()
    {
        $profile = $this->karyawan_model->getProfile();

        foreach ($profile as $p)
        {
            $id = $p['idkaryawan'];
        }
        $notifikasi = $this->karyawan_model->getNotifikasi($id);
        $total = $this->karyawan_model->getCountNotifikasi($id);

        $slipgaji = $this->slipgaji_model->getSlipGaji($id);
        $this->load->view('slipgaji/slipgaji', array('profile' => $profile, 'slipgaji' => $slipgaji, 'notifikasi' => $notifikasi, 'total' => $total));
    }

    public function report($id_slip)
    {

        $slip = $this->slipgaji_model->reportSlipGaji($id_slip);

        foreach ($slip as $data)
        {
            $kode = $data['idkaryawan'];
            $nama = $data['nama'];
            $NPWP = $data['NPWP'];

            $gaji_pokok = $data['gaji_pokok'];
            $uang_lembur = $data['uang_lembur'];
            $tunjangan_game = $data['tunjangan_game'];
            $tunjangan_makan = $data['tunjangan_makan'];
            $THR = $data['THR'];
            $tunjangan_transportasi = $data['tunjangan_transportasi'];
            $tunjangan_keluarga = $data['tunjangan_keluarga'];
            $NPP_BPJS_Ketenagakerjaan = $data['NPP_BPJS_Ketenagakerjaan_v'];
            $NPP_BPJS_Kesehatan = $data['NPP_BPJS_Kesehatan_v'];

            $PPh21 = $data['potonganPPh21'];
            $pinjaman = $data['pinjaman'];
            $pajak = $data['pajak'];
            $ketidakhadiran = $data['ketidakhadiran'];

            $pendapatan = $gaji_pokok + $uang_lembur + $tunjangan_game + $tunjangan_makan + $THR + $tunjangan_transportasi + $tunjangan_keluarga + $NPP_BPJS_Ketenagakerjaan + $NPP_BPJS_Kesehatan;
            $pemotongan = $PPh21 + $pinjaman +  $pajak + ($ketidakhadiran*1);

            $total = $pendapatan - $pemotongan ;
            $hasil = number_format($total, 2, '.', '.');

            $periode = date('m/Y', strtotime($data['tanggal']));
            $bagian = $data['bagian'];
        }


        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('PT. Kreasi Digital Sinergi');
        $pdf->SetTitle('PT. Kreasi Digital Sinergi');
        $pdf->SetSubject('Slip Gaji');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // set default header data
        $pdf->SetHeaderData('logo.png', "25", "PT. Kreasi Digital Sinergi", "Slip Gaji Karyawan");

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', "19"));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, "50", PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

// ---------------------------------------------------------

        // set font
        $pdf->SetFont('dejavusans', '', 10);

        // add a page
        $pdf->AddPage();

        $heading = <<<EOD
        
        <style>
table, th, td {
   
    padding: 5px;
}
table {
    border-spacing: 150px;
}
</style>
        <table style="width:100%">
        <tr>
            <td>NIK</td>
            <td>: {$kode}</td>
            <td>Jabatan</td>
            <td>: {$bagian}</td>
  
        </tr>
        <tr>
            <td>Nama</td>
            <td>: {$nama}</td>
            <td>NPWP</td>
            <td>: {$NPWP}</td>
        </tr>
        <tr>
            <td>Tanggal/Periode</td>
            <td>: $periode</td>
        </tr>
        </table>
<br><br><br><br>
EOD;

        $content2 = <<<EOD
        <style>
            table, th, td {
               
                padding: 5px;
            }
            table {
                border-spacing: 150px;
            }
        </style>
<br>

    <table>
    <tr>
   
    <hr>
        <td><h2>Pendapatan</h2></td>
        
        <td></td>
        <td><h2>Pemotongan</h2></td>
        <td></td>
        <hr>
    </tr>
  
    </table>
<table>
    <tr>
        <td>Gaji Pokok</td>
        <td>Rp. {$gaji_pokok}</td>
        <td>Potongan PPh21</td>
        <td>Rp. {$PPh21}</td>
    </tr>
    <tr>
        <td>Uang Lembur</td>
        <td>RP. {$uang_lembur}</td>
        <td>Pinjaman</td>
        <td>Rp. {$pinjaman}</td>
    </tr>
    <tr>
        <td>Tunjangan Game</td>
        <td>Rp. {$tunjangan_game}</td>
        <td>Pajak</td>
        <td>Rp. {$pajak}</td>
    </tr>
    <tr>
        <td>Tunjangan Makan</td>
        <td>Rp. {$tunjangan_makan}</td>
        <td>Ketidakhadiran</td>
        <td>Rp. {$ketidakhadiran}</td>
    </tr>
    <tr>
        <td>THR</td>
        <td>Rp. {$THR}</td>
    </tr>
    <tr>
        <td>Tunjangan Transportasi</td>
        <td>Rp. {$tunjangan_transportasi}</td>
    </tr>
    <tr>
        <td>Tunjangan Keluarga</td>
        <td>Rp. {$tunjangan_keluarga}</td>
    </tr>
    <tr>
        <td>NPP BPJS Ketenagakerjaan</td>
        <td>Rp. {$NPP_BPJS_Ketenagakerjaan}</td>
    </tr>
    <tr>
        <td>NPP BPJS Kesehatan</td>
        <td>Rp. {$NPP_BPJS_Kesehatan}</td>
    </tr>
    
<hr>
    <tr>
    <td>Total Pendapatan</td>
    <td>Rp. {$pendapatan}</td>
    </tr>
    <tr>
    <td>Total Pemotongan</td>
    <td>Rp. {$pemotongan}</td>
    </tr>
    <hr>
    <tr>
    <td>Total</td>
    <td>Rp. {$hasil}</td>
    </tr>
</table>

EOD;

        $tertanda = <<<EOD
        <br><br><br><br><br><br><br><br><br>
        <table align="center">
            <tr>
                <td>Bekasi, ........................</td>
                <td>Bekasi, ........................</td>
            </tr>
        </table>
        <br><br><br><br>
        <table align="center">
            <tr>
                <td>{$nama}</td>
                <td>HRD</td>
            </tr>
        </table>

EOD;
        $pdf->writeHTMLCell(0,1,'','', $heading, 0, 9, 0, true, '', true);
        $pdf->writeHTMLCell(0,1,'','', $content2, 1, 9, 0, true, '', true);
        $pdf->writeHTMLCell(0,1,'','', $tertanda, 0, 9, 0, true, '', true);

        ob_clean();
        $pdf->Output("PT. Kreasi Digital Sinergi.pdf", "I");
        end_ob_clean();
    }
}