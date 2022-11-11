<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends MY_Controller {

  public function __construct(){
    parent::__construct();    
    
   $this->load->model(array('Slip_gaji_model','Karir_model','Karyawan_model','Data_model'));
   $this->load->helper(array('tgl_indo_helper'));
    $this->load->library(array());
    
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
    $this->load->view('absensi/data',$data);
  }
  public function rekap()
  {
    $this->load->view('absensi/rekap');
  }
   public function personal($id)
  {
   $data['karyawan'] = $this->Karyawan_model->get_karyawan_detail($id);
    $this->load->view('absensi/personal',$data);
  }     
	
}
