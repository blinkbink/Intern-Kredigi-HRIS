<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Excel extends MY_Controller {

	public function __construct(){
		parent::__construct();		
		
		$this->load->model(array('Data_model','Absensi_model'));
		$this->load->helper(array());
		$this->load->library('Libexcel');
	}

	public function index(){
		$this->load->view('excel');
	}

	public function upload(){
        $this->load->library('upload', $this->site->file_upload_config());

      if ($this->upload->do_upload('file')){
      	$upload_data = $this->upload->data();
      	//print_r($upload_data);
      	iF($upload_data['file_ext']=='.xlsx'){
			$objReader= PHPExcel_IOFactory::createReader('Excel2007');	// For excel 2007 	
			$lanjut=true;  
		}
      	elseif ($upload_data['file_ext']=='.xls') {
  			$objReader =PHPExcel_IOFactory::createReader('Excel5');     //For excel 2003 
  			$lanjut=true;
  		}  
  		else{
  			echo 'bukan excel';
  			$lanjut=false;
  		}	

  		if($lanjut){
	  		$objReader = PHPExcel_IOFactory::createReaderForFile($upload_data['full_path']);
          //Set to read only
          $objReader->setReadDataOnly(true); 		  
        //Load excel file		
		 $objPHPExcel=$objReader->load($upload_data['full_path']);		 
         $totalrows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel      	 
         $objWorksheet=$objPHPExcel->setActiveSheetIndex(0);      

         //print_r($objWorksheet);          
          //loop from first data untill last data
          for($i=2;$i<=$totalrows;$i++)
          {
          	
             $id 		=$objWorksheet->getCellByColumnAndRow(1,$i)->getValue();			
             $nama 		=$objWorksheet->getCellByColumnAndRow(3,$i)->getValue();
             $tgl 		=$objWorksheet->getCellByColumnAndRow(5,$i)->getValue(); 
			 $masuk 	=$objWorksheet->getCellByColumnAndRow(9,$i)->getValue(); 
			 $pulang 	=$objWorksheet->getCellByColumnAndRow(10,$i)->getValue(); 
			 
			$karID=get_data_db('karyawan',$id,'karyawan_ID',TRUE);
			 if($karID!='<i> -None- </i>'){
				 $status= ($masuk!='') ? 'HHK' : '';
				 $new_tgl=date('Y-m-d',strtotime($tgl));
				// $array_data[]=
				$cek_data=get_data_db_by('Absensi',array('karyawan_ID'=>$karID,'absensi_tgl'=>$new_tgl,));
				$cek_input=count($cek_data);
					/**/
				if($cek_input==0)
				 $this->Absensi_model->insert(array(
				 		'karyawan_ID'=>$karID,
				 		'absensi_tgl'=>$new_tgl,
				 		'absensi_masuk'=>$masuk,
				 		'absensi_pulang'=>$pulang,
				 		'absensi_status'=>$status,
				 		'perusahaan_ID'=>get_user_info('perusahaan_ID'),
				 	));
				else
					 $this->Absensi_model->update(array(
				 		'absensi_status'=>$status,
				 		'absensi_masuk'=>$masuk,
				 		'absensi_pulang'=>$pulang,
				 	),array(
				 		'karyawan_ID'=>$karID,
				 		'absensi_tgl'=>$new_tgl,
				 	));
				/**/		  
			}
          }
      }
             unlink($upload_data['full_path']); //File Deleted After uploading in database .			 
             redirect(site_url('absensi/data'));
      }
       echo $this->upload->display_errors();

       
      
       //print_r($upload_data);

       //Path of files were you want to upload on localhost (C:/xampp/htdocs/ProjectName/uploads/excel/)	
       
		
			
	           
    }

	public function data_perusahaan(){
		$arrCol[] = array('urutan'=>1, 'nilai'=>'ID.','fontsize'=> '12', 'bold'=>true, 'namanya'=>'data_ID', 'format'=>'string');
		$arrCol[] = array('urutan'=>2, 'nilai'=>'id perusahaan.','fontsize'=> '12', 'bold'=>true,'namanya'=>'perusahaan_ID','format'=>'string');
		$arrCol[] = array('urutan'=>3, 'nilai'=>'kategori.','fontsize'=> '12', 'bold'=>true, 'namanya'=>'kategori_data','format'=>'string');
		$arrCol[] = array('urutan'=>4, 'nilai'=>'nama.','fontsize'=> '12', 'bold'=>true, 'namanya'=>'nama_data','format'=>'string');
		$arrCol[] = array('urutan'=>5, 'nilai'=>'status.','fontsize'=> '12', 'bold'=>true, 'namanya'=>'status_data','format'=>'string');
		$arrCol[] = array('urutan'=>6, 'nilai'=>'option.','fontsize'=> '12', 'bold'=>true, 'namanya'=>'option_data','format'=>'string');
		$rsl = $this->Data_model->get();
		$arrExcel = array('sNAMESS'=>'detanto', 'sFILNAM'=>'tes','col'=>$arrCol, 'rsl'=>$rsl);
		$this->libexcel->bangunexcel($arrExcel);
	}



	
}
