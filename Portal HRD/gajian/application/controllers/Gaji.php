<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gaji extends MY_Controller {

	public function __construct(){
		parent::__construct();		
		
		$this->load->model(array('Slip_gaji_model','Karir_model','Karyawan_model','Data_model'));
		$this->load->helper(array('tgl_indo_helper'));
		$this->load->library(array());
		
	}

	public function index() {
		$date=date('Y-m-d');
		$this->Karir_model->update(array('tgl_stop'=>''.$date.''),array('stat_efektif'=>'1','group_gaji !='=>''));
		$data=$this->session->flashdata();
		
	    $this->load->view('gaji/index',$data);
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
        
	
}
