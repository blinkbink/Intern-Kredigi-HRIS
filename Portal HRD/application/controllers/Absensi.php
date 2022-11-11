<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends MY_Controller {

  public function __construct(){
    parent::__construct();    
    
   $this->load->model(array('Slip_gaji_model','Karir_model','Karyawan_model','Data_model','Absensi_model'));
   $this->load->helper(array('tgl_indo_helper', 'form', 'url'));
   $this->load->library(array());
   $this->load->library("PHPExcel");
   //$this->load->model("phpexcel_model");
  }

  public function index($tgl=NULL)
  {
    $post=$this->input->post(NULL,TRUE);  
    $tgl=$tgl!=NULL ? $tgl : date('Y-m-d');
    $tgl=(!empty($post['tanggal'])) ? date('Y-m-d',strtotime($post['tanggal'])) : $tgl;
    //echo $tgl;
    $data=array('hari_ini'=>$tgl);
    $this->session->set_flashdata($data);
    redirect('absensi/data',$data);
  }
  public function data()
  {
    $data = $this->session->flashdata();
    //$listStatus = $this->Absensi_model->getListStatusKehadiran();
    $this->load->view('absensi/data',$data);
    //$this->load->view('absensi/rekap', array('data' => $data, 'listStatus' => $listStatus));
  }
  public function rekap()
  {
    $dateAwal = $this->uri->segment('3');
    $dateAkhir = $this->uri->segment('4');
    //$data['karyawan'] = $this->Karyawan_model->get_karyawan_list();
    $data['karyawan'] = $this->Karyawan_model->get_karyawan_detail();
    //$data['absensi'] = $this->Absensi_model->getListAbsensi($dateAwal, $dateAkhir);
    $this->load->view('absensi/rekap', $data);
  }
   public function personal($id)
  {
    $data['karyawan'] = $this->Karyawan_model->get_karyawan_detail($id);
    $this->load->view('absensi/personal',$data);
  }

  public function hitungPersentase($number)
  {
    $total = $this->Karyawan_model->getTotal();
    echo $total;
    echo $number;
    $persen = ($number/$total) * 100;
    echo $persen;
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
  
      public function update_alasan(){
            $karyawanID = $this->input->post("user_id");
            $absenID = $this->input->post("id_absensi");
            $alasan = $this->input->post("alasan");
            
            //echo ". Absen id: ".$absenID." dan alasan: ".$alasan." serta karyaID: ".$karyawanID;
            if(!empty($absenID) && $absenID > 0){
                //echo "masok";
                $where = array(
                    'id_absensi' => $absenID,
                );
                
                $data = array(
                    'alasan_telat' => $alasan,
                );
                
                $this->Absensi_model->edit_data($where, $data, 'absensi');
                redirect(site_url('absensi/data'));
            }
      }
      
  public function ekspor_excel(){
	$dateAwal = $this->uri->segment('3');
    	$dateAkhir = $this->uri->segment('4');

	$dateAwal = DateTime::createFromFormat('d-m-Y', $dateAwal)->format('Y-m-d');
	$dateAkhir = DateTime::createFromFormat('d-m-Y', $dateAkhir)->format('Y-m-d');

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
	$subscribers = $this->Karyawan_model->get_karyawan_detail();
	//$subscribers = $this->Absensi_model->getDataAbsensiRekap($kode_absensi, $tanggalAwal, $tanggalAkhir);
	
	//nama perusahaan
	$perusahaan = $this->Perusahaan_model->get(get_user_info('perusahaan_ID'));

	require_once APPPATH . '/third_party/Phpexcel/Bootstrap.php';

	//membuat objek spreadsheet baru
	$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
	
	//set properti dokumen
	$spreadsheet->getProperties()->setCreator('kredigi.co.id')
	->setLastModifiedBy('Kredigi Team')
	->setTitle('Rekap Absensi')	
	->setSubject('Rekap Absensi Alia Group')
	->setDescription('rekap bulanan absensi');

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

	$spreadsheet->getActiveSheet()->getStyle('A1:A3')->applyFromArray($styleBold);
	$spreadsheet->getActiveSheet()->getStyle('A6:B7')->applyFromArray($styleArrayOutBorder);
	$spreadsheet->getActiveSheet()->getStyle('G6:G7')->applyFromArray($styleArrayOutBorder);
	$spreadsheet->getActiveSheet()->getStyle('C6:F7')->applyFromArray($styleArrayFullBorder);

	//autofit column based content
	foreach(range('B','F') as $columnID){
		$spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
	}

	//khusus kolom A diset lebar manual
	$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(4);
	$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(40);

	//merge cell
	$spreadsheet->getActiveSheet()
	->mergeCells('A1:G1')
	->mergeCells('A2:G2')
	->mergeCells('A3:G3')
	->mergeCells('C6:D6')
	->mergeCells('E6:F6');

	//set the names of header cells
	$spreadsheet->setActiveSheetIndex(0)
	->setCellValue("A1",'REKAPITULASI DAFTAR HADIR KARYAWAN')
	->setCellValue("A2",strtoupper($perusahaan->nama_perusahaan))
	->setCellValue("A3",'PERIODE '.$periode)
	//->setCellValue("A5",'22 hari kerja / 4 x Sabtu')
	->setCellValue("A6",'NO.')
	->setCellValue("B6",'MANAGER & STAFF')
	->setCellValue("C6",'UMK')
	->setCellValue("C7",'Senin - Jumat')
	->setCellValue("D7",'Sabtu')
	->setCellValue("E6",'UML')
	->setCellValue("E7",'Senin - Jumat')
	->setCellValue("F7",'Sabtu')
	->setCellValue("G6",'KETERANGAN');
	//->setCellValue dst

	//data dari database
	$i=8;
	$x=1;
	foreach($subscribers as $sub){
	    $rekapA = $this->Absensi_model->getDataAbsensiRekap($sub->kode_absensi, $dateAwal, $dateAkhir, $sub->karyawan_ID);
	    foreach($rekapA as $rek){
            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue("A5",$rek['totalHariKerja']." hari kerja / ".$rek['totalHariSabtu']." x Sabtu")
            ->setCellValue("A$i",$x)
            ->setCellValue("B$i",$sub->nama_lengkap)
            ->setCellValue("C$i",$rek['totalAbsensi'])
            ->setCellValue("D$i",$rek['kerjaSabtu'])
            ->setCellValue("E$i",$rek['totalLembur'])
            ->setCellValue("F$i",$rek['lemburSabtu'])
            ->setCellValue("G$i",$rek['totalKetidakhadiran']."xOFF (".$rek['totalSakit']." sakit | ".$rek['totalIzin']." izin | ".$rek['totalCuti']." cuti | ".$rek['totalMangkir']." absen)");
            //$spreadsheet->getActiveSheet()->getStyle('A'.$i.':F'.$i)->applyFromArray($styleArrayFullBorderBiasa);
            //$spreadsheet->getActiveSheet()->getStyle('G'.$i)->applyFromArray($styleArrayFullBorderBiasaTengah);
            //->setCellValue dst
            $x++;
            $i++;
	    }
	}
    
    //set style
    $j = $i - 1;
    $spreadsheet->getActiveSheet()->getStyle('A'.$j.':F'.$j)->applyFromArray($styleArrayFullBorderBiasa);
    $spreadsheet->getActiveSheet()->getStyle('G'.$j)->applyFromArray($styleArrayFullBorderBiasaTengah);
        
	//rename worksheet
	$spreadsheet->getActiveSheet()->setTitle($perusahaan->nama_perusahaan);

	//set active sheet saat open excel
	$spreadsheet->setActiveSheetIndex(0);
	
	// Redirect output to a client's web browser (Excel2007)
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	//header('Content-Disposition: attachment;filename="subscribers_sheet.xlsx"'); //nama file
        header('Content-Disposition: attachment;filename="Rekap_Absensi_Periode_'.$periode.'_'.$perusahaan->nama_perusahaan.'.xlsx"'); //nama file
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
  }

    public function upload(){    
        //File upload path
        $perusahaanID = $this->session->userdata('perusahaan_ID');
        $file_name = $_FILES['myfile']['name'];
        $newfile_name= preg_replace('/[^A-Za-z0-9]/', "", $file_name);
        $config['upload_path']   = './uploads/'.$perusahaanID.'/';
        $config['allowed_types'] = 'ods|xls|xlsx';
        $config['remove_spaces'] = TRUE;
        $config['file_name']     = $file_name;
        //$config['max_size']      = 100;

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('myfile')){
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('absensi/data', $error);
        } else {
            $data = array('upload_data' => $this->upload->data());
            //-------
            $upload_data = $this->upload->data(); //Mengambil detail data yang di upload
            $filename = $upload_data['file_name'];//Nama File
            
            //konversi file xls ke ods untuk memastikan bahwa file xls dapat dibaca di format excel 2000
            /* disable dulu ga bekerja karena error: Array ( [0] => Error: Unable to connect or start own listener. Aborting. )
            exec('soffice --headless /dev/null; unoconv -f ods -o '.$file_name.'.ods '.$filename.' 2>&1', $output);
            print_r($output);
            //*/ 
            
            $this->Absensi_model->upload_data($filename);
            //unlink('./assets/uploads/'.$filename); //<< command buat menghapus file
            $success = array('success' => 'File '.$filename.' berhasil diunggah');
            $this->load->view('absensi/data', $success);
        }
    }
}
