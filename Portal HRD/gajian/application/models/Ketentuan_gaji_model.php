<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Data_model extends MY_Model {
	
	protected $_table_name = 'data_perusahaan';
	protected $_primary_key = 'data_ID';
	protected $_order_by = 'data_ID';
	protected $_order_by_type = 'ASC';

	public $rules = array(
		'nama_data' => array(
            'field' => 'nama_data',
            'label' => 'Data',
            'rules' => 'trim|required'
		)
	);	

	
	function __construct() {
		parent::__construct();
	}	
	
	function data_use($where){
		$this->db->where($where);
		//$this->db->from('karyawan_karir');
		return $this->db->count_all_results('karyawan_karir');
	}

	function komponen_use($where){
		$this->db->where($where);
		//$this->db->from('karyawan_karir');
		return $this->db->count_all_results('karyawan_karir');
	}

	function pendapatan_utama(){
		$option=array(
		'0' => array(
            'nama' => 'Gaji Pokok (Basic Salary)',
            'tipe' => 'Gaji Pokok'
		),
		'1' => array(
            'nama' => 'Tunjangan Hari Raya (THR)',
            'tipe' => 'THR'
		),
		'2' => array(
            'nama' => 'Uang Lembur (overtime)',
            'tipe' => 'Uang Lembur'
		)

	);
		//return json_encode($option);
		return $option;
		
	}

	function get_data_detail($id=NULL,$key=NULL){
		$info = parent::get($id);
		if($key!=NULL)
			return  $info->$key;
		else
			return $info;
	}
}