<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//require 'application/libraries/spreadsheet/vendor/autoload.php';

class Upload extends CI_Controller {

	public function __construct(){
		parent::__construct();
			$this->load->helper(array('form', 'url'));
			$this->load->library("PHPExcel");
 		       	$this->load->model("phpexcel_model");
	}
/*
	public function index(){
		//$this->load->view('v_upload', array('error' => ' '));
		$data['absensi'] = $this->phpexcel_model->tampil_data()->result();
		$this->load->view('v_tampil',$data);
	}
//*/
	public function upload(){
		$this->load->view('v_upload', array('error' => ' '));
	}

	public function aksi_upload(){
		$file_name = $_FILES["berkas"]['name'];
		$newfile_name= preg_replace('/[^A-Za-z0-9]/', "", $file_name);

		$config['upload_path']		= './gambar/';
		$config['allowed_types']	= 'ods|xls|xlsx';
		$config['remove_spaces']	= TRUE;
		$config['file_name']		= $file_name;
		//$config['max_size']			= 100;	

		$this->load->library('upload', $config);

		if(!$this->upload->do_upload('berkas')){
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('v_upload', $error);
		} else {
			$data = array('upload_data' => $this->upload->data());
			//$this->load->view('v_upload_sukses', $data);

			//-------
			$upload_data = $this->upload->data(); //Mengambil detail data yang di upload
            $filename = $upload_data['file_name'];//Nama File           
            //$filename = $this->upload->data('orig_name');   //Nama File original

            //echo $filename;
            //$filename = substr($filename, 0, -1);
            //echo $filename;
            $this->phpexcel_model->upload_data($filename);
            //unlink('./assets/uploads/'.$filename);
            //redirect('php_excel/import/success','refresh');
            $this->load->view('v_upload_sukses', $data); 
		}
	}
}
