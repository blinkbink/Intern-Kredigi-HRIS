<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan_model extends MY_Model {
	
	protected $_table_name = 'karyawan';
	protected $_primary_key = 'karyawan_ID';
	protected $_order_by = 'karyawan_ID';
	protected $_order_by_type = 'ASC';

	public $rules = array(
		'nama_data' => array(
            'field' => 'nama_lengkap',
            'label' => 'Nama Lengkap',
            'rules' => 'trim|required'
		)
	);	

	
	function __construct() {
		parent::__construct();
	}	
	

	function get_karyawan_detail($id=NULL,$key=NULL){
		$this->db->where('perusahaan_ID',$this->session->userdata('perusahaan_ID'));
		$info = parent::get($id);
		if($key!=NULL)
			return  $info->$key;
		else
			return $info;
	}
	function get_karir($id=NULL,$key=NULL){
		$this->db->where('karyawan_ID',$id);
		$this->db->where('stat_efektif','1');
		$record = $this->db->get('karyawan_karir')->row();
		if(!empty($record)){			
			if($key!=NULL)
				return $this->Data_model->get_data_detail($record->$key,'nama_data');
			else
				return $record;
		}
		else{
			return '';
		}

		
	}
}