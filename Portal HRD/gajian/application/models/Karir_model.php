<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Karir_model extends MY_Model {
	
	protected $_table_name = 'karyawan_karir';
	protected $_primary_key = 'karir_ID';
	protected $_order_by = 'karir_ID';
	protected $_order_by_type = 'DESC';

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
	

	
	function get_data_karir($id=NULL,$key=NULL){
		$this->db->select('karyawan_ID,nama_lengkap');
		$this->db->where('perusahaan_ID',get_user_info('perusahaan_ID'));		
		$karyawan = $this->db->get('karyawan')->result();
		
		foreach ($karyawan as $key => $value) {
			$this->db->where('karyawan_ID',$value->karyawan_ID);	
			$this->db->order_by('karir_ID','DESC');
			$this->db->limit(1);	
			
			$karir[$value->karyawan_ID] = $this->db->get('karyawan_karir')->row();
		}
		return $karir;
	}

	function get_karir($id=NULL,$key=NULL){
		$info = parent::get($id);
		if($key!=NULL)
			return  $info->$key;
		else
			return $info;
	}
}