<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gaji extends MY_Controller {

	public function __construct(){
		parent::__construct();		
		
		$this->load->model(array('Slip_gaji_model','Karir_model','Karyawan_model','Data_model','Absensi_model'));
		$this->load->helper(array('tgl_indo_helper'));
		$this->load->library("pdf");
		//$this->load->library('Dom_pdf');
		$this->load->library(array());
		
	}

	public function index() {
		$date=date('Y-m-d');
		$this->Karir_model->update(array('tglStop'=>''.$date.''),array('stat_efektif'=>'1','group_gaji !='=>''));
		$data=$this->session->flashdata();
		
	    $this->load->view('gaji/index',$data);
        //$this->load->view('gaji/index');
	}

	public function option(){
		$get=$this->input->get(NULL,TRUE);
		
		$this->session->set_flashdata($get);

		redirect(site_url('gaji'));
	}

	public function personal($id){
		$data['karyawan'] = $this->Karyawan_model->get_karyawan_detail($id);
		$this->load->view('Gaji/personal',$data);
	}

	public function optionperiode(){
                //$get=$this->input->get(NULL,TRUE);
                //$this->session->set_flashdata($get);
		$masterGajiID = $this->uri->segment('3');
		$periode = $this->input->get('periode');
		$pisah = explode("/", $periode);
		$nama = $pisah[0];
		$awal = $pisah[1];
		$akhir = $pisah[2];
		//$num = $pisah[3];

		//echo "periode cuy: ".$periode;
                redirect(site_url('gaji/gajiperiode/'.$masterGajiID.'/'.$nama.'/'.$awal.'/'.$akhir));
        }

	public function gajiperiode(){
		//$masterGajiID =	$this->uri->segment('3');
		//$periodeAkhirDate = $this->uri->segment('4');
		//echo $masterGajiID." dan ";
		//echo $periodeAkhirDate;
		//$data['karyawan']= $this->Slip_gaji_model->get_periodegaji_detail($masterGajiID, $periodeAkhirDate)->result();
		$this->load->view('gaji/gajiperiode');
	}
	
	public function slipgaji_bak(){
        /*/
		$masterGajiID = $this->input->get('idmaster');
		$karyawanID = $this->input->get('idkaryawan');
		$periodeAwalDate = $this->input->get('dateawal');
		$periodeAkhirDate = $this->input->get('dateakhir');
        //*/
        
        $masterGajiID = $this->uri->segment('3');
        $karyawanID = $this->uri->segment('4');
        $periodeAwalDate = $this->uri->segment('5');
        $periodeAkhirDate = $this->uri->segment('6');

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
        
        //tanggal untuk tampilan
        $bln_awal = $this->getNamaBulan($bln_awal);
        $bln_akhir = $this->getNamaBulan($bln_akhir);

        $tanggal_awal = $tgl_awal.' '.$bln_awal.' '.$thn_awal;
        $tanggal_akhir = $tgl_akhir.' '.$bln_akhir.' '.$thn_akhir;
        
        $hitungGaji['tglPeriode'] = array(
            'tanggal_awal'=>$tanggal_awal,
            'tanggal_akhir'=>$tanggal_akhir,
        );
        
        $hitungGaji['pendapatan'] = $this->pendapatan($masterGajiID, $periodeAkhirDate, $karyawanID, $dateAwal, $dateAkhir);
        $hitungGaji['potongan'] = $this->potongan($masterGajiID, $periodeAkhirDate, $karyawanID);
        $hitungGaji['keterangan'] = $this->keterangan($masterGajiID, $periodeAkhirDate, $karyawanID);

        //var_dump($hitungGaji);
        //$hitungGaji = $this->hitungGaji($masterGajiID, $periodeAkhirDate, $karyawanID, $dateAwal, $dateAkhir);
		$this->session->set_userdata('referred_slip', current_url());
		$this->load->view('gaji/slipgaji', $hitungGaji);
	}
	
	public function slipgaji(){
        /*/
		$masterGajiID = $this->input->get('idmaster');
		$karyawanID = $this->input->get('idkaryawan');
		$periodeAwalDate = $this->input->get('dateawal');
		$periodeAkhirDate = $this->input->get('dateakhir');
        //*/
        
        $masterGajiID = $this->uri->segment('3');
        $karyawanID = $this->uri->segment('4');
        $periodeAwalDate = $this->uri->segment('5');
        $periodeAkhirDate = $this->uri->segment('6');
        
		$this->session->set_userdata('referred_slip', current_url());
		$this->load->view('gaji/slipgaji');
	}
	
    
    //tes pdf (not used, save for future)
	/*
	public function lamanpdf(){
		$this->load->view('gaji/lamanpdf');
	}
	//*/
	public function tespdf(){
		$karyawanID = $this->uri->segment('4');
		$data['karyawan'] = $this->Karyawan_model->get_karyawan_detail($karyawanID);
		$data['perusahaan'] = $this->Perusahaan_model->get_perusahaan_detail();
		$data['karir'] = $this->Karir_model->get_data_karir($karyawanID);
                $this->load->view('gaji/slipgajidompdf', $data);
        }
	//*/

	public function eksporkepdf(){
		$masterGajiID = $this->uri->segment('3');
                $id = $this->uri->segment('4');
                $periodeDate = $this->uri->segment('6');
                //echo $id."id".$masterGajiID;
                $data['karir'] = $this->Karir_model->get_karir($id);
		$data['karyawan'] = $this->Karyawan_model->get_karyawan_detail($id);
		//now pass the data//
		$this->data['title']="MY PDF TITLE 1.";
		$this->data['description']="";
		$this->data['description']=$this->official_copies;

		//$this->load->view('gaji/slipgajidompdf');
		//$this->load->view('gaji/slipgajitopdf');
		$html=$this->load->view('gaji/slipgajitopdf',$this->data, true);
		
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

	public function editslipgaji(){
		$this->load->view('gaji/editslipgaji');
	}

	public function update(){
		//get data post
		$id = $this->input->post('periode_gaji_id');
		$idItem = $this->input->post('kodeItem');
		$unit = $this->input->post('unit');
		$rate = $this->input->post('rate');
		$valueItem = $this->input->post('valueItem');
		
		/*
		$countItem = count($idItem);
		$countUnit = count($unit);
		$countRate = count($rate);
		$countValue = count($valueItem);
		/*
		echo "jumlah item array: ".$countItem."\n";
		var_dump($idItem);
                echo "jumlah unit array: ".$countUnit."\n";
		var_dump($unit);
                echo "jumlah rate array: ".$countRate."\n";
		var_dump($rate);
                echo "jumlah value array: ".$countValue."\n";
		var_dump($valueItem);
		//*/
		//membuat array id_periode_gaji untuk keperluan where dalam mysql
		$where = array(
                        'periode_gaji_ID' => $id,
                );

		//membaca data array untuk kemudian dipilah dan disimpan ke basisdata
		foreach( $idItem as $key => $iT ) {
		//for($key=0;$key < $countItem;$key++){
  			//print "The idItem is ".$idItem[$key]." and its value is ".$valueItem[$key].", thank you\n";
			if (!isset($dataGaji)) $dataGaji = new stdClass(); //biar ga warning null
			if(($rate[$key]) >= 0){
			 	//echo "oh there are rate ".$rate[$key]." sukroon\n";
				$dataGaji->$idItem[$key] = $rate[$key];
			} else {
				$removeDot = str_replace('.','',$valueItem[$key]); //buat menghilangkan dot desimal sebagai efek js buat menampilkan desimal 10.000
				$dataGaji->$idItem[$key] = $removeDot;
			}
			//menyimpan ke format json
			$json_dat = json_encode(@$dataGaji);
			if($unit[$key] >= 0){
				//echo "and unit is ".$unit[$key]." arigatorimakasi\n";
				//update/insert data unit
				$this->Slip_gaji_model->update_data_unit($id, $unit[$key], $idItem[$key]);
			}
		}
		//debug untuk keperluan cek kontrol data
		//var_dump($dataGaji);
		//var_dump($json_dat);

		//memutakhirkan data slip gaji ke database
		$dataArray = array( 'gaji_detail_bulanan' => $json_dat );
		$this->Slip_gaji_model->update_data_slip($where,$dataArray);
		
		//buat kembali ke page sebelumnya dengan kondisi terbaru
		$referred_slip = $this->session->userdata('referred_slip');
		redirect($referred_slip, 'refresh'); //<============= dimatiin dulu sementara buat debugging
	}

	public function changestatus(){
		//get data dari url
		$periodeID = $this->uri->segment('3');
		$status = $this->uri->segment('4');
		//echo $periodeID." daaan ".$status;

		//menentukan kondisi status
		if($status == "Belum"){
			$newstatus = "Sudah";
		} else {
			$newstatus = "Belum";
		}

		//meng-update status pembayaran di table periode_gaji
		$where = array('periode_gaji_ID'=>$periodeID);
		$data = array('status_pembayaran'=>$newstatus);
		$this->Slip_gaji_model->changeStatusPembayaran($where, $data);

		//balik ke laman sebelumnya
		$referred_from = $this->session->userdata('laman_slip_gaji');
		redirect($referred_from, 'refresh');
	}
    
    public function getNamaBulan($bulan){
        switch ($bulan) {
            case '1': $bulan = 'Januari'; break;
            case '2': $bulan = 'Februari'; break;
            case '3': $bulan = 'Maret'; break;
            case '4': $bulan = 'April'; break;
            case '5': $bulan = 'Mei'; break;
            case '6': $bulan = 'Juni'; break;
            case '7': $bulan = 'Juli'; break;
            case '8': $bulan = 'Agustus'; break;
            case '9': $bulan = 'September'; break;
            case '10': $bulan = 'Oktober'; break;
            case '11': $bulan = 'November'; break;
            case '12': $bulan = 'Desember'; break;
            default: break;
        }
        return $bulan;
    }
  
    public function pendapatan($masterGajiID, $periodeAkhirDate, $karyawanID, $dateAwal, $dateAkhir){
        $totalIncome = 0;
        $pendapatan = 0;
        $karir= $this->Slip_gaji_model->get_periodegaji_detail($masterGajiID, $periodeAkhirDate, $karyawanID);

        foreach($karir as $u => $value){
            $gaji=json_decode($value['json_gaji'], TRUE);
            $itemGaji = $this->Slip_gaji_model->getItemGaji($masterGajiID);

            foreach($itemGaji as $gg => $key){
                //Menghitung nilai pendapatan 
                if($key['kategori_data']=='pendapatan'){
                    if($key['option_data']=='Tergantung Kehadiran' || $key['option_data']=='Uang Lembur'){
                        $rate = $gaji[$key['data_ID']];
                        $namaItem = $key['nama_data'];

                        //Menghitung unit pendapatan tergantung kehadiran/lembur
                        $unitQ = $this->Slip_gaji_model->getUnit($value['periode_gaji_id'], $key['data_ID']);
                        if(!empty($unitQ)){ //jika ada di tabel unit_gaji
                            $unit = $unitQ[0]['unit'];
                        } else { //jika tidak ada hasilnya di tabel unit_gaji, cek tabel absensi
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
                    $totalIncome = $income + $totalIncome;
                    $pendapatan = array(
                        'namaItem' => $namaItem,
                        'unit' => $unit,
                        'rate' => $rate,
                        'income' => $income,
                        'totalIncome'=>$totalIncome,
                    );
                }
            }//close foreach $itemGaji
        }
        return $pendapatan;
    }
    
    public function potongan($masterGajiID, $periodeAkhirDate, $karyawanID){
        $totalPotongan = 0;
        $karir= $this->Slip_gaji_model->get_periodegaji_detail($masterGajiID, $periodeAkhirDate, $karyawanID);

        foreach($karir as $u => $value){
            $gaji=json_decode($value['json_gaji'], TRUE);
            $itemGaji = $this->Slip_gaji_model->getItemGaji($masterGajiID);

            foreach($itemGaji as $gg => $key){
                //Menghitung nilai potongan 
                if($key['kategori_data']=='potongan'){ //menghitung potongan gaji
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
                    $totalPotongan = $totalPotongan + $potong;
                    $potongan = array(
                        'nama_item' => $nama,
                        'potong' => $potong,
                        'totalPotongan'=>$totalPotongan,
                    );
                }
            }//close foreach $itemGaji
        }
        return $potongan;
    }
    
    public function keterangan($masterGajiID, $periodeAkhirDate, $karyawanID){
        $karir= $this->Slip_gaji_model->get_periodegaji_detail($masterGajiID, $periodeAkhirDate, $karyawanID);
        foreach($karir as $u => $value){
            $gaji=json_decode($value['json_gaji'], TRUE);
            
            $keterangan = array(
                'nama_lengkap' => $karir[0]['nama_lengkap'],
                'id_karyawan' => $karir[0]['id_karyawan'],
                'nama_slip' => $karir[0]['nama'],
                'jumlahRow' => $value['jumlahRow'],
                'tglEfektif' => $value['tglEfektif'],
            );
        }
        return $keterangan;
    }
    
    public function rekap_excel(){
        $idslip = $this->uri->segment('3');
        $namaPeriode = $this->uri->segment('4');
        $namaPeriode = str_replace("%20", " ", $namaPeriode); //menghilangkan karakter "%20"
        $dateAwal = $this->uri->segment('5');
        $dateAkhir = $this->uri->segment('6');

        //$dateAwal = DateTime::createFromFormat('d-m-Y', $dateAwal)->format('Y-m-d');
        //$dateAkhir = DateTime::createFromFormat('d-m-Y', $dateAkhir)->format('Y-m-d');

        //konversi tanggal
        $periodeAwalD = DateTime::createFromFormat('Y-m-d', $dateAwal)->format('d');
        $periodeAkhirD = DateTime::createFromFormat('Y-m-d', $dateAkhir)->format('d');

        $pMAw = DateTime::createFromFormat('Y-m-d', $dateAwal)->format('m');
        $pMAk = DateTime::createFromFormat('Y-m-d', $dateAkhir)->format('m');

        $yearAw= DateTime::createFromFormat('Y-m-d', $dateAwal)->format('Y');
        $yearAk= DateTime::createFromFormat('Y-m-d', $dateAkhir)->format('Y');
        $resultY = $yearAk - $yearAw;
        $resultM = $pMAk - $pMAw;
        if($resultY == 0){
           if($resultM > 0) {
            $periode = strtoupper($periodeAwalD.' '.$this->getNamaBulan($pMAw).' - '.$periodeAkhirD.' '.$this->getNamaBulan($pMAk).' '.$yearAk);
    //*
           } else {
            $periode = strtoupper($periodeAwalD.' - '.$periodeAkhirD.' '.$this->getNamaBulan($pMAk).' '.$yearAk);
           }
    //*/
        } else {
           $periode = strtoupper($periodeAwalD.' '.$this->getNamaBulan($pMAw).' '.$yearAw.' - '.$periodeAkhirD.' '.$this->getNamaBulan($pMAk).' '.$yearAk);
        }
        

        //mengambil data absen dari database
        //$subscribers = $this->Karyawan_model->get_karyawan_detail();
        $subscribers = $this->Slip_gaji_model->get_periodegaji_list($idslip, $dateAkhir);
        //$subscribers = $this->Karyawan_model->get_karyawan_all();
        //$subscribers = $this->Absensi_model->getDataAbsensiRekap($kode_absensi, $tanggalAwal, $tanggalAkhir);
        
        //nama perusahaan
        $perusahaan = $this->Perusahaan_model->get(get_user_info('perusahaan_ID'));

        require_once APPPATH . '/third_party/Phpexcel/Bootstrap.php';

        //membuat objek spreadsheet baru
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        
        //set properti dokumen
        $spreadsheet->getProperties()->setCreator('kredigi.co.id')
        ->setLastModifiedBy('Kredigi Team')
        ->setTitle('Rekap Gaji')	
        ->setSubject('Rekap Slip Gaji')
        ->setDescription('rekap gaji');

        //style header
        $styleArrayFullBorder = array(
            'font'=> array(
                'bold' => true,
            ),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical'=> \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,		
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ),
            ),
            'fill' =>array(
                'type' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
                'rotation' => 90,
                'startcolor' => array(
                    'argb' => 'FFA0A0A0',
                ),
                'endcolor' => array(
                    'argb' => 'FFFFFFFF',
                ),
            ),
        );

        $styleArrayOutBorder = array(
                    'font'=> array(
                            'bold' => true,
                    ),
                    'alignment' => array(
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'vertical'=> \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ),
                    'borders' => array(
                            'outline' => array(
                                    'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            ),
                    ),
                    'fill' =>array(
                            'type' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
                            'rotation' => 90,
                            'startcolor' => array(
                                    'argb' => 'FFA0A0A0',
                            ),
                            'endcolor' => array(
                                    'argb' => 'FFFFFFFF',
                            ),
                    ),
            );

        $styleBold = array(
            'font' => array(
                'bold' => true,
            ),
            'alignment' => array(
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'vertical'=> \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ),
        );

        $styleArrayFullBorderBiasaTengah = array(
                    'alignment' => array(
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'vertical'=> \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ),
                    'borders' => array(
                            'allborders' => array(
                                    'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            ),
                    ),
            );

        $styleArrayFullBorderBiasa = array(
                    'borders' => array(
                            'allborders' => array(
                                    'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            ),
                    ),
            );

        $styleIdentLeft = array(
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical'=> \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
            ),
        );
        
        $styleIdentRightBold = array(
            'font' => array(
                'bold' => true,
            ),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                'vertical'=> \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
            ),
        );
        
        $spreadsheet->getActiveSheet()->getStyle('A2:A3')->applyFromArray($styleBold);
        $spreadsheet->getActiveSheet()->getStyle('A8:O8')->applyFromArray($styleArrayFullBorder);
        //$spreadsheet->getActiveSheet()->getStyle('G6:G7')->applyFromArray($styleArrayOutBorder);
        //$spreadsheet->getActiveSheet()->getStyle('C6:F7')->applyFromArray($styleArrayFullBorder);

        //autofit column based content
        foreach(range('B','O') as $columnID){
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }

        //khusus kolom A diset lebar manual
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(4);
        //$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(10);
        //$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(40);
        //$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(40);

        //merge cell
        //*/
        $spreadsheet->getActiveSheet()
        ->mergeCells('A1:C1')
        ->mergeCells('A2:C2')
        ->mergeCells('A3:C3')
        ->mergeCells('A6:C6');
        //->mergeCells('E6:F6');
        //*/
        
        //freeze pane biar bisa liat walaupun digeser kiri/kanan
        $spreadsheet->getActiveSheet()->freezePane('E1');
        
        //set the names of header cells
        $spreadsheet->setActiveSheetIndex(0)
        //->setCellValue("A1",'REKAPITULASI DAFTAR HADIR KARYAWAN')
        ->setCellValue("A2",strtoupper($perusahaan->nama_perusahaan))
        ->setCellValue("A3",'LAPORAN REKAP GAJI KARYAWAN')
        ->setCellValue("A4",'NAMA SLIP: '.$namaPeriode)
        //->setCellValue("A5",'22 hari kerja / 4 x Sabtu')
        ->setCellValue("A6",'PERIODE '.$periode)
        ->setCellValue("A8",'NO')
        ->setCellValue("B8",'NIK')
        ->setCellValue("C8",'NAMA')
        ->setCellValue("D8",'STATUS WAJIB PAJAK')
        ->setCellValue("E8",'STATUS PERSONALIA')
        ->setCellValue("F8",'GAJI POKOK')
        ->setCellValue("G8",'TUNJANGAN LAIN-LAIN')
        ->setCellValue("H8",'UANG LEMBUR')
        ->setCellValue("I8",'TUNJANGAN BERBASIS KEHADIRAN')
        ->setCellValue("J8",'TOTAL PENDAPATAN')
        ->setCellValue("K8",'POTONGAN LAIN-LAIN')
        ->setCellValue("L8",'POTONGAN BPJS')
        ->setCellValue("M8",'TOTAL POTONGAN')
        ->setCellValue("N8",'TAKE HOME PAY');
        //->setCellValue("O8",'STATUS ABSENSI'); //<---------- sementara dihilangkan dulu
        //->setCellValue dst

        //data dari database
        $i=9;
        $x=1;
        foreach($subscribers as $sub){
            $rekapA = $this->Absensi_model->getDataAbsensiRekap($sub['kode_absensi'], $dateAwal, $dateAkhir, $sub['id_karyawan']);
            $jabatan = $this->Karyawan_model->get_jabatan($sub['jabatan_ID'])->result();
            //$karirA = $this->Karyawan_model->getKarir($sub->karyawan_ID);
            
            //mendecode json gaji
            $gaji=json_decode($sub['json_gaji'], TRUE);
            
            //mendapatkan value gaji pokok
            $idata = $this->Slip_gaji_model->getTipeData($idslip,'Gaji Pokok');            
            if(!empty($idata)){
                $pokok = $gaji[$idata['itemID']];
            } else {
                $pokok = 0;
            }
            
            //testing
            $itemGaji = $this->Slip_gaji_model->getItemGaji($idslip);
            $incomeHadir = 0;
            $incomeLembur = 0;
            $incomePokok = 0;
            $incomeTetap = 0;
            $incomeTHR = 0;
            $unit = 0;
            $potongManual = 0;
            $totpotongman = 0;
            $potongLainnya = 0;
            $potongBPJS = 0;
            foreach($itemGaji as $gg => $key){
                if($key['kategori_data']=='pendapatan'){
                    if($key['option_data']=='Tergantung Kehadiran' || $key['option_data']=='Uang Lembur'){
                        $rate = $gaji[$key['data_ID']];
                        //$namaItem = $key['nama_data'];
                        
                        $unitQ = $this->Slip_gaji_model->getUnit($sub['periode_gaji_id'], $key['data_ID']);
                        if(!empty($unitQ)){
                            $unit = $unitQ[0]['unit'];
                            //echo "ada unit di database!!".$unit;
                            if($key['option_data']=='Tergantung Kehadiran'){
                                $incomeHadir = $incomeHadir + ($unit * $rate);
                                //echo "saya+".$incomeHadir;
                            } elseif($key['option_data']=='Uang Lembur'){
                                $incomeLembur = $incomeLembur + ($unit * $rate);
                                //echo "watpu".$incomeLembur;
                            }
                        } else { //jika tidak ada hasilnya di tabel unit_gaji, cek absensi
                            //echo "oh ga ada unit di database, ambil dari tabel absensi aja";
                            $absensi = $this->Absensi_model->getDataAbsensiRekap($sub['kode_absensi'],$dateAwal, $dateAkhir);
                            //var_dump($absensi);
                            if(!empty($absensi)){
                                if($key['option_data']=='Tergantung Kehadiran'){
                                    $unit = $absensi[0]['totalAbsensi'] + $absensi[0]['kerjaSabtu'];
                                    $incomeHadir = $incomeHadir + ($unit * $rate);
                                } elseif($key['option_data']=='Uang Lembur'){
                                    $unit = $absensi[0]['totalLembur'] + $absensi[0]['lemburSabtu'];
                                    $incomeLembur = $incomeLembur + ($unit * $rate);
                                }
                            }
                        }
                    } elseif($key['option_data']=='Gaji Pokok'){
                        $incomePokok = $gaji[$key['data_ID']];
                    } elseif($key['option_data']=='THR'){
                        $incomeTHR = $gaji[$key['data_ID']];
                    } elseif($key['option_data']=='Jumlah Tetap'){
                        $incomeTetap = $gaji[$key['data_ID']];
                    }
                } elseif($key['kategori_data']=='potongan') {
                    $nama = $key['nama_data'];
                    if($key['option_data']=='Manual'){
                        if(!empty($gaji[$key['data_ID']])){
                            $potongManual = $gaji[$key['data_ID']];
                        }
                        $totpotongman = $potongManual + $totpotongman;
                    }  elseif($key['option_data']=='BPJS') {
                        //$bpjs = $gaji[$key['data_ID']];
                        $potongBPJS = $incomePokok * 0.002;
                        //echo "ada";
                    }else {
                        $potongLainnya = $gaji[$key['data_ID']];
                        $totpotongman = $totpotongman + $potongLainnya;
                    }
                }
            }
            $tunjanganLain = $incomeTetap + ($incomeTHR * $incomePokok);
            
            //*
            //mendapatkan value gaji berbasis kehadiran
            //$idKeh = $this->Slip_gaji_model->getTipeData($idslip,'Kehadiran');
            //$hadirV = $gaji[$idKeh['itemID']];
 
            //if(!empty($idKeh)){
                //$hadirV = $gaji[$idKeh['itemID']];
                //$unitQ = $this->Slip_gaji_model->getUnit($sub['periode_gaji_id'], $idKeh['itemID']);
                /*
                if(!empty($unitQ)){
                    $unit = $unitQ[0]['unit'];
                } else { //jika tidak ada hasilnya di tabel unit_gaji, cek absensi
                    $absensi = $this->Absensi_model->getDataAbsensiRekap($sub['kode_absensi'],$dateAwal, $dateAkhir);
                    if($key['option_data']=='Tergantung Kehadiran'){
                        $unit = $absensi[0]['totalAbsensi'] + $absensi[0]['kerjaSabtu'];
                    } elseif($key['option_data']=='Uang Lembur'){
                        $unit = $absensi[0]['totalLembur'] + $absensi[0]['lemburSabtu'];
                    } else {
                        $unit = 0;
                    }
                }
                $valKeh = $unit * $hadirV;
                //*/
                //$valkeh = $hadirV;
            //} else {
                //$hadirV = 0;
                //$valKeh = 0;
            //} 
            //*/
            //$valKeh = $hadirV;
            foreach($rekapA as $rek){
                $spreadsheet->setActiveSheetIndex(0)
                //->setCellValue("A5",$rek['totalHariKerja']." hari kerja / ".$rek['totalHariSabtu']." x Sabtu")
                ->setCellValue("A$i",$x)
                ->setCellValue("B$i",$sub['nik'])
                ->setCellValue("C$i",$sub['nama_lengkap'])
                ->setCellValue("D$i",$sub['status_wp'])
                ->setCellValue("E$i",$jabatan[0]->nama_data)
                ->setCellValue("F$i",$incomePokok)//$pokok)
                ->setCellValue("G$i",$tunjanganLain)
                ->setCellValue("H$i",$incomeLembur)
                ->setCellValue("I$i",$incomeHadir)
                ->setCellValue("J$i","=SUM(F".$i.":I".$i.")")
                ->setCellValue("K$i",$totpotongman)
                ->setCellValue("L$i",$potongBPJS)
                ->setCellValue("M$i","=SUM(K".$i.":L".$i.")")
                ->setCellValue("N$i","=J".$i."-M".$i);
                //$spreadsheet->getActiveSheet()->getStyle('A'.$i.':O'.$i)->applyFromArray($styleArrayFullBorderBiasa);
                //$spreadsheet->getActiveSheet()->getStyle('G'.$i)->applyFromArray($styleArrayFullBorderBiasaTengah);
                //$spreadsheet->getActiveSheet()->getStyle('B'.$i)->applyFromArray($styleIdentLeft);
                //->setCellValue dst
                $x++;
                $i++;
            }
        }
        $j = $i + 2;
        $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue("D$j",'Total')
        ->setCellValue("F$j","=SUM(F9:F".$i.")")
        ->setCellValue("J$j","=SUM(J9:J".$i.")")
        ->setCellValue("N$j","=SUM(N9:N".$i.")");
        
        //set teks ke kiri/kanan bold
        $spreadsheet->getActiveSheet()->getStyle('B'.$i)->applyFromArray($styleIdentLeft);
        $spreadsheet->getActiveSheet()->getStyle('D'.$j.':N'.$j)->applyFromArray($styleIdentRightBold);
        
        //set style border box
        $k = $i - 1;
        $spreadsheet->getActiveSheet()->getStyle('A'.$k.':O'.$k)->applyFromArray($styleArrayFullBorderBiasa);
        $spreadsheet->getActiveSheet()->getStyle('G'.$k)->applyFromArray($styleArrayFullBorderBiasaTengah);
                
        //rename worksheet
        $spreadsheet->getActiveSheet()->setTitle($periode);

        //set active sheet saat open excel
        $spreadsheet->setActiveSheetIndex(0);
        //*
        // Redirect output to a client's web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        //header('Content-Disposition: attachment;filename="subscribers_sheet.xlsx"'); //nama file
        header('Content-Disposition: attachment;filename="'.$namaPeriode.'_'.$periode.'_'.$perusahaan->nama_perusahaan.'.xlsx"'); //nama file
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Excel2007');
        $writer->save('php://output');
        exit;
        //*/
    }
}
