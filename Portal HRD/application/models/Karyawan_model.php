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
	    //'absensiID' => 'absensi_ID'
            'rules' => 'trim|required'
		)
	);	

	
	function __construct() {
		parent::__construct();
	}	
	

	function get_karyawan_detail($id=NULL,$key=NULL){
		$this->db->where('perusahaan_ID',$this->session->userdata('perusahaan_ID'));
		$this->db->order_by('nama_lengkap', 'asc'); 
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

	function getTotal(){
		$total = $this->db->count_all_results('karyawan');
		return $total;
	}

	function get_karyawan_list(){
		$this->db->from('karyawan');
		$this->db->where('perusahaan_ID',$this->session->userdata('perusahaan_ID'));
		return $this->db->get();
	}
    
    function get_jabatan($dataID){
        $this->db->where('data_ID',$dataID);
        return $this->db->get('data_perusahaan');
    }
    
    function get_user($karyawanID){
        $kodet = array();
        $this->db->from('user');
        $this->db->where('karyawan_ID',$karyawanID);
        $this->db->where('group','Karyawan');
        $this->db->where('perusahaan_ID',$this->session->userdata('perusahaan_ID'));
        $query = $this->db->get();
        
        foreach ($query->result_array() as $key){
            $kodet = array(
                'ID' => $key['ID'],
                'username' => $key['username'],
                'perusahaan_ID' => $key['perusahaan_ID'],
                'karyawan_ID' => $key['karyawan_ID'],
                'group' => $key['group'],
                'password' => $key['password'],
                'email' => $key['email'],
                'activation_code' => $key['activation_code'],
                'active' => $key['active'],
            );
        }
        return $kodet;
    }
    
    function changeStatusPortal($where, $data){
		$this->db->where($where);
		$this->db->update('user',$data);
	}
}
