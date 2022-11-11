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
        if(!isset($_SESSION['username']))
        {
            redirect(base_url()."");
        }
        $this->load->model("karyawan_model");
        $this->load->model("slipgaji_model");
        $this->load->model("Kehadiran_model");
        //$this->load->library("Pdf_Library");
        $this->load->library("pdf");

    }

    public function index()
    {
        $profile = $this->karyawan_model->getProfile();
        $ide = $this->session->userdata('karyawan_ID');
        
        foreach ($profile as $p)
        {
            $id = $p['karyawan_ID'];
        }
        
        $notifikasi = $this->karyawan_model->getNotifikasi($id);
        $total = $this->karyawan_model->getCountNotifikasi($id);
        //$slipgaji = $this->slipgaji_model->getSlipGaji($id);
        $slipgaji = $this->slipgaji_model->get_periodegaji_list($id);
        $this->load->view('slipgaji/slipgaji', array('profile' => $profile, 'slipgaji' => $slipgaji, 'notifikasi' => $notifikasi, 'total' => $total));
    }

    public function report($id_slip)
    {

        $slip = $this->slipgaji_model->reportSlipGaji($id_slip);

        foreach ($slip as $data)
        {
            $kode = $data['karyawan_ID'];
            $nama = $data['nama_lengkap'];
            $NPWP = $data['nomor_npwp'];

            $gaji_pokok = $data['gaji_pokok'];
            $conv_gaji_poko = number_format($gaji_pokok, 2, '.', '.');
            $uang_lembur = 2500 * $data['lembur'];
            $conv_lembur = number_format($uang_lembur, 2, '.', '.');
            $tunjangan_makan = $data['tunjangan_makan'];
            $conv_tunjangan_makan = number_format($tunjangan_makan, 2, '.', '.');
            $THR = $data['THR'];
            $conv_thr = number_format($THR, 2, '.', '.');
            $tunjangan_transportasi = $data['tunjangan_transportasi'];
            $conv_transportasi = number_format($tunjangan_transportasi, 2, '.', '.');
            $tunjangan_keluarga = $data['tunjangan_keluarga'];
            $conv_keluarga = number_format($tunjangan_keluarga, 2, '.', '.');
            $NPP_BPJS_Ketenagakerjaan = $data['NPP_BPJS_Ketenagakerjaan_v'];
            $conv_bpjs = number_format($NPP_BPJS_Ketenagakerjaan, 2, '.', '.');
            $NPP_BPJS_Kesehatan = $data['NPP_BPJS_Kesehatan_v'];
            $conv_bpjs_kesehatan = number_format($NPP_BPJS_Kesehatan, 2, '.', '.');

            $PPh21 = $data['potonganPPh21'];
            $conv_pph21 = number_format($PPh21, 2, '.', '.');
            $pinjaman = $data['pinjaman'];
            $conv_pinjaman = number_format($pinjaman, 2, '.', '.');
            $pajak = $data['pajak'];
            $conv_pajak = number_format($pajak, 2, '.', '.');
            $ketidakhadiran = 25000 * $data['ketidakhadiran'];
            $conv_ketidakhadiran = number_format($ketidakhadiran, 2, '.', '.');

            $pendapatan = $gaji_pokok + $uang_lembur + $tunjangan_makan + $THR + $tunjangan_transportasi + $tunjangan_keluarga + $NPP_BPJS_Ketenagakerjaan + $NPP_BPJS_Kesehatan;
            $conv_pendapatan = $conv_ketidakhadiran = number_format($pendapatan, 2, '.', '.');
            $pemotongan = $PPh21 + $pinjaman + $pajak + $ketidakhadiran ;
            $conv_pemotongan = $conv_ketidakhadiran = number_format($pemotongan, 2, '.', '.');
            $total = $pendapatan - $pemotongan ;
            $hasil = number_format($total, 2, '.', '.');

            $periode = date('m/Y', strtotime($data['tanggal']));
            $bagian = $data['bagian'];
        }


        // create new PDF document
        $pdf = new Pdf_Library(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('PT. Kreasi Digital Sinergi');
        $pdf->SetTitle('PT. Kreasi Digital Sinergi');
        $pdf->SetSubject('Slip Gaji');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // set default header data
        $pdf->SetHeaderData('image_demo.jpg', "24", "PT. Kreasi Digital Sinergi", "Slip Gaji Karyawan");

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', "15"));
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
        <td>Rp. {$conv_gaji_poko}</td>
        <td>Potongan PPh21</td>
        <td>Rp. {$conv_pph21}</td>
    </tr>
    <tr>
        <td>Uang Lembur</td>
        <td>RP. {$conv_lembur}</td>
        <td>Pinjaman</td>
        <td>Rp. {$conv_pinjaman}</td>
    </tr>
    <tr>
        <td>Tunjangan Makan</td>
        <td>Rp. {$conv_tunjangan_makan}</td>
        <td>Pajak</td>
        <td>Rp. {$conv_pajak}</td>
    </tr>
    <tr>
        <td>THR</td>
        <td>Rp. {$conv_thr}</td>
        <td>Ketidakhadiran</td>
        <td>Rp. {$conv_ketidakhadiran}</td>
    </tr>
    <tr>
        <td>Tunjangan Transportasi</td>
        <td>Rp. {$conv_transportasi}</td>
    </tr>
    <tr>
        <td>Tunjangan Keluarga</td>
        <td>Rp. {$conv_keluarga}</td>
    </tr>
    <tr>
        <td>NPP BPJS Ketenagakerjaan</td>
        <td>Rp. {$conv_bpjs}</td>
    </tr>
    <tr>
        <td>NPP BPJS Kesehatan</td>
        <td>Rp. {$conv_bpjs_kesehatan}</td>
    </tr>
    
<hr>
    <tr>
    <td>Total Pendapatan</td>
    <td>Rp. {$conv_pendapatan}</td>
    </tr>
    <tr>
    <td>Total Pemotongan</td>
    <td>Rp. {$conv_pemotongan}</td>
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
    
    public function reportPDF()
    {
		$masterGajiID = $this->uri->segment('3');
        $id = $this->uri->segment('4');
        $periodeDate = $this->uri->segment('6');
        
        //$data['karir'] = $this->Karyawan_model->get_karir($id);
		//$data['karyawan'] = $this->Karyawan_model->get_karyawan_detail($id);
		
        //now pass the data//
		$this->data['title']="MY PDF TITLE 1.";
		$this->data['description']="";
		//$this->data['description']=$this->official_copies;

		//$this->load->view('gaji/slipgajidompdf');
		//$this->load->view('gaji/slipgajitopdf');
		$html=$this->load->view('slipgaji/slipgajipdf',$this->data, true);
		
		//$html = $this->output->get_output();
		$pdfFilePath ="mypdfName-".time()."-download.pdf";

		$pdf = $this->pdf->load();
		//generate the PDF!
		$pdf->WriteHTML($html,2);
		//offer it to user via browser download! (The PDF won't be saved on your server HDD)
		$pdf->Output($pdfFilePath, "I");

		// Convert to PDF
		/*
		$this->dompdf->load_html($html);        
		$this->dompdf->render();
		$this->dompdf->stream("namaSlip-dateAkhirPeriode-idKaryawan-namaKaryawan.pdf");
		//*/
	}
    
    /*public function slipgajipdf(){
        $this->load->view(slipgaji/slipgajipdf);
    }*/
}